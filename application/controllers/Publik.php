<?php
defined('BASEPATH') or exit("No direct script access allowed");

class publik extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model('m_hasil');
  }

  public function hasil(){
    $data['hasil'] = $this->m_hasil->hasil();
    $data['title'] = 'Hasil Pemilihan ~ Voting';
    $this->load->view('admin/master/header_home.php',$data);
    $this->load->view('hasil.php');
    $this->load->view('admin/master/footer_home.php');
  }

  public function cek(){
    echo kredit();
  }

  public function prosesHasil(){
    $data = $this->m_hasil->hasil()->result();
    echo json_encode($data);
  }
}
