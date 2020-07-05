<?php
defined('BASEPATH') or exit("No direct script access allowed");

class login_admin extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model("m_login");
  }

  // LOGIN PEMILIH
  public function index(){
    if($this->session->userdata('admin')){
      redirect('admin/tampil');
    }else {
      $this->load->view('loginAdmin');
    }
  }
  public function loginAdmin(){
    $output = array('error' => false);

    $user  = $_POST['user'];
    $pass  = $_POST['pass'];
    // Kirim DB
    $data = $this->m_login->loginAdmin($user,$pass);
    // cek benar
    if ($data) {
      $this->session->set_userdata('admin',$data);
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
    redirect('login_admin');
  }
}
