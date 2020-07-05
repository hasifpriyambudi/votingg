<?php
if ($settings->num_rows() < 1) {
  ?>
  <div class="col-md-12">
    <div class="row">
      <button type="button" id="btnKembali" class="btn btn-primary" style="float:left;margin-top:45px;margin-left:20px"><i class="fas fa-step-backward"></i> Kembali Home</button>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card text-center" style="margin-top:15px;">
      <div class="card-header">
        Belum Ada Admin
      </div>
      <div class="card-body">
        <p class="card-text">Untuk menambahkan Admin, silahkan klik tombol dibawah ini</p>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahAdmin"><i class="fas fa-user-plus"></i> Tambah Admin</a>
      </div>
      <div class="card-footer text-muted">
        <?php echo kredit();?>
      </div>
    </div>
  </div>
  <?php
}else{
  ?>
  <!-- Daftar Admin -->
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12" style="margin-top:45px;">
        <button type="button" class="btn btn-primary" style="float:left;" id="btnKembali"><i class="fas fa-step-backward"></i> Kembali Home</button>
        <button type="button" class="btn btn-primary" style="float:right;"  data-toggle="modal" data-target="#modalTambahAdmin"><i class="fas fa-user-plus"></i> Tambah Admin</button>
      </div>
      <div class="col-md-12"style="margin-top:10px;">
        <div class="card text-center">
          <div class="card-header"><h5>Daftar Admin</h5></div>
          <div class="col-md-12 table-responsive" style="padding-bottom:1rem;padding-top:0.5rem;">
            <table class="table" id="tableAdmin">
              <thead class="thead" style="background-color:#576574;">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">User</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($settings->result() as $look) {?>
                <tr>
                  <th scope="row"><?php echo $no++;?></th>
                  <td><?php echo $look->nama;?></td>
                  <td><?php echo $look->user;?></td>
                  <td>
                    <button class="btn btn btn-warning my-2 my-sm-0" onclick="infoAdmin(<?php echo $look->id;?>)"><i class="fas fa-pencil-alt"></i></button>
                    <button class="btn btn btn-danger my-2 my-sm-0" onclick="hapusAdmin(<?php echo $look->id;?>)"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-muted">
            <?php echo kredit();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Daftar Modal -->

<!-- Modal Tambah Admin -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>admin/settings/tambah" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nama Admin</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Hasif Priyambudi" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
          </div>
          <small><p class="text-muted">*User akan dibuat secara otomatis.</p></small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Info Admin -->
<div class="modal fade" id="modalInfoAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>admin/settings/updateAdmin" method="post" enctype="multipart/form-data">
          <input type="hidden" id="infoId" name="infoId">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nama Admin</label>
              <input type="text" class="form-control" id="namaEdit" name="namaEdit" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input type="password" class="form-control" id="passEdit" name="passEdit">
            </div>
          </div>
          <small><p class="text-muted">*Jika Password Tidak Ingin Diubah, Kosongi saja.</p></small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Hapus Admin -->
<div class="modal fade" id="modalHapusAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="<?php echo base_url();?>admin/settings/hapus" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="idHapus" name="idHapus">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
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
  $('#tableAdmin').DataTable()
})
</script>

<script>
function hapusAdmin(id) {
  $('#idHapus').val(id)
  $('#modalHapusAdmin').modal('show')
}
function infoAdmin(id) {
  $.ajax({
    url: base+"admin/settings/infoAdmin/"+id,
    dataType: "JSON",
    success:function(data){
      $('#infoId').val(id)
      $('#namaEdit').val(data.nama)
      $('#modalInfoAdmin').modal('show')
    }
  })
}
</script>
<script>

CKEDITOR.replace('misi');
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('editable');
</script>
