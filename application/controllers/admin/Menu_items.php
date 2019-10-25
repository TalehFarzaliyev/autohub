<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_items extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['title'] = $this->data['text'][$this->controller][$this->controller . '_index_title'];
        $this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller . '_index_description'];

        $this->data['sort'] = [
            'column' => ($this->input->get('column')) ? $this->input->get('column') : 'order',
            'order' => ($this->input->get('order')) ? $this->input->get('order') : 'ASC'
        ];

        $this->data['columns'] = [
            'id', 
            'name',
            'status',
        ];

        $this->data['search_field'] = [
            'name' => [
                'property' => 'input',
                'type' => 'search',
                'name' => 'name',
                'class' => 'form-control',
                'value' => $this->input->get('name'),
                'placeholder' => $this->data['text']['common']['common_search_placeholder']
            ]
        ];

        $this->data['filter'] = [];
        $this->data['filter']['lang_id'] = ($this->input->get('lang_id') != NULL) ? (int)$this->input->get('lang_id') : $this->data['current_lang_id'];

        if ($this->input->get('name') != NULL)
            $this->data['filter']['name LIKE'] = "%" . $this->input->get('name') . "%";
        if ($this->input->get('status') != NULL)
            $this->data['filter']['status'] = $this->input->get('status');

        $this->data['total_rows'] = $this->{$this->model}->get_rows_count($this->data['filter']);
        $segment_array = $this->uri->segment_array();
        $page = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;

        $this->data['limit'] = [
            'per_page' => $this->data['per_page'],
            'page' => $page
        ];

        $this->data['rows'] = $this->{$this->model}->get_rows($this->data['columns'], $this->data['filter'], $this->data['sort'], $this->data['limit']);
        $this->data['next_order'] = ($this->data['sort']['order'] == 'ASC') ? 'DESC' : 'ASC';

        $array = [];
        foreach($this->data['rows'] as $key=>$value)
        {
            $array[$value['id']] = $value;
        }
        
        $this->data['rows'] = $array;
         
        $this->data['action'] = [
            'edit' => TRUE,
            'delete' => TRUE,
        ];

        $this->data['custom_rows'] = [
            [
                'column' => 'status',
                'data' => [
                    '0' => "<span class='label label-danger'>{$this->data['text']['common']['common_disable']}</span>",
                    '1' => "<span class='label label-success'>{$this->data['text']['common']['common_enable']}</span>"
                ]
            ]
        ];

        $this->data['table'] = parent::generate_table();

        //Pagination
        $config['base_url']     = site_url_multi($this->directory . $this->controller . '/index');
        $config['total_rows']   = $this->data['total_rows'];
        $config['per_page']     = $this->data['per_page'];

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['buttons'][] = [
            'type' => 'a',
            'text' => $this->data['text']['common']['common_header_button_create'],
            'href' => site_url($this->directory . $this->controller . '/create'),
            'class' => 'btn btn-success btn-labeled heading-btn',
            'id' => '',
            'icon' => 'icon-plus-circle2'
        ];

        $this->data['buttons'][] = [
            'type' => 'button',
            'text' => $this->data['text']['common']['common_header_button_delete'],
            'href' => site_url($this->directory . $this->controller . '/delete'),
            'class' => 'btn btn-danger btn-labeled heading-btn',
            'id' => '',
            'icon' => 'icon-trash',
            'additional' => [
                'onclick' => "confirm('Are you sure?') ? $('#form-list').submit() : false;",
                'form' => 'form-list',
                'formaction' => site_url($this->directory . $this->controller . '/delete')
            ]
        ];


        $this->data['breadcrumb_links'][] = [
            'text' => $this->data['text']['common']['common_breadcrumb_link_all'],
            'href' => site_url($this->directory . $this->controller . '/index'),
            'icon_class' => 'icon-database position-left',
            'label_value' => $this->{$this->model}->where()->count_rows(),
            'label_class' => 'label label-primary position-right'
        ];

        $this->data['breadcrumb_links'][] = [
            'text' => $this->data['text']['common']['common_breadcrumb_link_active'],
            'href' => site_url($this->directory . $this->controller . '/index?status=1'),
            'icon_class' => 'icon-shield-check position-left',
            'label_value' => $this->{$this->model}->where(['status' => 1])->count_rows(),
            'label_class' => 'label label-success position-right'
        ];

        $this->data['breadcrumb_links'][] = [
            'text' => $this->data['text']['common']['common_breadcrumb_link_deactive'],
            'href' => site_url($this->directory . $this->controller . '/index?status=0'),
            'icon_class' => 'icon-shield-notice position-left',
            'label_value' => $this->{$this->model}->where(['status' => 0])->count_rows(),
            'label_class' => 'label label-warning position-right'
        ];

        $this->data['breadcrumb_links'][] = [
            'text' => $this->data['text']['common']['common_breadcrumb_link_trash'],
            'href' => site_url($this->directory . $this->controller . '/trash'),
            'icon_class' => 'icon-trash position-left',
            'label_value' => $this->{$this->model}->only_trashed()->count_rows(),
            'label_class' => 'label label-danger position-right'
        ];

        $this->render('index');
    }
    

    

    public function create() {
        $this->data['title'] = $this->data['text'][$this->controller][$this->controller . '_index_title'];
        $this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller . '_index_description'];
        
        if($_POST)
        {
            $this->data['menu_id'] = $this->input->post('menu_id');
            $this->data['parent']  = $this->input->post('parent');
            $this->data['order']   = $this->input->post('order');
            $this->data['status']  = $this->input->post('status');
            $this->data['lang_id'] = $this->input->post('lang_id');
            $this->data['name']    = $this->input->post('name');
            $this->data['slug']    = $this->input->post('slug');
            
            /* Menu Insert */
            $this->data['insertMenuData'] = array(
                'menu_id'   => $this->data['menu_id'],
                'parent'    => $this->data['parent'],
                'order'     => $this->data['order'],
                'status'    => $this->data['status']
            );
            
            $this->data['insertMenu'] = $this->{$this->model}->insertMenu($this->data['insertMenuData']);
            
            /* Menu Lang Insert */
            $this->data['insertData'] = []; 
            foreach($this->data['lang_id'] as $key=>$value)
            {
                $this->data['insertData'][] = array(
                    'lang_id'         => $value,
                    'menu_items_id'   => $this->data['insertMenu'],
                    'name'            => $this->data['name'][$key],
                    'slug'            => $this->data['slug'][$key]
                );
            } 
            foreach($this->data['insertData'] as $key=>$value)
            {
                $this->data['insertMenuLang'] = $this->{$this->model}->insertMenuLang($value);
            } 
            redirect(site_url_multi($this->directory.$this->controller));
        }
       
        $this->data['get_query_builder']        = $this->{$this->model}->get_query_builder();
        $this->data['get_parent_menu']          = $this->{$this->model}->get_parent_menu();
        
        $this->render('form');
    }
    
    
    public function edit($id = null)
    {
        $this->data['title'] = $this->data['text'][$this->controller][$this->controller . '_index_title'];
        $this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller . '_index_description'];
        
        if($id != null)
        {
            if($_POST)
            {
                $this->data['menu_id'] = $this->input->post('menu_id');
                $this->data['parent']  = $this->input->post('parent');
                $this->data['order']   = $this->input->post('order');
                $this->data['status']  = $this->input->post('status');
                $this->data['lang_id'] = $this->input->post('lang_id');
                $this->data['name']    = $this->input->post('name');
                $this->data['slug']    = $this->input->post('slug');
                
                $this->data['insertMenuData'] = array(
                    'menu_id'   => $this->data['menu_id'],
                    'parent'    => $this->data['parent'],
                    'order'     => $this->data['order'],
                    'status'    => $this->data['status']
                );
                
                $this->data['updateMenu'] = $this->{$this->model}->updateMenu($this->data['insertMenuData'],$id);
                
                $this->data['deleteLangMenu'] = $this->{$this->model}->deleteLangMenu($id);

                $this->data['insertData'] = []; 
                foreach($this->data['lang_id'] as $key=>$value)
                {
                    $this->data['insertData'][] = array(
                        'lang_id'         => $value,
                        'menu_items_id'   => $id,
                        'name'            => $this->data['name'][$key],
                        'slug'            => $this->data['slug'][$key]
                    );
                } 
                foreach($this->data['insertData'] as $key=>$value)
                {
                    $this->data['insertMenuLang'] = $this->{$this->model}->insertMenuLang($value);
                }
                redirect(site_url_multi($this->directory.$this->controller));
                
            }
            
            $this->data['get_single_rows']          = $this->{$this->model}->get_single_rows($id);
            $this->data['get_single_lang_rows']     = $this->{$this->model}->get_single_lang_rows($id);
            $this->data['get_query_builder']        = $this->{$this->model}->get_query_builder();
            $this->data['get_parent_menu']          = $this->{$this->model}->get_parent_menu();
            
            $array = [];
            
            foreach ($this->data['get_single_lang_rows'] as $key=>$value)
            {
                $array[$value['lang_id']][] = $value; 
            }
            
            $this->data['get_single_lang_rows'] = $array;

            $this->render('edit');
        }
        else 
        {
            redirect(site_url_multi($this->directory.$this->controller));
        }
    }

    public function delete($id = false) {
        if ($id) {
            $this->{$this->model}->delete($id);
            echo json_encode(['success' => 1]);
        } else {
            if ($this->input->method() == 'post') {
                foreach ($this->input->post('selected') as $id) {
                    $this->{$this->model}->delete($id);
                }

                redirect(site_url_multi($this->directory . $this->controller));
            }
        }
    }

    public function remove($id = false) {
        if ($id) {
            $this->{$this->model}->remove($id);
            echo json_encode(['success' => 1]);
        } else {
            if ($this->input->method() == 'post') {
                foreach ($this->input->post('selected') as $id) {
                    $this->{$this->model}->remove($id);
                }

                redirect(site_url_multi($this->directory . $this->controller));
            }
        }
    }

    public function clean() {
        $this->{$this->model}->remove_all();
        redirect(site_url_multi($this->directory . $this->controller));
    }

}
