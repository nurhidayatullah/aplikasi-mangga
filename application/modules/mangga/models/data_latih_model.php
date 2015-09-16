<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_latih_model extends CI_Model {
	function save($data){
		$this->db->insert('data_latih', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function All(){
		$this->db->select('a.kode_data,a.mean_g,a.momen_g,a.dev_g,a.circularity,a.compactness,b.nama_mangga,b.biner,a.nama_file');
		$this->db->join('mangga as b','a.kode_mangga=b.kode_mangga');
		$query = $this->db->get('data_latih as a');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function AllDataUji(){
		$query = $this->db->get('data_uji');
		if($query->row_array()>0){
			return $query->result_array();
		}
		return NULL;
	}
	function saveUji($data){
		$this->db->insert('uji_coba', $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function getCount(){
		$query = $this->db->get('data_latih'); 
		return $query->num_rows();
	}
	function delete($id){
		$this->db->where('kode_data',$id);
		$this->db->delete('data_latih'); 
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function updateData($data,$id,$table){
		$this->db->where('kode_data',$id);
		$this->db->update($table, $data);
		return (($this->db->affected_rows()>0)?TRUE:FALSE);
	}
	function get_foto($id){
		$this->db->select('nama_file');
		$this->db->where('kode_data',$id);
		$query = $this->db->get('data_latih');
		if($query->row_array()>0){
			foreach($query->result_array() as $data){
				$foto = $data['nama_file'];
			}
			return $foto;
		}
		return NULL;
	}
	function get_json_data_latih(){
		$data_latih = array();
		$this->db->select('a.kode_data,a.mean_g,a.momen_g,a.dev_g,a.circularity,a.compactness,b.biner');
		$this->db->join('mangga as b','a.kode_mangga=b.kode_mangga');
		$query = $this->db->get('data_latih as a');
		if($query->row_array()>0){
			$i = 1;
			foreach($query->result_array() as $data){
				$dt = array(
					'id' => $i,
					'mean_g' => $data['mean_g'],
					'momen_g' => $data['momen_g'],
					'dev_g' => $data['dev_g'],
					'compactness' => $data['compactness'],
					'circularity' => $data['circularity'],
					'target' => $data['biner']
				);
				array_push($data_latih,$dt);
				$i++;
			}
			return json_encode($data_latih);
		}
		return NULL;
	}
}
?>