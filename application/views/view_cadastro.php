<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EDC | Cadastre-se</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url (); ?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url (); ?>assets/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url (); ?>assets/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url (); ?>assets/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url (); ?>assets/plugins/iCheck/square/blue.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			/* display: none; <- Crashes Chrome on hover */
			-webkit-appearance: none;
			margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
		}

		input[type=number] {
			-moz-appearance: textfield; /* Firefox */
		}
	</style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
	<div class="register-logo">
		<a href="login"><b>Engenharia </b>das Coisas</a>
	</div>

	<div class="register-box-body">
		<p class="login-box-msg">Novo usuário</p>

		<?php
		echo form_open ( 'Cadastrar' );
		?>

		<div class="form-group has-feedback ">
			<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
			<?php echo "<div style='color: red;'>".form_error ( 'nome' ). "</div>" ?>
		</div>


		<div class="form-group has-feedback ">
			<input type="email" class="form-control" name="email" id="email" placeholder="Email">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			<?php echo "<div style='color: red;'>".form_error ( 'email' )."</div>" ?>
		</div>

		<div class="form-group has-feedback ">
			<input type="number" class="form-control" name="celular" id="celular" placeholder="Celular">
			<span class="glyphicon glyphicon-phone form-control-feedback"></span>
			<?php echo "<div style='color: red;'>".form_error ( 'celular' )."</div>" ?>
		</div>

		<div class="form-group has-feedback ">
			<select class="form-control" name="curso" id="curso" value="curso">
				<option selected>Selecione o curso</option>
				<option name="Engenharia Ambiental">Engenharia Ambiental</option>
				<option name="Engenharia Elétrica">Engenharia Elétrica</option>
				<option name="Engenharia Civil">Engenharia Civil</option>
				<option name="Engenharia da Computação">Engenharia da Computação</option>
				<option name="Engenharia de Produção">Engenharia de Produção</option>
				<option name="Engenharia Química">Engenharia Química</option>
			</select>
			<?php echo "<div style='color: red;'>".form_error ( 'curso' )."</div>" ?>
		</div>

		<div class="form-group has-feedback ">
			<input type="number" class="form-control" name="ra" id="ra" placeholder="Seu RA">
			<span class="glyphicon glyphicon-console form-control-feedback"></span>
			<?php echo "<div style='color: red;'>".form_error ( 'ra' )."</div>" ?>
		</div>

		<div class="form-group has-feedback ">
			<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			<?php echo "<div style='color: red;'>".form_error ( 'senha' )."</div>" ?>
		</div>

		<div class="form-group has-feedback ">
			<input type="password" class="form-control" name="confsenha" id="confsenha"
				   placeholder="Confirmação de senha">
			<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			<?php echo "<div style='color: red;'>".form_error ()."</div>" ?>
		</div>

		<div class="row">
			<div class="col-xs-8">
				<div class="checkbox icheck">
					<label>
						<input type="checkbox" id="termos" name="termos"> Eu concordo com os <a
							href="<?php echo base_url ( 'termos' ) ?>">termos.</a>
					</label>
					<?php echo "<div style='color: red;'>".'<b>' . form_error ( 'termos' ) . '</b>'."</div>" ?>
				</div>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
			</div>
			<!-- /.col -->
		</div>
		<?php echo form_close (); ?>

		<a href="login" class="text-center">Eu já possuo cadastro.</a>
	</div>
	<!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url (); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url (); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url (); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
