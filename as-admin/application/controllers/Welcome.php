<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

/*
	public function ajax(){
		if ($this->input->is_ajax_request()) {
			if (empty($_POST['mydata']) === false) {
				$display_name = $_POST['mydata']['name']['title'].'.'.$_POST['mydata']['name']['first'].' '.$_POST['mydata']['name']['last'];
				$username 	= $_POST['mydata']['login']['username'];
				$nicname	= $_POST['mydata']['login']['username'];
				$password	= md5('123456789');
				$registered	= time();
				$capabilities	= 'author';
				$picture		= $_POST['mydata']['picture']['large'];
				$email			= $_POST['mydata']['email'];
				$active_key 		= $email.time();
				$active_key 		= md5($active_key);



				$full_data 	= array(
						'username' 				=> $username,
						'password' 				=> $password,
						'user_nicename' 		=> $nicname,
						'user_email' 			=> $email,
						'user_registered' 		=> $registered,
						'user_activation_key' 	=> $active_key,
						'display_name' 			=> $display_name,
					);

				$user_id = $this->login_model->insert_user($full_data);
				$this->user->add_user_meta($user_id, 'profile_pic',  $picture);
				$this->user->add_user_meta($user_id, 'capabilities', $capabilities);


			}
		}		
	}*/

}
