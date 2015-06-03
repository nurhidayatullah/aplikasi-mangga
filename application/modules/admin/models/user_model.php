<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model {
	function All(){
		$this->db->select('a.*,b.nama_group');
		$this->db->join('group_user as b','a.kode_group=b.kode_group');
		$this->db->from('user as a');
		$query = $this->db->get();
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
    }
	function actived($data){
		$value = array('active'=>$data['active'],'update_at'=>$data['update_at']);
		$this->db->where('kode_user',$data['kode_user']);
		$this->db->update('user',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function save($data) {
        $this->db->insert('user', $data);
        return (($this->db->affected_rows()>0)?TRUE:FALSE);
    }
	function delete($id){
		$this->db->where('kode_user',$id);
		$this->db->delete('user'); 
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function find($id){
		$this->db->where('kode_user',$id);
		$query = $this->db->get('user');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function update_profile($data){
		$value = array(
			'first_name'=>$data['first_name'],
			'last_name'=>$data['last_name'],
			'email'=>$data['email'],
			'password'=>$data['password'],
			'update_at'=>$data['update_at']
		);
		$this->db->where('kode_user',$data['kode_user']);
		$this->db->update('user',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function update($data){
		$value = array(
			'first_name'=>$data['first_name'],
			'last_name'=>$data['last_name'],
			'email'=>$data['email'],
			'kode_group'=>$data['kode_group'],
			'update_at'=>$data['update_at']
		);
		$this->db->where('kode_user',$data['kode_user']);
		$this->db->update('user',$value);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
}
?>