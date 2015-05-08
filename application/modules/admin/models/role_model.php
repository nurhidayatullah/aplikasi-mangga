<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class role_model extends CI_Model {
	function All(){
		$this->db->select('a.kode_role,a.kode_menu,c.nama_menu,a.kode_group,b.nama_group,a.view,a.itambah,a.iupdate,a.idelete,a.create_at,a.update_at');
		$this->db->join('group_user as b','a.kode_group=b.kode_group');
		$this->db->join('menu as c','c.kode_menu=a.kode_menu');
		$this->db->order_by('a.kode_menu');
		$this->db->from('role as a');
		$query = $this->db->get();
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
    }
	function update($data,$kode){
		$this->db->where('kode_role',$kode);
		$this->db->update('role',$data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function save($data) {
        $this->db->insert('role', $data);
        return (($this->db->affected_rows()>0)?TRUE:FALSE);
    }
}
?>