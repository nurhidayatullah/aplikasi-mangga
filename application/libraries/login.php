<?php
class Login{
	function ceck_login(){
		$this->load->library('session');
        $user_id = $this->session->userdata('kode_admin');
		if($user_id){
             return TRUE;
		}else{
             return FALSE;
		}
	}
}
?>