<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group_model extends CI_Model {
	function All(){
		$this->db->select('*');
		$this->db->from('group');
		$query = $this->db->get();
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
    }
	function save($data) {
        $this->db->insert('group', $data);
        return (($this->db->affected_rows()>0)?TRUE:FALSE);
    }
	function delete($id){
		$this->db->where('kode_group',$id);
		$this->db->delete('group'); 
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function find($id){
		$this->db->select('*');
		$this->db->where('kode_group',$id);
		$query = $this->db->get('group');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function update($data){
		$value = array('nama_group'=>$data['nama_group'],'update_at'=>$data['update_at']);
		$this->db->where('kode_group',$data['kode_group']);
		$this->db->update('group',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
}
?>