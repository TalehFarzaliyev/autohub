<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {
	
	public $directory;
	public $controller;
	public $model;
	public $method;


	public function __construct()
	{
		parent::__construct();

		$this->directory 			= $this->router->directory;
		$this->controller 			= $this->router->class;
		$this->method 				= $this->router->method;
		$this->model 	  			= ucfirst($this->controller)."_model";

		


		$this->data['language_list'] = $this->Language_model->where(['status' => 1])->order_by('sort', 'ASC')->get_all();



	    if($this->data['language_list'] !== FALSE)
	    {
	      foreach($this->data['language_list'] as $language)
	      {

	        $this->data['langs'][$language->slug] = [
	        	'id'		=> $language->id,
	        	'name'		=> $language->name,
	        	'code'		=> $language->code,
	        	'directory'	=> $language->directory
	        ];

	        if($language->default == '1')
	        {
	        	$default_language 		= $language->slug;
	        	$default_language_id 	= $language->id;
	        }
	      }
	    }

 		$lang_slug = ($this->uri->segment(1)) ? $this->uri->segment(1) : "az";
	 
	    if(isset($lang_slug) && array_key_exists($lang_slug, $this->data['langs']))
	    {
	    	$current_lang 		= $lang_slug;
	    	$current_lang_id	= $this->data['langs'][$current_lang]['id'];
	    }
	    else
	    {
	    	if($this->session->has_userdata('current_lang'))
	    	{
	    		$current_lang 		= $this->session->userdata('current_lang');
	    		$current_lang_id	= $this->session->userdata('current_lang_id');
	    	}
	    	else
	    	{
	    		$current_lang 		= $default_language;
	    		$current_lang_id 	= $default_language_id;
	    	}
	    }
 		
	    if(isset($current_lang))
	    {
	    	$this->session->set_userdata('current_lang', $current_lang);
	    	$this->session->set_userdata('current_lang_id', $current_lang_id);

	    	$this->config->set_item('language',  $this->data['langs'][$current_lang]['directory']);

	    	$this->data['current_lang'] 	= $current_lang;
	    	$this->data['current_lang_id']	= $current_lang_id;
	    }
	    
		$this->data['controller'] 	= $this->controller;

		//Load Common Language File Per Controller
		$this->lang->load($this->directory.'common');		
		$this->data['text']['common'] = $this->lang->language;

		//Load Own Language File Per Controller
		$this->lang->load($this->directory.$this->controller);
		$this->data['text'][$this->controller] = $this->lang->language;
	}

	public function render($content = NULL, $template = 'admin/layout')
	{
		$this->data['content'] = $content;
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->smarty->view($template.'.tpl', $this->data);
	}
}

require_once('Admin_Controller.php');
require_once('Site_Controller.php');