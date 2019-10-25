<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->data['title'] 		= translate('index_title');
		$this->data['subtitle'] 	= translate('index_description');

		$this->data['buttons'][] = [
			'type'		=> 'button',
			'text'		=> translate('form_button_save',1),
			'class'		=> 'btn btn-primary btn-labeled heading-btn',
			'id'		=> 'save',
			'icon'		=> 'icon-floppy-disk',
			'additional' => [
				'onclick'	=> "confirm('Are you sure?') ? $('#form-save').submit() : false;",
				'form' 		=> 'form-save',
				'formaction'=> current_url()
			]
		];
		
		$this->data['tabs'] = [
			'general'	=> [
				'icon'				=> 'icon-menu7',
				'label'				=> translate('tab_general'),
				'active'			=> true,
				'fields'			=> [
					'site_title'		=> [
						'property'		=> 'input',
						'name'          => 'site_title',
						'class'			=> 'form-control',
						'value'         => (set_value('site_title')) ? set_value('site_title') : get_setting('site_title'),
						'label'			=> translate('site_title'),
						'placeholder'	=> translate('site_title_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
					'site_description'		=> [
						'property'		=> 'input',
						'name'          => 'site_description',
						'class'			=> 'form-control',
						'value'         => (set_value('site_description')) ? set_value('site_description') : get_setting('site_description'),
						'label'			=> translate('site_description'),
						'placeholder'	=> translate('site_description_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
					'meta_title'		=> [
						'property'		=> 'input',
						'name'          => 'meta_title',
						'class'			=> 'form-control',
						'value'         => (set_value('meta_title')) ? set_value('meta_title') : get_setting('meta_title'),
						'label'			=> translate('meta_title'),
						'placeholder'	=> translate('meta_title_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
				]
			],
			'social'	=> [
				'icon'				=> 'icon-facebook2',
				'label'				=> translate('tab_social'),
				'fields'			=>  [
					'facebook'		=> [
						'property'		=> 'input',
						'name'          => 'facebook',
						'icon'          => 'icon-facebook',
						'class'			=> 'form-control',
						'value'         => (set_value('facebook')) ? set_value('facebook') : get_setting('facebook'),
						'label'			=> translate('facebook'),
						'placeholder'	=> translate('facebook_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'twitter'		=> [
						'property'		=> 'input',
						'name'          => 'twitter',
						'icon'          => 'icon-twitter',
						'class'			=> 'form-control',
						'value'         => (set_value('twitter')) ? set_value('twitter') : get_setting('twitter'),
						'label'			=> translate('twitter'),
						'placeholder'	=> translate('twitter_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'instagram'		=> [
						'property'		=> 'input',
						'name'          => 'instagram',
						'icon'          => 'icon-instagram',
						'class'			=> 'form-control',
						'value'         => (set_value('instagram')) ? set_value('instagram') : get_setting('instagram'),
						'label'			=> translate('instagram'),
						'placeholder'	=> translate('instagram_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'linkedin'		=> [
						'property'		=> 'input',
						'name'          => 'linkedin',
						'icon'          => 'icon-linkedin',
						'class'			=> 'form-control',
						'value'         => (set_value('linkedin')) ? set_value('linkedin') : get_setting('linkedin'),
						'label'			=> translate('linkedin'),
						'placeholder'	=> translate('linkedin_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'googleplus'	=> [
						'property'		=> 'input',
						'name'          => 'googleplus',
						'icon'          => 'icon-google-plus',
						'class'			=> 'form-control',
						'value'         => (set_value('googleplus')) ? set_value('googleplus') : get_setting('googleplus'),
						'label'			=> translate('googleplus'),
						'placeholder'	=> translate('googleplus_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'youtube'		=> [
						'property'		=> 'input',
						'name'          => 'youtube',
						'icon'          => 'icon-youtube',
						'class'			=> 'form-control',
						'value'         => (set_value('youtube')) ? set_value('youtube') : get_setting('youtube'),
						'label'			=> translate('youtube'),
						'placeholder'	=> translate('youtube_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'github'		=> [
						'property'		=> 'input',
						'name'          => 'github',
						'icon'          => 'icon-github',
						'class'			=> 'form-control',
						'value'         => (set_value('github')) ? set_value('github') : get_setting('github'),
						'label'			=> translate('github'),
						'placeholder'	=> translate('github_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'vimeo'			=> [
						'property'		=> 'input',
						'name'          => 'vimeo',
						'icon'          => 'icon-vimeo',
						'class'			=> 'form-control',
						'value'         => (set_value('vimeo')) ? set_value('vimeo') : get_setting('vimeo'),
						'label'			=> translate('vimeo'),
						'placeholder'	=> translate('vimeo_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'flickr'		=> [
						'property'		=> 'input',
						'name'          => 'flickr',
						'icon'          => 'icon-flickr',
						'class'			=> 'form-control',
						'value'         => (set_value('flickr')) ? set_value('flickr') : get_setting('flickr'),
						'label'			=> translate('flickr'),
						'placeholder'	=> translate('flickr_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'rss'			=> [
						'property'		=> 'input',
						'name'          => 'rss',
						'icon'          => 'icon-feed2',
						'class'			=> 'form-control',
						'value'         => (set_value('rss')) ? set_value('rss') : get_setting('rss'),
						'label'			=> translate('rss'),
						'placeholder'	=> translate('rss_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'wordpress'		=> [
						'property'		=> 'input',
						'name'          => 'wordpress',
						'icon'          => 'icon-wordpress',
						'class'			=> 'form-control',
						'value'         => (set_value('wordpress')) ? set_value('wordpress') : get_setting('wordpress'),
						'label'			=> translate('wordpress'),
						'placeholder'	=> translate('wordpress_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'dribbble'		=> [
						'property'		=> 'input',
						'name'          => 'dribbble',
						'icon'          => 'icon-dribbble',
						'class'			=> 'form-control',
						'value'         => (set_value('dribbble')) ? set_value('dribbble') : get_setting('dribbble'),
						'label'			=> translate('dribbble'),
						'placeholder'	=> translate('dribbble_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'blogger'		=> [
						'property'		=> 'input',
						'name'          => 'blogger',
						'icon'          => 'icon-blogger',
						'class'			=> 'form-control',
						'value'         => (set_value('blogger')) ? set_value('blogger') : get_setting('blogger'),
						'label'			=> translate('blogger'),
						'placeholder'	=> translate('blogger_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'tumblr'		=> [
						'property'		=> 'input',
						'name'          => 'tumblr',
						'icon'          => 'icon-tumblr',
						'class'			=> 'form-control',
						'value'         => (set_value('tumblr')) ? set_value('tumblr') : get_setting('tumblr'),
						'label'			=> translate('tumblr'),
						'placeholder'	=> translate('tumblr_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'skype'			=> [
						'property'		=> 'input',
						'name'          => 'skype',
						'icon'          => 'icon-skype',
						'class'			=> 'form-control',
						'value'         => (set_value('skype')) ? set_value('skype') : get_setting('skype'),
						'label'			=> translate('skype'),
						'placeholder'	=> translate('skype_placeholder'),
						'validation'	=> ['rules' => '']
					]
				]
			],
			'contact'	=> [
				'icon'				=> 'icon-phone',
				'label'				=> translate('tab_contact'),
				'fields'			=> [
					'contact_email'		=> [
						'property'		=> 'input',
						'name'          => 'email',
						'class'			=> 'form-control',
						'value'         => (set_value('email')) ? set_value('email') : get_setting('email'),
						'label'			=> translate('contact_email'),
						'placeholder'	=> translate('contact_email_placeholder'),
						'validation'	=> ['rules' => ''],
						'icon'          => 'icon-envelop',
					],
					'contact_latitude'		=> [
						'property'		=> 'input',
						'name'          => 'latitude',
						'class'			=> 'form-control',
						'value'         => (set_value('latitude')) ? set_value('latitude') : get_setting('latitude'),
						'label'			=> translate('contact_latitude'),
						'placeholder'	=> translate('contact_latitude_placeholder'),
						'validation'	=> ['rules' => ''],
						'icon'          => 'icon-pin',
					],
					'contact_longitude'		=> [
						'property'		=> 'input',
						'name'          => 'longitude',
						'class'			=> 'form-control',
						'value'         => (set_value('longitude')) ? set_value('longitude') : get_setting('longitude'),
						'label'			=> translate('contact_longitude'),
						'placeholder'	=> translate('contact_longitude_placeholder'),
						'validation'	=> ['rules' => ''],
						'icon'          => 'icon-pin'
					],
					'contact_address'		=> [
						'property'		=> 'input',
						'name'          => 'contact_address',
						'class'			=> 'form-control',
						'value'         => (set_value('contact_address')) ? set_value('contact_address') : get_setting('contact_address'),
						'label'			=> translate('contact_address'),
						'placeholder'	=> translate('contact_address_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
					'contact_region'		=> [
						'property'		=> 'input',
						'name'          => 'contact_region',
						'class'			=> 'form-control',
						'value'         => (set_value('contact_region')) ? set_value('contact_region') : get_setting('contact_region'),
						'label'			=> translate('contact_region'),
						'placeholder'	=> translate('contact_region_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
					'contact_place'		=> [
						'property'		=> 'input',
						'name'          => 'contact_place',
						'class'			=> 'form-control',
						'value'         => (set_value('contact_place')) ? set_value('contact_place') : get_setting('contact_place'),
						'label'			=> translate('contact_place'),
						'placeholder'	=> translate('contact_place_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
					'contact_postal'		=> [
						'property'		=> 'input',
						'name'          => 'contact_postal',
						'class'			=> 'form-control',
						'value'         => (set_value('contact_postal')) ? set_value('contact_postal') : get_setting('contact_postal'),
						'label'			=> translate('contact_postal'),
						'placeholder'	=> translate('contact_postal_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
					'contact_phone'		=> [
						'property'		=> 'input',
						'name'          => 'contact_phone',
						'class'			=> 'form-control',
						'value'         => (set_value('contact_phone')) ? set_value('contact_phone') : get_setting('contact_phone'),
						'label'			=> translate('contact_phone'),
						'placeholder'	=> translate('contact_phone_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					],
					'contact_fax'		=> [
						'property'		=> 'input',
						'name'          => 'contact_fax',
						'class'			=> 'form-control',
						'value'         => (set_value('contact_fax')) ? set_value('contact_fax') : get_setting('contact_fax'),
						'label'			=> translate('contact_fax'),
						'placeholder'	=> translate('contact_fax_placeholder'),
						'validation'	=> ['rules' => ''],
						'translate'		=> true
					]			
				]
			],
			'mail'	=> [
				'icon'				=> 'icon-envelop',
				'label'				=> translate('tab_mail'),
				'fields'			=> [
					'mail_server'		=> [		    	
						'property'		=> 'dropdown',
						'name'			=> 'mail_server',
						'id'			=> 'mail_server',
						'label'			=> translate('mail_server'),
						'class' 		=> 'bootstrap-select',
						'data-style' 	=> 'btn-default btn-xs',
						'data-width'	=> '100%',
						'options'		=> [
							'phpmailer' => translate('mail_server_phpmailer'),
							'smtp'	     => translate('mail_server_smtp')
						],				
						'selected'      => (set_value('mail_server')) ? set_value('mail_server') : get_setting('mail_server'),
						'validation'	=> ['rules' => '']
					],
					'mail_hostname'		=> [
						'property'		=> 'input',
						'name'          => 'mail_hostname',
						'class'			=> 'form-control',
						'value'         => (set_value('mail_hostname')) ? set_value('mail_hostname') : get_setting('mail_hostname'),
						'label'			=> translate('mail_hostname'),
						'placeholder'	=> translate('mail_hostname_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'mail_username'		=> [
						'property'		=> 'input',
						'name'          => 'mail_username',
						'class'			=> 'form-control',
						'value'         => (set_value('mail_username')) ? set_value('mail_username') : get_setting('mail_username'),
						'label'			=> translate('mail_username'),
						'placeholder'	=> translate('mail_username_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'mail_password'		=> [
						'property'		=> 'input',
						'name'          => 'mail_password',
						'class'			=> 'form-control',
						'value'         => (set_value('mail_password')) ? set_value('mail_password') : get_setting('mail_password'),
						'label'			=> translate('mail_password'),
						'placeholder'	=> translate('mail_password_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'mail_port' => [
						'property'		=> 'input',
						'name'          => 'mail_port',
						'class'			=> 'form-control',
						'value'         => (set_value('mail_port')) ? set_value('mail_port') : get_setting('mail_port'),
						'label'			=> translate('mail_port'),
						'placeholder'	=> translate('mail_port_placeholder'),
						'validation'	=> ['rules' => '']
					],
					'mail_timeout' => [
						'property'		=> 'input',
						'name'          => 'mail_timeout',
						'class'			=> 'form-control',
						'value'         => (set_value('mail_timeout')) ? set_value('mail_timeout') : get_setting('mail_timeout'),
						'label'			=> translate('mail_timeout'),
						'placeholder'	=> translate('mail_timeout_placeholder'),
						'validation'	=> ['rules' => '']
					]
				]
			]
		];


		
		//die();
		if($this->input->method() == 'post')
		{

			$setting_data = [];
			foreach ($this->input->post() as $key => $setting) {
				if(is_array($setting))
				{
					$setting_data[$key] = json_encode($setting);
				}
				else
				{
					$setting_data[$key]	=	$setting;
				}
			}

			$this->{$this->model}->update_setting($setting_data);
			redirect(site_url_multi($this->directory.$this->controller));
		}
		
		$this->render('index');
	}
}
