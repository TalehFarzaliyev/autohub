<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_index_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_index_description'];

		$this->data['buttons'][] = [
			'type'	=> 'a',
			'text'	=> $this->data['text']['common']['common_header_button_create'],
			'href'	=> site_url($this->directory.$this->controller.'/create'),
			'class'	=> 'btn btn-success btn-labeled heading-btn',
			'id'	=> '',
			'icon'	=> 'icon-plus-circle2'
		];

		$this->data['buttons'][] = [
			'type'	=> 'a',
			'text'	=> $this->data['text']['common']['common_header_button_delete'],
			'href'	=> site_url($this->directory.$this->controller.'/delete'),
			'class'	=> 'btn btn-danger btn-labeled heading-btn',
			'id'	=> '',
			'icon'	=> 'icon-trash'
		];



		// Table Column
		$this->data['columns'] = ['id', 'name', 'directory', 'slug', 'code', 'default', 'status', 'sort'];

		$this->data['search_field'] = [
			'name'			=> [
				'property'		=> 'input',
				'type'			=> 'search',
				'name'          => 'name',
		        'class'			=> 'form-control',
		        'value'         => $this->input->get('name'),
		        'placeholder'	=> $this->data['text']['common']['common_search_placeholder'],
		    ]
		];

		//Filter
		$filter = [];
		if($this->input->get('status') != NULL) { $filter['status'] = $this->input->get('status'); }
		if($this->input->get('name') != NULL) { $filter['name'] = $this->input->get('name'); }


		$sort = [
			'column'	=> ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
			'order'		=> ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
		];

		$this->data['next_order'] = ($sort['order'] == 'ASC') ? 'DESC' : 'ASC';


		$this->data['per_page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : $this->data['per_page'];

		$this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';



		$total_rows = $this->{$this->model}->where($filter)->count_rows();
		$this->data['rows'] = $this->{$this->model}->fields($this->data['columns'])->as_array()->where($filter)->order_by($sort['column'], $sort['order'])->paginate($this->data['per_page'], $total_rows);

		$this->data['action'] = [
			'edit' 		=> TRUE,
			'delete'	=> TRUE,
			'custom'	=> [
				[
					'href'			=> site_url_multi('admin/translation/directory/'),
					'href_value'	=> 'directory',
					'icon'			=> 'icon-folder',
					'text'			=> $this->data['text'][$this->controller][$this->controller.'_translation']
				]
			]
		];


		$this->data['custom_rows'] = [
			[
				'column'	=> 'status',
				'data'		=> [
					'0'	=> '<span class="label label-danger">'.$this->data['text']['common']['common_disable'].'</span>',
					'1'	=> '<span class="label label-success">'.$this->data['text']['common']['common_enable'].'</span>'
				]
			],
			[
				'column'	=> 'default',
				'data'		=> [
					'0' => '',
					'1'	=> '<i class="icon-checkmark"></i>'
				]
			]
		];

		$this->data['table'] = parent::generate_table();


		//Pagination
		$config['base_url'] 			= site_url_multi($this->directory.$this->controller.'/index');
		$config['total_rows'] 			= $total_rows;
		$config['per_page'] 			= $this->data['per_page'];
		$config['reuse_query_string'] 	= TRUE;
		$config['use_page_numbers'] 	= TRUE;

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_all'],
			'href'			=> site_url($this->directory.$this->controller),
			'icon_class'	=> 'icon-database position-left',
			'label_value'	=> $this->{$this->model}->where()->count_rows(),
			'label_class'	=> 'label label-primary position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_active'],
			'href'			=> site_url($this->directory.$this->controller.'?status=1'),
			'icon_class'	=> 'icon-shield-check position-left',
			'label_value'	=> $this->{$this->model}->where(['status' => 1])->count_rows(),
			'label_class'	=> 'label label-success position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_deactive'],
			'href'			=> site_url($this->directory.$this->controller.'?status=0'),
			'icon_class'	=> 'icon-shield-notice position-left',
			'label_value'	=> $this->{$this->model}->where(['status' => 0])->count_rows(),
			'label_class'	=> 'label label-warning position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_trash'],
			'href'			=> site_url($this->directory.$this->controller.'/trash'),
			'icon_class'	=> 'icon-trash position-left',
			'label_value'	=> $this->{$this->model}->only_trashed()->count_rows(),
			'label_class'	=> 'label label-danger position-right'
		];

       	$this->render('index');
	}

	public function create()
	{
		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_create_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_create_description'];

		$this->data['buttons'][] = [
			'type'	=> 'a',
			'text'	=> $this->data['text']['common']['common_header_button_go_back'],
			'href'	=> site_url($this->directory.$this->controller.'/create'),
			'class'	=> 'btn btn-primary btn-labeled heading-btn',
			'id'	=> '',
			'icon'	=> 'icon-arrow-left8'
		];

		$this->breadcrumbs->push($this->data['text'][$this->controller][$this->controller.'_create_title'], $this->directory.$this->controller.'/create');


		// Form Fields
		$this->data['form_field'] = [
			'name' => [
				'name'          => 'name',
		        'id'            => 'name',
		        'class'			=> 'form-control',
		        'value'         => set_value('name'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name']
			],
			'directory' => [
				'name'          => 'directory',
		        'id'            => 'directory',
		        'class'			=> 'form-control',
		        'value'         => set_value('directory'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_directory']
			],
			'slug' => [
				'name'          => 'slug',
		        'id'            => 'slug',
		        'class'			=> 'form-control',
		        'value'         => set_value('slug'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_slug']
			],
			'code' => [
				'name'          => 'code',
		        'id'            => 'code',
		        'class'			=> 'form-control',
		        'value'         => set_value('code'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_code']
			],
			'default' => [
				'name'          => 'default',
		        'id'            => 'default',
		        'class'			=> 'styled',
		        'value'         => 1,
		        'checked'		=> (set_value('default')) ? TRUE : FALSE
			],
			'sort' => [
				'name'          => 'sort',
		        'id'            => 'sort',
		        'class'			=> 'form-control',
		        'value'         => (set_value('sort')) ? set_value('sort') : 0,
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_sort']
			],
			'status' => [
				'id'			=> 'status',
				'class' 		=> 'bootstrap-select',
				'data-style' 	=> 'btn-default btn-xs',
				'data-width'	=> '100%'
			]
		];

		// Form Buttons
		$this->data['form_button'] = [
			'submit' => [
		        'id'            => 'button',
		        'type'          => 'submit',
		        'content'       => $this->data['text'][$this->controller][$this->controller.'_form_button_submit'].' <i class="icon-arrow-right14 position-right"></i>',
		        'class'			=> 'btn btn-primary'
			],
			'reset' => [
		        'id'            => 'button',
		        'type'          => 'reset',
		        'content'       => $this->data['text'][$this->controller][$this->controller.'_form_button_reset'].' <i class="icon-reload-alt position-right"></i>',
		        'class'			=> 'btn btn-danger'
			],
		];


		// Form Select Options
		$this->data['options'] = [
			'status'	=> [$this->data['text']['common']['common_disable'], $this->data['text']['common']['common_enable']]
		];


		if($this->input->method() == 'post')
		{

			$insert = $this->{$this->model}->from_form()->insert();

			if ($insert == TRUE)
	        {
	        	$this->session->set_flashdata('message', $this->data['text'][$this->controller][$this->controller.'_form_success_create']);
	        	redirect(site_url_multi($this->directory.$this->controller), 'refresh');
	        }
	        else
	        {
	        	$this->data['message'] 		= (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	        }
		}


		$this->render('form');
	}

	public function edit($id)
	{
		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_edit_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_edit_description'];

		$this->data['buttons'][] = [
			'type'	=> 'a',
			'text'	=> $this->data['text'][$this->controller][$this->controller.'_header_button_go_back'],
			'href'	=> site_url($this->directory.$this->controller.'/create'),
			'class'	=> 'btn btn-primary btn-labeled heading-btn',
			'id'	=> '',
			'icon'	=> 'icon-arrow-left8'
		];

		$this->breadcrumbs->push($this->data['text'][$this->controller][$this->controller.'_edit_title'], $this->directory.$this->controller.'/edit/'.$id);


				// Form Fields
		$this->data['form_field'] = [
			'name' => [
				'name'          => 'name',
		        'id'            => 'name',
		        'class'			=> 'form-control',
		        'value'         => set_value('name'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name']
			],
			'directory' => [
				'name'          => 'directory',
		        'id'            => 'directory',
		        'class'			=> 'form-control',
		        'value'         => set_value('directory'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_directory']
			],
			'slug' => [
				'name'          => 'slug',
		        'id'            => 'slug',
		        'class'			=> 'form-control',
		        'value'         => set_value('slug'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_slug']
			],
			'code' => [
				'name'          => 'code',
		        'id'            => 'code',
		        'class'			=> 'form-control',
		        'value'         => set_value('code'),
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_code']
			],
			'default' => [
				'name'          => 'default',
		        'id'            => 'default',
		        'class'			=> 'styled',
		        'value'         => 1,
		        'checked'		=> (set_value('default')) ? TRUE : FALSE
			],
			'sort' => [
				'name'          => 'sort',
		        'id'            => 'sort',
		        'class'			=> 'form-control',
		        'value'         => (set_value('sort')) ? set_value('sort') : 0,
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_sort']
			],
			'status' => [
				'id'			=> 'status',
				'class' 		=> 'bootstrap-select',
				'data-style' 	=> 'btn-default btn-xs',
				'data-width'	=> '100%'
			]
		];

		// Form Buttons
		$this->data['form_button'] = [
			'submit' => [
		        'id'            => 'button',
		        'type'          => 'submit',
		        'content'       => $this->data['text'][$this->controller][$this->controller.'_form_button_submit'].' <i class="icon-arrow-right14 position-right"></i>',
		        'class'			=> 'btn btn-primary'
			],
			'reset' => [
		        'id'            => 'button',
		        'type'          => 'reset',
		        'content'       => $this->data['text'][$this->controller][$this->controller.'_form_button_reset'].' <i class="icon-reload-alt position-right"></i>',
		        'class'			=> 'btn btn-danger'
			],
		];


		// Form Select Options
		$this->data['options'] = [
			'status'	=> [
				$this->data['text']['common']['common_disable'],
				$this->data['text']['common']['common_enable']]
		];



		$this->render('form');
	}

	public function delete($id)
	{
		$this->{$this->model}->delete($id);
		echo json_encode(['success' => 1]);
	}

}
