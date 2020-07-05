<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Pemilih - Voting</title>
	<meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/boot-3.css">
  <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h3 class="page-header text-center"><b></b></h3>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="login-panel panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title"> Silahkan Login
		            </h3>
		        </div>
		    	<div class="panel-body">
		        	<form id="logForm">
		            	<fieldset>
		                	<div class="form-group">
		                    	<input class="form-control" autocomplete="off" placeholder="NISN" type="number" id="nisn" name="nisn">
		                	</div>
											<div class="form-group">
		                    	<input class="form-control" autocomplete="off" placeholder="TOKEN" type="text" id="token" maxlength="6" name="token">
		                	</div>
		                	<button type="submit" class="btn btn-lg btn-primary btn-block" id="btnlgn"><span id="logText"></span></button>
		            	</fieldset>
		        	</form>
		    	</div>
		    </div>
				<div id="wewet"></div>
			<div id="responseDiv" class="alert text-center" style="margin-top:20px; display:none;">
				<button type="button" class="close" id="clearMsg"><span aria-hidden="true">&times;</span></button>
				<span id="message"></span>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		$('#logText').html('Login');
		$('#logForm').submit(function(e){
			e.preventDefault();
			$('#logText').html('Checking...');
			var url = '<?php echo base_url();?>';
			var user = $('#logForm').serialize();
			var login = function(){
				$.ajax({
					type: 'POST',
					url: url + 'login/loginPilih/',
					dataType: 'json',
					data: user,
					success:function(response){
						$('#message').html(response.message);
						$('#logText').html('Login');
						if(response.error){
							$('#responseDiv').removeClass('alert-success').addClass('alert-danger').show();
						}else{
							$('#responseDiv').removeClass('alert-danger').addClass('alert-success').show();
							$('#logForm')[0].reset();
							setTimeout(function(){
								location.reload();
							}, 2000);
						}
					}
				});
			};
			setTimeout(login, 3000);
		});

		$(document).on('click', '#clearMsg', function(){
			$('#responseDiv').hide();
      $('#idPegawai').val('');
		});
	});
</script>
</body>
</html>
