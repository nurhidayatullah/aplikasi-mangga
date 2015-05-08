<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu_model extends CI_Model {
	function get_menu($parent,$group){
		$this->db->select('a.kode_menu,b.nama_menu,b.controller,a.itambah,a.iupdate,a.idelete');
		$this->db->join('menu as b','a.kode_menu=b.kode_menu');
		$this->db->where('a.kode_group',$group);
		$this->db->where('b.kode_parent',$parent);
		$this->db->where('a.view',1);
		$query = $this->db->get('role as a');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function get_parent($parent){
		$this->db->where('kode_parent',$parent);
		$query = $this->db->get('menu');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function get_priv($id,$group){
		$this->db->select('itambah,iupdate,idelete');
		$this->db->where('kode_group',$group);
		$this->db->where('kode_menu',$id);
		$query = $this->db->get('role');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function getById($id){
		$this->db->where('kode_menu',$id);
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
	function update($data){
		$value = array(
			'nama_menu'=>$data['nama_menu'],
			'controller'=>$data['controller'],
			'update_at'=>$data['update_at'],
			'kode_parent'=>$data['kode_parent']
		);
		$this->db->where('kode_menu',$data['kode_menu']);
		$this->db->update('menu',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
}
?>