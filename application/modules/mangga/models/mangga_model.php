<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mangga_model extends CI_Model {
	function All(){
		$query = $this->db->get('mangga');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
    }
	function get_biner(){
		$this->db->select('biner');
		$query = $this->db->get('mangga');
		if($query->row_array()>0){
			$x = array();
			foreach($query->result_array() as $data){
				$x[]=$data['biner'];
			}
			return $x;
		}
		return NULL;
	}
	
	function getCount(){
		$query = $this->db->get('mangga'); 
		return $query->num_rows();
	}
	
	function getDataByBiner($data){
		$this->db->where('biner',$data);
		$query = $this->db->get('mangga');
		if($query->row_array()>0){
			return $query->row_array();
		}
		return NULL;
		
	}
	function add($data) {
        $this->db->insert('mangga', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
    }
	
	function saveLog($data) {
        $this->db->insert('data_uji', $data);
		return (($this->db->affected_rows()>0)?$this->db->insert_id():FALSE);
    }
	function delete($id){
		$this->db->where('kode_mangga',$id);
		$this->db->delete('mangga'); 
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function get_foto($id){
		$this->db->select('foto');
		$this->db->where('kode_mangga',$id);
		$query = $this->db->get('mangga');
		if($query->row_array()>0){
			foreach($query->result_array() as $data){
				$foto = $data['foto'];
			}
			return $foto;
		}
		return NULL;
	}
	
	function getDetailDataUji($id){
		$this->db->where('kode_data',$id);
		$query = $this->db->get('data_uji');
		if($query->row_array()>0){
			return $query->row_array();
		}
		return NULL;
	}
}
?>