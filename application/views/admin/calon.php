<?php
  if ($calon->num_rows() < 1) {
?>
  <div class="col-md-12">
    <div class="row">
      <button type="button" id="btnKembali" class="btn btn-primary" style="float:left;margin-top:45px;margin-left:20px"><i class="fas fa-step-backward"></i> Kembali Home</button>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card text-center" style="margin-top:15px;">
      <div class="card-header">
        Belum Ada Calon
      </div>
      <div class="card-body">
        <p class="card-text">Untuk menambahkan calon, silahkan klik tombol dibawah ini</p>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahCalon"><i class="fas fa-user-plus"></i> Tambah Calon</a>
      </div>
      <div class="card-footer text-muted">
        <?php echo kredit();?>
      </div>
    </div>
  </div>
  <?php
}else{
  ?>
  <!-- Daftar Calon -->
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12" style="margin-top:45px;margin-bottom:2rem;">
        <button type="button" class="btn btn-primary" style="float:left;" id="btnKembali"><i class="fas fa-step-backward"></i> Kembali Home</button>
        <button type="button" class="btn btn-primary" style="float:right;"  data-toggle="modal" data-target="#modalTambahCalon"><i class="fas fa-user-plus"></i> Tambah Calon</button>
      </div>
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
            <button type="button" class="btn btn-outline-danger" style="float:right;" title="Hapus Calon" onclick="hapusCalon(<?php echo $look->id_calon;?>, '<?php echo $look->gambar;?>')"><i class="fas fa-trash"></i></button>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
<?php } ?>

<!-- Model tambah calon -->
<div class="modal fade" id="modalTambahCalon" tabindex="1000" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Calon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>admin/calon/tambah" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPassword4">Nama Ketua</label>
              <input type="text" class="form-control" id="ketua" name="ketua" placeholder="Hasif Priyambudi" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputAddress">Nama Wakil</label>
              <input type="text" class="form-control" id="wakil" name="wakil" placeholder="Hanif Pramono" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress2">Visi</label>
            <textarea type="text" class="form-control" id="visi" name="visi" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="inputEmail4">Misi</label>
            <textarea type="text" class="form-control" id="misi" name="misi" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label>Gambar</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="gambar" name="gambar" required>
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
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
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="modalHapusCalon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Are you sure?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <p>Do you really want to delete these records? This process cannot be undone.</p>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-12">
          <form action="<?php echo base_url();?>admin/calon/hapusPaslon" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="idHapus" name="idHapus">
            <input type="hidden" id="gambarHapus" name="gambarHapus">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" id="btnHapus">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
var base = "<?php echo base_url();?>"
$(document).ready(function(){
  $('#btnKembali').click(function(){
    window.location = base+"admin/tampil"
  })
})
</script>

<script>
var base = "<?php echo base_url();?>"
function detailMisi(id) {
  $.ajax({
    url: base+"admin/calon/detailMisi/"+id,
    dataType: "JSON",
    success:function(data){
      $('#misiCalon').html(data.misi)
      $('#titleModalMisi').html("Misi Paslon 0"+data.nomor)
      $('#modalMisi').modal('show')
    }
  })
}


// Hapus Paslon
function hapusCalon(id,gambar) {
  $('#modalHapusCalon').modal('show')
  $('#idHapus').val(id)
  $('#gambarHapus').val(gambar)
}
</script>
<script>
CKEDITOR.replace('misi');
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('editable');
</script>
