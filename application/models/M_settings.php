<?php

class m_settings extends CI_model{

  function tambah($data){
    return $this->db->insert('admin',$data);
  }
  function infoAdmin($id){
    return $this->db->query("SELECT * FROM admin WHERE id='$id'");
  }
  function hapus($id){
    return $this->db->query("DELETE FROM admin WHERE id='$id'");
  }
  function updateAdmin($id,$nama){
    return $this->db->query("UPDATE admin SET nama='$nama' WHERE id='$id'");
  }
  function updateAdmin2($id,$data){
    return $this->db->query("UPDATE admin set nama=?, password=? WHERE id='$id'",$data);
  }
  public function hapusSemua($user){
    $tanggal = date("Y-m-d H:i:s");
    // ORang yang menghapus
    $this->db->query("INSERT INTO rekam SET user='$user', tanggal='$tanggal'");
    // HAPUS DATA
    $this->db->query("DELETE FROM calon");
    $this->db->query("DELETE FROM hasil");
    $this->db->query("DELETE FROM pemilih");
    return TRUE;
  }
}
