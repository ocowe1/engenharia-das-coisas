<?php
$erro = $this->session->flashdata('erro');
$sucesso = $this->session->flashdata('sucesso');
$alerta = $this->session->flashdata('alerta');

if(isset($erro)){?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-ban"></i> Ops!</h4>
		<?php echo $erro; ?>
	</div>
<?php
}elseif(isset($sucesso)){?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Tudo certo!</h4>
		<?php echo $sucesso; ?>
	</div>
<?php
}elseif(isset($alerta)){?>
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-warning"></i> Hey!</h4>
		<?php echo $alerta; ?>
	</div>
<?php
}
