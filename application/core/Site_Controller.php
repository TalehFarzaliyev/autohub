<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Controller extends Main_Controller {

	public $load_model = FALSE;

	public function __construct()
	{		
		parent::__construct();

		if($this->load_model === TRUE)
		{
			$this->load->model($this->model);
		}

		$this->data['css'] = '';
		$this->data['main_css'] = '';
		$this->data['js'] = '';
		$this->data['script'] = '';
		$this->data['title'] = '';
		$this->data['description'] = '';
		$this->data['meta_title'] = '';
		$this->data['meta_description'] = '';
		$this->data['meta_keywords'] = '';

		
//		$this->load->library("Auth");
//
//		if ($this->auth->is_loggedin())
//		{
//			$this->data['user'] = [
//				'id'			=> $this->auth->get_user()->id,
//				'email'			=> $this->auth->get_user()->email,
//				'username'		=> $this->auth->get_user()->username,
//				'fullname'		=> $this->auth->get_user()->firstname." ".$this->auth->get_user()->lastname
//			];
//
//			$this->session->set_userdata($this->data['user']);
//		}

	}

	public function render($content = NULL, $template = 'default/layout')
	{
		$maintenance 	= 0;
		$theme 				= 'default';

		if($maintenance !== 0)
		{
			$content 	= $theme.'/maintenance';
			$template 	= $theme.'/layout_maintenance';
		}
		else
		{
			$content =  $theme.'/'.$content;
			$template 	= $theme.'/layout';
		}

		parent::render($content, $template);

	}
}