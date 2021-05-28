<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> <a>Home</a>  / Mensagens</a></li>
		</ol>
	</section>
	<br><br>
	<section class="content">
		<?php $this->load->view('telas/user/view_flashdata'); ?>
		<div class="row">
			<div class="col-md-3">
				<td><form action="<?php echo base_url ('p/m/escrever') ?>" method="post"><button type="submit" class="btn btn-primary btn-block margin-bottom">Escrever</button></form></td>
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Pastas</h3>

						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="<?php echo base_url ('p/mensagens') ?>"><i class="fa fa-inbox"></i> Inbox
									<span class="label label-primary pull-right"><!-- fazer a contagem das mensagens que precisam ser lidas --></span></a></li>
							<li class="active"><a href="<?php echo base_url ('p/enviadas'); ?>"><i class="fa fa-envelope-o"></i> Enviados</a></li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Enviadas</h3>

						<div class="box-tools pull-right">
							<div class="has-feedback">
								<input type="text" class="form-control input-sm" placeholder="Search Mail">
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
							</div>
						</div>
						<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">

						<div class="table-responsive mailbox-messages">
							<table class="table table-hover table-striped">
								<tbody>

								<?php

								if(empty($emails)){
									echo '<td><small>Não há mensagens</small></td>';
								}else{
									foreach($emails as $m){ ?>

										<tr>
											<td><form action="<?php echo base_url ('p/a/enviado/'.$m->email_id); ?>"><button type="submit" class="btn btn-sm btn-default"><i class="fa fa-trash-o"></i></button></form></td>
											<!--td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td-->
											<td class="mailbox-name"><a href="<?php echo base_url('p/m/enviado/' . $m->email_id)?>"><?php echo $m->user_name_enviado; ?></a></td>
											<td class="mailbox-subject"><b><?php echo $m->email_assunto; ?></b>
											</td>
											<td class="mailbox-attachment"></td>
											<td class="mailbox-date"><?php echo date('d/m/Y', strtotime($m->data)) . ' às ' . $m->hora; ?></td>
										</tr>
									<?php }} ?>


								</tbody>
							</table>
							<!-- /.table -->
						</div>
						<!-- /.mail-box-messages -->
					</div>
					<!-- /.box-body -->
					<div class="box-footer no-padding">
						<div class="mailbox-controls">
							<div class="btn-group">
								<?php echo $paginacao;?>
							</div>
							<!-- /.btn-group -->
						</div>
						<!-- /.pull-right -->
					</div>
				</div>
			</div>
			<!-- /. box -->
		</div>
		<!-- /.col -->
</div>
<!-- /.row -->

</section>

</div>

