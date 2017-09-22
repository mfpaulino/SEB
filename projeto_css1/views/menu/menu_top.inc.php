<?php
if ($inc == "sim"){
	?>
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
	<!-- Navbar Right Menu -->
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- Messages: style can be found in dropdown.less-->
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
							<a href="<?php echo PAGINA_BLOQUEIO.'?flag='.($pagina);?>"><button type="button" class="btn btn-warning btn-flat">Bloquear tela</button></a>
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
?>