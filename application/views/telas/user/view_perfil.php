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
		'user_cidade' => $d->user_cidade,

	);
}

$img = $user['user_img'];



?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Perfil do usuário
		</h1>
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li><a>Perfil</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php $this->load->view('telas/user/view_flashdata'); ?>
		<div class="row">
			<div class="col-md-12">

				<!-- Profile Image -->
				<div class="box box-primary">
						<form action="<?php echo base_url('u/usuario/foto'); ?>" enctype="multipart/form-data" method="post">
							<div class="box-body box-profile">
								<img class="profile-user-img img-responsive img-circle"  style="width: 90px; height: 90px" alt="User Image" src="<?php echo base_url ('/assets/upload/profile_img/'.$user['user_img']); ?>">
								<center><br>
									<input name="foto" id="foto" type="file" value="Alterar foto"><br>
								<h3 class="profile-username text-center"><?php echo $user['user_name'];?></h3>
								</center>
								<p class="text-muted text-center"><?php echo $user['user_curso']; ?> <span class="label label-primary">Usuário</span></p>
								<ul class="list-group list-group-unbordered">
									<li class="list-group-item">
										<b>E-mail</b> <a class="pull-right"><?php echo $user['user_email']; ?></a>
									</li>
									<li class="list-group-item">
										<b>Celular</b> <a class="pull-right"><?php echo $user['user_celular']; ?></a>
									</li>
									<li class="list-group-item">
										<b>Cidade</b> <a class="pull-right"><?php echo $user['user_cidade']; ?></a>
									</li>
									<li class="list-group-item">
										<b>RA</b> <a class="pull-right"><?php echo $user['user_ra']; ?></a>
									</li>

								</ul>
								<input type="submit" class="btn btn-primary" name="alterar" value="Salvar">
							</div>

						</form>

					<!-- /.box-body -->
				</div>
				<!-- /.box -->
				<!-- /.box -->
			</div>
			<!-- /.col -->


			<!-- /.col -->
		</div>
		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>
