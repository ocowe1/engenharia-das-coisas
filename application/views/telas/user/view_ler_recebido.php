
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<ol class="breadcrumb">
				<li><a><i class="fa fa-dashboard"></i><a>Home</a>  / <a href="<?php echo base_url('usuario/mensagens'); ?>">Mensagens</a> / Enviar</a></li>
			</ol>
		</section>
		<br>

		<section class="content">
			<?php $this->load->view('telas/user/view_flashdata'); ?>
			<div class="row">
				<div class="col-md-3">
					<td><form action="<?php echo base_url ('u/usuario/escrever') ?>"><button type="submit" class="btn btn-primary btn-block margin-bottom">Escrever</button></form></td>

					<div class="box box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Pastas</h3>

							<div class="box-tools">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i
										class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="box-body no-padding">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="<?php echo base_url ('u/usuario/mensagens') ?>"><i class="fa fa-inbox"></i> Inbox
										<span class="label label-primary pull-right"><!-- fazer a contagem das mensagens que precisam ser lidas --></span></a></li>
								<li><a href="<?php echo base_url ('u/usuario/enviadas') ?>"><i class="fa fa-envelope-o"></i> Enviado</a></li>
							</ul>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /. box -->
				</div>
				<!-- /.col -->

				<?php foreach ($email as $e){ ?>
				<div class="col-md-9">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3><?php echo $e->email_assunto; ?></h3>
						</div>

						<div class="box-body no-padding">
							<div class="mailbox-read-info">

								<h3>De: <?php echo $e->user_name_enviado; ?>
									<span
										class="mailbox-read-time pull-right"><?php echo date('d/m/Y', strtotime($e->data)) . ' às ' . $e->hora; ?></span>
								</h3>
							</div>
							<!-- /.mailbox-read-info -->


							<div class="mailbox-read-message">
								<?php echo nl2br ($e->email_conteudo); ?>
							</div>
							<!-- /.mailbox-read-message -->
						</div>
						<!-- /.box-body -->

						<!-- /.box-footer -->
						<div class="box-footer">
							<div class="pull-right">

									<td><form action="<?php echo  base_url ('u/responder/'.$e->email_id); ?>"><button type="submit" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Responder</button></form></td>

							</div>
							<td><form action="<?php echo  base_url ('u/a/recebido/'.$e->email_id); ?>"><button type="submit" class="btn btn-sm btn-default"><i class="fa fa-trash-o"></i> Deletar</button></form></td>
						</div>
						<!-- /.box-footer -->
					</div>

					<!-- /. box -->
				</div>
				<?php }?>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>

	</div>
