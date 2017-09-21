<?php
if ($inc == "sim"){
	$con_qtde_correio = $mysqli->query("SELECT COUNT(id) AS qtde_msg FROM correio_recebidos WHERE lida = 'nao' AND destinatario = '$id_usuario'");
	$row_qtde_correio = $con_qtde_correio->fetch_assoc();

	$con_ultimo_correio = $mysqli->query("SELECT ce.id_correio, ce.assunto, ce.data, cr.lida, p.posto, u.nome_guerra, u.codom, u.avatar FROM correio_enviados ce, correio_recebidos cr, postos p, usuarios u WHERE cr.destinatario = '$id_usuario' and cr.lida = 'nao' and ce.id_correio = cr.id_correio and ce.remetente = u.cpf and p.id_posto = u.id_posto  ORDER BY ce.data desc");
	$row_ultimo_correio = $con_ultimo_correio->fetch_assoc();

	$sql_sigla_ultimo_correio = "SELECT sigla FROM cciex_om WHERE codom = '$row_ultimo_correio[codom]' limit 1";
	$con_sigla_ultimo_correio = $mysqli1->query($sql_sigla_ultimo_correio);
	$row_sigla_ultimo_correio = $con_sigla_ultimo_correio->fetch_assoc();

	if(date('d/m/Y') - 1 == date('d/m/Y', strtotime($row_ultimo_correio['data']))){
		$data = "Ontem " . date('H:i',strtotime($row_ultimo_correio['data']));
	}
	else if(date('d/m/Y') == date('d/m/Y', strtotime($row_ultimo_correios['data']))){
		$data = "Hoje " . date('H:i',strtotime($row_ultimo_correio['data']));
	}
	else{
		$data = date('d/m/Y H:i', strtotime($row_ultimo_correio['data']));
	}

	$remetente = $row_ultimo_correio['posto']." ". $row_ultimo_correio['nome_guerra'];

	if(strlen($remetente) > 26){
		$remetente = substr($remetente, 0, 26)."...";
	}
	if(strlen($row_ultimo_correio['assunto']) > 31){
		$assunto = substr($row_ultimo_correio['assunto'], 0, 36)."...";
	}
	else {
		$assunto =  $row_ultimo_correio['assunto'];
	}
	?>
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
	<!-- Navbar Right Menu -->
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- Messages: style can be found in dropdown.less-->
			<li class="dropdown messages-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-default"><div id="correio1"><?php echo $row_qtde_correio['qtde_msg'];?></div></span></a>
				<ul class="dropdown-menu">
					<li class="header">
						<span><b>Você tem <span id="correio2"><?php echo $row_qtde_correio['qtde_msg'];?></span> novas mensagens de correio</b></span>
					<li>
					<li>
						<!-- inner menu: contains the messages -->
						<ul class="menu">
							<!-- start message -->
							<li>
								<a href="#">
									<div id="correio3" class="pull-left">
										<!-- User Image -->
										<img src="views/avatar/<?php echo $row_ultimo_correio['avatar'];?>" class="img-circle" alt="User Image">
									</div>
									<!-- Message title and timestamp -->
									<h4>
										<?php echo $remetente;?>
										<br />
										<?php echo "(".$row_sigla_ultimo_correio['sigla'].")";?>
									</h4>
									<!-- The message -->
									<p><?php echo $assunto;?>
									<br /><small><i class="fa fa-clock"></i>&nbsp;&nbsp;<?php echo $data;?></small></p>
								</a>
							</li>
							<!-- end message -->
						</ul>
						<!-- /.menu -->
					</li>
					<li class="footer"><a href="#">Ver Todas as Mensagens</a></li>
				</ul>
			</li>
			<!-- /.messages-menu -->
			<!-- Notifications Menu -->
			<li class="dropdown notifications-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-warning"></i><span class="label label-warning">10</span></a>
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
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="label label-danger">9</span></a>
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
?>