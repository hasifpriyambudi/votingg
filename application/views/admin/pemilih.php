<?php
if ($pemilih->num_rows() < 1) {
  ?>
  <div class="col-md-12">
    <div class="row">
      <button type="button" id="btnKembali" class="btn btn-primary" style="float:left;margin-top:45px;margin-left:20px"><i class="fas fa-step-backward"></i> Kembali Home</button>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card text-center" style="margin-top:15px;">
      <div class="card-header">
        Belum Ada Pemilih
      </div>
      <div class="card-body">
        <p class="card-text">Untuk menambahkan Pemilih, silahkan klik tombol dibawah ini</p>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPemilih"><i class="fas fa-user-plus"></i> Tambah Pemilih</a>
      </div>
      <div class="card-footer text-muted">
        <?php echo kredit();?>
      </div>
    </div>
  </div>
  <?php
}else{
  ?>
  <!-- Daftar Pemilih -->
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12" style="margin-top:45px;">
        <button type="button" class="btn btn-primary" style="float:left;" id="btnKembali"><i class="fas fa-step-backward"></i> Kembali Home</button>
        <button type="button" class="btn btn-primary" style="float:right;"  data-toggle="modal" data-target="#modalTambahPemilih"><i class="fas fa-user-plus"></i> Tambah Pemilih</button>
      </div>
      <div class="col-md-12" style="margin-top:10px;">
        <div class="card text-center">
          <div class="card-header">
            <h5>Daftar Pemilih</h5>
          </div>
          <div class="col-md-12 table-responsive" style="padding-bottom:1rem;padding-top:0.5rem;">
            <table class="table" id="tablePemilih">
              <thead class="thead" style="background-color:#576574;">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Kelas</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">NIK/User</th>
                  <th scope="col">Token</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1;
                foreach ($pemilih->result() as $look){
                  ?>
                  <tr>
                    <th scope="row"><?php echo $no++;?></th>
                    <td><?php echo $look->nama;?></td>
                    <td><?php echo $look->kelas;?></td>
                    <td><?php echo $look->jenis;?></td>
                    <td><?php echo $look->nik;?></td>
                    <td><?php echo $look->token;?></td>
                    <td><?php
                    if ($look->status == 0) {
                      echo "<label style='background:yellow;'>Belum Memilih</label>";
                    }else{
                      echo "<label style='background:green;'>Sudah Memilih</label>";
                    }
                    ?></td>
                    <td>
                      <button class="btn btn btn-primary my-2 my-sm-0" data-toggle="modal" onclick="infoPemilih(<?php echo $look->id;?>)"><i class="fas fa-address-card"></i></button>
                      <button class="btn btn btn-danger my-2 my-sm-0" onclick="hapusPemilih(<?php echo $look->id;?>)"><i class="fas fa-trash"></i></button>
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

<!-- Modal Tambah Pemilih -->
<div class="modal fade" id="modalTambahPemilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pemilih</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="href" action="<?php echo base_url();?>admin/pemilih/tambah" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div id="formManual">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">NIK/NISN</label>
                <input type="text" class="form-control" id="nik" name="nik" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Hasif Priyambudi">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Jenis Kelamin</label>
              <select class="form-control form-control-sm" name="jenis" id="jenis">
                <option>--Jenis Kelamin--</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas">
              </div>
            </div>
          </div>
          <div id="formExcel" style="display:none;">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="fileExcel" name="fileExcel" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-5">
            <button type="button" class="btn btn-success" style="float:left;display:block;" id="btnExcel" title="Tambah Menggunakan Excel"><i class="fa fa-file-excel"></i></button>
            <button type="button" class="btn btn-warning" style="float:left;display:none;" id="btnTulis" title="Tambah Manual"><i class="fa fa-user-plus"></i></button>
          </div>
          <div class="col-md-7">
            <div style="float:right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Info Pemilih -->
<div class="modal fade" id="modalInfoPemilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pemilih</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>admin/pemilih/updatePemilih/" method="post" enctype="multipart/form-data">
          <input type="hidden" id="infoId" name="infoId">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">NIK/NISN</label>
              <input readonly type="text" class="form-control" id="infoNik" name="infoNik" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Nama</label>
              <input readonly type="text" class="form-control" id="infoNama" name="infoNama" placeholder="Hasif Priyambudi" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPassword4">Token</label>
              <input readonly type="text" class="form-control" id="infoToken" name="infoToken" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Kelas</label>
              <input readonly type="text" class="form-control" id="infoKelas" name="infoKelas" required>
            </div>
          </div>
          <div class="form-row">
            <label for="inputAddress">Jenis Kelamin</label>
            <select readonly class="form-control form-control-sm" required name="infoJenis" id="infoJenis">
              <option>--Jenis Kelamin--</option>
              <option value="Laki-Laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-5">
            <button type="button" onclick="modeEdit()" id="btnModeEdit" class="btn btn-warning" title="Mode Edit"><i class="fas fa-edit"></i></button>
            <button type="button" onclick="modeLihat()" id="btnModeLihat" class="btn btn-warning" style="display:none;" title="Mode Lihat"><i class="fas fa-eye"></i></button>
          </div>
          <div class="col-md-7">
            <div style="float:right;">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="btnUpdate" disabled style="cursor:not-allowed;">Save changes</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Hapus Pemilih -->
<div class="modal fade" id="modalHapusPemilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="<?php echo base_url();?>admin/pemilih/hapus" method="POST" enctype="multipart/form-data">
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
  // Buton Kembali
  $('#btnKembali').click(function(){
    window.location = base+"admin/tampil"
  })
  // DataTable
  $('#tablePemilih').DataTable()
})


function hapusPemilih(id) {
  $('#modalHapusPemilih').modal('show')
  $('#idHapus').val(id)
}
function infoPemilih(id) {
  $.ajax({
    url: base+"admin/pemilih/detailPemilih/"+id,
    dataType: "JSON",
    success:function(data){
      $('#infoId').val(id)
      $('#infoNik').val(data.nik)
      $('#infoNama').val(data.nama)
      $('#infoToken').val(data.token)
      $('#infoKelas').val(data.kelas)
      $('#infoJenis').val(data.jenis)
      $('#modalInfoPemilih').modal('show')
    }
  })
}
function modeEdit() {
  $('#infoNama').removeAttr('readonly')
  $('#infoJenis').removeAttr('readonly')
  $('#btnUpdate').removeAttr('disabled')
  $('#btnUpdate').css('cursor','pointer')
  // $('#infoAlamat').removeAttr('readonly')
  $('#infoKelas').removeAttr('readonly')
  $('#btnModeEdit').css("display",'none')
  $('#btnModeLihat').css("display",'block')
}
function modeLihat(){
  $('#infoNama').attr('readonly', true)
  $('#infoJenis').attr('readonly', true)
  $('#btnUpdate').attr('disabled', true)
  $('#btnUpdate').css('cursor','not-allowed')
  // $('#infoAlamat').attr('readonly', true)
  $('#infoKelas').attr('readonly', true)
  $('#btnModeEdit').css("display",'block')
  $('#btnModeLihat').css("display",'none')
}
$('#btnExcel').click(function(){
  $('#btnExcel').css('display','none')
  $('#btnTulis').css('display','block')
  $('#formManual').css('display','none')
  $('#formExcel').css('display','block')
  $('#href').attr('action',base+"admin/pemilih/tambahExcel")
})
$('#btnTulis').click(function(){
  $('#btnTulis').css('display','none')
  $('#btnExcel').css('display','block')
  $('#formManual').css('display','block')
  $('#formExcel').css('display','none')
  $('#href').attr('action',base+"admin/pemilih/tambah")
})
</script>
<script>
CKEDITOR.replace('misi');
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('editable');
</script>
