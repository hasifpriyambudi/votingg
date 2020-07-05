<?php

defined('BASEPATH') or exit("No direct script access allowed");

class pemilih extends CI_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->model('m_pemilih');
    if(!$this->session->userdata('admin')){
      redirect('login_admin');
    }
  }

  public function tambah(){
    // Terima Post
    $nik = $this->input->post("nik");
    $cekNik = $this->db->query("SELECT nik from pemilih WHERE nik='$nik'")->num_rows();
    if ($cekNik < 1) {
      $nama = $this->input->post("nama");
      $jenis = $this->input->post("jenis");
      $kelas = $this->input->post('kelas');
      // Created Token
      $token = bin2hex(random_bytes(3));
      // Array
      $data = array('nik' => $nik, 'nama' => $nama, 'jenis' => $jenis, 'kelas' => $kelas, 'token' => $token, 'status' => '0', 'created_at' => date("Y-m-d H:i:s"));
      // Kirim Database
      $data = $this->m_pemilih->tambah($data);
      // Alert
      $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Pemilih Berhasil Ditambah!!!", type: "success", showConfirmButton: false}); </script>';
      $this->load->view('admin/master/alert',$alert);
    }else {
      $alert['alert'] = '<script type="text/javascript">swal({ title: "Gagal!", text: "Nik/NISN Sudah Digunakan!!!", type: "warning", showConfirmButton: false}); </script>';
      $this->load->view('admin/master/alert',$alert);
    }
  }

  function hapus(){
    $data = $this->m_pemilih->hapus($this->input->post('idHapus'));
    $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Pemilih Berhasil Dihapus!!!", type: "success", showConfirmButton: false}); </script>';
    $this->load->view('admin/master/alert',$alert);
  }

  function detailPemilih($id){
    $data = $this->m_pemilih->detailPemilih($id)->row();
    echo json_encode($data);
  }

  function updatePemilih(){
    $nik = $this->input->post("infoNik");
    $nama = $this->input->post("infoNama");
    $id = $this->input->post('infoId');
    $jenis = $this->input->post("infoJenis");
    $kelas = $this->input->post('infoKelas');
    // Array
    $data = array('nama' => $nama, 'jenis' => $jenis, 'kelas' => $kelas);
    // Kirim Database
    $data = $this->m_pemilih->updatePemilih($id,$data);
    // Alert
    $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Pemilih Berhasil Diupdate!!!", type: "success", showConfirmButton: false}); </script>';
    $this->load->view('admin/master/alert',$alert);
  }


  function tambahExcel(){
      $path = './assets/excel/';
      require_once APPPATH . '/third_party/PHPExcel.php';
      $config['upload_path'] = $path;
      $config['allowed_types'] = 'xlsx|xls|csv';
      $config['remove_spaces'] = TRUE;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      // CEK FILE SUDAH MEMILIH FILE BELUM
      if (!$this->upload->do_upload('fileExcel')) {
        $error = array('error' => $this->upload->display_errors());
      }else {
        $data = array('nama_file' => $this->upload->data());
      }
      // INITIALIZE FILE ke NAMA DI DB
      if(empty($error)){
        if (!empty($data['nama_file']['file_name'])) {
          $import_xls_file = $data['nama_file']['file_name'];
        }else {
          $import_xls_file =0;
        }
        $inputFileName = $path.$import_xls_file;
        // PROSES
        try {
          $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
          $objReader = PHPExcel_IOFactory::createReader($inputFileType);
          $objPHPExcel = $objReader->load($inputFileName);
          $allDataInsheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
          $flag = true;
          $i = 0;
          foreach ($allDataInsheet as $value) {
            if ($flag) {
              $flag = false;
              continue;
            }
            $insertdata[$i]['nama'] = $value['A'];
            $insertdata[$i]['jenis'] = $value['B'];
            $insertdata[$i]['kelas'] = $value['C'];
            $insertdata[$i]['nik'] = $value['D'];
            $insertdata[$i]['token'] = bin2hex(random_bytes(3));
            $insertdata[$i]['status'] = '0';
            $insertdata[$i]['created_at'] = date("Y-m-d H:i:s");
            $i++;
          }
          $result = $this->m_pemilih->tambahExcel($insertdata);
          if ($result) {
            $alert['alert'] = '<script type="text/javascript">swal({ title: "Berhasil!", text: "Pemilih Berhasil DiTambah!!!", type: "success", showConfirmButton: false}); </script>';
            $this->load->view('admin/master/alert',$alert);
          }else {
            // echo "gagal";
            $alert['alert'] = '<script type="text/javascript">swal({ title: "Gagal!", text: "Terdapat Kesalahan!!!", type: "success", showConfirmButton: false}); </script>';
            $this->load->view('admin/master/alert',$alert);
          }
        } catch (Exception $e) {
          die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
        }
      }else {
        echo 'cuk';
      }
  }
}
