<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function index($page_val = ''){		
		if (is_user_logged_in() === true) {
			$cur_userdata = $this->user->get_user(get_current_user_id());
			$data = array();
			$data['currentuserdata'] = $cur_userdata;
			$data['page_title'] 	 = page_title();
			switch ($page_val) {
			    case "all-user":
				    if (user_can(get_current_user_id(), 'manage_options') === true) {
						$this->load->view('inc/dashboard/header', $data);
						$this->load->view('dashboard/navber', $data);
						$this->load->view('inc/dashboard/all-user', $data);									
						$this->load->view('inc/dashboard/footer', $data);
				    }else{
				    	redirect(base_url('dashboard/profile'), 'refresh');
				    }			        
			        break;
			    default:
				$this->load->view('inc/dashboard/header', $data);
				$this->load->view('dashboard/navber', $data);
				$this->load->view('dashboard/dashboard', $data);
				$this->load->view('inc/dashboard/footer', $data);
			}
		}else{
			redirect(base_url('login'), 'refresh');
	    	exit();
		}
	}

}
