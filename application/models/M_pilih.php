<?php

class m_pilih extends CI_Model{

  public function detailMisi($id){
    return $this->db->query("SELECT misi,nomor FROM calon WHERE id_calon='$id'");
  }
  public function pilih($idUser,$nomor){
    $tanggal = date('Y-m-d H:i:s');
    $this->db->query("INSERT INTO hasil set no_calon='$nomor'");
    $this->db->query("UPDATE pemilih SET status='1', jam_memilih='$tanggal' WHERE id='$idUser'");
  }
}
