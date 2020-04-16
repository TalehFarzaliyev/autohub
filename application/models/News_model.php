<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends Main_Model {

	public $table = 'news';
	public $primary_key = 'id';
	public $table_image = 'wc_news_images';
	public $table_video = 'wc_news_videos';

	public $relation_tables = [
		[
			'name'		=> 'news_translation',
			'column'	=> 'news_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function search($lang_id,$status,$limit,$value)
	{
			$query = $this->db->query("
					SELECT a.id, b.name, a.view, a.image, a.created_at
					FROM ".$this->table." a
					INNER JOIN wc_news_translation b ON a.id = b.news_id
					WHERE b.lang_id = $lang_id AND a.status = $status AND b.name LIKE '%$value%'
					ORDER BY a.id DESC LIMIT $limit
			");
			return $query->result_array();
	}

	public function callback_get_image($data, $params = [])
	{
		if(!empty($data))
		{
			return "<img src='".$this->Model_tool_image->resize($data, $params['width'], $params['height'])."' width='".$params['width']."' height='".$params['height']."'>";
		}
		return;
	}

	public function insert_images($data)
	{
		$this->db->insert($this->table_image,$data);
	}

	public function insert_videos($data)
	{
		$this->db->insert($this->table_video,$data);
	}

	public function get_images($news_id)
	{
		$this->db->where('news_id', $news_id);
		$query = $this->db->get('news_images');
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return false;
	}

	public function get_videos($news_id)
	{
		$this->db->where('news_id', $news_id);
		$query = $this->db->get('news_videos');
		if($query->num_rows())
		{
			return $query->result();
		}
		return false;
	}

	public function get_news_images($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_image);
		$this->db->where('news_id', $id);
		$query = $this->db->get();

		if($query->num_rows())
			return $query->result();
	}

	public function delete_images($news_id)
	{
		$this->db->where('news_id', $news_id);
		$this->db->delete('news_images');
	}

	public function delete_videos($news_id)
	{
		$this->db->where('news_id', $news_id);
		$this->db->delete('news_videos');
	}

	public function get_news_ids($id)
    {
        $this->db->select('news_id');
        $this->db->from('wc_news_to_category');
        $this->db->where('category_id', $id);
        $query = $this->db->get();

        if($query->num_rows())
            return $query->result_array();
    }

    public function getCategoryNews($sql,$lang,$limit)
    {
        $query = $this->db->query("SELECT `news_id`, `name`, `name_text`, `slug`, `desc_text`, `image`, `created_at` 
                        FROM `wc_news` 
                        
                        JOIN `wc_news_translation` ON `wc_news`.`id` = `wc_news_translation`.`news_id` 
                        WHERE `status` = 1 AND `lang_id` ='$lang'  AND `news_id` IN($sql) AND `deleted_at` IS NULL ORDER BY `created_at` DESC LIMIT $limit");
        return $query->result_array();
    }

}
