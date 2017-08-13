<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function user_exists($data){
		$this->db->select('ID'); 
		$this->db->where('username', $data); 
		$query = $this->db->get('cod_user'); 
		return ($query->num_rows() > 0) ? true : false ;
	}


	public function chack_valid_user_by_password($username, $password){
		$this->db->select('ID'); 
		$this->db->where('username', $username); 
		$this->db->where('password', $password); 
		$query = $this->db->get('cod_user'); 
		return ($query->num_rows() > 0) ? true : false ;
	}

	public function get_user_id_by_username_and_password($username, $password){
		$this->db->select('ID'); 
		$this->db->where('username', $username); 
		$this->db->where('password', $password); 
		$query = $this->db->get('cod_user'); 
		if ($query->num_rows() == 1) {
			$data = $query->result_array();
			return $data[0]['ID'];
		}
		return false;
	}

	public function insert_user($data){
		$this->db->insert('cod_user', $data);
		return $this->db->insert_id(); 
	}

}
