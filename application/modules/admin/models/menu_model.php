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
	function All(){
		$query = $this->db->get('menu');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function delete($id){
		$this->db->where('kode_menu',$id);
		$this->db->delete('menu'); 
	}
	function save($data){
		$this->db->insert('menu', $data);
		if($this->db->affected_rows()>0){
			$query = $this->db->query('SELECT kode_menu FROM menu order by kode_menu desc LIMIT 1');
			$row = $query->row();
			return $row->kode_menu;
		}
		return NULL;
	}
}
?>