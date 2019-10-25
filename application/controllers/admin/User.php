<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Group_model');
	}
	
	public function index()
	{
		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_index_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_index_description'];

		$this->data['sort'] = [
			'column'	=> ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
			'order'		=> ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
		];

		$this->data['columns'] = ['id', 'firstname', 'lastname', 'username', 'email', 'banned', 'last_activity'];

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

		if($this->input->get('name') != NULL) $this->data['filter']['username LIKE'] = "%".$this->input->get('name')."%";
		if($this->input->get('banned') != NULL) $this->data['filter']['banned'] = $this->input->get('banned');
	

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

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_active'],
			'href'			=> site_url($this->directory.$this->controller.'/index?banned=1'),
			'icon_class'	=> 'icon-shield-check position-left',
			'label_value'	=> $this->{$this->model}->where(['banned' => 1])->count_rows(),
			'label_class'	=> 'label label-success position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_deactive'],
			'href'			=> site_url($this->directory.$this->controller.'/index?banned=0'),
			'icon_class'	=> 'icon-shield-notice position-left',
			'label_value'	=> $this->{$this->model}->where(['banned' => 0])->count_rows(),
			'label_class'	=> 'label label-warning position-right'
		];
       	$this->render('index');
	}

	public function create()
	{
		$this->data['title'] 	= $this->data['text'][$this->controller][$this->controller.'_create_title'];
		$this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller.'_create_description'];

		$groups = $this->Group_model->get_rows('id,name',[]);
		$group = [];
		foreach ($groups as $item) {
			$group[''] = $this->data['text'][$this->controller][$this->controller.'_form_please_select'];
			$group[$item['id']] = $item['name'];
		}

		$this->data['form_field']['general'] = [
			'firstname'		=> [
				'property'		=> 'input',
				'id'       		=> 'firstname',
				'name'          => 'firstname',
		        'class'			=> 'form-control',
		        'value'         => set_value('firstname'),
			    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_firstname'],
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_firstname'],
		        'validation'	=> ['rules' => 'required']
		    ],
		    'lastname'		=> [
				'property'		=> 'input',
				'id'       		=> 'lastname',
				'name'          => 'lastname',
		        'class'			=> 'form-control',
		        'value'         => set_value('lastname'),
			    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_lastname'],
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_lastname'],
		        'validation'	=> ['rules' => 'required']
		    ],
		    'email'		=> [
				'property'		=> 'input',
				'type'			=> 'email',
				'id'       		=> 'email',
				'name'          => 'email',
		        'class'			=> 'form-control',
		        'value'         => set_value('email'),
			    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_email'],
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_email'],
		        'validation'	=> ['rules' => 'required|valid_email']
		    ],
		    'group_id'	=> [		    	
				'property'		=> 'dropdown',
				'name'			=> 'group_id',
		    	'id'			=> 'group_id',
		    	'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_group'],
				'class' 		=> 'bootstrap-select',
				'data-style' 	=> 'btn-default btn-xs',
				'data-width'	=> '100%',
				'options'		=> $group,				
		        'selected'      => set_value('group_id'),
		        'validation'	=> ['rules' => 'required']
		    ],
		    'username'		=> [
				'property'		=> 'input',
				'id'       		=> 'username',
				'name'          => 'username',
		        'class'			=> 'form-control',
		        'value'         => set_value('username'),
			    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_username'],
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_username'],
		        'validation'	=> ['rules' => 'required']
		    ],
		    'password'		=> [
				'property'		=> 'input',
				'type'			=> 'password',
				'id'       		=> 'password',
				'name'          => 'password',
		        'class'			=> 'form-control',
		        'value'         => set_value('password'),
			    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_password'],
		        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_password'],
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

		// $this->data['buttons'][] = [
		// 	'type'		=> 'button',
		// 	'text'		=> $this->data['text']['common']['common_form_button_save_exit'],
		// 	'class'		=> 'btn btn-success btn-labeled heading-btn',
		// 	'id'		=> 'save_exit',
		// 	'icon'		=> 'icon-floppy-disks',
		// 	'additional' => [
		// 		'onclick'	=> "confirm('Are you sure?') ? $('#form-save').submit() : false;",
		// 		'form' 		=> 'form-save',
		// 		'formaction'=> current_url()
		// 	]
		// ];

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
            		'firstname'	=> $this->input->post('firstname'),
            		'lastname'	=> $this->input->post('lastname'),
            		'email'	    => $this->input->post('email'),
            		'username'	=> $this->input->post('username'),
            		'password'	=> $this->input->post('password'),
            		'group_id'	=> $this->input->post('group_id')
            	];

            	$user_id = $this->auth->create_user($general['email'],$general['password'],$general['username'],$general['firstname'],$general['lastname'],$general['group_id']);
            	if($user_id){
            		redirect(site_url_multi($this->directory.$this->controller));            	
            	}
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
				$groups = $this->Group_model->get_rows('id,name',[]);
				$group = [];
				foreach ($groups as $item) {
					$group[''] = $this->data['text'][$this->controller][$this->controller.'_form_please_select'];
					$group[$item['id']] = $item['name'];
				}

				// selected group 
				$user_group = $this->{$this->model}->get_user_group('*',['user_id'=>$id]);
				if($user_group){
					$user_group = $user_group[0]['group_id'];
				}
				$this->data['form_field']['general'] = [
					'firstname'		=> [
						'property'		=> 'input',
						'id'       		=> 'firstname',
						'name'          => 'firstname',
				        'class'			=> 'form-control',
				        'value'         => (set_value('firstname')) ? set_value('firstname') : $this->data['general']->firstname,
					    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_firstname'],
				        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_firstname'],
				        'validation'	=> ['rules' => 'required']
				    ],
				    'lastname'		=> [
						'property'		=> 'input',
						'id'       		=> 'lastname',
						'name'          => 'lastname',
				        'class'			=> 'form-control',
				        'value'         => (set_value('lastname')) ? set_value('lastname') : $this->data['general']->lastname,
					    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_lastname'],
				        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_lastname'],
				        'validation'	=> ['rules' => 'required']
				    ],
				    'email'		=> [
						'property'		=> 'input',
						'type'			=> 'email',
						'id'       		=> 'email',
						'name'          => 'email',
				        'class'			=> 'form-control',
				        'value'         => (set_value('email')) ? set_value('email') : $this->data['general']->email,
					    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_email'],
				        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_email'],
				        'validation'	=> ['rules' => 'required|valid_email']
				    ],
				    'group_id'	=> [		    	
						'property'		=> 'dropdown',
						'name'			=> 'group_id',
				    	'id'			=> 'group_id',
				    	'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_group'],
						'class' 		=> 'bootstrap-select',
						'data-style' 	=> 'btn-default btn-xs',
						'data-width'	=> '100%',
						'options'		=> $group,
						'selected'		=> (set_value('group_id')) ? set_value('group_id') : $user_group,
				        'validation'	=> ['rules' => 'required']
				    ],
				    'username'		=> [
						'property'		=> 'input',
						'id'       		=> 'username',
						'name'          => 'username',
				        'class'			=> 'form-control',
				        'value'         => (set_value('username')) ? set_value('username') : $this->data['general']->username,
					    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_username'],
				        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_username'],
				        'validation'	=> ['rules' => 'required']
				    ],
				    'password'		=> [
						'property'		=> 'input',
						'type'			=> 'password',
						'id'       		=> 'password',
						'name'          => 'password',
				        'class'			=> 'form-control',
				        'value'         => set_value('password'),
					    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_password'],
				        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_password'],
				        'validation'	=> ['rules' => '']
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

				// $this->data['buttons'][] = [
				// 	'type'		=> 'button',
				// 	'text'		=> $this->data['text']['common']['common_form_button_save_exit'],
				// 	'class'		=> 'btn btn-success btn-labeled heading-btn',
				// 	'id'		=> 'save_exit',
				// 	'icon'		=> 'icon-floppy-disks',
				// 	'additional'=> [
				// 		'type'	=> 'submit'
				// 	]
				// ];

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
	            		'firstname'	=> $this->input->post('firstname'),
	            		'lastname'	=> $this->input->post('lastname'),
	            		'email'	    => $this->input->post('email'),
	            		'password'	=> $this->input->post('password'),
	            		'username'	=> $this->input->post('username'),
	            		'group_id'	=> $this->input->post('group_id')
	            	];
	            	$response = $this->auth->update_user($id, $general['email'],$general['password'],$general['username'],$general['firstname'],$general['lastname'],$general['group_id']);
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

	public function block($id)
	{

	}

	public function unblock($id)
	{

	}
}
