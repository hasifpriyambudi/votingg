<?php

class M_login extends CI_Model{

  function loginPilih($nisn,$token){
    $query = $this->db->get_where('pemilih', array('nik'=>$nisn, 'token'=>$token));
		return $query->row_array();
  }

  public function loginAdmin($user,$pass){
    $query = $this->db->get_where('admin', array('user'=>$user, 'password'=>md5($pass)));
		return $query->row_array();
  }
}
