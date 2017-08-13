<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{

		$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required|trim|alpha_numeric|min_length[5]|max_length[20]|_user_exists_by_username[username]'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required|trim|min_length[5]|max_length[50]|chack_valid_user['.$this->input->post('username').']',
		                'errors' => array(
		                		'min_length' => 'Please enter at least 5 characters.',
		                		'max_length' => 'Please enter maximum 50 characters.'
		                	)
		        ),
		);
		$this->form_validation->set_rules($config);

	    if ($this->form_validation->run() === FALSE)
	    {

			$this->load->view('inc/login/header');
			$this->load->view('login_page');
			$this->load->view('inc/login/footer');
	    }else{
			$remember = $this->input->post('remember');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password = md5($password);
			$user_id  = $this->login_model->get_user_id_by_username_and_password($username, $password);       

	    	if (isset($remember)) {
	    		$this->input->set_cookie(array(
		            'name'   => 'remember_me',
		            'value'  => 'remember',                            
		            'expire' => time() + (86400 * 30),
	            ));
	    		$this->input->set_cookie(array(
		            'name'   => 'user_id',
		            'value'  => $user_id,                            
		            'expire' => time() + (86400 * 30),
	            ));
	    		$this->input->cookie('remember_me', TRUE);
	    		$this->input->cookie('user_id', TRUE);
	    	}else{
	    		$this->session->set_userdata('user_id',$user_id);
	    	}

	    	redirect(base_url(), 'refresh');
	    	exit();

	    	$this->load->view('inc/login/header');
			$this->load->view('login_page');
			$this->load->view('inc/login/footer');
	    }

	}


	public function registration(){

		$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required|trim|alpha_numeric|min_length[5]|max_length[20]|is_unique[cod_user.username]',
		                'errors' => array(
		                		'is_unique' => '%s already exists.',
		                	)
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required|trim|min_length[5]|max_length[50]',
		                'errors' => array(
		                		'min_length' => '%s enter at least 5 characters.',
		                		'max_length' => '%s enter maximum 50 characters.'
		                	)
		        ),
		        array(
		                'field' => 'repeat_password',
		                'label' => 'Retype Password',
		                'rules' => 'required|trim|matches[password]',
		                'errors' => array(
		                		'matches' => 'Password and Retype password not match.'
		                	)
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email address',
		                'rules' => 'required|trim|valid_email|is_unique[cod_user.user_email]',
		                'errors' => array(
		                		'is_unique' => 'This "'.$this->input->post('email').'" already exists.'
		                	)
		        ),
		);
		$this->form_validation->set_rules($config);


	    if ($this->form_validation->run() === FALSE)
	    {
			$this->load->view('inc/login/header');
			$this->load->view('registration');
			$this->load->view('inc/login/reg_footer');
	    }else{
			$username 			= $this->input->post('username');
			$password 			= md5($this->input->post('password'));
			$email 				= $this->input->post('email');
			$active_key 		= $email.time();
			$active_key 		= md5($active_key);
			$nicename 			= $username;
			$registered			= time();

			$full_data 	= array(
					'username' 				=> $username,
					'password' 				=> $password,
					'user_nicename' 		=> $username,
					'user_email' 			=> $email,
					'user_registered' 		=> $registered,
					'user_activation_key' 	=> $active_key,
					'display_name' 			=> $username,
				);

			$user_id = $this->login_model->insert_user($full_data);
			$this->session->set_userdata('user_id',		$user_id);
			$this->session->set_userdata('recent_user',	'recent');
			
			//need send mail

			redirect(base_url(), 'refresh');
	    	exit();

			$this->load->view('inc/login/header');
			$this->load->view('registration');
			$this->load->view('inc/login/reg_footer');
	    }



	}


	public function logout(){


	$cooki_id 	 = get_cookie('user_id');
	$user_id 	 = $this->session->userdata('user_id');
	$remember_me = get_cookie('remember_me');

	if (isset($remember_me) === true) {
		delete_cookie('remember_me');
	}

	if (isset($cooki_id) === true && is_numeric($cooki_id) === true) {
		delete_cookie('user_id');
	}

	if (isset($user_id) === true) {
		$this->session->unset_userdata('user_id');
	}
    $this->cache->clean();  # add	    
    
    redirect(base_url().'login', 'refresh');
    ob_clean(); # add

	}


}
