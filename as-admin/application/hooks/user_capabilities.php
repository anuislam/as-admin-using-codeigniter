<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_capabilities{

	public $capabilities;

	public function __construct(){
		$this->capabilities = array();
	}

	public function add_cap($roll, $data){		
		foreach ($this->capabilities as $key => $value) {
			if ($key == $roll) {
				$this->capabilities[$roll]['capabilities'][$data] = 1;
			}
		}
	}

	public function remove_cap($roll, $data){
		foreach ($this->capabilities[$roll]['capabilities'] as $key => $value) {
			if ($key == $data) {
				unset($this->capabilities[$roll]['capabilities'][$data]);
			}
		}
	}

	public function get_cap($roll, $data){
		foreach ($this->capabilities[$roll]['capabilities'] as $key => $value) {
			if ($key == $data) {
				return $key;
				break;
			}
		}
		return false;
	}

	public function add_roll($roll, $title){
		$this->capabilities[$roll]['title'] = $title;
	}

	public function get_roll($roll){
		foreach ($this->capabilities as $key => $value) {
			if ($key == $roll) {
				return $key;
				break;
			}
		}
		return false;
	}

	public function remove_roll($roll){
		foreach ($this->capabilities as $key => $value) {
			if ($key == $roll) {
				unset($this->capabilities[$roll]);
			}
		}

	}

	public function get_user_cap_and_roll(){
		return $this->capabilities;
	}
}
