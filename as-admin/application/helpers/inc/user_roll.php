<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function manage_user_rool(){

	require_once(APPPATH.'hooks/user_capabilities.php');

	$obj = new User_capabilities();-
	$obj->add_roll('subscriber', 'Subscriber');
	$obj->add_roll('contributor', 'Contributor');
	$obj->add_roll('author', 'Author');
	$obj->add_roll('editor', 'Editor');
	$obj->add_roll('administrator', 'Administrator');

	do_action('add_user_roll', $obj);
	
	/***************************************
	/for subscriber capabilities
	/**************************************/
	$obj->add_cap('subscriber', 'read');
	/***************************************
	/for contributor capabilities
	/**************************************/
	$obj->add_cap('contributor', 'delete_posts');
	$obj->add_cap('contributor', 'edit_posts');
	$obj->add_cap('contributor', 'read');
	/***************************************
	/for editor capabilities
	/**************************************/
	$obj->add_cap('editor', 'delete_others_pages');
	$obj->add_cap('editor', 'delete_others_posts');
	$obj->add_cap('editor', 'delete_pages');
	$obj->add_cap('editor', 'delete_posts');
	$obj->add_cap('editor', 'delete_private_pages');
	$obj->add_cap('editor', 'delete_private_posts');
	$obj->add_cap('editor', 'delete_published_pages');
	$obj->add_cap('editor', 'delete_published_posts');
	$obj->add_cap('editor', 'edit_others_pages');
	$obj->add_cap('editor', 'edit_others_posts');
	$obj->add_cap('editor', 'edit_pages');
	$obj->add_cap('editor', 'edit_posts');
	$obj->add_cap('editor', 'edit_private_pages');
	$obj->add_cap('editor', 'edit_private_posts');
	$obj->add_cap('editor', 'edit_published_pages');
	$obj->add_cap('editor', 'edit_published_posts');
	$obj->add_cap('editor', 'manage_categories');
	$obj->add_cap('editor', 'manage_links');
	$obj->add_cap('editor', 'moderate_comments');
	$obj->add_cap('editor', 'publish_pages');
	$obj->add_cap('editor', 'publish_posts');
	$obj->add_cap('editor', 'read');
	$obj->add_cap('editor', 'read_private_pages');
	$obj->add_cap('editor', 'read_private_posts');
	$obj->add_cap('editor', 'unfiltered_html');
	$obj->add_cap('editor', 'upload_files');
	/***************************************
	/for author capabilities
	/**************************************/
	$obj->add_cap('author', 'delete_posts');
	$obj->add_cap('author', 'delete_published_posts');
	$obj->add_cap('author', 'edit_posts');
	$obj->add_cap('author', 'edit_published_posts');
	$obj->add_cap('author', 'publish_posts');
	$obj->add_cap('author', 'read');
	$obj->add_cap('author', 'upload_files');
	/***************************************
	/for administrator capabilities
	/**************************************/
	$obj->add_cap('administrator', 'activate_plugins');
	$obj->add_cap('administrator', 'delete_others_pages');
	$obj->add_cap('administrator', 'delete_others_posts');
	$obj->add_cap('administrator', 'delete_pages');
	$obj->add_cap('administrator', 'delete_posts');
	$obj->add_cap('administrator', 'delete_private_pages');
	$obj->add_cap('administrator', 'delete_private_posts');
	$obj->add_cap('administrator', 'delete_published_pages');
	$obj->add_cap('administrator', 'delete_published_posts');
	$obj->add_cap('administrator', 'edit_dashboard');
	$obj->add_cap('administrator', 'edit_others_pages');
	$obj->add_cap('administrator', 'edit_others_posts');
	$obj->add_cap('administrator', 'edit_pages');
	$obj->add_cap('administrator', 'edit_posts');
	$obj->add_cap('administrator', 'edit_private_pages');
	$obj->add_cap('administrator', 'edit_private_posts');
	$obj->add_cap('administrator', 'edit_published_pages');
	$obj->add_cap('administrator', 'edit_published_posts');
	$obj->add_cap('administrator', 'edit_theme_options');
	$obj->add_cap('administrator', 'export');
	$obj->add_cap('administrator', 'import');
	$obj->add_cap('administrator', 'list_users');
	$obj->add_cap('administrator', 'manage_categories');
	$obj->add_cap('administrator', 'manage_links');
	$obj->add_cap('administrator', 'manage_options');
	$obj->add_cap('administrator', 'moderate_comments');
	$obj->add_cap('administrator', 'promote_users');
	$obj->add_cap('administrator', 'publish_pages');
	$obj->add_cap('administrator', 'publish_posts');
	$obj->add_cap('administrator', 'read_private_pages');
	$obj->add_cap('administrator', 'read_private_posts');
	$obj->add_cap('administrator', 'read');
	$obj->add_cap('administrator', 'remove_users');
	$obj->add_cap('administrator', 'switch_themes');
	$obj->add_cap('administrator', 'upload_files');
	$obj->add_cap('administrator', 'customize');
	$obj->add_cap('administrator', 'delete_site');
	$obj->add_cap('administrator', 'update_core');
	$obj->add_cap('administrator', 'update_plugins');
	$obj->add_cap('administrator', 'update_themes');
	$obj->add_cap('administrator', 'install_plugins');
	$obj->add_cap('administrator', 'install_themes');
	$obj->add_cap('administrator', 'upload_plugins');
	$obj->add_cap('administrator', 'upload_themes');
	$obj->add_cap('administrator', 'delete_themes');
	$obj->add_cap('administrator', 'delete_plugins');
	$obj->add_cap('administrator', 'edit_plugins');
	$obj->add_cap('administrator', 'edit_themes');
	$obj->add_cap('administrator', 'edit_users');
	$obj->add_cap('administrator', 'create_users');
	$obj->add_cap('administrator', 'delete_users');	
	$obj->add_cap('administrator', 'unfiltered_html');


	do_action('add_user_capabilities', $obj);

	return $obj->get_user_cap_and_roll();
}
