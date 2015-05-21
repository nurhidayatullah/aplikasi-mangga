<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group_model extends CI_Model {
	function All(){
		$this->db->select('*');
		$this->db->from('group_user');
		$query = $this->db->get();
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
    }
	function save($data) {
        $this->db->insert('group_user', $data);
		if($this->db->affected_rows()>0){
			$query = $this->db->query('SELECT kode_group FROM group_user order by kode_group desc LIMIT 1');
			$row = $query->row();
			return $row->kode_group;
		}
        return NULL;
    }
	function delete($id){
		$this->db->where('kode_group',$id);
		$this->db->delete('group_user'); 
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function find($id){
		$this->db->select('*');
		$this->db->where('kode_group',$id);
		$query = $this->db->get('group_user');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function find_role($id){
		$this->db->select('a.kode_role,a.kode_menu,c.nama_menu,a.kode_group,a.view,a.itambah,a.iupdate,a.idelete,a.create_at,a.update_at');
		$this->db->join('menu as c','c.kode_menu=a.kode_menu');
		$this->db->where('a.kode_group',$id);
		$this->db->order_by('a.kode_menu');
		$this->db->from('role as a');
		$query = $this->db->get();
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function update($data){
		$value = array('nama_group'=>$data['nama_group'],'update_at'=>$data['update_at']);
		$this->db->where('kode_group',$data['kode_group']);
		$this->db->update('group_user',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
}
?>