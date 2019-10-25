<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_index_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_index_description'];

		$this->data['sort'] = [
			'column'	=> ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
			'order'		=> ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
		];

		$this->data['columns'] = ['id', 'name', 'description'];

		$this->data['search_field'] = [
			'name'			=> [
				'property'		=> 'input',
				'type'			=> 'search',
				'name'          => 'name',
		        'class'			=> 'form-control',
		        'value'         => $this->input->get('name'),
		        'placeholder'	=> $this->data['text']['common']['common_search_placeholder']
		    ]
		];

		$this->data['filter'] = [];

		if($this->input->get('name') != NULL) $this->data['filter']['name LIKE'] = "%".$this->input->get('name')."%";
	

		$this->data['total_rows'] = $this->{$this->model}->where($this->data['filter'])->count_rows();
		$segment_array = $this->uri->segment_array();
		$page = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;

		$this->data['rows'] = $this->{$this->model}->as_array()->fields($this->data['columns'])->where($this->data['filter'])->order_by($this->data['sort']['column'], $this->data['sort']['order'])->paginate($this->data['per_page'], $this->data['total_rows']);
		$this->data['next_order'] = ($this->data['sort']['order'] == 'ASC') ? 'DESC' : 'ASC';

   		$this->data['action'] = [
			'edit' 		=> TRUE,
			'delete'	=> TRUE,
			
		];

		$this->data['custom_rows'] = [
			[
				'column'	=> 'banned',
				'data'		=> [					
					'0'	=> "<span class='label label-danger'>{$this->data['text']['common']['common_disable']}</span>",
					'1'	=> "<span class='label label-success'>{$this->data['text']['common']['common_enable']}</span>"
				]
			]
		];


   		$this->data['table'] =  parent::generate_table();

		//Pagination
		$config['base_url'] 			= site_url_multi($this->directory.$this->controller.'/index');
		$config['total_rows'] 			= $this->data['total_rows'];
		$config['per_page'] 			= $this->data['per_page'];

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();

		$this->data['buttons'][] = [
			'type'	=> 'a',
			'text'	=> $this->data['text']['common']['common_header_button_create'],
			'href'	=> site_url($this->directory.$this->controller.'/create'),
			'class'	=> 'btn btn-success btn-labeled heading-btn',			
			'id'	=> '',
			'icon'	=> 'icon-plus-circle2'
		];

		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> $this->data['text']['common']['common_header_button_delete'],
			'href'		=> site_url($this->directory.$this->controller.'/delete'),
			'class'		=> 'btn btn-danger btn-labeled heading-btn',
			'id'		=> '',
			'icon'		=> 'icon-trash',
			'additional' => [
				'onclick'	=> "confirm('Are you sure?') ? $('#form-list').submit() : false;",
				'form' 		=> 'form-list',
				'formaction'=> site_url($this->directory.$this->controller.'/delete')
			]
		];
		

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_all'],
			'href'			=> site_url($this->directory.$this->controller.'/index'),
			'icon_class'	=> 'icon-database position-left',
			'label_value'	=> $this->{$this->model}->where()->count_rows(),
			'label_class'	=> 'label label-primary position-right'
		];
       	$this->render('index');
	}

	public function create()
	{
		$this->data['title'] 	= $this->data['text'][$this->controller][$this->controller.'_create_title'];
		$this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller.'_create_description'];

		$this->data['form_field']['general'] = [
			'name'		=> [
				'property'		=> 'input',
				'id'       		=> 'name',
				'name'          => 'name',
		        'class'			=> 'form-control',
		        'value'         => set_value('name'),
			    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name'],
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name'],
		        'validation'	=> ['rules' => 'required']
		    ],
		    'description'		=> [
				'property'		=> 'textarea',
				'name'          => 'description',
		        'class'			=> 'form-control',
		        'value'         => set_value('description'),
			    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_description'],
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
		        'validation'	=> ['rules' => 'required']
		    ]

		];

		foreach ($this->data['form_field']['general'] as $key => $value)
		{
			$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
		}

	

		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> $this->data['text']['common']['common_form_button_save'],
			'class'		=> 'btn btn-primary btn-labeled heading-btn',
			'id'		=> 'save',
			'icon'		=> 'icon-floppy-disk',
			'additional' => [
				'onclick'	=> "confirm('Are you sure?') ? $('#form-save').submit() : false;",
				'form' 		=> 'form-save',
				'formaction'=> current_url()
			]
		];

		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> $this->data['text']['common']['common_form_button_save_exit'],
			'class'		=> 'btn btn-success btn-labeled heading-btn',
			'id'		=> 'save_exit',
			'icon'		=> 'icon-floppy-disks',
			'additional' => [
				'onclick'	=> "confirm('Are you sure?') ? $('#form-save').submit() : false;",
				'form' 		=> 'form-save',
				'formaction'=> current_url()
			]
		];

		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> $this->data['text']['common']['common_form_button_reset'],
			'class'		=> 'btn btn-danger btn-labeled heading-btn',
			'id'		=> 'reset',
			'icon'		=> 'icon-reload-alt',
			'additional' => [
				'onclick'	=> "confirm('Are you sure?') ? $('#form-save').reset() : false;",
				'form' 		=> 'form-save',
				'formaction'=> current_url()
			]
		];

		$this->breadcrumbs->push($this->data['text'][$this->controller][$this->controller.'_create_title'], $this->directory.$this->controller.'/create');

		if($this->input->method() == 'post')
		{
			if ($this->form_validation->run() == TRUE)
            {
            	$general = [
            		'name'	=> $this->input->post('name'),
            		'description'	=> $this->input->post('description')
            	];

            	$this->{$this->model}->insert($general);
            	redirect(site_url_multi($this->directory.$this->controller));
            }
            else
            {
            	$this->data['message'] = $this->data['text']['common']['common_error_warning'];
            }
		}

       	$this->render('form');
	}

	public function edit($id)
	{
		if($id && ctype_digit($id))
		{
			$this->data['general'] = $this->{$this->model}->get($id);
			if($this->data['general'])
			{
				//Set title & description
				$this->data['title'] 	= $this->data['text'][$this->controller][$this->controller.'_edit_title'];
				$this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller.'_edit_description'];

				// Set General Form Field
				$this->data['form_field']['general'] = [
					'name'		=> [
						'property'		=> 'input',
						'id'       		=> 'name',
						'name'          => 'name',
				        'class'			=> 'form-control',
				        'value'         => (set_value('name')) ? set_value('name') : $this->data['general']->name,
					    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name'],
				        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name'],
				        'validation'	=> ['rules' => 'required']
				    ],
				    'description'		=> [
						'property'		=> 'textarea',
						'name'          => 'description',
				        'class'			=> 'form-control',
				        'value'         => (set_value('description')) ? set_value('description') : $this->data['general']->description,
					    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_description'],
				        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
				        'validation'	=> ['rules' => 'required']
				    ]

				];
				// Set Form Validation General Form Field
				foreach ($this->data['form_field']['general'] as $key => $value)
				{
					$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
				}


				$this->data['buttons'][] = [
					'type'		=> 'button',
					'text'		=> $this->data['text']['common']['common_form_button_save'],
					'class'		=> 'btn btn-primary btn-labeled heading-btn',
					'id'		=> 'save',
					'icon'		=> 'icon-floppy-disk',
					'additional' => [
						'onclick'	=> "confirm('Are you sure?') ? $('#form-save').submit() : false;",
						'form' 		=> 'form-save',
						'formaction'=> current_url()
					]
				];

				$this->data['buttons'][] = [
					'type'		=> 'button',
					'text'		=> $this->data['text']['common']['common_form_button_save_exit'],
					'class'		=> 'btn btn-success btn-labeled heading-btn',
					'id'		=> 'save_exit',
					'icon'		=> 'icon-floppy-disks',
					'additional'=> [
						'type'	=> 'submit'
					]
				];

				$this->data['buttons'][] = [
					'type'		=> 'button',
					'text'		=> $this->data['text']['common']['common_form_button_reset'],
					'class'		=> 'btn btn-danger btn-labeled heading-btn',
					'id'		=> 'reset',
					'icon'		=> 'icon-reload-alt',
					'additional' => [
						'onclick'	=> "confirm('Are you sure?') ? $('#form-save').reset() : false;",
						'form' 		=> 'form-save',
						'formaction'=> current_url()
					]
				];

				$this->breadcrumbs->push($this->data['text'][$this->controller][$this->controller.'_edit_title'], $this->directory.$this->controller.'/edit');

				if($this->input->method() == 'post' && $this->form_validation->run() == TRUE)
				{
					$general = [
	            		'name'	=> $this->input->post('name'),
	            		'description'	=> $this->input->post('description')
	            	];

	            	$this->{$this->model}->update($general, ['id' => $id]);
	            	redirect(site_url_multi($this->directory.$this->controller));
				}
				else
				{
					$this->data['message'] = $this->data['text']['common']['common_error_warning'];
					$this->render('form');
				}
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

	public function delete($id)
	{
		$this->{$this->model}->delete($id);
		echo json_encode(['success' => 1]);
	}

}
