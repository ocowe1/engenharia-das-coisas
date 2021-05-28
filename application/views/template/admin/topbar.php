<?php
	$session = $this->session->userdata('logged_in');
	$user_name = $session['user_name'];
	$user_curso = $session['user_curso'];
?>
<header class="main-header">

	<!-- Logo -->
	<a href="dashboard" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>E</b>DC</span>
		<!-- logo for regular state and mobile devices -->
		<small><span class="logo-lg"><b>Engenharia </b>das Coisas</span></small>
	</a>

	<!-- Header Navbar: style can be found in header.less -->


<nav class="navbar navbar-static-top">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
	</a>
	<!-- Navbar Right Menu -->
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- Messages: style can be found in dropdown.less-->
			<li class="dropdown messages-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-envelope-o"></i>
					<span class="label label-success">4</span>
				</a>
				<ul class="dropdown-menu">
					<li class="header">You have 4 messages</li>

					<li class="footer"><a href="#">See All Messages</a></li>
				</ul>
			</li>
			<!-- Notifications: style can be found in dropdown.less -->
			<li class="dropdown notifications-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-bell-o"></i>
					<span class="label label-warning">10</span>
				</a>
				<ul class="dropdown-menu">
					<li class="header">You have 10 notifications</li>
					<li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">

						</ul>
					</li>
					<li class="footer"><a href="#">View all</a></li>
				</ul>
			</li>
			<!-- Tasks: style can be found in dropdown.less -->

			<!-- User Account: style can be found in dropdown.less -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo base_url(); ?>assets/dist/img/user.png" class="user-image" alt="User Image">
					<span class="hidden-xs"><?php echo $user_name; ?></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header">
						<img src="<?php echo base_url(); ?>assets/dist/img/user.png" class="img-circle" alt="User Image">

						<p>
							<?php echo $user_name; ?>
							<small><?php echo $user_curso; ?></small>	
						</p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<div class="pull-left">
							<a href="#" class="btn btn-default btn-flat">Profile</a>
						</div>
						<div class="pull-right">
							<a href="../logout" class="btn btn-default btn-flat">Sair</a>
						</div>
					</li>
				</ul>
			</li>
			<!-- Control Sidebar Toggle Button -->

		</ul>
	</div>

</nav>

</header>
