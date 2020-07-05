<?php
if ($hasil->num_rows() < 1) { ?>
  <div class="col-md-12">
    <div class="row">
      <button type="button" id="btnKembali" class="btn btn-primary" style="float:left;margin-top:45px;margin-left:20px"><i class="fas fa-step-backward"></i> Kembali Home</button>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card text-center" style="margin-top:10px;">
      <div class="card-header">
        Belum Ada Pemilihan
      </div>
      <div class="card-body">
        <p class="card-text">Silahkan memilih terlebih dahulu</p>
      </div>
      <div class="card-footer text-muted">
        <?php echo kredit();?>
      </div>
    </div>
  </div>
<?php }else{ ?>
  <div class="col-md-12">
    <div class="row">
      <button type="button" id="btnKembali" class="btn btn-primary" style="float:left;margin-top:45px;margin-left:20px"><i class="fas fa-step-backward"></i> Kembali Home</button>
    </div>
  </div>
  <!-- Display Chart -->
  <div class="col-md-12">
    <div class="row justify-content-center">
      <label><h2>Hasil Pemilu</h2></label>
    </div>
    <div class="row justify-content-center">
      <div id="canvas-holder" style="width:70%; height:70%;">
        <canvas id="chartHasil">

        </canvas>
      </div>
    </div>
    <center><div class="card-footer text-muted">
      <?php echo kredit();?>
    </div></center>
  </div>
<?php } ?>


<script>
var base = "<?php echo base_url();?>"
$(document).ready(function(){
  $('#btnKembali').click(function(){
    window.location = base+"admin/tampil"
  })
})

// Chart
var ctx = document.getElementById('chartHasil').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
          <?php
              foreach ($hasil->result() as $look) {
                echo "'Paslon Nomor 0" .$look->no_calon ."',";
              }
          ?>
        ],
        datasets: [{
            label: 'Jumlah Pemilih ',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
              <?php
                   foreach ($hasil->result() as $look) {
                    echo $look->hasil . ", ";
                  }
              ?>
            ]
        }]
    },
});
</script>
