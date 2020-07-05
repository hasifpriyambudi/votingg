<?php

class m_pemilih extends CI_Model{

  function tambah($data){
    return $this->db->insert('pemilih',$data);
  }
  function hapus($id){
    return $this->db->query("DELETE FROM pemilih WHERE id='$id'");
  }
  function detailPemilih($id){
    return $this->db->query("SELECT * FROM pemilih WHERE id='$id'");
  }
  function updatePemilih($id,$data){
    return $this->db->query("UPDATE pemilih SET nama=?,jenis=?,kelas=? WHERE id='$id'",$data);
  }
  function tambahExcel($data){
    return $this->db->insert_batch('pemilih',$data);
    // if ($cek) {
    //   return TRUE;
    // }else {
    //   return FALSE;
    // }
  }
}
