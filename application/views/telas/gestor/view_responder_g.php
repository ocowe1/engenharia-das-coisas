<?php foreach ($emails as $e){ ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> <a>Home </a> / <a>Mensagens</a>Ler</a> /Responder</a></li>
		</ol>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">
		<?php $this->load->view('telas/gestor/view_flashdata'); ?>
		<form action="<?php echo base_url  ( 'gestor/resposta'); ?>" method="post">
		<div class="box box-info">
			<div class="box-header">
				<i class="fa fa-envelope"></i>

				<h3 class="box-title">Responder Mensagem</h3>
			</div>
			<div class="box-body">

				<div class="form-group">
					<input type="email" class="form-control" name="emailto" id="emailto"
						   value="<?php echo $e->user_email_enviado; ?>" readonly>
				</div>
				<?php }?>
				<div class="form-group">
					<input type="text" class="form-control" name="assunto" id="assunto" value="<?php echo 'RE: '.$e->email_assunto; ?>" readonly/>
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
		<?php echo form_close (); ?>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
