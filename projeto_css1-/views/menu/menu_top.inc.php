<?php
if ($inc == "sim"){
	if (strpos($pagina,'mailbox_view') === false){//qualquer script <> mailbox_view
		$pagina_lock = md5($pagina);//será usado no redirecionamento da PAGINA_INICIAL (user.php)
	}
	else{
		$pagina_lock = md5(date('d-m-Y')).$pagina;//será usado no redirecionamento da PAGINA_INICIAL (user.php)
	}
	?>
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" title="Ocultar/expandir menu"><span class="sr-only">Toggle navigation</span></a>
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="views/avatar/<?php echo $avatar_usuario;?>" class="user-image" alt="User Image">
					<span class="hidden-xs"><b><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></b></span>
				</a>
				<ul class="dropdown-menu">
					<li class="user-header">
						<img src="views/avatar/<?php echo $avatar_usuario;?>" class="img-circle" alt="User Image">
						<p>
							<?php echo $perfil_usuario . " - " . $sigla_usuario;?>
							<small>Acesso anterior: <?php echo $acesso_anterior_usuario;?></small>
						</p>
					</li>
					<li class="user-body">
						<div class="pull-left">
							<a href="<?php echo PAGINA_BLOQUEIO.'?flag='.($pagina_lock);?>"><button type="button" class="btn btn-warning btn-flat">Bloquear tela</button></a>
						</div>
						<div class="pull-right">
							<?php $flag = md5("logout");?>
							<a href="controllers/autenticacao/logout.php?flag=<?php echo $flag;?>"><button type="button" class="btn btn-danger btn-flat">Fazer logout</button></a>
						</div>
					</li>
				</ul>
			</li>
			<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears" title="Administração do Usuário"></i></a></li>
		</ul>
	</div>
<?php
}
else {
	include_once('../../controllers/autenticacao/acesso_negado.php');//exibe msg de ACESSO NEGADO
}
?>