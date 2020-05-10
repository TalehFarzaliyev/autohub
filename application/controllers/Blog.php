<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Site_Controller {

	public function __construct()
	{
		parent::__construct();
		// Calendar //
		$this->load->model('News_model','news');
		$this->load->model('Category_model','category');
		$this->data['categories'] = $this->category->get_rows(['name', 'slug'], ['status' => 1, 'lang_id' => $this->data['current_lang_id']], ['column' => 'created_at', 'order' => 'ASC']);
	}

	public function index()
	{
		$this->data['title'] = translate('title');		
		$this->data['sort'] = [
			'column'	=> 'created_at',
			'order'		=> 'DESC'
		];
		$segment_array = $this->uri->segment_array();
		$page = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;


		$rows = $this->News_model->get_rows(['name', 'name_text', 'slug', 'description', 'desc_text','image', 'created_at','featured'], ['status' => 1, 'lang_id' => $this->data['current_lang_id'],'featured'=>1], $this->data['sort']);
		
		if($rows)
		{
			foreach($rows as $row)
			{
				if(!empty($row['image']) && count($row['image']) != 0)
				{
					$image = $row['image'];
					if(!$image)
					{
						$image = '/catalog/nophotonews.png';
					}
				}
				else
				{
					$image = '/catalog/nophotonews.png';
				}

				$this->data['news_list'][] = [
					'name'			=> $row['name'],
					'name_text' 	=> $row['name_text'],
					'slug'			=> $row['slug'],
					'description'	=> $row['description'],
					'desc_text'		=> $row['desc_text'],
					'featured'		=> $row['featured'],
					'created_at'=> ($row['created_at'] == null) ?  strftime("%e %b %G",strtotime($row['created_at']))  :   strftime("%e %b %G",strtotime($row['created_at'])),       //date('d M Y', strtotime($row['created_at'])) : date('d M Y', strtotime($row['published_date'])),
					'image'		=> $image
					//'href'		=> site_url_multi('news/'.$row['slug'].'/'.$row['news_id'])
				];
			}
		}
		else
		{
			$this->data['news_list'] = [];
		}

		$this->render('blog');
	}

	public function category($slug = false)
	{
        if($slug)
        {
            $segment_array          = $this->uri->segment_array();
            $page                   = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;
            $category               = $this->category->get_row(['*'], ['status' => 1, 'lang_id' => $this->data['current_lang_id'], 'slug' => $slug],[]);
            //echo $slug; die();
            //echo '<pre>'; print_r($category); exit();

            $this->data['category'] = ['name'=> $category['name'],'slug'=>base_url('kateqoriya/'.$category['slug'])];
            $this->data['title']    = translate('title');
            $news_ids               = $this->news->get_news_ids($category['id']);
            if(!empty($news_ids)) {
                $news_id_text = '';
                foreach ($news_ids as $item) {
                    $news_id_text .= $item['news_id'] . ',';
                }
                $news_id_text = rtrim($news_id_text, ',');
                $rows = $this->news->getCategoryNews($news_id_text, $this->data['current_lang_id'], 12);
                if ($rows) {
                    foreach ($rows as $row) {
                        if (!empty($row['image'])) {
                            $image = $row['image'];
                            if (!$image) {
                                $image = '/catalog/nophotonews.png';
                            }
                        } else {
                            $image = '/catalog/nophotonews.png';
                        }

                        $this->data['news_list'][] = [
                            'name'      => $row['name'],
                            'name_text' => $row['name_text'],
                            'slug'      => base_url('xeber/' . $row['slug']),
                            'desc_text' => $row['desc_text'],
                            'created_at'=> ($row['created_at'] == null) ? strftime("%e %b %G", strtotime($row['created_at'])) : strftime("%e %b %G", strtotime($row['created_at'])),       //date('d M Y', strtotime($row['created_at'])) : date('d M Y', strtotime($row['published_date'])),
                            'image'     => $image
                        ];
                    }
                } else {
                    $this->data['news_list'] = [];
                }
            }
            $this->render('category');
        }
        else
        {
            show_404();
        }
	}

	public function view($slug = false)
	{
		if($slug)
		{
			$news = $this->news->get_rows(['id', 'name', 'name_text', 'slug', 'description', 'desc_text', 'image', 'view', 'created_at'], ['status' => 1, 'lang_id' => $this->data['current_lang_id'], 'slug' => $slug]);
			$this->data['last_news'] = $this->news->get_rows(['name', 'slug', 'description', 'image', 'created_at'], ['status' => 1, 'lang_id' => $this->data['current_lang_id']], ['column' => 'created_at', 'order' => 'DESC', 'limit' => '8'], []);
			
			if($news)
			{
				$this->data['news'] = $news[0];
				//View Count
				$view = $news[0]['view']+1;
				$this->news->update(['view' => $view], $news[0]['id']);
				//View Count End
				$images = $this->news->get_images($news[0]['id']);
				$videos = $this->news->get_videos($news[0]['id']);
				$this->data['news']['created_at'] = strftime("%e %b %G",strtotime($news[0]['created_at']));

				if($images)
				{
					foreach($images as $image)
					{
						$this->data['galleries'][] = [
							'type'			=> 'image',
							'href' 			=> site_url('uploads/'.$image['images']),
							'image'			=> $image['images']
						];
					}
				}

				if($videos)
				{
					foreach($videos as $video)
					{
						$v = $this->youtube_id($video->video);
						$this->data['galleries'][] = [
							'type'			=> 'video',
							'href' 			=> 'https://www.youtube.com/embed/'.$v,
							'image'			=> 'https://img.youtube.com/vi/'.$v.'/hqdefault.jpg'
						];
					}
				}
				$this->render('details');
			}
			else
			{
				show_404();
			}
		}
		else
		{
			show_404();
		}
		
	}

	public function youtube_id($youtube_url)
	{
		parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $my_array_of_vars );
		return $my_array_of_vars['v']; 
	}

	public function month_()
	{
		$month_array = array(
			1   => 	array(1=>'January',     2=>'Yanvar',    3=>'Январь'),
			2   => 	array(1=>'Feburary',    2=>'Fevral',    3=>'Февраль'),
			3   => 	array(1=>'March',       2=>'Mart',      3=>'Март'),
			4   => 	array(1=>'April',       2=>'Aprel',     3=>'Апрель'),
			5   => 	array(1=>'May',         2=>'May',       3=>'Май'),
			6   => 	array(1=>'June',        2=>'Iyun',      3=>'Июнь'),
			7   => 	array(1=>'July',        2=>'Iyul',      3=>'Июль'),
			8   => 	array(1=>'August',      2=>'Avgust',    3=>'Август'),
			9   => 	array(1=>'September',   2=>'Sentyabr',  3=>'Сентябрь'),
			10  =>	array(1=>'October',     2=>'Oktyabr',   3=>'Октябрь'),
			11  =>	array(1=>'November',    2=>'Noyabr',    3=>'Ноябрь'),
			12  =>	array(1=>'December',    2=>'Dekabr',    3=>'Декабрь'),
		);
		return $month_array;
	}

	public function related($category_id=false)
    {

    }
}