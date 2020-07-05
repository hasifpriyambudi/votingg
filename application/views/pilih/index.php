<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/image/favicon.ico">
  <title><?php echo $title;?></title>
  <!-- Jquery -->
  <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
  <!-- Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/font/css/all.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datatable.css"/>
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/ckeditor/ckeditor.js"/> -->
  <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
  <!-- JS -->
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/Chart.js"></script>
  <script src="<?php echo base_url();?>assets/js/swal.js"></script>
  <script src="<?php echo base_url();?>assets/js/datatable.js"></script>
</head>
<body style="background:#dfe6e9;">
  <div class="col-md-12" style="margin-top:1rem;">
    <div class="row">
      <div class="col-md-12" style="margin-top:0.5rem;">
        <button type="button" class="btn btn-danger" style="float:right;" id="btnLogout" onclick="btnLogout()"><i class="fas fa-power-off"></i> Logout</button>
      </div>
    </div>
  </div>
  <?php
  if ($calon->num_rows() < 1) {
    ?>
    <div class="col-md-12">
      <div class="card text-center" style="margin-top:5rem;">
        <div class="card-header">
          Belum Ada Calon
        </div>
        <div class="card-body">
          <p class="card-text">Tunggu admin menambahkan calon.</p>
        </div>
        <div class="card-footer text-muted">
          Made by Hasif Priyambudi | dolanbae.com
        </div>
      </div>
    </div>
  <?php }else{ ?>
    <div class="col-md-12" style="margin-top:1rem;">
      <div class="row">
        <?php foreach ($calon->result() as $look) {?>
          <div class="col-md-4 col-xs-12">
            <div class="card" style="margin-top:5px;">
              <!-- Tampil Gambar -->
              <?php
              if ($look->gambar != null) {
                $gambar = base_url()."assets/image/calon/".$look->gambar;
              }else {
                $gambar = base_url()."assets/image/default-calon.png";
              }
              ?>
              <img class="card-img-top" src="<?php echo $gambar;?>" width="100%">
              <div class="card-body">
                <h5 class="card-title"><strong><?php echo $look->nomor;?>. <?php echo $look->nama_ketua;?> & <?php echo $look->nama_wakil;?></strong></h5>
                <p class="card-text"><?php echo $look->visi;?></p>
                <button class="btn btn-primary" onclick="detailMisi(<?php echo $look->id_calon;?>)">Detail Misi</button>
                <button type="button" class="btn btn-outline-success" style="float:right;" title="Pilih Calon 0<?php echo $look->nomor;?>" onclick="pilihCalon(<?php echo $look->id_calon;?>,<?php echo $look->nomor;?>)"><i class="fas fa-check"></i></button>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <!-- Modal Misi -->
  <div class="modal fade" id="modalMisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titleModalMisi"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="misiCalon">
          </p>
        </div>
      </div>
    </div>
  </div>
  <?php
    $data = $this->session->userdata();
    foreach ($data as $session) {
      $id = $session['id'];
      $nama = $session['nama'];
      $jenis = $session['jenis'];
      $kelas = $session['kelas'];
      $nik = $session['nik'];
      $token = $session['token'];
      $status = $session['status'];
      $jam = $session['jam_memilih'];
    }
  ?>

  <script>
  $(document).ready(function(){
    Swal.fire({
      title: 'Konfirmasi data di bawah ini!!!',
      text: "Apa anda adalah "+"<?php echo $nama;?>"+", dari kelas "+"<?php echo $kelas;?>"+"?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      cancelButtonText: 'IYA!',
      confirmButtonText: 'Bukan!'
    }).then((result) => {
      if (result.value) {
        window.location.href = '<?php echo base_url();?>login/logout/'
      }
    })
  })
  </script>

  <!-- JS -->
  <script>
  var base = "<?php echo base_url();?>"
  function detailMisi(id) {
    $.ajax({
      url: base+"pilih/calon/detailMisi/"+id,
      dataType: "JSON",
      success:function(data){
        $('#misiCalon').html(data.misi)
        $('#titleModalMisi').html("Misi Paslon 0"+data.nomor)
        $('#modalMisi').modal('show')
      }
    })
  }
  // Pilih Calon
  function pilihCalon(nomor) {
    Swal.fire({
      title: 'Yakin Memilih Paslon 0'+nomor+'?',
      text: "Jika Sudah Memilih, Maka Tidak Bisa Diulang!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin!'
    }).then((result) => {
      if (result.value) {
        window.location.href =base+"pilih/calon/pilih/"+nomor
      }
    })
  }
  // Logout
  function btnLogout() {
    Swal.fire({
      title: 'Anda Akan Keluar?',
      text: "Yakin Mau Keluar?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin!'
    }).then((result) => {
      if (result.value) {
        window.location.href = base+"login/logout"
      }
    })
  }
</script>
</body>
</html>
