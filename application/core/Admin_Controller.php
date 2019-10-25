<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends Main_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->data['base_url'] = base_url();

		$this->data['per_page'] = $this->Setting_model->get(['key' => 'per_page'])->value;

		//Load Javascript File Per Controller
		//$this->data['scrips'] = $this->assets->load_js(['assets/admin/js/pages/'.$this->controller.'/'.$this->method.'.js']);
		$this->data['scrips'] = '';
		//Per Page Options
		$per_page_lists = json_decode($this->Setting_model->get(['key' => 'per_page_list'])->value);

		foreach ($per_page_lists as $per_page_list)
		{
			$this->data['per_page_lists'][$per_page_list] = $per_page_list;
		}

		$this->load->library("Auth");
		if (!$this->auth->is_loggedin() && !$this->auth->is_admin())
		{
			redirect('/admin/authentication/login');
		}

		/*if(!check_permission())
		{
			show_error();
		}*/

		$this->data['user'] = [
			'id'			=> $this->auth->get_user()->id,
			'email'			=> $this->auth->get_user()->email,
			'username'		=> $this->auth->get_user()->username,
			'fullname'		=> $this->auth->get_user()->firstname." ".$this->auth->get_user()->lastname
		];

		/* Load Breadcrumb Home Link */
		$this->breadcrumbs->push($this->data['text']['common']['common_breadcrumb_home'], $this->directory.'dashboard');		
		$this->breadcrumbs->push($this->data['text'][$this->controller][$this->controller.'_index_title'], $this->directory.$this->controller);

		//Default Error Delimiters
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
		
		$this->data['copyright'] 	= sprintf($this->data['text']['common']['common_footer_copyright'], date('Y'), VERSION);
		$this->data['elapsed_time'] = $this->benchmark->elapsed_time();
		$this->data['memory_usage'] = $this->benchmark->memory_usage();

		//Load Model Per Controller
		$this->load->model($this->model);

		$this->load->model('User_model');
        $this->load->library('Fcm');
		
	}

	public function render($content = NULL, $template = 'admin/layout')
	{
		$content = $this->directory.$this->controller.'/'.$content;
		parent::render($content, $template);
	}

	public function format_rows($rows, $custom_rows, $action = false)
	{
		if($rows)
		{
			foreach ($rows as $key => $value)
			{

				$formatted_rows[$key]['checkbox'] 	= '<input type="checkbox" name="selected[]" value="'.$value['id'].'" class="styled">';
				foreach ($value as $column => $data)
				{
					$formatted_rows[$key][$column] = $data;
					foreach ($custom_rows as $custom_row)
					{
						if($column ==  $custom_row['column'])
						{
							if(isset($custom_row['data']))
							{
								$formatted_rows[$key][$custom_row['column']] = $custom_row['data'][$data];
							}
							elseif(isset($custom_row['callback']))
							{
								$formatted_rows[$key][$custom_row['column']] = $this->{$this->model}->{'callback_'.$custom_row['callback']}($data, $custom_row['params']);
							}
						}
					}
				}

				if($action)
				{
					$formatted_rows[$key]['action'] 	= '<ul class="icons-list">';

					if(isset($action['custom']) && !empty($action['custom']))
					{
						foreach ($action['custom'] as $custom) {
							$formatted_rows[$key]['action']		.= '<li><a href="'.$custom['href'];
							if(is_array($custom['href_value']))
							{
								$values = [];
								foreach ($custom['href_value'] as $href_value) {
									$values[]  = $value[$href_value];
								}
								
								$formatted_rows[$key]['action'] .= implode('/', $values);;
							}
							else
							{
								$formatted_rows[$key]['action'] .= $value[$custom['href_value']];
							}

							$formatted_rows[$key]['action'] .= '" data-popup="tooltip" title="'.$custom['text'].'"><i class="'.$custom['icon'].'"></i></a></li>';
						}
					}
					if(isset($action['edit']) && !empty($action['edit']) && $action['edit'] === TRUE)
					{
						$formatted_rows[$key]['action']		.= '<li><a href="'.site_url_multi($this->directory.$this->controller.'/edit/').$value['id'].'" data-popup="tooltip" title="'.$this->data['text']['common']['common_edit'].'"><i class="icon-pencil7"></i></a></li>';
					}
					if(isset($action['delete']) && !empty($action['delete']) && $action['delete'] === TRUE)
					{
						$formatted_rows[$key]['action']		.= '<li><a href="'.site_url_multi($this->directory.$this->controller.'/delete/').$value['id'].'" class="delete" data-popup="tooltip" title="'.$this->data['text']['common']['common_delete'].'"><i class="icon-trash"></i></a></li>';
					}
					if(isset($action['restore']) && !empty($action['restore']) && $action['restore'] === TRUE)
					{
						$formatted_rows[$key]['action']		.= '<li><a href="'.site_url_multi($this->directory.$this->controller.'/restore/').$value['id'].'" class="restore" data-popup="tooltip" title="'.$this->data['text']['common']['common_restore'].'"><i class="icon-reset"></i></a></li>';
					}
					if(isset($action['remove']) && !empty($action['remove']) && $action['remove'] === TRUE)
					{
						$formatted_rows[$key]['action']		.= '<li><a href="'.site_url_multi($this->directory.$this->controller.'/remove/').$value['id'].'" class="remove" data-popup="tooltip" title="'.$this->data['text']['common']['common_remove'].'"><i class="icon-cancel-circle2"></i></a></li>';
					}
					if(isset($action['activity']) && !empty($action['activity']) && $action['activity'] === TRUE)
					{
						$formatted_rows[$key]['action']		.= '<li><a href="'.site_url_multi($this->directory.'match_activity'.'/create/').$value['id'].'"  data-popup="tooltip" title="'.$this->data['text']['common']['common_activity'].'"><i class="icon-transmission"></i></a></li>';
					}					
					$formatted_rows[$key]['action']		.= '</ul>';
				}
				
								
			}

			return $formatted_rows;
		}		
	}

	public function format_heading($columns, $next_order, $action)
	{
		$table_heads[] = "<th style=\"width:1px;\"><input type=\"checkbox\" class=\"styled\" onclick=\"$('input[name*=\'selected\']').prop('checked', this.checked); $.uniform.update();\"></th>";
		foreach ($columns as $column)
		{
			$table_heads[] =  '<th class="column_'.$column.'"><a href="'.current_url().'?per_page='.$this->data['per_page'].'&column='.$column.'&order='.$next_order.'">'.$this->data['text'][$this->controller][$this->controller.'_table_head_'.$column];
			if($this->input->get('column') == $column)
			{
				$table_heads[] .= '<i class="icon-order-'.strtolower($this->data['next_order']).' pull-right"></i>';
			}
			else
			{
				$table_heads[] .= '<i class="icon-menu-open pull-right"></i>';
			}

			$table_heads[] .= '</a></th>';
		}
		if($action)
		{
			$table_heads[] = "<th>".$this->data['text'][$this->controller][$this->controller.'_table_head_action']."</th>";
		}

		return $table_heads;
	}

	public function generate_table()
	{
		$this->data['formatted_heading'] = self::format_heading($this->data['columns'], $this->data['next_order'], $this->data['action']);
		$this->table->set_heading($this->data['formatted_heading']);		
		$formatted_rows = self::format_rows($this->data['rows'], $this->data['custom_rows'], $this->data['action']);
		if(!empty($formatted_rows))
		{
			return $this->table->generate($formatted_rows);
		}
		else
		{
			$cell = ['data' => $this->data['text']['common']['common_empty_data'], 'class' => 'text-center', 'colspan' => count($this->data['columns'])+2];
			$this->table->add_row($cell);
			return $this->table->generate();
		}
	}

	public function send_notification($type = '3',$data, $match_type = 0)
	{
		$users  = $this->User_model->get_rows(['fcm_token'],['banned'=>'0','fcm_token != '=>'']);
		$keys = [];
		foreach ($users as $user) 
		{	
			$keys[] = $user['fcm_token'];
		}
		$fcm_data = [
			'title'     => $data['title'],
			'type'      => $type,
			'match_type'=> $match_type,
			'body'      => $data['body'],
			'message'   => $data['message']
		];
		if($keys)
		{
			$this->fcm->send($keys,$fcm_data);
		}
	}
	

}