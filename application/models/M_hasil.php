<?php

class m_hasil extends CI_Model{

  function hasil(){
    return $this->db->query("SELECT no_calon, count(pilih) as hasil FROM `hasil` GROUP BY no_calon");
  }
}
