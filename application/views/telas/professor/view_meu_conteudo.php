<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<section class="content-header">

		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> <a>Home</a> / Meu Conteúdo</a></li>
		</ol>
	</section>
	<br><br>
	<section class="content">
		<?php $this->load->view ( 'telas/professor/view_flashdata_p' ); ?>
		<div class="col-md-3">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Disciplinas</h3>

					<div class="box-tools">
						<button type="button" class="btn btn-box-tool nova" data-toggle="modal" data-target="#nova">
							<i class="fa fa-plus-circle"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i
								class="fa fa-minus"></i>
						</button>
					</div>
				</div>

				<?php
				if ( empty( $disciplinas ) ) {
					?>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li>
								<a><span class="text-muted">Você ainda não possue disciplinas cadastradas!</span></a>
							</li>
						</ul>
					</div>
					<?php
				}
				else {
					foreach ($disciplinas as $d) {
						?>
						<div class="box-body no-padding">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="<?php echo base_url ( 'p/disciplina/' . $d->disciplina_id ) ?>">
										<i class="fa fa-circle-o "></i><?php echo $d->disciplina; ?></a>
								</li>
							</ul>
						</div>
					<?php }
				} ?>

				<!-- /.box-body -->
			</div>


		</div>


		<div class="col-md-9">
			<div class="box box-primary">

				<div class="box-header with-border">
					<?php
					if ( empty( $d_id ) ) {

					}
					else { ?>

						<div class="box-tools">
							<button type="button" class="btn btn-box-tool novo" data-toggle="modal" data-target="#novo">
								<i class="fa fa-plus-circle"></i>
							</button>
						</div>
					<?php } ?>

					<h3 class="box-title">
						<?php
						if ( !isset( $conteudo ) ) {
							echo 'Selecione uma disciplina';
						}
						else {
							$this->load->model ( 'model_professor' );
							$dados = $this->model_professor->disciplina ( $d_id );
							foreach ($dados as $d) {
								echo $d->disciplina;
							}
						}

						?>
					</h3>
					<!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				<div class="box-body no-padding">

					<div class="table-responsive mailbox-messages">
						<table class="table table-hover table-striped">
							<tbody>

							<?php

							if ( empty( $conteudo ) ) {
								echo '<td><small>Não há conteúdo</small></td>';
							}
							else {
								foreach ($conteudo as $c) {

									$content = $c->conteudo_id; ?>

									<tr>

										<td class="mailbox-name">
											<?php echo $c->conteudo_nome; ?>
											<span class="username"></span>
											<span class="text-muted">
												<?php
												if ( $c->status != 'ativo' ) {
													echo ' - oculto';
												}
												?>
											</span></td>
										<td class="mailbox-subject"><b><?php echo $c->conteudo_desc; ?></b>
										</td>
										<td class="mailbox-attachment"></td>
										<td class="mailbox-date"><?php echo date ( 'd/m/Y' , strtotime ( $c->data ) ) . ' às ' . $c->hora; ?></td>
										<td class="mailbox-subject" id="id_content">
											<form action="<?php echo base_url ( 'download/c/' . $c->conteudo_id ) ?>">
											<button type="button" data-toggle="modal" data-target="#excluir"
													id="<?php echo $c->conteudo_id ?>"
													class="btn btn-xs btn-danger excluirPubli"><i
													class="fa fa-times" ></i>
											</button>

											<button type="button" data-toggle="modal" data-target="#ocultar"
													id="<?php echo $c->conteudo_id; ?>"
													class="btn btn-xs btn-warning ocultarPubli"><i
													class="fa fa-eye-slash"></i>
											</button>
												<button type="submit" class="btn btn-xs btn-success download"><i
														class="fa fa-download"></i>
												</button>
											</form>
										</td>
									</tr>
								<?php }
							} ?>


							</tbody>
						</table>
						<!-- /.table -->
					</div>
					<!-- /.mail-box-messages -->
				</div>
				<!-- /.box-body -->
				<div class="box-footer no-padding">
					<div class="mailbox-controls">

						<?php echo @$paginacao; ?>

					</div>
					<!-- /.pull-right -->
				</div>
			</div>
		</div>
		<!-- /. box -->
	</section>
</div>

<section id="nova" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content rounded-0">
			<form action="<?php echo base_url ( 'p/n/disciplina' ) ?>" method="post">
				<div class="modal-header border-0 rounded-0">
					<h3 class="modal-title">Qual o nome dessa disciplina?</h3><br>
					<input type="text" autocomplete="off" class="form-control input-sm" id="disciplina"
						   name="disciplina"
						   placeholder="Digite aqui o nome da disciplina">
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
						<button id="confirm-btn" type="submit"
								class="btn btn-block btn-primary rounded-0">
							Confirmar
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<section id="novo" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content rounded-0">
			<form role="form" enctype="multipart/form-data" action="<?php echo base_url ( 'p/n/conteudo/' . $d_id ) ?>"
				  method="post">
				<div class="modal-header border-0 rounded-0">
					<h3 class="modal-title">Adicionar conteúdo</h3><br>

					<div class="form-group">
						<label for="exampleInputEmail1">Titulo</label>
						<input type="text" class="form-control" id="titulo" autocomplete="off" name="titulo"
							   placeholder="Coloque um titulo">
					</div>

					<div class="form-group">
						<label for="exampleInputPassword1">Sobre</label>
						<textarea class="form-control" rows="5" id="sobre" name="sobre"
								  placeholder="Sobre o conteúdo" maxlength="30"></textarea>
					</div>

					<div class="form-group">
						<label for="exampleInputFile">Insira o arquivo</label>
						<input type="file" name="arquivo" multiple="" id="arquivo">

					</div>
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
						<button id="confirm-btn" type="submit"
								class="btn btn-block btn-primary rounded-0">
							Confirmar
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>


<section id="excluir" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content rounded-0">
			<div class="modal-header border-0 rounded-0">
				<h3 class="modal-title">Deseja excluir este arquivo?</h3>
				<p>Ao fazer isso não será possível recuperar.</p>
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
					<form
						action="#" id="frmPublicacaoD" method="post">
						<button id="confirm-btn" type="submit"
								class="btn btn-block btn-primary rounded-0">
							Confirmar
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="ocultar" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content rounded-0">
			<div class="modal-header border-0 rounded-0">
				<h3 class="modal-title">Tem certeza?</h3>
				<p>Se o conteúdo já estiver oculto ele será imediatamente ativado e todos os usuários poderão ver novamente.</p>
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
					<form action="#" id="frmPublicacaoO" method="post">
						<button id="confirm-btn" type="submit"
								class="btn btn-block btn-primary rounded-0">
							Confirmar
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


<script>
    $(document).ready(function () {
        $('.excluirPubli').click(function () {

            var id_publicacao = $(this).attr('id');

            $('#frmPublicacaoD').attr('action', $('#base_url').val() + 'excluir/c/' + id_publicacao);
        });
    });


    $(document).ready(function () {
        $('.ocultarPubli').click(function () {

            var id_publicacao = $(this).attr('id');

            $('#frmPublicacaoO').attr('action', $('#base_url').val() + 'ocultar/c/' + id_publicacao);
        });
    });

</script>
