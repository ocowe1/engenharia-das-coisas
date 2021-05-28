<?php
$session = $this->session->userdata ( 'logged_in' );
$this->load->model ( 'model_user' );
$dados = $this->model_user->users ();


//$img = $user['user_img'];


?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> Home / Membros</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<br>
		<?php $this->load->view('telas/user/view_flashdata'); ?>
		<div class="col-xs-12 col-sm-6 col-lg-12">
			<!-- USERS LIST -->
			<div class="box box-danger">
				<div class="box-header with-border">
					<h3 class="box-title">MEMBROS</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body no-padding">
					<ul class="users-list clearfix">

						<?php
						foreach ($dados as $user) {
							?>

							<li>
								<img src="<?php echo base_url ( 'assets/upload/profile_img/' . $user->user_img ); ?>"
									 class="img-circle" style="width: 165px; height: 165px" alt="User Image">
								<a class="users-list-name"><?php echo $user->user_name; ?></a>
								<span class="users-list-date"><?php echo $user->user_profile; ?></span>
								<span class="users-list-date"><?php echo $user->user_curso; ?></span>

							</li>

						<?php } ?>

					</ul>
					<!-- /.users-list -->
				</div>
				<!-- /.box-body -->

				<!-- /.box-footer -->
			</div>
			<!--/.box -->
		</div>


	</section>
	<!-- /.content -->
</div>


