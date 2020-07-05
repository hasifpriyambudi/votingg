<?php
defined('BASEPATH') or exit("No direct script access allowed");

class calon extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model('m_pilih');
    if(!$this->session->userdata('pemilih')){
      $this->load->view('alert');
    }
  }

  public function detailMisi($id){
    $data = $this->m_pilih->detailMisi($id)->row();
    echo json_encode($data);
  }

  public function pilih($nomor){
    // GET id user
    $data = $this->session->userdata();
    foreach ($data as $look) {
      $idUser = $look['id'];
    }
    // Cek Sudah Memilih atau belum
    $cekPilih = $this->db->query("SELECT status FROM pemilih WHERE id='$idUser'")->row();
    if ($cekPilih->status == 1) {
      $this->session->sess_destroy();
      echo "<script>
        alert('Anda Sudah Memilih')
        setTimeout(
          function(){
            window.location.href = '".base_url()."publik/hasil'
          },
          800);
    </script>";
    }else {
      // Pilih Calon
      $kirim = $this->m_pilih->pilih($idUser,$nomor);
      redirect('/pilih/tampil/hasil');
    }
  }
}
