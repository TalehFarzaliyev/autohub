<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Site_Controller {

	public function __construct()
	{
		//$this->load_model = TRUE;
		parent::__construct();
		$this->load->model('Slider_model','slider');
		$this->load->model('News_model','news');
		$this->load->model('Menu_model','menu');
		$this->load->helper('general_helper');
	}

	public function index()
	{
		$this->data['title'] = translate('title');
		//news
			$this->data['filter']           = [];
			$this->data['filter']['status'] = 1;
			$this->data['filter']['lang_id']= $this->data['current_lang_id'];
			$this->data['sort'] 		    = [
				'column'	=> 'created_at',
				'order'		=> 'DESC'
			];
			$this->data['limit']            = [
				'per_page'	=> 25,
				'page'		=> 1
			];
			$news_list = $this->news->get_rows(['name','desc_text', 'created_at', 'slug', 'image'], $this->data['filter'], $this->data['sort'], $this->data['limit']);
            $news_list = partition($news_list,5);
			$this->data['news_list']['slider'] = $news_list[0];
            $this->data['news_list']['recent'] = $news_list[1];
            $this->data['news_list']['next']   = $news_list[2];
            $this->data['news_list']['most']   = $news_list[3];
            $this->data['news_list']['last_news'] = $news_list[4];
            //debug_data($this->data['news_list']['recent']); exit();
        //news

		$this->render('home');
	}
}