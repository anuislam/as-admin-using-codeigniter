<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_db extends CI_Model {

	public function chack_table_row($database, $ck_row = '')
	{
		$this->db->select('*'); 
		$query = $this->db->get($database); 
		$row = $query->row();
		if (isset($row) === true) {
			foreach ($row as $key => $value) {
				if ($ck_row ==$key) {
					return true;
				}
			}
		}
		return false;
	}

}
