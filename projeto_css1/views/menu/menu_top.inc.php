<?php
if ($inc == "sim"){

	$con_correio = $mysqli->query("SELECT COUNT(id) AS qtde_msg FROM correio_recebidos WHERE lida = 'nao' AND destinatario = '$id_usuario'");
	$row_correio = $con_correio->fetch_assoc();
	?>
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
	<!-- Navbar Right Menu -->
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- Messages: style can be found in dropdown.less-->
			<li class="dropdown messages-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-primary"><?php echo $row_correio['qtde_msg'] ;?></span></a>
				<ul class="dropdown-menu">
					<li class="header">You have 4 messages</li>
					<li>
						<!-- inner menu: contains the messages -->
						<ul class="menu">
							<!-- start message -->
							<li>
								<a href="#">
									<div class="pull-left">
										<!-- User Image -->
										<img src="componentes/externos/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									</div>
									<!-- Message title and timestamp -->
									<h4>
										Support Team
										<small><i class="fa fa-clock"></i> 5 mins</small>
									</h4>
									<!-- The message -->
									<p>Why not buy a new awesome theme?</p>
								</a>
							</li>
							<!-- end message -->
						</ul>
						<!-- /.menu -->
					</li>
					<li class="footer"><a href="#">See All Messages</a></li>
				</ul>
			</li>
			<!-- /.messages-menu -->
			<!-- Notifications Menu -->
			<li class="dropdown notifications-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="label label-warning">10</span></a>
				<ul class="dropdown-menu">
					<li class="header">You have 10 notifications</li>
					<li>
						<!-- Inner Menu: contains the notifications -->
						<ul class="menu">
							<li>
								<!-- start notification -->
								<a href="#">
								  <i class="fa fa-users text-aqua"></i> 5 new members joined today
								</a>
								<!-- end notification -->
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">View all</a></li>
				</ul>
			</li>
			<!-- Tasks Menu -->
			<li class="dropdown tasks-menu">
				<!-- Menu Toggle Button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i><span class="label label-danger">9</span></a>
				<ul class="dropdown-menu">
					<li class="header">You have 9 tasks</li>
					<li>
						<!-- Inner menu: contains the tasks -->
						<ul class="menu">
							<li>
								<!-- Task item -->
								<a href="#">
									<!-- Task title and progress text -->
									<h3>Design some buttons<small class="pull-right">20%</small></h3>
									<!-- The progress bar -->
									<div class="progress xs">
										<!-- Change the css width attribute to simulate progress -->
										<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">20% Complete</span>
										</div>
									</div>
								</a>
								<!-- end task item -->
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">View all tasks</a></li>
				</ul>
			</li>
			<!-- User Account Menu -->
			<li class="dropdown user user-menu">
				<!-- Menu Toggle Button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<!-- The user image in the navbar-->
					<img src="views/avatar/<?php echo $avatar_usuario;?>" class="user-image" alt="User Image">
					<!-- hidden-xs hides the username on small devices so only the image appears. -->
					<span class="hidden-xs"><b><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></b></span>
				</a>
				<ul class="dropdown-menu">
					<!-- The user image in the menu -->
					<li class="user-header">
						<img src="views/avatar/<?php echo $avatar_usuario;?>" class="img-circle" alt="User Image">
						<p>
							<?php echo $perfil_usuario . " - " . $sigla_usuario;?>
							<small>Acesso anterior: <?php echo $acesso_anterior_usuario;?></small>
						</p>
					</li>
					<!-- Menu Body-->
					<li class="user-body">
						<div class="pull-left">
							<a href="<?php echo PAGINA_BLOQUEIO.'?flag='.md5($pagina);?>"><button type="button" class="btn btn-warning btn-flat">Bloquear tela</button></a>
						</div>
						<div class="pull-right">
							<?php $flag = md5("logout");?>
							<a href="controllers/autenticacao/logout.php?flag=<?php echo $flag;?>"><button type="button" class="btn btn-danger btn-flat">Fazer logout</button></a>
						</div>
					</li>
				</ul>
			</li>
			<!-- Control Sidebar Toggle Button -->
			<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
		</ul>
	</div>
<?php
}
else {
	include_once('../../controllers/autenticacao/acesso_negado.php');//exibe msg de ACESSO NEGADO
}