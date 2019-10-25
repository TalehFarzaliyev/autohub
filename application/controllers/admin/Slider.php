<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends Admin_Controller {

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

		$this->data['columns'] = ['id', 'name', 'image', 'status'];

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

		if($this->input->get('name') != NULL) $this->data['filter']['name LIKE'] = "%".$this->input->get('name')."%";
		if($this->input->get('status') != NULL) $this->data['filter']['status'] = $this->input->get('status');


		$this->data['filter']['lang_id'] = ($this->input->get('lang_id') != NULL) ? (int)$this->input->get('lang_id') : $this->data['current_lang_id'];

		foreach ($this->data['language_list'] as $language)
		{
			$this->data['language_list_holder'][] = [
				'id'		=> $language->id,
				'name'		=> $language->name,
				'code'		=> $language->code,
				'count'		=>  $this->{$this->model}->get_rows_count(['lang_id' => $language->id]),
				'class'		=> ($this->data['filter']['lang_id'] == $language->id) ? 'btn btn-primary' : 'btn btn-default'
			]; 
		}

		$this->data['total_rows'] = $this->{$this->model}->get_rows_count($this->data['filter']);
		$segment_array = $this->uri->segment_array();
		$page = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;

		$this->data['limit'] = [
			'per_page'	=> $this->data['per_page'],
			'page'		=> $page
		];

		$this->data['rows'] = $this->{$this->model}->get_rows($this->data['columns'], $this->data['filter'], $this->data['sort'], $this->data['limit']);
		$this->data['next_order'] = ($this->data['sort']['order'] == 'ASC') ? 'DESC' : 'ASC';
		
		$this->data['action'] = [
			'edit' 		=> TRUE,
			'delete'	=> TRUE
		];

		$this->data['custom_rows'] = [
			[
				'column'	=> 'status',
				'data'		=> [					
					'0'	=> "<span class='label label-danger'>{$this->data['text']['common']['common_disable']}</span>",
					'1'	=> "<span class='label label-success'>{$this->data['text']['common']['common_enable']}</span>"
				]
			],
			[
				'column'	=> 'image',
				'callback'	=> 'get_image',
				'params'	=> [
					'width'		=> '400',
					'height'	=> '100',
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
			'href'			=> site_url($this->directory.$this->controller.'/index?status=1'),
			'icon_class'	=> 'icon-shield-check position-left',
			'label_value'	=> $this->{$this->model}->where(['status' => 1])->count_rows(),
			'label_class'	=> 'label label-success position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_deactive'],
			'href'			=> site_url($this->directory.$this->controller.'/index?status=0'),
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

	public function trash()
	{
		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_trash_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_trash_description'];

		$this->data['sort'] = [
			'column'	=> ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
			'order'		=> ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
		];

		$this->data['columns'] = ['id', 'name', 'image', 'status'];


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
	
		if($this->input->get('name') != NULL) $this->data['filter']['name LIKE'] = "%".$this->input->get('name')."%";
		if($this->input->get('status') != NULL) $this->data['filter']['status'] = $this->input->get('status');


		$this->data['filter']['lang_id'] = ($this->input->get('lang_id') != NULL) ? (int)$this->input->get('lang_id') : $this->data['current_lang_id'];

		foreach ($this->data['language_list'] as $language)
		{
			$this->data['language_list_holder'][] = [
				'id'		=> $language->id,
				'name'		=> $language->name,
				'code'		=> $language->code,
				'count'		=>  $this->{$this->model}->get_rows_count(['lang_id' => $language->id], TRUE),
				'class'		=> ($this->data['filter']['lang_id'] == $language->id) ? 'btn btn-primary' : 'btn btn-default'
			]; 
		}

		$this->data['total_rows'] = $this->{$this->model}->get_rows_count($this->data['filter'], TRUE);
		$segment_array = $this->uri->segment_array();
		$page = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;

		$this->data['limit'] = [
			'per_page'	=> $this->data['per_page'],
			'page'		=> $page
		];

		$this->data['rows'] = $this->{$this->model}->get_rows($this->data['columns'], $this->data['filter'], $this->data['sort'], $this->data['limit'], TRUE);
		$this->data['next_order'] = ($this->data['sort']['order'] == 'ASC') ? 'DESC' : 'ASC';
		
		$this->data['action'] = [
			'remove'	=> TRUE,
			'restore'	=> TRUE
		];

		$this->data['custom_rows'] = [
			[
				'column'	=> 'status',
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
			'text'		=> $this->data['text']['common']['common_header_button_restore'],
			'href'		=> site_url($this->directory.$this->controller.'/restore'),
			'class'		=> 'btn btn-primary btn-labeled heading-btn restore',
			'id'		=> '',
			'icon'		=> 'icon-reset'
		];

		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> $this->data['text']['common']['common_header_button_delete_permanently'],
			'href'		=> site_url($this->directory.$this->controller.'/remove'),
			'class'		=> 'btn btn-danger btn-labeled heading-btn delete_permanently',
			'id'		=> '',
			'icon'		=> 'icon-trash',
			'additional' => [
				'onclick'	=> "confirm('Are you sure?') ? $('#form-list').submit() : false;",
				'form' 		=> 'form-list',
				'formaction'=> site_url($this->directory.$this->controller.'/delete')
			]
		];

		$this->data['buttons'][] = [
			'type'	=> 'a',
			'text'	=> $this->data['text']['common']['common_header_button_clean'],
			'href'	=> site_url($this->directory.$this->controller.'/clean'),
			'class'	=> 'btn btn-warning btn-labeled heading-btn clean',			
			'id'	=> 'clean',
			'icon'	=> 'icon-eraser2'	
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
			'href'			=> site_url($this->directory.$this->controller.'/index?status=1'),
			'icon_class'	=> 'icon-shield-check position-left',
			'label_value'	=> $this->{$this->model}->where(['status' => 1])->count_rows(),
			'label_class'	=> 'label label-success position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'			=> $this->data['text']['common']['common_breadcrumb_link_deactive'],
			'href'			=> site_url($this->directory.$this->controller.'/index?status=0'),
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
		$this->data['title'] 	= $this->data['text'][$this->controller][$this->controller.'_create_title'];
		$this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller.'_create_description'];

		// Form Fields Multilingual
		foreach ($this->data['language_list'] as $language)
		{
			$this->data['form_field']['translation'][$language->id] = [
				'name' => [
					'property'		=> 'input',
					'name'          => 'translation['.$language->id.'][name]',
			        'class'			=> 'form-control name',
			        'value'         => set_value('translation['.$language->id.'][name]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name'],
					'validation'	=> ['rules' => 'required']
				],
				'title' => [
					'property'		=> 'input',
					'name'          => 'translation['.$language->id.'][title]',
			        'class'			=> 'form-control name',
			        'value'         => set_value('translation['.$language->id.'][title]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name2'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name2'],
					'validation'	=> ['rules' => 'required']
				],
				'description' => [
					'property'		=> 'textarea',
					'name'          => 'translation['.$language->id.'][description]',
			        'class'			=> 'form-control editor',
			        'value'         => set_value('translation['.$language->id.'][description]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_description'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
			        'validation'	=> ['rules' => 'required']
				],
			];

			foreach ($this->data['form_field']['translation'][$language->id] as $key => $value)
			{
				$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
			}
		}

		$this->data['form_field']['general'] = [
			'image'		=> [
				'property'			=> 'image',
				'id'       			=> 'input-image',
				'name'          	=> 'image',
		        'value'         	=> set_value('image'),
		        'src'        		=> set_value('image') ? $this->Model_tool_image->resize(set_value('image'), 200, 200) : $this->Model_tool_image->resize('catalog/nophoto.png', 200, 200),
			    'label'				=> $this->data['text'][$this->controller][$this->controller.'_form_label_image'],
		        'placeholder'		=> $this->Model_tool_image->resize('catalog/nophoto.png', 200, 200),
		        'validation'		=> ['rules' => '']
			],
			'link' => [
					'property'		=> 'input',
					'name'          => 'link',
			        'class'			=> 'form-control name',
			        'value'         => set_value('link'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_link'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_link'],
					'validation'	=> ['rules' => 'required']
			],
		    'status'		=> [		    	
				'property'		=> 'dropdown',
				'name'			=> 'status',
		    	'id'			=> 'status',
		    	'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_status'],
				'class' 		=> 'bootstrap-select',
				'data-style' 	=> 'btn-default btn-xs',
				'data-width'	=> '100%',
				'options'		=> [$this->data['text']['common']['common_disable'], $this->data['text']['common']['common_enable']],				
		        'selected'      => set_value('status'),
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
            		'status'	=> (int)$this->input->post('status'),
            		'image'		=> $this->input->post('image'),
            		'link'		=> $this->input->post('link')
            	];

            	$slide_id = $this->{$this->model}->insert($general);
            	
            	foreach ($this->input->post('translation') as $lang_id => $value)
            	{
            		$translation = [
            			'slide_id'		=> $slide_id,
            			'lang_id'		=> $lang_id,
            			'name'			=> $value['name'],
            			'title'			=> $value['title'],
            			'text'			=> $value['description'],
            		];

            		$this->{$this->model}->insert_translation($translation);
            	}

            	redirect(site_url_multi($this->directory.$this->controller));
            }
            else
            {
            	$this->data['message'] = $this->data['text']['common']['common_error_warning'];
            }
		}

       	$this->render('form');
	}

	public function edit($id = false)
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
						'image'		=> [
							'property'			=> 'image',
							'id'       			=> 'input-image',
							'name'          	=> 'image',
							'value'         	=> set_value('image') ? set_value('image') : $this->data['general']->image,
							'src'        		=> set_value('image') ? $this->Model_tool_image->resize(set_value('image'), 200, 200) : $this->Model_tool_image->resize($this->data['general']->image, 200, 200),
							'label'				=> $this->data['text'][$this->controller][$this->controller.'_form_label_image'],
							'placeholder'		=> $this->Model_tool_image->resize('catalog/nophoto.png', 200, 200),
							'validation'		=> ['rules' => '']
						],
						'link' => [
							'property'		=> 'input',
							'name'          => 'link',
						    'class'			=> 'form-control name',
						    'value'         => (set_value('link')) ? set_value('link') : $this->data['general']->link,
						    'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_link'],
						    'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_link'],
							'validation'	=> ['rules' => 'required']
						],
					    'status'		=> [		    	
							'property'		=> 'dropdown',
							'name'			=> 'status',
					    	'id'			=> 'status',
					    	'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_status'],
							'class' 		=> 'bootstrap-select',
							'data-style' 	=> 'btn-default btn-xs',
							'data-width'	=> '100%',
							'options'		=> [$this->data['text']['common']['common_disable'], $this->data['text']['common']['common_enable']],				
					        'selected'      => (set_value('status')) ? set_value('status') : $this->data['general']->status,
					        'validation'	=> ['rules' => 'required']
					    ]
					];

				// Set Form Validation General Form Field
				foreach ($this->data['form_field']['general'] as $key => $value)
				{
					$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
				}

				// Set Multilingual Data Column
				$this->data['columns'] = ['name','title','text'];

				foreach ($this->data['language_list'] as $language)
				{
					$translation_content = $this->{$this->model}->get_rows($this->data['columns'], ['slide_id' => $id, 'lang_id' => $language->id]);

					$this->data['translation'][$language->id] = ($translation_content) ? $translation_content[0] : false;

					// Set Translation Form Field
						$this->data['form_field']['translation'][$language->id] = [
							'name' => [
								'property'		=> 'input',
								'name'          => 'translation['.$language->id.'][name]',
						        'class'			=> 'form-control',
						        'value'         => (set_value('translation['.$language->id.'][name]')) ? set_value('translation['.$language->id.'][name]') : $this->data['translation'][$language->id]['name'],
						        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name'],
						        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name'],
							    'validation'	=> ['rules' => 'required']
							],
							'title' => [
								'property'		=> 'input',
								'name'          => 'translation['.$language->id.'][title]',
						        'class'			=> 'form-control name',
						        'value'         => (set_value('translation['.$language->id.'][title]')) ? set_value('translation['.$language->id.'][title]') : $this->data['translation'][$language->id]['title'],
						        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name2'],
						        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name2'],
								'validation'	=> ['rules' => 'required']
							],
							'description' => [
								'property'		=> 'textarea',
								'name'          => 'translation['.$language->id.'][description]',
						        'class'			=> 'form-control editor',
						        'value'         => (set_value('translation['.$language->id.'][description]')) ? set_value('translation['.$language->id.'][text]') : $this->data['translation'][$language->id]['text'],
						        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_description'],
						        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
						        'validation'	=> ['rules' => 'required']
							],
						];


					// Set Form Validation Translation Form Field
					foreach ($this->data['form_field']['translation'][$language->id] as $key => $value)
					{
						$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
					}
				}
				//butons
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
				///end
				$this->breadcrumbs->push($this->data['text'][$this->controller][$this->controller.'_edit_title'], $this->directory.$this->controller.'/edit');

				if($this->input->method() == 'post' && $this->form_validation->run() == TRUE)
				{
					$general = [
	            		'status'	=> (int)$this->input->post('status'),
	            		'image'		=> $this->input->post('image'),
	            		'link'		=> $this->input->post('link'),
	            	];

	            	$this->{$this->model}->update($general, ['id' => $id]);	            	
	            	$this->{$this->model}->delete_translation($id);

	            	foreach ($this->input->post('translation') as $lang_id => $value)
	            	{

	            		$translation = [
	            			'slide_id'		=> $id,
	            			'lang_id'		=> $lang_id,
	            			'name'			=> $value['name'],
	            			'title'			=> $value['title'],
	            			'text'			=> $value['description'],
	            		];

	            		$this->{$this->model}->insert_translation($translation);
	            	}

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

	public function delete($id = false)
	{
		if($id)
		{
			$this->{$this->model}->delete($id);
			echo json_encode(['success' => 1]);
		}
		else
		{
			if($this->input->method() == 'post')
			{
				foreach ($this->input->post('selected') as $id)
				{
					$this->{$this->model}->delete($id);
				}

	            redirect(site_url_multi($this->directory.$this->controller));
			}
		}
		
	}

	public function remove($id = false)
	{
		if($id)
		{
			$this->{$this->model}->remove($id);
			echo json_encode(['success' => 1]);
		}
		else
		{
			if($this->input->method() == 'post')
			{
				foreach ($this->input->post('selected') as $id)
				{
					$this->{$this->model}->remove($id);
				}
				
	            redirect(site_url_multi($this->directory.$this->controller));
			}
		}
	}

	public function clean()
	{
		$this->{$this->model}->remove_all();
		redirect(site_url_multi($this->directory.$this->controller));
	}
}
