<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/swal.js"></script>
</head>
<body>
  <div class="alert"><?php echo $alert;?></div>
  <script>
  var base = '<?php echo base_url();?>';
  $(document).ready(function(){
    setTimeout(
      function(){
        window.history.back(-1);
      },
      2000);
    })
    </script>
  </body>
  </html>
