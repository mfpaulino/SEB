<?php
if ($inc == "sim"){
	$con_qtde_correio = $mysqli->query("SELECT COUNT(id) AS qtde_msg FROM correio_recebidos WHERE lida = 'nao' AND pasta = 'entrada' AND destinatario = '$id_usuario'");
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
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<li class="dropdown messages-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-default"><?php echo $row_qtde_correio['qtde_msg'];?></span></a>
				<?php if($row_qtde_correio['qtde_msg'] > 0){?>
					<ul class="dropdown-menu">
						<li class="header">
							<span>
								<b>
									Você tem
									<?php echo $row_qtde_correio['qtde_msg'];
									if($row_qtde_correio['qtde_msg'] == 1){
										echo ' novo correio';
									}
									else{
										echo ' novos correios';
									}
									?>
								</b>
							</span>
						<li>
						<li>
							<ul class="menu">
								<li>
									<a href="#">
										<div class="pull-left">
											<img src="views/avatar/<?php echo $row_ultimo_correio['avatar'];?>" class="img-circle" alt="User Image">
										</div>
										<h4>
											<?php echo $remetente;?>
											<br />
											<?php echo "(".$row_sigla_ultimo_correio['sigla'].")";?>
										</h4>
										<p><?php echo $assunto;?>
										<br /><small><i class="fa fa-clock"></i>&nbsp;&nbsp;<?php echo $data;?></small></p>
									</a>
								</li>
							</ul>
						</li>
						<li class="footer"><a href="mailbox_input.php">Ver todos os correios</a></li>
					</ul>
				<?php } ?>
			</li>
			<li class="dropdown notifications-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-warning"></i><span class="label label-warning">10</span></a>
				<ul class="dropdown-menu">
					<li class="header">You have 10 notifications</li>
					<li>
						<ul class="menu">
							<li>
								<a href="#">
								  <i class="fa fa-users text-aqua"></i> 5 new members joined today
								</a>
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">View all</a></li>
				</ul>
			</li>
			<li class="dropdown tasks-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="label label-danger">9</span></a>
				<ul class="dropdown-menu">
					<li class="header">You have 9 tasks</li>
					<li>
						<ul class="menu">
							<li>
								<a href="#">
									<h3>Design some buttons<small class="pull-right">20%</small></h3>
									<div class="progress xs">
										<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">20% Complete</span>
										</div>
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">View all tasks</a></li>
				</ul>
			</li>
		</ul>
	</div>
<?php
}
else {
	include_once('../../controllers/autenticacao/acesso_negado.php');//exibe msg de ACESSO NEGADO
}
?>