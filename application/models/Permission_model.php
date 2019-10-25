<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends Main_Model {

	public $table = 'permissions';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct()
	{	
		parent::__construct();
		$this->rules = [
			'insert' => [
				[
	                'field' => 'name',
	                'label' => $this->lang->translate('permission_form_label_name'),
	                'rules' => 'required',
	                'errors' => [
	                	'required' => $this->lang->translate('permission_form_error_required_name'),
	                ]
		        ],
		        [
		            'field' => 'description',
		            'label' => $this->lang->translate('permission_form_label_directory'),
		            'rules' => 'required',
		            'errors' => [
	                	'required' => $this->lang->translate('permission_form_error_required_description'),
	                ]
		        ]	    
			],
			'update' => [
				[
	                'field' => 'name',
	                'label' => $this->lang->translate('permission_form_label_name'),
	                'rules' => 'required',
	                'errors' => [
	                	'required' => $this->lang->translate('permission_form_error_required_name'),
	                ]
		        ],
		        [
		            'field' => 'description',
		            'label' => $this->lang->translate('permission_form_label_directory'),
		            'rules' => 'required',
		            'errors' => [
	                	'required' => $this->lang->translate('permission_form_error_required_description'),
	                ]
		        ]	    
			]
		];
	}

}