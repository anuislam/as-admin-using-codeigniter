<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function get_user($user_id){
		if (is_numeric($user_id) === true) {
			$this->db->select('*'); 
			$this->db->where('ID', $user_id); 
			$query = $this->db->get('cod_user'); 
			$row = $query->row();
			if (isset($row) === true) {
				return $row;
			}			
		}
		return false;
	}


	public function get_user_by($data){
		if (valid_email($data) === true) {
			$this->db->select('*'); 
			$this->db->where('user_email', $data); 
			$query = $this->db->get('cod_user'); 
			$row = $query->row();
			if (isset($row) === true) {
				return $row;
			}	
		}else if (is_numeric($data)) {
			return $this->get_user($data);
		}else{
			$this->db->select('*'); 
			$this->db->where('username', $data); 
			$query = $this->db->get('cod_user'); 
			$row = $query->row();
			if (isset($row) === true) {
				return $row;
			}	
		}
		return false;
	}


	public function get_users($config = ''){
		$user_per_page 	= (isset($config['user_per_page'])) ? $config['user_per_page'] : 10 ;
		$user_paged 	= (isset($config['user_paged'])) ? $config['user_paged'] : 0 ;
		$orderby 		= (isset($config['orderby'])) ? $config['orderby'] : false ;
		$order 			= (isset($config['order'])) ? $config['order'] : false ;
		$search 		= (isset($config['search'])) ? $config['search'] : false ;

		$this->db->select('*'); 
		if ($orderby && $order) {
			if ($this->db->table_exists('contacts') && $this->db->table_exists('contacts')) {
				# code...
			}
			$this->db->order_by($orderby, $order);
		}
		if ($search) {
			$this->db->like('username', $search, 'both');
		}
		$this->db->limit($user_per_page, $user_paged);		
		$query = $this->db->get('cod_user'); 
		if ($query->num_rows() > 0) {
			return $query->result();
		}	
		return false;
	}


	public function get_the_user_meta($user_id, $meta_key = '', $single = false){
		$user_id 	= (int)$user_id;
		$meta_key 	= (string)$meta_key;
		$single 	= (bool)$single;
		if ($single === true) {
			$this->db->select('meta_value'); 
			$this->db->where('user_ID', $user_id);
			$this->db->where('meta_key', $meta_key);
			$query = $this->db->get('cod_usemeta');
			$row = $query->row_array();
			if (isset($row) === true) {

				if (is_serialized($row['meta_value']) === true) {
					return unserialize($row['meta_value']);
				}else{
					return $row['meta_value'];
				}

				
			}
		}else{
			$this->db->select('*'); 
			$this->db->where('user_ID', $user_id);  
			$query = $this->db->get('cod_usemeta');
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $value) {

					if (is_serialized($value->meta_value) === true) {
						$data[$value->meta_key] = unserialize($value->meta_value);
					}else{
						$data[$value->meta_key] = $value->meta_value;
					}						
					
				}
				return $data;
			}			
		}
		return false;
	}

	public function add_user_meta($user_id, $key, $value)
	{
		if (is_numeric($value) === true) {
			$value = (int)$value;
		}else if (is_object($value) === true) {
			$value = serialize($value);
		}else if (is_array($value) === true) {
			$value = serialize($value);
		}else if (is_bool($value) === true) {
			$value = (bool)$value;
		}else{
			$value = (string)$value;
		}
		
		$data = array(
				'user_ID' 		=> $user_id,
				'meta_key' 		=> $key,
				'meta_value' 	=> $value
			);
		$this->db->insert('cod_usemeta', $data);
		return $this->db->insert_id(); 
	}

	public function total_uset_count()
	{
		$this->db->select('*'); 
		$query = $this->db->get('cod_user'); 
		return $query->num_rows();
	}

}
