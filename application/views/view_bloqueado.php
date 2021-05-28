<?php
$session = $this->session->userdata("bloqueado");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EDC | Bloqueado</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url () ?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url () ?>assets/dist/css/AdminLTE.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition lockscreen">
<?php $this->load->view ( 'telas/professor/view_flashdata_p' ); ?>
<div class="lockscreen-wrapper">

	<div class="lockscreen-logo">
		<a href="<?php  echo base_url ('login')?>"><b>Engenharia</b> das Coisas</a>
	</div>
	<!-- User name --><br><br>
	<div class="lockscreen-name"><?php echo $session['user_name']; ?></div>

	<!-- START LOCK SCREEN ITEM -->
	<div class="lockscreen-item">
		<!-- lockscreen image -->
		<div class="lockscreen-image">
			<img src="<?php echo base_url ('assets/upload/profile_img/'.$session['user_img']); ?>" />
		</div>

		<form action="<?php echo base_url ('autentica/desbloquear')?>" method="post" class="lockscreen-credentials">
			<div class="input-group">
				<input type="password" id="senha"  name="senha" class="form-control" placeholder="Senha">

				<div class="input-group-btn">
					<button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
				</div>
			</div>

		</form>

		<!-- /.lockscreen credentials -->

	</div>
	<?php  echo  validation_errors();  ?>
	<br>
	<!-- /.lockscreen-item -->
	<div class="help-block text-center">
		Digite sua senha para retornar para sua sessão
	</div>
	<div class="text-center">
		<a href="<?php echo base_url ('logout')?>">Ou Faça login com outro usuário</a>
	</div>
	<br><br><br>
	<div class="lockscreen-footer text-center">
		<strong>Copyright &copy; <?php echo date('Y'); ?> <a>Engenharia das Coisas</a>.</strong> Todos os direitos reservados.
	</div>
</div>
<!-- /.center -->
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url () ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url () ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
