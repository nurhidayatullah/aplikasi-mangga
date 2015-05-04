<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu_model extends CI_Model {
	function get_menu($parent){
		$this->db->where('kode_parent',$parent);
		$this->db->order_by('nama_menu');
		$query = $this->db->get('menu');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
}
?>