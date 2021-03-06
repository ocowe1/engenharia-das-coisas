<?php
//$tela = '';
$session = $this->session->userdata ( 'logged_in' );
if ( $session[ 'profile_id' ] == 2 ) {
	if ( $this->session->userdata ( 'logged_in' ) ) {
		if ( isset( $tela ) ) {
			$tela = $tela;
		}
		else {
			$tela = 'view_administracao';
		}
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>EDC | Home</title>
			<!-- Tell the browser to be responsive to screen width -->
			<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			<!-- Bootstrap 3.3.6 -->
			<link rel="stylesheet" href="<?php echo base_url (); ?>assets/bootstrap/css/bootstrap.min.css">
			<!-- Font Awesome -->
			<link rel="stylesheet"
				  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
			<!-- Ionicons -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
			<!-- jvectormap -->
			<link rel="stylesheet"
				  href="<?php echo base_url (); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
			<!-- Theme style -->
			<link rel="stylesheet" href="<?php echo base_url (); ?>assets/dist/css/AdminLTE.min.css">
			<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
			<link rel="stylesheet" href="<?php echo base_url (); ?>assets/dist/css/skins/_all-skins.min.css">
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">


			<?php
			$this->load->view ( 'template/admin/header' );
			$this->load->view ( 'template/admin/topbar' );
			$this->load->view ( 'template/admin/sidebar' );
			$this->load->view ( 'template/admin/configbar' );
			if ( $tela != '' ) {
				$this->load->view ( 'telas/' . $tela );
			}
			$this->load->view ( 'template/admin/footer' );
			$this->load->view ( 'template/admin/controlbar' );
			$this->load->view ( 'template/admin/js' );
			?>


			<div class="control-sidebar-bg"></div>

		</div>


		<!-- jQuery 2.2.3 -->
		<script src="<?php echo base_url (); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="<?php echo base_url (); ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="<?php echo base_url (); ?>assets/plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url (); ?>assets/dist/js/app.min.js"></script>
		<!-- Sparkline -->
		<script src="<?php echo base_url (); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="<?php echo base_url (); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?php echo base_url (); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- SlimScroll 1.3.0 -->
		<script src="<?php echo base_url (); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- ChartJS 1.0.1 -->
		<script src="<?php echo base_url (); ?>assets/plugins/chartjs/Chart.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="<?php echo base_url (); ?>assets/dist/js/pages/dashboard2.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo base_url (); ?>assets/dist/js/demo.js"></script>
		</body>
		</html>
		<?php
	}
	else {
		redirect ( 'login' , 'refresh' );
		die();
	}

}
else {
	redirect ( 'login' , 'refresh' );
	die();
}
?>

