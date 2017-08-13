<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
function call_custom_hooks_admin(){
		$obj =& get_instance();
		$data_class = $obj->router->fetch_class();
		if ($data_class == 'dashboard') {
			//add_filter('ragister_admin_menu', 'function_name');					
			add_filter('manage_user_rool', 'manage_user_rool');			
			add_action('admin_menu', 'get_admin_menu');			
			ragister_admin_menu_function(); // after all menu filter and action	
		}
	}	

