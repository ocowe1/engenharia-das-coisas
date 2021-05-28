<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<ol class="breadcrumb">
			<li><a><i class="fa fa-dashboard"></i> Home / Contato</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

<section class="content">
	<?php $this->load->view('telas/gestor/view_flashdata'); ?>
	<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Contate-nos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <?php
              echo form_open('g/contatar');
              ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nome</label>
                  <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite seu nome">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Digite o email">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Assunto</label>
                  <input type="text" name="assunto" class="form-control" id="assunto" placeholder="Digite o assunto do email">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Mensagem</label>
                  <textarea class="form-control" id="mensagem" name="mensagem" rows="5"  placeholder="Enter email"></textarea>
                </div>

                <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Enviar</button>
            	</div>
            </div>
            <?php echo form_close(); ?>
    </div>
</div>
</div>
</section>
</div>
