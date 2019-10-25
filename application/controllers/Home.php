<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Site_Controller {

	public function __construct()
	{
		//$this->load_model = TRUE;
		parent::__construct();
		$this->load->model('Slider_model');
		$this->load->model('News_model');
	}

	public function index()
	{
		$this->data['title'] = translate('title');

		/*custom*/

		//Slider
			$this->data['columns']          = ['id', 'name','title','link', 'text', 'image', 'status'];
			$this->data['filter']           = [];
			$this->data['filter']['status'] = 1;
			$this->data['filter']['lang_id']= $this->data['current_lang_id'];
			$this->data['sort'] 		    = [
				'column'	=> 'sort',
				'order'		=> 'ASC'
			];
			$this->data['limit']            = [
				'per_page'	=> 10,
				'page'		=> 1
			];
			$this->data['slides'] = $this->Slider_model->get_rows($this->data['columns'], $this->data['filter'], $this->data['sort'], $this->data['limit']);
	    //slider

		$this->data['news_list'] = $this->News_model->get_rows(['name', 'slug', 'image'], ['status' => 1, 'lang_id' => $this->data['current_lang_id']], ['column' => 'created_at', 'order' => 'DESC'], ['per_page'	=> 4, 'page' => 1]);

		$this->render('home');
	}
}