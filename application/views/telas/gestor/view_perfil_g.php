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
		<?php $this->load->view('telas/gestor/view_flashdata'); ?>
		<div class="row">
			<div class="col-md-12">

				<!-- Profile Image -->
				<div class="box box-primary">
							<div class="box-body box-profile">
								<button type="button" data-toggle="modal" data-target="#foto" class="profile-user-img img-responsive img-circle">
									<img class="img-responsive img-circle"  style="width: 90px; height: 90px" alt="User Image" src="<?php echo base_url ('/assets/upload/profile_img/'.$user['user_img']); ?>">
								</button><center><br>

								<h3 class="profile-username text-center"><?php echo $user['user_name'];?></h3>
								</center>
								<p class="text-muted text-center"><span class="label label-success">Professor</span></p>
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
								</ul>
							</div>


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

<section id="foto" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content rounded-0">
			<form action="<?php echo base_url('gestor/foto'); ?>" enctype="multipart/form-data" method="post">
			<div class="modal-header border-0 rounded-0">
				<h4>Selecione sua nova foto de perfil</h4>
				<p>Por favor obedeça as regras, sendo elas: imagens em png, jpg e jpeg com um máximo de 50mb.</p>
				<br>
				<input name="foto" id="foto" type="file" value="Alterar foto"><br>
			</div>
			<div class="modal-body pt-0">
				<div class="col mt-sm-4">
					<button type="button" data-dismiss="modal"
							class="btn btn-block btn-secondary rounded-0">
						Cancelar
					</button>
				</div>
				<br>
				<div class="col mt-2 mt-sm-4">
						<button id="confirm-btn" type="submit" name="alterar"
								class="btn btn-block btn-primary rounded-0">
							Atualizar
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
