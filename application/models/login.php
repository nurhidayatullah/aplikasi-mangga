<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {
	function ceck_login(){
		$this->load->library('session');
        $user_id = $this->session->userdata('kode_user');
		if($user_id){
             return TRUE;
		}else{
             return FALSE;
		}
	}
	function do_login($data){
		$this->db->where('email',$data['email']);
		$this->db->where('password',$data['password']);
		$this->db->where('active',1);
		$user = $this->db->get('user');
		if($user->num_rows() ==1){
			return $user->result_array();
		}
		return NULL;
	}
}
?>