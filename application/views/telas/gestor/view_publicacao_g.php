<?php
$session = $this->session->userdata ( 'logged_in' );
$id = $session[ 'user_id' ];
$this->load->model ( 'model_user' );
$dados = $this->model_user->busca ( $id );
$query = $this->model_user->post ( $p_id );
$comentarios = $this->model_user->all_comentarios ( $p_id );

?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> Home / Publicação</a></li>
		</ol>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">
		<?php $this->load->view ( 'telas/gestor/view_flashdata' ); ?>
		<?php foreach ( $dados

		as $d ){ ?>
		<?php foreach ( $query

		as $q ){
		$like = $this->model_user->l_contagem ( $q->publicacao_id );
		$coment = $this->model_user->c_contagem ( $q->publicacao_id );
		$postador = $this->model_user->busca ( $q->user_id );
		foreach ( $postador

		as $p ){
		if ( $like == 1 ) {
			$qtd_likes = 'Curtida';
		}
		else {
			$qtd_likes = 'Curtidas';
		}

		?>
		<div class="row">
			<div class="col-md-12">
				<!-- Box Comment -->
				<div class="box box-widget">
					<div class="box-header with-border">
						<div class="user-block">
							<img class="img-circle"
								 src="<?php echo base_url ( 'assets/upload/profile_img/' . $p->user_img ); ?>">
							<span class="username"><a href="#"><?php echo $p->user_name; ?> </a>
							<?php
							if ( $p->profile_id == 3 ) {
								echo '<span class="label label-warning">Gestor</span>';
							}
							elseif ( $p->profile_id == 4 ) {
								echo '<span class="label label-success">Professor</span>';
							}
							elseif ( $p->profile_id == 2 ) {
								echo '<span class="label label-danger">Administrador</span>';
							}
							elseif ( $p->profile_id == 1 ) {
								echo '<span class="label label-info">Master</span>';
							}
							?>
							</span>


							<div class="pull-right">
								<table>
									<tr>
										<td>

											<section id="bloquear" class="modal fade" tabindex="-1" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content rounded-0">
														<div class="modal-header border-0 rounded-0">
															<h3 class="modal-title">Deseja bloquear está
																publicação?</h3>
															<p>Os usuários ainda conseguirão ver esta publicação, porém
																não poderão mais comentar.</p>
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
																	action="<?php echo base_url ( 'g/bloquear/' . $q->publicacao_id ) ?>"
																	method="post">
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

											<button type="button" data-toggle="modal" data-target="#bloquear"
													class="btn btn-sm btn-primary"><i class="fa fa-minus-circle"></i>
											</button>
										</td>

										<td>

											<section id="excluir" class="modal fade" tabindex="-1" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content rounded-0">
														<div class="modal-header border-0 rounded-0">
															<h3 class="modal-title">Deseja excluir está publicação?</h3>
															<p>Ao fazer isso nenhum usuário poderá voltar a ver
																novamente.</p>
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
																	action="<?php echo base_url ( 'g/excluir/' . $q->publicacao_id ) ?>"
																	method="post">
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


											<button type="button" data-toggle="modal" data-target="#excluir"
													class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>

										</td>

										<td>

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
																<form
																	action="<?php echo base_url ( 'g/ocultar/' . $q->publicacao_id ) ?>"
																	method="post">
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

											<button type="button" data-toggle="modal" data-target="#ocultar"
													class="btn btn-sm btn-warning"><i class="fa fa-eye-slash"></i>
											</button>

										</td>
									</tr>
								</table>
							</div>


							<span class="description"><?php echo $p->user_curso; ?></span>
							<span
								class="description">Publicado em: <?php echo date ( 'd/m/Y' , strtotime ( $q->data ) ) . ' às ' . $q->hora; ?></span>
						</div>


					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<h4><?php echo $q->titulo; ?></h4><br>
						<p><?php echo nl2br ( $q->conteudo ); ?></p>

						<hr>
						<table>
							<tr>
								<td>
									<form action="<?php echo base_url ( 'gestor/download/' . $q->publicacao_id ) ?>">
										<?php if ( $q->tipo == '1' ) { ?>
											<button type="submit" class="btn btn-info btn-xs"><i
													class="fa fa-download"></i>
												Baixar
											</button>
										<?php } ?>
									</form>
								</td>
								<td>
									<form
										action="<?php echo base_url ( 'gestor/p/' . $q->publicacao_id . '/curtir' ); ?>">
										<button type="submit"
											<?php
											$verifica = $this->model_user->ver_like ( $id , $q->publicacao_id );
											?>
												class="btn btn-<?php if ( !empty( $verifica ) ) {
													echo 'danger';
												}
												else {
													echo 'primary';
												} ?> btn-xs"><i class="fa fa-thumbs-o-up"></i>
											<?php if ( !empty( $verifica ) ) {
												echo 'Curtido';
											}
											else {
												echo 'Curtir';
											} ?>
										</button>
									</form>
								</td>
							</tr>
						</table>
						<a href="<?php echo base_url ( 'gestor/p/' . $q->publicacao_id . '/' . $q->titulo ); ?>"><span
								class="pull-right text-muted"><?php echo $like . ' ' . $qtd_likes . ' | ' . $coment . ' Comentários'; ?></span></a>

					</div>


					<!-- /.box-body -->
					<div class="box-footer box-comments">
						<?php
						foreach ($comentarios

								 as $c) {
							$dest = $this->model_user->busca ( $c->user_id );
							?>
							<div class="box-comment">
								<?php foreach ( $dest

								as $d_user ){ ?>
								<img class="img-circle img-sm"
									 src="<?php echo base_url ( 'assets/upload/profile_img/' . $d_user->user_img );
									 } ?>">

								<div class="comment-text">

								<span class="username">
									<?php echo $d_user->user_name ?>
									<?php
									if ( $d_user->profile_id == 3 ) {
										echo '<span class="label label-warning">Gestor</span>';
									}
									elseif ( $d_user->profile_id == 4 ) {
										echo '<span class="label label-success">Professor</span>';
									}
									elseif ( $d_user->profile_id == 2 ) {
										echo '<span class="label label-danger">Administrador</span>';
									}
									elseif ( $d_user->profile_id == 1 ) {
										echo '<span class="label label-info">Master</span>';
									}
									?>
									
								</span>


									<span
										class="text-muted pull-right"><?php echo date ( 'd/m/Y' , strtotime ( $c->data ) ) . ' às ' . $c->hora ?></span>


									<?php echo $c->comentario; ?>
									<hr>

									<div class="box-comment">
										<?php
										$resp = $this->model_user->resposta ( $p_id , $c->comentario_id );
										foreach ($resp as $r) {
											$resposta_user = $this->model_user->busca ( $r->user_id );
											foreach ($resposta_user as $r_user) {
												?>
												<img class="img-circle img-sm" src="<?php echo base_url ( 'assets/upload/profile_img/' . $r_user->user_img );
											} ?>">
											<div class="comment-text">
												<span class="username">
													<?php echo $r_user->user_name ?>
													<?php
													if ( $r_user->profile_id == 3 ) {
														echo '<span class="label label-warning">Gestor</span>';
													}
													elseif ( $r_user->profile_id == 4 ) {
														echo '<span class="label label-success">Professor</span>';
													}
													elseif ( $r_user->profile_id == 2 ) {
														echo '<span class="label label-danger">Administrador</span>';
													}
													elseif ( $r_user->profile_id == 1 ) {
														echo '<span class="label label-info">Master</span>';
													}
													?>
												</span>
												<span
													class="text-muted pull-right"><?php echo date ( 'd/m/Y' , strtotime ( $r->data ) ) . ' às ' . $r->hora ?></span>
												</span>
												<?php echo $r->resposta; ?>
											</div>
										<?php } ?>
									</div>

									<!-- colocar aqui a exibição -->
									<?php
									if ( $q->status === 'bloqueado' ) {
										?>

										<?php
									}

									if ( $q->status === 'oculto' ) {
										?>

										<?php
									}

									if ( $q->status === 'ativo' ) {
										?>
										<form
											action="<?php echo base_url ( 'gestor/p/' . $q->publicacao_id . '/' . $c->comentario_id . '/r/comentario' ); ?>"
											method="post">
											<img class="img-responsive img-circle img-sm"
												 src="<?php echo base_url ( 'assets/upload/profile_img/' . $d->user_img ) ?>">
											<!-- .img-push is used to add margin to elements next to floating images -->
											<div class="img-push">
												<input type="text" autocomplete="off" class="form-control input-sm"
													   name="resposta_c"
													   id="resposta_c"
													   placeholder="Pressione enter para responder o comentário">
											</div>
										</form>
									<?php } ?>

								</div>
							</div>
						<?php } ?>
					</div>

					<!-- /.box-footer -->

					<?php
					if ( $q->status === 'bloqueado' ) {
						?>
						<div class="box-footer">
							<span class="text-muted">PUBLICAÇÃO BLOQUEADA POR UM ADMINISTRADOR</span>
						</div>
						<?php
					}

					if ( $q->status === 'oculto' ) {
						?>
						<div class="box-footer">
							<span class="text-muted">ESTÁ PUBLICAÇÃO ESTA OCULTA</span>
						</div>
						<?php
					}

					if ( $q->status === 'ativo' ) {
						?>
						<div class="box-footer">
							<form
								action="<?php echo base_url ( 'gestor/p/' . $q->publicacao_id . '/comentar' ); ?>"
								method="post">
								<img class="img-responsive img-circle img-sm"
									 src="<?php echo base_url ( 'assets/upload/profile_img/' . $d->user_img ) ?>">
								<!-- .img-push is used to add margin to elements next to floating images -->
								<div class="img-push">
									<input type="text" class="form-control input-sm" autocomplete="off"
										   name="comentario" id="comentario"
										   placeholder="Pressione enter para postar o comentário">
								</div>
							</form>
						</div>
						<?php
					}
					?>
					<!-- /.box-footer -->
				</div>


				<?php }
				}
				} ?>
	</section>
	<!-- /.content -->
</div>
