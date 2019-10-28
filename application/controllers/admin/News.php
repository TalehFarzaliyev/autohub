<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
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
					'width'		=> '100',
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
			'remove'	=> TRUE
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
					'width'		=> '100',
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
			'text'		=> $this->data['text']['common']['common_header_button_delete_permanently'],
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

		$this->data['buttons'][] = [
			'type'	=> 'a',
			'text'	=> $this->data['text']['common']['common_header_button_clean'],
			'href'	=> site_url($this->directory.$this->controller.'/clean'),
			'class'	=> 'btn btn-warning btn-labeled heading-btn',
			'id'	=> '',
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

		$categories = $this->Category_model->get_rows(['id','name'],['lang_id'=>$this->data['current_lang_id'],'status'=>'1']);

		$category_name = [];
		if($categories){
			foreach ($categories as $category) {
				$category_name[$category['id']] = $category['name'];
			}
		}

		// Form Fields Multilingual
		foreach ($this->data['language_list'] as $language)
		{
			$this->data['form_field']['translation'][$language->id] = [
				'name' => [
					'property'		=> 'input',
					'name'          => 'translation['.$language->id.'][name]',
			        'class'			=> 'form-control',
			        'value'         => set_value('translation['.$language->id.'][name]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name'],
				    'validation'	=> ['rules' => '']
				],
				'slug' => [
					'property'		=> 'input',
					'name'          => 'translation['.$language->id.'][slug]',
			        'class'			=> 'form-control',
			        'value'         => set_value('translation['.$language->id.'][slug]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_slug'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_slug'],
				    'validation'	=> ['rules' => '']
				],
				'desc_text' => [
					'property'		=> 'textarea',
					'name'          => 'translation['.$language->id.'][desc_text]',
			        'class'			=> 'form-control editor',
			        'value'         => set_value('translation['.$language->id.'][desc_text]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_desc_text'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
			        'validation'	=> ['rules' => '']
				],
				'description' => [
					'property'		=> 'textarea',
					'name'          => 'translation['.$language->id.'][description]',
			        'class'			=> 'form-control editor',
			        'value'         => set_value('translation['.$language->id.'][description]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_description'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
			        'validation'	=> ['rules' => '']
				],
				'meta_title' => [
					'property'		=> 'input',
					'name'          => 'translation['.$language->id.'][meta_title]',
			        'class'			=> 'form-control',
			        'value'         => set_value('translation['.$language->id.'][meta_title]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_meta_title'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_meta_title'],
			        'validation'	=> ['rules' => '']
				],
				'meta_description' => [
					'property'		=> 'textarea',
					'name'          => 'translation['.$language->id.'][meta_description]',
			        'class'			=> 'form-control',
			        'value'         => set_value('translation['.$language->id.'][meta_description]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_meta_description'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_meta_description'],
			        'validation'	=> ['rules' => '']
				],
				'meta_keyword' => [
					'property'		=> 'input',
					'name'          => 'translation['.$language->id.'][meta_keyword]',
			        'class'			=> 'form-control',
			        'value'         => set_value('translation['.$language->id.'][meta_keyword]'),
			        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_meta_keyword'],
			        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_meta_keyword'],
			        'validation'	=> ['rules' => '']
				]
			];

			$check = false;
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
		        'validation'		=> [
	                'rules' => ''
	        	]
			],
			'featured'		=> [
				'property'		=> 'dropdown',
				'name'			=> 'featured',
		    	'id'			=> 'featured',
		    	'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_featured'],
				'class' 		=> 'bootstrap-select',
				'data-style' 	=> 'btn-default btn-xs',
				'data-width'	=> '100%',
				'options'		=> ['0' => $this->data['text']['news']['news_form_please_select'], '1' => $this->data['text']['news']['news_featured_1']],
		        'selected'      => set_value('featured'),
		        'validation'	=> [
	                'rules' => ''
	        	]
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
		        'validation'	=> [
	                'rules' => 'required'
	        	]
		    ],
		    'category'		=> [
				'property'		=> 'multiselect',
				'name'			=> 'category[]',
		    	'id'			=> 'category',
		    	'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_category'],
				'class' 		=> 'multiselect-select-all-filtering',
				'options'		=> $category_name,
				'selected'      => set_value('category'),
		        'validation'	=> [
	                'rules' => ''
	        	]
			],
		];
		// Images fields
		if ($this->input->post('images'))
		{
			foreach ($this->input->post('images') as $image)
			{
					if(!empty($image))
					{
						$this->data['images'][] = [
							'image'	=> $image,
							'thumb' => $this->Model_tool_image->resize($image, 200, 200)
						];
					}
			}
		}
		else
		{
			$this->data['images'] = [];
		}
		//Form Validation Rules Set
		foreach ($this->data['language_list'] as $language)
		{
			foreach ($this->data['form_field']['translation'][$language->id] as $key => $value)
			{
				$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
			}
		}

		foreach ($this->data['form_field']['general'] as $key => $value)
		{
			$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
		}



		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> $this->data['text']['common']['common_form_button_save'],
			'href'		=> site_url($this->directory.$this->controller.'/delete'),
			'class'		=> 'btn btn-primary btn-labeled heading-btn',
			'id'		=> '',
			'icon'		=> 'icon-floppy-disk',
			'additional' => [
				'onclick'	=> "confirm('Are you sure?') ? $('#form-save').submit() : false;",
				'form' 		=> 'form-save',
				'formaction'=> current_url()
			]
		];

		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> $this->data['text']['common']['common_form_button_reset'],
			'href'		=> site_url($this->directory.$this->controller.'/delete'),
			'class'		=> 'btn btn-danger btn-labeled heading-btn',
			'id'		=> '',
			'icon'		=> 'icon-reload-alt',
			'additional'=> [
				'type'	=> 'reset'
			]
		];

		$this->breadcrumbs->push($this->data['text'][$this->controller][$this->controller.'_create_title'], $this->directory.$this->controller.'/create');

		if($this->input->method() == 'post')
		{

			if ($this->form_validation->run() == TRUE)
            {
            	$general = [
            		'featured'	=> (int)$this->input->post('featured'),
            		'status'	=> (int)$this->input->post('status'),
            		'image'		=> $this->input->post('image')
            	];

            	${$this->controller.'_id'}=$this->{$this->model}->insert($general);
            	foreach ($this->input->post('images') as $image)
                {
					if(!empty($image))
					{
						$image_data = [
							$this->controller.'_id' => ${$this->controller.'_id'},
							'images'				=> $image
						];
						$this->{$this->model}->insert_images($image_data);
					}
				}
				foreach ($this->input->post('videos') as $video)
                {
					if(!empty($video))
					{
						$video_data = [
							$this->controller.'_id' => ${$this->controller.'_id'},
							'video'				=> $video
						];
						$this->{$this->model}->insert_videos($video_data);
					}
				}
				
            	$categories = $this->input->post('category');
            	foreach ($categories as $category)
            	{
            		$data = ['news_id' => ${$this->controller.'_id'}, 'category_id' => $category];
					$this->Category_model->insert_news_to_category($data);
				}

            	foreach ($this->input->post('translation') as $lang_id => $value)
            	{
            		$translation = [
            			$this->controller.'_id'		=> ${$this->controller.'_id'},
            			'lang_id'					=> $lang_id,
            			'name'						=> $value['name'],
            			'slug'						=> $value['slug'],
            			'description'				=> $value['description'],
            			'desc_text'					=> $value['desc_text'],
            			'meta_title'				=> $value['meta_title'],
            			'meta_description'			=> $value['meta_description'],
            			'meta_keyword'				=> $value['meta_keyword']
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

				$this->data['news_images'] = $this->{$this->model}->get_news_images($id);
				// images field
		        $images = $this->{$this->model}->get_images($id);
				if ($images)
				{
					foreach ($images as $image)
					{
						$this->data['images'][] = [
							'image'	=> $image['images'],
							'thumb' => $this->Model_tool_image->resize($image['images'], 200, 200)
						];
					}
				}
				elseif($this->input->post('images'))
				{
					foreach ($this->input->post('images') as $image)
					{
						$this->data['images'][] = [
							'image'	=> $image,
							'thumb' => $this->Model_tool_image->resize($image, 200, 200)
						];
					}
				}
				else
				{
					$this->data['images'] = [];
				}

				$videos = $this->{$this->model}->get_videos($id);

				if ($videos)
				{
					foreach ($videos as $video)
					{
						$this->data['videos'][] = $video->video;
					}
				}
				elseif($this->input->post('videos'))
				{
					foreach ($this->input->post('videos') as $video)
					{
						$this->data['videos'][] = $video;
					}
				}
				else
				{
					$this->data['videos'] = [];
				}
				// Get all  categories
				$categories = $this->Category_model->get_rows(['id','name'],['lang_id'=>$this->data['current_lang_id'],'status'=>'1']);
				$category_name = [];
				if($categories){
					foreach ($categories as $category) {
						$category_name[$category['id']] = $category['name'];
					}
				}

				//Get selected category
				$news_category = $this->Category_model->get_news_to_category('category_id',['news_id'=>$id]);
				$selected_category = [];
				if($news_category){
					foreach ($news_category as $category) {
						$selected_category[] = $category['category_id'];
					}
				}
				// Set General Form Field
				$this->data['form_field']['general'] = [
					'image'		=> [
						'property'			=> 'image',
						'id'       			=> 'input-image',
						'name'          	=> 'image',
				        'value'         	=> (set_value('image')) ? set_value('image') : $this->data['general']->image,
				        'src'        		=> (set_value('image')) ? $this->Model_tool_image->resize(set_value('image'), 200, 200) : $this->Model_tool_image->resize($this->data['general']->image, 200, 200),
					    'label'				=> $this->data['text'][$this->controller][$this->controller.'_form_label_image'],
				        'placeholder'		=> '/uploads/nophoto.png',
				        'validation'		=> [
			                'rules' => '',
			                'errors' => []
			        	]
					],
					'featured'		=> [
						'property'		=> 'dropdown',
						'name'			=> 'featured',
						'id'			=> 'featured',
						'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_featured'],
						'class' 		=> 'bootstrap-select',
						'data-style' 	=> 'btn-default btn-xs',
						'data-width'	=> '100%',
						'options'		=> ['0' => $this->data['text']['news']['news_form_please_select'], '1' => $this->data['text']['news']['news_featured_1']],
						'selected'      => (set_value('featured')) ? set_value('featured') : $this->data['general']->featured,
						'validation'	=> [
							'rules' => ''
						]
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
				        'validation'	=> [
			                'rules' => 'required'
			        	]
				    ],
				    'category'		=> [
						'property'		=> 'multiselect',
						'name'			=> 'category[]',
				    	'id'			=> 'category',
				    	'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_category'],
						'class' 		=> 'multiselect-select-all-filtering',
						'options'		=> $category_name,
						'selected'      => (set_value('category')) ? set_value('category') : $selected_category,
				        'validation'	=> [
			                'rules' => ''
			        	]
				    ],
					'notification'	=> [		    	
						'property'		=> 'dropdown',
						'name'			=> 'notification',
						'id'			=> 'notification',
						'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_notification'],
						'class' 		=> 'bootstrap-select',
						'data-style' 	=> 'btn-default btn-xs',
						'data-width'	=> '100%',
						'options'		=> [$this->data['text']['news']['news_form_label_disable'],$this->data['text']['news']['news_form_label_enable']],				
						'selected'      => set_value('notification'),
						'validation'	=> [
							'rules' => 'required'
						]
					],

				];

				// Set Form Validation General Form Field
				foreach ($this->data['form_field']['general'] as $key => $value)
				{
					$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
				}

				// Set Multilingual Data Column
				$this->data['columns'] = ['name', 'name_text', 'slug', 'desc_text', 'description', 'meta_title', 'meta_description', 'meta_keyword'];

				$check = true;
				foreach ($this->data['language_list'] as $language)
				{
					$translation_content = $this->{$this->model}->get_rows($this->data['columns'], [$this->controller.'_id' => $id, 'lang_id' => $language->id]);

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
						    'validation'	=> [
				                'rules' => ''
				        	]
						],
						'slug' => [
							'property'		=> 'input',
							'name'          => 'translation['.$language->id.'][slug]',
					        'class'			=> 'form-control',
					        'value'         => (set_value('translation['.$language->id.'][slug]')) ? set_value('translation['.$language->id.'][slug]') : $this->data['translation'][$language->id]['slug'],
					        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_slug'],
					        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_slug'],
						    'validation'	=> [
				                'rules' => ''
				        	]
						],
						'name_text' => [
							'property'		=> 'input',
							'name'          => 'translation['.$language->id.'][name_text]',
					        'class'			=> 'form-control',
					        'value'         => (set_value('translation['.$language->id.'][name_text]')) ? set_value('translation['.$language->id.'][name_text]') : $this->data['translation'][$language->id]['name_text'],
					        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_name_text'],
					        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_name_text'],
						    'validation'	=> [
				                'rules' => ''
				        	]
						],
						'desc_text' => [
							'property'		=> 'textarea',
							'name'          => 'translation['.$language->id.'][desc_text]',
					        'class'			=> 'form-control editor',
					        'value'         => (set_value('translation['.$language->id.'][desc_text]')) ? set_value('translation['.$language->id.'][desc_text]') : $this->data['translation'][$language->id]['desc_text'],
					        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_desc_text'],
					        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
					        'validation'	=> [
				                'rules' => ''
				        	]
						],
						'description' => [
							'property'		=> 'textarea',
							'name'          => 'translation['.$language->id.'][description]',
					        'class'			=> 'form-control editor',
					        'value'         => (set_value('translation['.$language->id.'][description]')) ? set_value('translation['.$language->id.'][description]') : $this->data['translation'][$language->id]['description'],
					        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_description'],
					        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_description'],
					        'validation'	=> [
				                'rules' => ''
				        	]
						],
						'meta_title' => [
							'property'		=> 'input',
							'name'          => 'translation['.$language->id.'][meta_title]',
					        'class'			=> 'form-control',
					        'value'         => (set_value('translation['.$language->id.'][meta_title]')) ? set_value('translation['.$language->id.'][meta_title]') : $this->data['translation'][$language->id]['meta_title'],
					        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_meta_title'],
					        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_meta_title'],
					        'validation'	=> [
				                'rules' 	=> ''
				        	]
						],
						'meta_description' => [
							'property'		=> 'textarea',
							'name'          => 'translation['.$language->id.'][meta_description]',
					        'class'			=> 'form-control',
					        'value'         => (set_value('translation['.$language->id.'][meta_description]')) ? set_value('translation['.$language->id.'][meta_description]') : $this->data['translation'][$language->id]['meta_description'],
					        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_meta_description'],
					        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_meta_description'],
					        'validation'	=> [
				                'rules' => ''
				        	]

						],
						'meta_keyword' => [
							'property'		=> 'input',
							'name'          => 'translation['.$language->id.'][meta_keyword]',
					        'class'			=> 'form-control',
					        'value'         => (set_value('translation['.$language->id.'][meta_keyword]')) ? set_value('translation['.$language->id.'][meta_keyword]') : $this->data['translation'][$language->id]['meta_keyword'],
					        'label'			=> $this->data['text'][$this->controller][$this->controller.'_form_label_meta_keyword'],
					        'placeholder'	=> $this->data['text'][$this->controller][$this->controller.'_form_placeholder_meta_keyword'],
					        'validation'	=> [
				                'rules' => ''
				        	]
						]
					];
					$check = false;

					// Set Form Validation Translation Form Field
					foreach ($this->data['form_field']['translation'][$language->id] as $key => $value)
					{
						$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
					}
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
						'featured'	=> (int)$this->input->post('featured'),
	            		'status'	=> (int)$this->input->post('status'),
	            		'image'	=> $this->input->post('image')
	            	];

	            	$this->{$this->model}->update($general, ['id' => $id]);
	            	$this->{$this->model}->delete_translation($id);
	            	$this->Category_model->delete_news_to_category($id);

	            	$categories = $this->input->post('category');

	            	foreach ($categories as $category)
	            	{
	            		$data = ['news_id' => $id, 'category_id' => $category];
						$this->Category_model->insert_news_to_category($data);
					}

					
					$this->{$this->model}->delete_images($id);
					foreach ($this->input->post('images') as $image)
					{
						if(!empty($image))
						{
							$image_data = [
								$this->controller.'_id' => $id,
								'images'				=> $image
							];
							$this->{$this->model}->insert_images($image_data);
						}else{
							$this->{$this->model}->insert_images($image_data);
						}
					}

					$this->{$this->model}->delete_videos($id);
					foreach ($this->input->post('videos') as $video)
					{
						if(!empty($video))
						{
							$video_data = [
								$this->controller.'_id' => $id,
								'video'				=> $video
							];
							$this->{$this->model}->insert_videos($video_data);
						}
					}


	            	foreach ($this->input->post('translation') as $lang_id => $value)
	            	{

	            		$translation = [
	            			$this->controller.'_id'		=> $id,
	            			'lang_id'					=> $lang_id,
	            			'name'						=> $value['name'],
	            			'name_text'					=> $value['name_text'],
            				'slug'						=> $value['slug'],
            				'description'				=> $value['description'],
            				'desc_text'					=> $value['desc_text'],
	            			'meta_title'				=> $value['meta_title'],
	            			'meta_description'			=> $value['meta_description'],
	            			'meta_keyword'				=> $value['meta_keyword']
	            		];

	            		$this->{$this->model}->insert_translation($translation);
					}
					
					//send notification
					if((int)$this->input->post('notification') && (int)$this->input->post('status'))
					{
						$data = [
							'title'		=>	$this->input->post('translation')['2']['name'],
							'message'	=>	$this->input->post('translation')['2']['description'],
							'body'		=>	$id
						];
						$this->send_notification('2',$data);
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
