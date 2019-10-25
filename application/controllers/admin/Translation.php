<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Translation extends Admin_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->config->load('translation');
	}

	public function directory($directory = [])
	{
		/*if($directory)
		{
			$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_index_title'];
			$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_index_description'];
			$directories = func_get_args();
			$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);
			$directory = implode('/', $directories);
			$this->data['directories'] = $this->{$this->model}->get_directories($directory);
			$this->data['files'] = $this->{$this->model}->get_files($directory);
			$this->render('index');
		}
		else
		{
			show_404();
		}*/

		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_index_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_index_description'];
		$server = site_url_multi();

		$filter_name = $this->input->get('filter_name');
		if (isset($filter_name))
		{
			$filter_name = rtrim(str_replace('*', '', $filter_name), '/');
		}
		else
		{
			$filter_name = null;
		}
		// Make sure we have the correct directory
		$directory = implode('/', func_get_args());

		if (isset($directory))
		{
			$directory = rtrim(APPPATH."language/". str_replace('*', '', $directory), '/');
		}
		else
		{
			$directory = APPPATH."language/".$directory."/";
		}

		$page = $this->input->get('page');
		if (isset($page))
		{
			$page = $page;
		}
		else
		{
			$page = 1;
		}

		$directories = [];
		$files = [];

		$this->data['images'] = [];
			// Get directories

		$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);

		if (!$directories)
		{
			$directories = [];
		}

		$files = glob($directory . '/' . $filter_name . '*{_lang.php}', GLOB_BRACE);


		if (!$files)
		{
			$files = [];
		}


		foreach ($directories as $directory)
		{
			$name = basename($directory);
			$folder_href = site_url_multi('admin/translation/directory/'.substr($directory, strlen(APPPATH."language/")));

			$this->data['directories'][] = array(
				'name'  => $name,
				'path'  => substr($directory, strlen(APPPATH."language/")),
				'href'  => $folder_href,
			);
		}

		foreach ($files as $file)
		{
			$name = basename($file);

			$this->data['files'][] = array(
				'name'  => $name,
				'path'  => substr($file, strlen(APPPATH."language/")),
				'href'  => site_url_multi('admin/translation/file/'.substr($file, strlen(APPPATH."language/")))
			);
		}


		$this->data['text_no_results'] = 'text_no_results';
		$this->data['text_confirm'] = 'text_confirm';



		$directory = $this->input->get('directory');
		if (isset($directory)) {
			$this->data['directory'] = urlencode($directory);
		} else {
			$this->data['directory'] = '';
		}

		$filter_name = $this->input->get('filter_name');
		if (isset($filter_name)) {
			$this->data['filter_name'] = $filter_name;
		} else {
			$this->data['filter_name'] = '';
		}

		// Return the target ID for the file manager to set the value
		$target = $this->input->get('target');
		if (isset($target)) {
			$this->data['target'] = $target;
		} else {
			$this->data['target'] = '';
		}

		// Parent
		$url = '';

		if (isset($directory)) {
			$pos = strrpos($directory, '/');

			if ($pos) {
				$url .= '&directory=' . urlencode(substr($directory, 0, $pos));
			}
		}

		$target = $this->input->get('target');
		if (isset($target)) {
			$url .= '&target=' . $target;
		}

		$this->data['parent'] = site_url_multi('admin/filemanager').'?token=token'. $url;

		$url = '';

		$directory = $this->input->get('directory');
		if (isset($directory)) {
			$url .= '&directory=' . urlencode($directory);
		}

		$target = $this->input->get('target');
		if (isset($target)) {
			$url .= '&target=' . $target;
		}



		$url = '';

		$directory = $this->input->get('directory');
		if (isset($directory)) {
			$url .= '&directory=' . urlencode(html_entity_decode($directory, ENT_QUOTES, 'UTF-8'));
		}

		$filter_name = $this->input->get('filter_name');
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		$target = $this->input->get('target');
		if (isset($target)) {
			$url .= '&target=' . $target;
		}
		$thumb = $this->input->get('thumb');
		if (isset($thumb)) {
			$url .= '&thumb=' . $thumb;
		}

		$config['base_url'] = site_url_multi('admin/filemanager');

		$this->render('index');
	}

	public function file($files = [])
	{
			$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_index_title'];
			$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_index_description'];

		$this->data['buttons'][] = [
			'type'	=> 'button',
			'text'	=> 'Save',
			'href'	=> '#',
			'class'	=> 'btn btn-success btn-labeled heading-btn',
			'id'	=> 'save',
			'icon'	=> 'icon-floppy-disk'
		];

		$this->data['buttons'][] = [
			'type'	=> 'button',
			'text'	=> 'Reset',
			'href'	=> '#',
			'class'	=> 'btn btn-danger btn-labeled heading-btn',
			'id'	=> 'reset',
			'icon'	=> 'icon-reload-alt'
		];

		$files = func_get_args();
		$file = implode('/', $files);
		$pattern_files = array_shift($files);
		$pattern_file = implode('/', $files);

		if(is_array($files))
		{
			if($file !== FALSE && file_exists(APPPATH."language/$file"))
			{
				require(APPPATH."language/$file");
				$this->data['lang_array']	= $lang;

				$this->data['file']	= $file;
				require(APPPATH."language/{$this->config->item('language_pattern_lang')}/$pattern_file");
				$this->data['pattern'] = $lang;
				$this->render('form');

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

	public function add_extra_keys()
	{
		if($this->input->post('add_keys'))
		{
			$l = $this->input->post('language');
			$file = $this->input->post('filename');

			if(!empty($l) && !empty($file) && is_dir(APPPATH."language/$l/") && file_exists(APPPATH."language/$l/$file"))
			{
				require(APPPATH."language/$l/$file");
				$keys = $this->{$this->model}->get_keys_from_db($file);

				if(!is_array($lang) || !is_array($keys))
				{
					redirect("/language/lang_file/$l/$file");
				}
				$extra_keys = array_diff(array_keys($lang),$keys);
				if($this->{$this->model}->add_keys($extra_keys,$file))
				{
					$this->session->set_flashdata('msg',$this->lang->line('language_msg_success'));
				}
				else
				{
					$this->session->set_flashdata('error',$this->lang->line('language_error'));
				}
				redirect("/language/lang_file/$l/$file");
			}
			else
			{
				$this->session->set_flashdata('error',$this->lang->line('language_error_dir_not_exist'));
				redirect('/language');
			}
		}
		else
		{
			$this->session->set_flashdata('error',$this->lang->line('language_error_no_direct_access'));
			redirect('/language');
		}
	}

	public function add_one_key()
	{
		if($this->input->post('add_key'))
		{
			$l = $this->input->post('language');
			$file = $this->input->post('filename');

			if(!empty($l) && !empty($file) && is_dir(APPPATH."language/$l/") && file_exists(APPPATH."language/$l/$file"))
			{
				require(APPPATH."language/$l/$file");
				$keys = $this->{$this->model}->get_keys_from_db($file);
				$new_key = $this->input->post('key');

				if(!is_array($lang) || !is_array($keys))
				{
					redirect("/language/lang_file/$l/$file");
				}

				if(!in_array($new_key,$keys) && array_key_exists($new_key,$lang))
				{
					if($this->{$this->model}->add_keys(array($new_key),$file))
					{
						$this->session->set_flashdata('msg',$this->lang->line('language_msg_success'));
					}
					else
					{
						$this->session->set_flashdata('error',$this->lang->line('language_error'));
					}
				}
				else
				{
					$this->session->set_flashdata('error',$this->lang->line('language_error'));
				}
				redirect("/language/lang_file/$l/$file");
			}
			else
			{
				$this->session->set_flashdata('error',$this->lang->line('language_error_dir_not_exist'));
				redirect('/language');
			}
		}
		else
		{
			$this->session->set_flashdata('error',$this->lang->line('language_error_no_direct_access'));
			redirect('/language');
		}
	}

	public function save()
	{
		if($this->input->post('change'))
		{
			$l = $this->input->post('language');
			$file = $this->input->post('filename');
			if(!empty($l) && !empty($file) && is_dir(APPPATH."language/$l/") && file_exists(APPPATH."language/$l/$file"))
			{
				$f = '<?php  if (!defined(\'BASEPATH\')) exit(\'No direct script access allowed\');'."\n"; /// begin file with standard line
				//$f .= "\$lang = array("."\n"; /// our language array
				$keys = $this->{$this->model}->get_keys_from_db($file);
				if(empty($keys)||!is_array($keys))
				{
					$keys=FALSE;
				}

				foreach($_POST as $key=>$value)
				{
					if($keys!==FALSE&&in_array($key,$keys))
					{
						$f .= '$lang[\''.$key.'\']=\'';
						$f .= addslashes($this->input->post($key,TRUE)).'\';'."\n";		///for language array		, add escaping "
					}
					elseif($pos=strpos($key, 'new_key_')!==FALSE)
					{
						$new_key = trim($this->input->post($key, TRUE));
						if(!empty($new_key))
						{
							if(!in_array($new_key,$keys) && !in_array($new_key,$new_keys))
							{
								$f .= '$lang[\''.$new_key.'\']=\''; ///for language array
								$f .= addslashes($this->input->post('new_value_'.substr($key,-1))).'\';'."\n"; ///for language array
								$new_keys[]=$new_key;
							}
						}
					}
				}
				$f.= '/* End of file '.$file.' */'; ///closing tags
				///Before we go on, copy files just in case.
				if(!isset($new_keys) || (!empty($new_keys) && is_array($new_keys) && $this->{$this->model}->add_keys($new_keys, $file)))
				{
					if(isset($comments) && !empty($comments))
					{
						$this->{$this->model}->add_comments($comments,$file);
					}
					copy(APPPATH."language/$l/$file",APPPATH."language/$l/backup_$file");
					$r = file_put_contents(APPPATH."language/$l/$file",$f,LOCK_EX);	///save language file
					if($r)
					{
						$this->session->set_flashdata('msg',$this->lang->line('language_file_saved'));
					}
					else
					{
						$this->session->set_flashdata('error',$this->lang->line('language_file_not_saved'));
					}
				}
				else
				{
					$this->session->set_flashdata('error',$this->lang->line('language_error_keys_db'));
				}
				redirect("/language/lang_file/$l/$file");
			}
			else
			{
				$this->session->set_flashdata('error',$this->lang->line('language_error_dir_not_exist'));
				redirect('/language');
			}
		}
		else
		{
			$this->session->set_flashdata('error',$this->lang->line('language_error_no_direct_access'));
			redirect ('/language');
		}
	}

	public function create_new_language(){
		if($this->input->post('create')){
			$l = $this->input->post('language');
			if(!empty($l) && !is_dir(APPPATH."language/$l/")){
				$l=$l;
				if(mkdir(APPPATH."language/$l/")){
					$this->session->set_flashdata('msg',$this->lang->line('language_created'));
					redirect("/language/lang_list/$l");
				}else{
					$this->session->set_flashdata('error',$this->lang->line('language_error_creating_dir_permissions'));
					redirect('/language/create_new_language');
				}
			}else{
				$this->session->set_flashdata('error',$this->lang->line('language_error_exist'));
				redirect ('/language');
			}
		}else{
			$this->session->set_flashdata('error',$this->lang->line('language_error_no_direct_access'));
			redirect ('/language');
		}
	}

	public function delete_language(){
		if($this->input->post('delete')){ //check if form was submitted
			$l = $this->input->post('language');
			if(!empty($l) && is_dir(APPPATH."language/$l/")){
				if(delete_files(APPPATH."language/$l/", TRUE) && rmdir(APPPATH."language/$l/")){
					$this->session->set_flashdata('msg',$this->lang->line('language_msg_deleted'));
				}else{
					$this->session->set_flashdata('error',$this->lang->line('language_error_delete_permissions'));
				}
			}else{
				$this->session->set_flashdata('error',$this->lang->line('language_langdir_not_exist'));
			}
		}else{
			$this->session->set_flashdata('error',$this->lang->line('language_error_no_direct_access'));
		}
		redirect('/language');
	}

	public function remove_key()
	{
		if(!$this->input->is_ajax_request()){
			redirect('/language');
		}else{
			$del_key=substr($this->input->post('key'),4);
			$file=$this->input->post('filename');
			$file = preg_replace('/[^a-zA-Z0-9-_.]*/','',$file);
			$l = $this->input->post('language');
			if(!empty($l) && !empty($file) && is_dir(APPPATH."language/$l/") && file_exists(APPPATH."language/$l/$file")){
				$in_lang = $this->{$this->model}->file_in_language($file);
				if(is_array($in_lang)){
					foreach($in_lang as $in){
						unset($lang);
						if($this->config->item('comments')==1){
							$comments = $this->{$this->model}->get_comments_from_db($file);
						}
						require(APPPATH."language/$in/$file");
						if(array_key_exists($del_key,$lang)){
							$f = '<?php  if (!defined(\'BASEPATH\')) exit(\'No direct script access allowed\');'."\n"; /// begin file with standard line
							foreach($lang as $key_lang=>$val){ /// create new array
								if($key_lang!=$del_key){
									if(isset($comments) && array_key_exists($key_lang,$comments) && !empty($comments[$key_lang])){
										$f .= '/* '.$comments[$key_lang].' */'."\n";
									}
									$f .= '$lang[\''.$key_lang.'\']=\''; ///for language array
									$f .= addslashes($val).'\';'."\n";		///for language array		, add escaping "
								}
							}
							$f.= '/* End of file '.$file.' */'; ///closing tags
							copy(APPPATH."language/$in/$file",APPPATH."language/$in/backup_$file");
							file_put_contents(APPPATH."language/$in/$file",$f,LOCK_EX);
						}
					}
				}
				$this->{$this->model}->delete_one_key($del_key,$file);
				echo json_encode(array('response'=>TRUE,'msg'=>$this->lang->line('language_key_deleted')));
			}else{
				echo json_encode(array('response'=>FALSE,'msg'=>$this->lang->line('language_error_dir_not_exist')));
			}
		}
	}

}
