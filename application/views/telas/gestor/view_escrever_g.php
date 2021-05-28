<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> <a>Home </a> / <a
						href="<?php echo base_url ( 'g/gestor/mensagens' ); ?>">Mensagens</a> / Enviar</a></li>
		</ol>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">

		<form action="<?php echo base_url ('g/m/envio') ?>" method="post">
		<?php $this->load->view('telas/gestor/view_flashdata'); ?>
		<div class="box box-info">
			<div class="box-header">
				<i class="fa fa-envelope"></i>

				<h3 class="box-title">Enviar Mensagem</h3>
			</div>
			<div class="box-body">


				<div class="form-group">
					<?php
					$this->load->model('model_user');
					$dados = $this->model_user->users();
					$session = $this->session->userdata('logged_in');
					//$id = $session['user_id'];
					//var_dump ($id);
					//$dados = $this->model_user->busca($id);
					//die();
					?>
					<select class="form-control" name="emailto" id="emailto">
						<option>Escolha o usuario</option>
						<?php foreach($dados as $d){ ?>
						<option value="<?php echo $d->user_email; ?>" ><?php echo $d->user_name.' <small>('.$d->user_email.')</small>';?></option>
						<?php } ?>
					</select>
				</div>



				<div class="form-group">
					<input type="text" class="form-control" name="assunto" autocomplete="off" id="assunto" placeholder="Assunto">
				</div>
				<div>
					<textarea class="textarea" name="mensagem" id="mensagem" placeholder="Mensagem"
							  style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
				</div>

			</div>
			<div class="box-footer clearfix">
				<button type="submit" class="pull-right btn btn-default" id="sendEmail">Enviar
					<i class="fa fa-arrow-circle-right"></i></button>
			</div>
		</div>
		</form>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
