<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->library("Auth");
	}

	public function login()
	{
		$this->data['title'] = 'Login';

		$this->form_validation->set_rules('login', 'login', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|trim');

		if ($this->form_validation->run() === TRUE)
		{

			$remember = (bool)$this->input->post('remember');

			if ($this->auth->login($this->input->post('login'), $this->input->post('password'), $remember))
			{
				redirect(site_url_multi('admin/dashboard'), 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->auth->print_errors());
				redirect(site_url_multi('admin/authentication/login'), 'refresh');
			}
		}
		else
		{
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['copyright'] 	= sprintf($this->data['text']['common']['common_footer_copyright'], date('Y'), VERSION);
			$this->render(NULL, 'admin/login');
		}

	}

	public function logout()
	{
		$this->auth->logout();
		redirect('admin/authentication/login', 'refresh');
	}

}
