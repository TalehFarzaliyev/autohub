<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Site_Controller {

	public function __construct()
	{
		$this->load_model = TRUE;
		parent::__construct();
		$this->load->model('Faq_model');
		$this->load->model('About_model');		
	}

	public function index($slug = false)
	{
		if($slug)
		{
			$about = $this->{$this->model}->get_rows('*', ['lang_id' => $this->data['current_lang_id'], 'slug' => $slug, 'status' => 1])[0];
			if($about)
			{
				$this->data['title'] 				= $about['name'];
				$this->data['template'] 			= $about['template'];
				$this->data['image'] 				= $this->Model_tool_image->resize($about['image'], 544, 589);
				$this->data['description'] 			= html_entity_decode($about['description'], ENT_QUOTES, 'UTF-8');
				$this->data['meta_title'] 			= $about['meta_title'];
				$this->data['meta_description'] 	= $about['meta_description'];
				$this->data['meta_keyword'] 		= $about['meta_keyword'];

				$this->data['sort'] = [
					'column'	=> 'sort',
					'order'		=> 'ASC'
				];

				$this->data['columns'] = ['id', 'name', 'description'];

				$this->data['filter']['status'] = 1;
				$this->data['filter']['lang_id'] = $this->data['current_lang_id'];

				$this->data['faqs'] = $this->Faq_model->get_rows($this->data['columns'], $this->data['filter'], $this->data['sort']);
				//echo '<pre>'; print_r($about); die();
				$this->render('about');
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
}