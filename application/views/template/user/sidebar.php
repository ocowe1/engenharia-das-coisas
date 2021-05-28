<?php
$session = $this->session->userdata('logged_in');
$id = $session['user_id'];
$this->load->model('model_user');
$dados = $this->model_user->busca($id);
foreach($dados as $d){
	$user = array(
		'user_name' => $d->user_name,
		'user_curso' => $d->user_curso,
		'user_img' => $d->user_img,
		'user_email' => $d->user_email,
		'user_ra' => $d->user_ra,
		'user_celular' => $d->user_celular,
		'semestre' => $d->semestre
	);
}

$img = $user['user_img'];


?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="padding-left: 4px;">
            <div class="pull-left image">
                <img src="<?php echo base_url ('/assets/upload/profile_img/'.$img); ?>" class="img-circle" style="width: 40px; height: auto; min-height: 40px;" >
            </div>
            <div class="pull-left info" style="padding-left: 5px;">
                <p><?php echo $user['user_name']; ?></p>
				<a class="description"><?php echo $user['user_curso']; ?></a>
            </div><br><br>
        </div>
        <!-- search form -->
        <form action="<?php echo base_url ('u/pesquisar') ?>" method="post" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="pesquisar" autocomplete="off" id="pesquisar" class="form-control" placeholder="Procurar">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">
            <li class="header">MENU DE NAVEGAÇÃO</li>
            <li class="treeview">
                <a href="<?php echo base_url ('u/feed') ?>">
                    <i class="fa fa-bars"></i> <span>Início</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url ('u/curso') ?>">
                    <i class="fa fa-book"></i> <span><?php echo $user['user_curso']; ?></span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url ('u/calendario') ?>">
                    <i class="fa fa-calendar"></i> <span>Calendário</span>
                </a>
            </li>


			<li class="treeview">
				<a href="">
					<i class="fa  fa-share-alt"></i> <span>Publicar</span>
					<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('u/e/arquivo'); ?>"><i class="fa fa-circle-o"></i>Com arquivo</a></li>
					<li><a href="<?php echo base_url ('u/e/texto') ?>"><i class="fa fa-circle-o"></i>Texto</a></li>
				</ul>
			</li>

            <li class="treeview">
                <a href="<?php echo base_url ('u/mensagens') ?>">
                    <i class="fa fa-envelope"></i> <span>Mensagens</span>
                </a>
            </li>

			<li class="treeview">
				<a href="">
					<i class="fa fa-share" href=""></i><span>Acessos Esamc</span>
					<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
				</a>
				<ul class="treeview-menu">
					<li><a href="http://waewebsantos.esamc.br/waeweb/servlet/hwalgn?21" target="_blank"><i class="fa fa-circle-o"></i> Aluno Net</a></li>
					<li><a href="http://esamc.blackboard.com" target="_blank"><i class="fa fa-circle-o"></i> Blackboard</a></li>
					<li><a href="https://esamc.br/home/" target="_blank"><i class="fa fa-circle-o"></i> Esamc</a></li>
				</ul>
			</li>

            <li class="treeview">
                <a href="<?php echo base_url ('u/membros') ?>">
                    <i class="fa fa-users"></i> <span>Membros</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url ('u/contato')?>">
                    <i class="fa fa-life-ring"></i> <span>Contato</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url ('u/info')?>">
                    <i class="fa fa-exclamation-circle"></i> <span>Informações</span>
                </a>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
