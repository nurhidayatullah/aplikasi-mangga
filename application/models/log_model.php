<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log_model extends CI_Model {
	function save($data){
		$this->db->insert('log', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function getLast(){
		$query = $this->db->get('log');
		if($query->num_rows()>0){
			foreach($query->result_array() as $data){
				$tanggal = $data['tanggal'];
				$last = $data['last_epoch'];
			}
			return array('tanggal'=>$tanggal,'last'=>$last);
		}
		return NULL;
	}
	function kosongkan(){
		$this->db->truncate('log'); 
		return (($this->db->affected_rows()>0)?$v:FALSE);
	}
}
?>