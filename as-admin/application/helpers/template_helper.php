<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/************************************
/if is_serialize
/***********************************/

require_once(APPPATH.'helpers/inc/is_serialized.php');


/************************************
/call javascript file
/***********************************/

if ( ! function_exists('script_tag')){
	function script_tag($data = ''){
		if (is_array($data) === true) {
			foreach ($data as $key => $value) {

?>
<script src="<?php echo @$value['src']; ?>" type="<?php echo (isset($value['type'])) ? $value['type'] : 'text/javascript'; ?>"></script>
<?php

			}
		}

	}
}

/************************************
/sunatize_text
/***********************************/

if (! function_exists('sunatize_text')) {
	function sunatize_text($data){
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		$data = htmlentities($data);
		$data = strip_tags($data);
		return $data;
	}
}

/************************************
/if username exists
/***********************************/

if (! function_exists('_user_exists_by_username')) {
	function _user_exists_by_username($data){
		$obj =& get_instance();
		$obj->load->model('login_model');
		$obj->load->library('form_validation');
		
		$username = $data;
		$username = sunatize_text($username);
		if ($obj->login_model->user_exists($username) === false) {	    		
			$obj->form_validation->set_message('_user_exists_by_username', '%s does not exists.');
    		return false;
		}
		return true;
	}
}

/************************************
/chack valid user by username and password
/***********************************/

if (! function_exists('chack_valid_user')) {
	function chack_valid_user($password, $username){
		$obj =& get_instance();
		$obj->load->model('login_model');
		$obj->load->library('form_validation');
		
		$username = sunatize_text($username);

		$password = md5($password);


		if ($obj->login_model->chack_valid_user_by_password($username, $password) === false) {	    		
			$obj->form_validation->set_message('chack_valid_user', "Username and Password not match.");
    		return false;
		}
		return true;
	}
}

/************************************
/chack logged user
/***********************************/

function is_user_logged_in(){
	$obj =& get_instance();
	$obj->load->library('session');


	$remember_me = get_cookie('remember_me');
	$user_id 	 = $obj->session->userdata('user_id');

	if (isset($remember_me) === true && $remember_me == 'remember') {
		return true;
	}else{
		if (isset($user_id) === true && is_numeric($user_id) === true) {
			return true;
		}	
	}
	return false;
}

/************************************
/get The current user id
/***********************************/

function get_current_user_id(){
	$obj =& get_instance();
	$obj->load->library('session');	

	$cooki_id 	 = get_cookie('user_id');
	$user_id 	 = $obj->session->userdata('user_id');

	if (isset($cooki_id) === true && is_numeric($cooki_id) === true) {
		return $cooki_id;
	}else{
		if (isset($user_id) === true && is_numeric($user_id) === true) {
			return $user_id;
		}	
	}

	return false;	
}



/************************************
/custom hook like wordpress
/***********************************/

require_once(APPPATH.'helpers/inc/actions_hook.php');



/************************************
/User capability chack
/***********************************/

function user_can($user_id, $capability){
	$obj =& get_instance();
	$user_roll = $obj->user->get_the_user_meta($user_id, 'capabilities', true);

	$get_all_cap = apply_filters('manage_user_rool', array());

	if (isset($get_all_cap[$user_roll]['capabilities'])) {
		if (is_array($get_all_cap[$user_roll]['capabilities'])) {
			foreach ($get_all_cap[$user_roll]['capabilities'] as $key => $value) {
				if ($key == $capability) {
					return true;
					break;
				}
			}
		}		
	}
	return false;
}




/************************************
/User capability chack
/***********************************/

function custom_breadcrumb(){
?>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Home</a> 
				<i class="icon-angle-right"></i>
			</li>
			<li><a href="#">Dashboard</a></li>
		</ul>


<?php
}


function get_admin_table($name_class){
	$obj =& get_instance();	
	$obj->load->library($name_class);
	$data = new $name_class();
	$data->get_main_table();
}

function chack_database_table_row($db_name, $ck_row)
{
	$obj =& get_instance();	
	$obj->load->model('custom_db');
	if ($obj->custom_db->chack_table_row($db_name, $ck_row) === true) {
		return true;
	}
	return false;
}


function set_error_message($name, $msg){
	$obj =& get_instance();	
	$obj->load->library('session');
	$obj->session->set_userdata($name, $msg);
	return true;
}
function get_error_message($name){
	$obj =& get_instance();	
	$obj->load->library('session');
	$error_data = $obj->session->userdata($name);
	return $error_data;
}

function delete_error_msg($name){
	$obj =& get_instance();	
	$obj->load->library('session');
	$obj->session->unset_userdata($name);
	return true;
}

