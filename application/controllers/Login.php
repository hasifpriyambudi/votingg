<?php
defined('BASEPATH') or exit("No direct script access allowed");

class login extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model("m_login");
  }

  // LOGIN PEMILIH
  public function index(){
    if($this->session->userdata('pemilih')){
      redirect('pilih/tampil');
    }else {
      $this->load->view('loginPilih');
    }
  }
  public function loginPilih(){
    $output = array('error' => false);

    $nisn   = $_POST['nisn'];
    $token  = $_POST['token'];
    // Kirim DB
    $data = $this->m_login->loginPilih($nisn,$token);
    // cek benar
    if ($data) {
      $this->session->set_userdata('pemilih',$data);
      $output['message'] = 'Logging in. Please wait...';
    }else{
      $output['error'] = true;
      $output['message'] = 'Login Invalid, User Or Password Incorrect';
    }

    echo json_encode($output);
  }
  // Destroy Login
  function logout(){
    $this->session->sess_destroy();
    redirect('login');
  }
}
