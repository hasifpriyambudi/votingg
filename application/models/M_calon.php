<?php

class M_calon extends CI_Model
{

  function tambahCalon($data){
    $this->db->insert("calon",$data);
  }

  public function detailMisi($id){
    return $this->db->query("SELECT misi, nomor FROM calon WHERE id_calon='$id'");
  }
}
