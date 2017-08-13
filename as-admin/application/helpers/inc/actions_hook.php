<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'hooks/custom_hooks.php');


function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1){
	global $custom_hooks;
	return $custom_hooks->add_action($tag, $function_to_add, $priority, $accepted_args);
}

function do_action($tag, $arg = ''){
	global $custom_hooks;
	return $custom_hooks->do_action($tag, $arg);
}
function has_action($tag, $function_to_check = false){
	global $custom_hooks;
	return $custom_hooks->has_action($tag, $function_to_check);
}
function remove_action( $tag, $function_to_remove, $priority = 10 ){
	global $custom_hooks;
	return $custom_hooks->remove_action($tag, $function_to_remove, $priority);
}
function remove_all_actions($tag, $priority = false){
	global $custom_hooks;
	return $custom_hooks->remove_all_actions($tag, $priority);
}



function add_filter ($tag, $function_to_add, $priority = 10, $accepted_args = 1){
	global $custom_hooks;
	return $custom_hooks->add_filter($tag, $function_to_add, $priority, $accepted_args);
}

function apply_filters($tag, $value){
	global $custom_hooks;
	return $custom_hooks->apply_filters($tag, $value);
}
function has_filter($tag, $function_to_check = false) {
	global $custom_hooks;
	return $custom_hooks->has_filter($tag, $function_to_check);
}
function remove_filter( $tag, $function_to_remove, $priority = 10 ){
	global $custom_hooks;
	return $custom_hooks->remove_filter( $tag, $function_to_remove, $priority);
}
