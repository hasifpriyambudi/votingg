<?php
defined('BASEPATH') or exit("No direct script access allowed");

class tampil extends CI_Controller{

  function __construct(){
    parent::__construct();
    if(!$this->session->userdata('pemilih')){
      $this->load->view('alert');
    }
  }

  public function index(){
    // Cek Sudah Memilih atau Belum
    $session = $this->session->userdata();
    foreach ($session as $look) {
      $status = $look['status'];
      $nama = $look['nama'];
      $kelas = $look['kelas'];
    }
    if(!$this->session->userdata('pemilih')){
      $this->load->view('alert');
    }elseif ($status == 1) {
      $this->session->sess_destroy();
      echo "<script>
        alert('Anda sudah memilih');
        setTimeout(
          function(){
            window.location.href = '".base_url()."publik/hasil'
          },
          800);
    </script>";
    }else {
      $data['title'] = 'Pilih Calon - Voting';
      $data['calon'] = $this->db->query("SELECT * FROM calon ORDER BY nomor");
      $this->load->view("pilih/index.php",$data);
    }
  }
}
