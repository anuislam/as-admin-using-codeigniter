<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function ragister_admin_menu_function(){
	global $menu;
	$menu = array();
	$menu[] = array(
				'title' 	=> 'Dashboard',
				'url' 		=> base_url('dashboard'),
				'icon' 		=> 'icon-dashboard',
				'page_title'=> 'Dashboard',
				'capability'=> 'read',
				); 
	$menu[] =	array(
						'title' 	=> 'Post',
						'url' 		=> base_url('dashboard/post-new'),
						'icon' 		=> 'icon-pushpin',
						'page_title'=> 'New Post',
						'capability'=> 'read',
						'parent'	=> array(
								array(
									'title' 	=> 'Add New Post',
									'url' 		=> base_url('dashboard/post-new'),
									'page_title'=> 'Add New Post',
									'capability'=> 'manage_options',
								),
								array(
									'title' 	=> 'All Post',
									'url' 		=> base_url('dashboard/all-post'),
									'page_title'=> 'All Post',
									'capability'=> 'read',
								),
								array(
									'title' 	=> 'Categories',
									'url' 		=> base_url('dashboard/categories'),
									'page_title'=> 'Categories',
									'capability'=> 'manage_options',
								),
							)
					);

	$menu[] = array(
				'title' 	=> 'User',
				'url' 		=> base_url('dashboard/user'),
				'icon' 		=> 'icon-user',
				'capability'=> 'read',
				'parent'	=> array(
								array(
									'title' 	=> 'Your Profile',
									'url' 		=> base_url('dashboard/profile'),
									'page_title'=> 'Profile',
									'capability'=> 'read',
								),
								array(
									'title' 	=> 'Add New User',
									'url' 		=> base_url('dashboard/add-new-user'),
									'page_title'=> 'Add New User',
									'capability'=> 'manage_options',
								),
								array(
									'title' 	=> 'All Users',
									'url' 		=> base_url('dashboard/all-user'),
									'page_title'=> 'All Users',
									'capability'=> 'manage_options',
								),
							)
				); 

	$menu = apply_filters('ragister_admin_menu', $menu);

	add_filter('admin_menu_filter', function(){
		global $menu;
		return $menu;
	});

	foreach ($menu as $value) {					
		add_admin_menu($value);
	}		
}

