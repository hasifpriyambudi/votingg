<div class="col-md-12" style="margin-top:90px;">
  <div class="row">
    <div class="col-md-12 row justify-content-center">
      <label><h3><i class="fas fa-cogs"></i> Menu Utama</h3></label>
    </div>
    <div class="col-md-3 col-xs-12">
      <div class="card text-center" style="margin-top:2rem;">
        <div class="card-header">
          Calon
        </div>
        <div class="card-body">
          <a href="<?php echo base_url();?>admin/tampil/calon" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</a>
        </div>
        <div class="card-footer text-muted">
          Berisi Seputar Calon Ketua
        </div>
      </div>
    </div>
    <div class="col-md-3 col-xs-12">
      <div class="card text-center" style="margin-top:2rem;">
        <div class="card-header">
          Pemilih
        </div>
        <div class="card-body">
          <a href="<?php echo base_url();?>admin/tampil/pemilih" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</a>
        </div>
        <div class="card-footer text-muted">
          Berisi Daftar Pemilih
        </div>
      </div>
    </div>
    <div class="col-md-3 col-xs-12">
      <div class="card text-center" style="margin-top:2rem;">
        <div class="card-header">
          Hasil
        </div>
        <div class="card-body">
          <a href="<?php echo base_url();?>admin/tampil/hasil" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</a>
        </div>
        <div class="card-footer text-muted">
          Berisi Hasil Pemilihan
        </div>
      </div>
    </div>
    <div class="col-md-3 col-xs-12">
      <div class="card text-center" style="margin-top:2rem;">
        <div class="card-header">
          Admin Area
        </div>
        <div class="card-body">
          <a href="<?php echo base_url();?>admin/tampil/settings" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</a>
        </div>
        <div class="card-footer text-muted">
          Berisi Daftar Admin
        </div>
      </div>
    </div>
    <div class="col-md-12" style="margin-top:1rem;">
      <div class="row">
        <div class="col-md-6" style="margin-top:0.5rem;">
          <button type="button" class="btn btn-warning" style="float:left;" id="btnHapusAll" onclick="btnHapusAll()"><i class="fas fa-trash"></i> Hapus Semua</button>
        </div>
        <div class="col-md-6" style="margin-top:0.5rem;">
          <button type="button" class="btn btn-danger" style="float:right;" id="btnKembali" onclick="btnLogout()"><i class="fas fa-power-off"></i> Logout</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$admin = $this->session->userdata();
foreach ($admin as $look) {
  $user = $look['nama'];
}
?>

<script>
var user = "<?php echo $user;?>"
var base = "<?php echo base_url();?>"
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
      window.location.href = base+"login_admin/logout"
    }
  })
}
// Hapus All
function btnHapusAll() {
  Swal.fire({
    title: 'SEMUA DATA AKAN DIHAPUS!!!',
    text: "Tindakan ini akan menghapus semua data (kecuali data admin), apa kamu yakin?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yakin!'
  }).then((result) => {
    if (result.value) {
      window.location.href = base+"admin/settings/hapusSemua/"+user
    }
  })
}
</script>
