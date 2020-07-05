<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/swal.js"></script>
</head>
<body>
  <script>
  var base = '<?php echo base_url();?>';
  swal({ title: "Belum Login!", text: "Anda Belum Login!!!", type: "warning", showConfirmButton: false});
  $(document).ready(function(){
    setTimeout(
      function(){
        window.location.href = "<?php echo base_url();?>login"
      },
      1500);
    })
    </script>
  </body>
  </html>
