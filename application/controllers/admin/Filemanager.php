<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($type = false)
	{
		$this->data['title'] 		= $this->data['text'][$this->controller][$this->controller.'_index_title'];
		$this->data['subtitle'] 	= $this->data['text'][$this->controller][$this->controller.'_index_description'];

		$server = site_url_multi();

		$filter_name = $this->input->get('filter_name');
		if (isset($filter_name)) {
			$filter_name = rtrim(str_replace('*', '', $filter_name), '/');
		} else {
			$filter_name = null;
		}
		// Make sure we have the correct directory
		$directory = $this->input->get('directory');
		if (isset($directory)) {
			$directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace('*', '', $directory), '/');
		} else {
			$directory = DIR_IMAGE . 'catalog';
		}

		$page = $this->input->get('page');
		if (isset($page)) {
			$page = $page;
		} else {
			$page = 1;
		}

		$directories = [];
		$files = [];

		$this->data['images'] = [];
			// Get directories

			$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);



			if (!$directories) {
				$directories = [];
			}

			// Get files
			$files = glob($directory . '/' . $filter_name . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF,pdf}', GLOB_BRACE);

			if (!$files) {
				$files = [];
			}


		// Merge directories and files
		$images = array_merge($directories, $files);


		// Get total number of files and directories
		$image_total = count($images);

		// Split the array based on current page number and max number of items per page of 10
		$images = array_splice($images, ($page - 1) * 16, 16);

		foreach ($images as $image) {
			$name = str_split(basename($image), 14);

			if (is_dir($image)) {
				$url = '';

				$this->data['target'] = $this->input->get('target');
				if (isset($this->data['target'])) {
					$url .= '&target=' . $this->data['target'];
				}
				$thumb = $this->input->get('thumb');
				if (isset($thumb)) {
					$url .= '&thumb=' . $thumb;
				}

				if($type == 'popup')
				{
					$folder_href = site_url_multi('admin/filemanager/index/popup').'?directory=' .substr($image, strlen(DIR_IMAGE . 'catalog/')) . $url;
				}
				else
				{
					$folder_href = site_url_multi('admin/filemanager').'?directory=' .substr($image, strlen(DIR_IMAGE . 'catalog/')) . $url;
				}

				$this->data['folders'][] = array(
					'name'  => implode(' ', $name),
					'path'  => substr($image, strlen(DIR_IMAGE)),
					'href'  => $folder_href,
				);
			} elseif (is_file($image)) {
				$format = $ext = pathinfo($image, PATHINFO_EXTENSION);;
				if($format != 'pdf')
				{
					$this->data['images'][] = array(
						'thumb' => $this->Model_tool_image->resize(substr($image, strlen(DIR_IMAGE)), 200, 200),
						'name'  => implode(' ', $name),
						'path'  => substr($image, strlen(DIR_IMAGE)),
						'href'  => $server . 'uploads/' . substr($image, strlen(DIR_IMAGE))
					);
				}
				else
				{
					$this->data['images'][] = array(
						'thumb' => '/uploads/catalog/pdf.png',
						'name'  => implode(' ', $name),
						'path'  => substr($image, strlen(DIR_IMAGE)),
						'href'  => $server . 'uploads/' . substr($image, strlen(DIR_IMAGE))
					);
				}
				
			}
		}

		$this->data['text_no_results'] = 'text_no_results';
		$this->data['text_confirm'] = 'text_confirm';



		$this->data['csrf_name'] = $this->security->get_csrf_token_name();
    	$this->data['csrf_hash'] = $this->security->get_csrf_hash();

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

		// Return the thumbnail for the file manager to show a thumbnail
		$thumb = $this->input->get('thumb');
		if (isset($thumb)) {
			$this->data['thumb'] = $thumb;
		} else {
			$this->data['thumb'] = '';
		}

		// Parent
		$url = '';

		$directory = $this->input->get('directory');
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

		$thumb = $this->input->get('thumb');
		if (isset($thumb)) {
			$url .= '&thumb=' . $thumb;
		}

		if($type == 'popup')
		{
			$this->data['parent'] = site_url_multi('admin/filemanager/index/popup').'?token=token'. $url;
		}
		else {
			$this->data['parent'] = site_url_multi('admin/filemanager').'?token=token'. $url;
		}
		// Refresh
		$url = '';

		$directory = $this->input->get('directory');
		if (isset($directory)) {
			$url .= '&directory=' . urlencode($directory);
		}

		$target = $this->input->get('target');
		if (isset($target)) {
			$url .= '&target=' . $target;
		}

		$thumb = $this->input->get('thumb');
		if (isset($thumb)) {
			$url .= '&thumb=' . $thumb;
		}

		if($type == 'popup')
		{
			$this->data['refresh'] = site_url_multi('admin/filemanager/index/popup').'?token'.$url;
		}
		else
		{
			$this->data['refresh'] = site_url_multi('admin/filemanager').'?token'.$url;
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

		if($type == 'popup')
		{
			$config['base_url'] = site_url_multi('admin/filemanager/index/popup');
		}
		else
		{
			$config['base_url'] = site_url_multi('admin/filemanager');
		}
		$config['total_rows'] = $image_total;
		$config['per_page'] = 16;
		$config['page'] = $page;
		$config['url'] = $url;
		$this->data['pagination'] = $this->pagination($config);

		if($type == 'popup')
		{
			$this->smarty->view('admin/filemanager/popup.tpl', $this->data);
		}
		else
		{
			$this->render('index');
		}

	}

	public function upload() {

		$json = array();

		$directory = $this->input->get('directory');
		if (isset($directory)) {
			$directory = rtrim(DIR_IMAGE . 'catalog/' . $directory, '/');
		} else {
			$directory = DIR_IMAGE . 'catalog';
		}

		$config = array();
		$config['upload_path'] = $directory;
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['max_size']      = '1024';
		$config['overwrite']     = FALSE;

		$this->load->library('upload');

		$files = $_FILES;
		$total = count($files['file']['name']);
		unset($_FILES);

		for($i=0; $i< $total; $i++)
		{
			$_FILES['file']['name']= $files['file']['name'][$i];
			$_FILES['file']['type']= $files['file']['type'][$i];
			$_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
			$_FILES['file']['error']= $files['file']['error'][$i];
			$_FILES['file']['size']= $files['file']['size'][$i];

			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('file'))
			{
				$json['error'] = $this->upload->display_errors();
			}
		}
		if(empty($json['error'])){
			$json['success'] = 'Successfull uploaded';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function folder()
	{
		$json = array();


		$directory = $this->input->get('directory');
		if (isset($directory)) {
			$directory = rtrim(DIR_IMAGE . 'catalog/' . $directory, '/');
		} else {
			$directory = DIR_IMAGE . 'catalog';
		}


		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			// Sanitize the folder name
			$folder = basename(html_entity_decode($this->input->post('folder'), ENT_QUOTES, 'UTF-8'));

			$json['folder'] = $folder;
			// Validate the filename length
			if ((strlen($folder) < 3) || (strlen($folder) > 128)) {
				$json['error'] = 'error_folder';
			}

			// Check if directory already exists or not
			if (is_dir($directory . '/' . $folder)) {
				$json['error'] = $directory . '/' . $folder;
			}
		}

		if (!isset($json['error'])) {
			mkdir($directory . '/' . $folder, 0777);
			chmod($directory . '/' . $folder, 0777);

			@touch($directory . '/' . $folder . '/' . 'index.html');

			$json['success'] = 'Direcory created';
		}

		//$this->response->addHeader('Content-Type: application/json');
		//$this->response->setOutput(json_encode($json));
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function delete() {
		//$this->load->language('admin/filemanager');

		$json = array();

		// Check user has permission
		//if (!$this->user->hasPermission('modify', 'admin/filemanager')) {
		//	$json['error'] = 'error_permission';
		//}

		$path = $this->input->post('path');
		if (isset($path)) {
			$paths = $path;
		} else {
			$paths = array();
		}


		if (!$json) {
			// Loop through each path
			foreach ($paths as $path) {
				$path = rtrim(DIR_IMAGE . $path, '/');

				// If path is just a file delete it
				if (is_file($path)) {
					unlink($path);

				// If path is a directory beging deleting each file and sub folder
				} elseif (is_dir($path)) {
					$files = array();

					// Make path into an array
					$path = array($path . '*');

					// While the path array is still populated keep looping through
					while (count($path) != 0) {
						$next = array_shift($path);

						foreach (glob($next) as $file) {
							// If directory add to path array
							if (is_dir($file)) {
								$path[] = $file . '/*';
							}

							// Add the file to the files to be deleted array
							$files[] = $file;
						}
					}

					// Reverse sort the file array
					rsort($files);

					foreach ($files as $file) {
						// If file just delete
						if (is_file($file)) {
							unlink($file);

						// If directory use the remove directory function
						} elseif (is_dir($file)) {
							rmdir($file);
						}
					}
				}
			}

			$json['success'] = 'text_delete';
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function pagination($data) {
		$base_url = $data['base_url'];
		$total = $data['total_rows'];
		$per_page = $data['per_page'];
		$page = $data['page'];
		$url = $data['url'];
		$pages = intval($total/$per_page); if($total%$per_page != 0){$pages++;}
		$p="";
		for($i=1; $i<= $pages;$i++){
			$p .= '<a class="btn directory" href="'.$base_url.'?page='.$i.$url.'" >'.$i.'</a>';
		}
		return $p;
	}
}
