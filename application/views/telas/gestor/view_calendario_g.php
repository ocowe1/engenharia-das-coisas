
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> Home / Calendário</a></li>
		</ol>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-3">
				<!-- /. box -->
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Criar Evento</h3>
					</div>
					<form action="<?php echo base_url ('gestor/evento')?>" method="post">
					<div class="box-body">
						<div class="input-group">
							<input id="titulo" name="titulo" type="text" autocomplete="off" class="form-control" placeholder="Titulo">
						</div>
						<br>
						<div class="input-group">
							<input id="dia" name="dia" autocomplete="off" type="number" class="form-control max" placeholder="Dia">
						</div>
						<br>
						<div class="input-group">
							<input id="mes" name="mes" autocomplete="off" type="number" class="form-control max" placeholder="Mês">
						</div>
						<br>
						<div class="input-group-btn">
							<button type="submit" class="btn btn-primary btn-flat">Add</button>
						</div>
						<br>

						<?php  echo  validation_errors();  ?>
					</div>
					</form>
				</div>


				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Seus eventos agendados</h3>
					</div>
					<?php
					foreach ($eventos as $e){
						echo '<div class="external-event bg-blue">'.$e->calendar_name.' - '. $e->calendar_day.'/'.$e->calendar_month.'
											<button type="button" data-toggle="modal" data-target="#apagar"
													id="'. $e->calendar_id .'"
													class="btn btn-xs btn-danger pull-right apagar"><i
													class="fa fa-remove" title="Apagar"></i>
											</button></div>';
					}
					?>
				</div>



			</div>




			<div class="col-md-9">
				<div class="box box-primary">
					<div class="box-body no-padding">
						<!-- THE CALENDAR -->
						<div id="calendar"></div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /. box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>


<section id="apagar" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content rounded-0">
			<div class="modal-header border-0 rounded-0">
				<h3 class="modal-title">Deseja excluir este evento?</h3>
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


<script>

    $(document).ready(function () {
        $('.apagar').click(function () {

            var id_publicacao = $(this).attr('id');

            $('#frmPublicacaoD').attr('action', $('#base_url').val() + 'g/apagar_evento/' + id_publicacao);
        });
    });

    $('input#max').attr('max_length','2').keypress(limitMe);

    function limitMe(e) {
        if (e.keyCode == 8) { return true; }
        return this.value.length < $(this).attr("maxLength");
    }
</script>

