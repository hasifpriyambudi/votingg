<?php
defined('BASEPATH') or exit("No direct script access allowed");

class calon extends CI_Controller{

  // Konstruk
  function __construct(){
    parent::__construct();
    $this->load->model("m_calon");
    if(!$this->session->userdata('admin')){
      redirect('login_admin');
    }
  }

  // Tambah Calon
  public function tambah(){
    // Library Upload
    $this->load->library('upload');
    $gambar['upload_path']  = './assets/image/calon/';
    $gambar['allowed_types']= 'jpg|png|jpeg';
    $gambar['max_size']     = '20000';
    $gambar['max_width']    = '2048';
    $gambar['max_height']   = '2048';
    $gambar['overweite']    = FALSE;
    $gambar['encrypt_name'] = FALSE;
    $this->upload->initialize($gambar);

    if ($_FILES['gambar']['name']) {
      if ($this->upload->do_upload('gambar')) {
        $gbr    = $this->upload->data();
        // post
        $ketua  = $this->input->post('ketua');
        $wakil  = $this->input->post('wakil');
        $visi   = $this->input->post('visi');
        $misi   = $this->input->post('misi');
        $created= date("Y-m-d H:i:s");
        $update = date("Y-m-d H:i:s");

        $gambar = $gbr['file_name'];

        // Generate Nomor Calon
        $cekNomor   = $this->db->query("SELECT nomor FROM calon")->num_rows();
        if ($cekNomor < 1) {
          $nomor      = "1";
        } else {
          $nomor            = $this->db->query("SELECT nomor FROM calon ORDER BY nomor DESC limit 1")->row();
          $nomor            = $nomor->nomor;
          $nomor            = $nomor+1;
        }

        // Array
        $calon  = array('nomor' => $nomor, 'nama_ketua' => $ketua, 'nama_wakil' => $wakil, 'visi' => $visi, 'misi' => $misi, 'gambar' => $gambar, 'created_at' => $created, "updated_at" => $update);
        $this->m_calon->tambahCalon($calon);
        $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Calon Berhasil Ditambah!!!", type: "success", showConfirmButton: false}); </script>';
        $this->load->view('admin/master/alert',$alert);
      }else {
        // echo $this->upload->display_errors();
        $error = $this->upload->display_errors();
        $alert['alert'] = '<script type="text/javascript">swal({ title: "Gagal!", text: "'.$error.'", type: "danger", showConfirmButton: false}); </script>';
        $this->load->view('admin/master/alert.php',$alert);
      }
    }else {
      $alert['alert'] = '<script type="text/javascript">swal({ title: "Gagal!", text: "Belum Memlih Gambar!", type: "warning", showConfirmButton: false}); </script>';
      $this->load->view('admin/master/alert.php',$alert);
    }
  }

  public function detailMisi($id){
    $data = $this->m_calon->detailMisi($id)->row();
    echo json_encode($data);
  }

  public function hapusPaslon(){
    $id = $this->input->post('idHapus');
    $gambar = $this->input->post('gambarHapus');
    unlink('./assets/image/calon/'.$gambar);
    $this->db->query("DELETE FROM calon WHERE id_calon='$id'");
    $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Paslon Berhasil Dihapus!", type: "success", showConfirmButton: false}); </script>';
    $this->load->view('admin/master/alert',$alert);
  }
}
