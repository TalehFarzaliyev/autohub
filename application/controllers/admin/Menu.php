<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['title'] = $this->data['text'][$this->controller][$this->controller . '_index_title'];
        $this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller . '_index_description'];

        $this->data['sort'] = [
            'column' => ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
            'order' => ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
        ];

        $this->data['columns'] = ['id', 'name', 'status'];

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
        $config['base_url'] = site_url_multi($this->directory . $this->controller . '/index');
        $config['total_rows'] = $this->data['total_rows'];
        $config['per_page'] = $this->data['per_page'];

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

    public function create()
    {
        $this->data['title']    = $this->data['text'][$this->controller][$this->controller . '_index_title'];
        $this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller . '_index_description'];

        if($_POST)
        {
            $this->data['name']   = $this->input->post('name');
            $this->data['slug']   = $this->input->post('slug');
            $this->data['status'] = $this->input->post('status');

            $this->data['message'] = "";

            if(empty($this->data['name']))
            {
                $this->data['message'] = "";
            }
            else if(empty($this->data['slug']))
            {
                $this->data['message'] = "";
            }
            else
            {
                $data = array(
                  'name'   => $this->data['name'],
                  'slug'   => $this->data['slug'],
                  'status' => $this->data['status']
                );

                $this->data['insertMenu']  = $this->{$this->model}->insertMenu($data);
                if($this->data['insertMenu'])
                {
                    header('Location:/en/admin/menu/?add=true');
                }
                else
                {
                    header('Location:/en/admin/menu/?add=false');
                }
            }
        }

        $this->render('form');
    }

    public function edit($id = null)
    {
        $this->data['title']    = $this->data['text'][$this->controller][$this->controller . '_index_title'];
        $this->data['subtitle'] = $this->data['text'][$this->controller][$this->controller . '_index_description'];
        if($id != null)
        {
            if($_POST)
            {
                $this->data['name']   = $this->input->post('name');
                $this->data['slug']   = $this->input->post('slug');
                $this->data['status'] = $this->input->post('status');

                $this->data['message'] = "";

                if(empty($this->data['name']))
                {
                    $this->data['message'] = "";
                }
                else if(empty($this->data['slug']))
                {
                    $this->data['message'] = "";
                }
                else
                {
                    $data = array(
                      'name'   => $this->data['name'],
                      'slug'   => $this->data['slug'],
                      'status' => $this->data['status']
                    );

                    $this->data['updateMenu']  = $this->{$this->model}->updateMenu($data,$id);
                    if($this->data['updateMenu'])
                    {
                        header('Location:/en/admin/menu/?update=true');
                    }
                    else
                    {
                        header('Location:/en/admin/menu/?update=false');
                    }
                }
            }
            $this->data['getBlock']  = $this->{$this->model}->getBlock($id);
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
