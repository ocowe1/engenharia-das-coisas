<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> Home / Compartilhar Conteúdo / Texto</a></li>
		</ol>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">
		<?php $this->load->view('telas/gestor/view_flashdata'); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Compartilhar Texto</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<?php
			echo form_open ('g/gestor/upload_texto');
			?>
				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Titulo</label>
						<input type="text" class="form-control" autocomplete="off" id="titulo" name="titulo" placeholder="Coloque um titulo">
					</div>


					<div class="form-group">
						<label for="exampleInputPassword1">Sobre</label>
						<textarea class="form-control" rows="5" id="sobre" name="sobre"
								  placeholder="Sobre o conteúdo"></textarea>
					</div>

					<div class="form-group">
						<p>Esta publicação é referente para qual engenharia?</p>
						<select class="form-control" name="curso" id="curso">
							<option name="Todas" selected>Todas</option>
							<option name="Engenharia Ambiental">Engenharia Ambiental</option>
							<option name="Engenharia Elétrica">Engenharia Elétrica</option>
							<option name="Engenharia Civil">Engenharia Civil</option>
							<option name="Engenharia Computação">Engenharia Computação</option>
							<option name="Engenharia Produção">Engenharia Produção</option>
							<option name="Engenharia Química">Engenharia Química</option>
						</select>
					</div>

						<p class="help-block">Respeite os <b><a href="<?php echo base_url ('g/termos') ?>">termos</a></b> da comunidade ao envio de arquivos ou publicação de
							textos, o envio de
							arquivos ou de textos fora do padrão resultarão em punição!</p>

				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Enviar</button>
				</div>
			<?php
			echo form_close();
			?>
		</div>
</div>


