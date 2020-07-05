<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tampil extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model("m_hasil");
    if(!$this->session->userdata('admin')){
      redirect('login_admin');
    }
  }

  // Tampilan Utama
  public function index(){
    $data['title']  = 'Home ~ Voting';
    $this->load->view('admin/master/header_home.php',$data);
    $this->load->view('admin/home.php');
    $this->load->view('admin/master/footer_home.php');
  }

  // Tampilan Calon
  public function calon(){
    $data['title']  = 'Halaman Calon ~ Voting';
    $data['calon']  = $this->db->query('SELECT * FROM calon ORDER BY nomor ASC');
    $this->load->view('admin/master/header_home.php',$data);
    $this->load->view('admin/calon.php');
    $this->load->view('admin/master/footer_home.php');
  }

  // Tampilan Pemilih
  public function pemilih(){
    $data['title'] = 'Halaman Pemilih ~ Voting';
    $data['pemilih']  = $this->db->query('SELECT * FROM pemilih ORDER BY kelas ASC');
    $this->load->view('admin/master/header_home.php',$data);
    $this->load->view('admin/pemilih.php');
    $this->load->view('admin/master/footer_home.php');
  }

  public function hasil(){
    $data['hasil'] = $this->m_hasil->hasil();
    $data['title'] = 'Hasil Pemilihan ~ Voting';
    $this->load->view('admin/master/header_home.php',$data);
    $this->load->view('admin/hasil.php');
    $this->load->view('admin/master/footer_home.php');
  }

  public function settings(){
    $data['title'] = 'Admin Area ~ Voting';
    $data['settings']  = $this->db->query('SELECT * FROM admin ORDER BY id');
    $this->load->view('admin/master/header_home.php',$data);
    $this->load->view('admin/settings.php');
    $this->load->view('admin/master/footer_home.php');
  }
}
