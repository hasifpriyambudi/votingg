<?php
defined('BASEPATH') or exit("No direct script allowed");

class settings extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model('m_settings');
    if(!$this->session->userdata('admin')){
      redirect('login_admin');
    }
  }

  function tambah(){
    $nama = $this->input->post('nama');
    $pass = $this->input->post('pass');
    // Generate User
    $user = explode(" ",$nama);
    if (count($user) == 1) {
      $user = strtolower($user[0]);
    }else {
      $user = strtolower($user[0].substr($user[1],0,3));
    }
    // CEK Plagiat User
    $cekUser = $this->db->query("SELECT * FROM admin WHERE user='$user'");
    if ($cekUser->num_rows() < 1) {
      // BUAT ARRAY
      $data = array('nama' => $nama, 'user' => $user, 'password' => md5($pass));
      // KIRIM DB
      $kirim = $this->m_settings->tambah($data);
      $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "User Pengguna Tersebut '.$user.'!!!", type: "success", showConfirmButton: false}); </script>';
      $this->load->view('admin/master/alert',$alert);
    }else {
      $alert['alert'] = '<script type="text/javascript">swal({ title: "Gagal!", text: "Coba Gunakan Nama Secara Lengkap/Lain!!!", type: "warning", showConfirmButton: false}); </script>';
      $this->load->view('admin/master/alert',$alert);
    }
  }

  function infoAdmin($id){
    $data = $this->m_settings->infoAdmin($id)->row();
    echo json_encode($data);
  }

  function hapus(){
    $data = $this->m_settings->hapus($this->input->post('idHapus'));
    $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Admin Berhasil Dihapus!!!", type: "success", showConfirmButton: false}); </script>';
    $this->load->view('admin/master/alert',$alert);
  }

  function updateAdmin(){
    $id = $this->input->post('infoId');
    $nama = $this->input->post('namaEdit');
    $pass = $this->input->post('passEdit');
    if ($pass == null) {
      $kirim = $this->m_settings->updateAdmin($id,$nama);
      // $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Admin Berhasil Diupdate!!!", type: "success", showConfirmButton: false}); </script>';
      // $this->load->view('admin/master/alert',$alert);
    }else {
      $data = array('nama' => $nama, 'password' => md5($pass));
      $kirim = $this->m_settings->updateAdmin2($id,$data);
      // $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Admin Berhasil Diupdate!!!", type: "success", showConfirmButton: false}); </script>';
      // $this->load->view('admin/master/alert',$alert);
    }
  }

  public function hapusSemua($user){
    // Cek User Ada Atau Tidak
    $cekUser = $this->db->query("SELECT user FROM admin WHERE user='$user'")->num_rows();
    if ($cekUser<1) {
      $alert['alert'] = '<script type="text/javascript">swal({ title: "GAGAL!", text: "Anda Bukan Admin!!!", type: "warning", showConfirmButton: false}); </script>';
      $this->load->view('admin/master/alert',$alert);
    }else {
      $data = $this->m_settings->hapusSemua($user);
      $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Semua Data Berhasil Dihapus!!!", type: "success", showConfirmButton: false}); </script>';
      $this->load->view('admin/master/alert',$alert);
    }
  }
}
