<?php
$session = $this->session->userdata('logged_in');
$id = $session['user_id'];
$this->load->model('model_user');
$dados = $this->model_user->busca($id);
foreach($dados as $d){
	$user = array(
		'user_name' => $d->user_name,
		'user_curso' => $d->user_curso,
		'user_img' => $d->user_img,
		'user_email' => $d->user_email,
		'user_ra' => $d->user_ra,
		'user_celular' => $d->user_celular,
		'semestre' => $d->semestre,
		'cadastro' => $d->cadastro_data
	);
}

$img = $user['user_img'];


?>
<header class="main-header">

	<!-- Logo -->
	<a href="<?php echo base_url('g/feed') ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>E</b>DC</span>
		<!-- logo for regular state and mobile devices -->
		<small><span class="logo-lg"><b>Engenharia </b>das Coisas</span></small>
	</a>

	<!-- Header Navbar: style can be found in header.less -->


<nav class="navbar navbar-static-top">

	<a class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
	</a>
	<!-- Navbar Right Menu -->
	<div class="navbar-custom-menu">

		<ul class="nav navbar-nav"><li class="dropdown user user-menu">

				<a href="" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo base_url('/assets/upload/profile_img/').$img; ?>" class="user-image" alt="User Image">
					<span class="hidden-xs"><?php echo $user['user_name']; ?></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header">
						<img src="<?php echo base_url ('/assets/upload/profile_img/'.$img); ?>" class="img-circle" alt="User Image">

						<p>
							<?php echo $user['user_name']; ?>
							<small><?php echo $user['user_curso']; ?></small>
						</p>
					</li>
					<!-- Menu Body -->

						<!-- /.row -->
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">


						<div class="pull-left">
							<form action="<?php echo base_url ('g/perfil'); ?>">
								<input value="Perfil" type="submit" class="btn btn-default btn-flat">
							</form>
							<!--<a href="<?php// echo base_url ('g/perfil'); ?>" class="btn btn-default btn-flat">Perfil</a>-->
						</div>


						<div class="pull-right">
							<form action="<?php echo base_url ('logout'); ?>">
								<input value="Sair" type="submit" class="btn btn-default btn-flat">
							</form>
							<!--<a href="<?php// echo base_url ('p/logout'); ?>" class="btn btn-default btn-flat">Sair</a>-->

						</div>

					</li>
				</ul>
			</li>
			<!-- Control Sidebar Toggle Button -->
			<li class="dropdown messages-menu" title="Bloquear">
				<a href="<?php echo base_url ('bloquear')?>">
					<i class="fa fa-circle-o-notch"></i>
				</a>
			</li>

		</ul>

	</div>


</nav>

</header>
