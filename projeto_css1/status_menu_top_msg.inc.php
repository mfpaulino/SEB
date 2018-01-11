<?php
/*************************************************************************************************
 ./status_menu_top_msg.inc.php
 As alterações realizadas aqui devem ser replicadas para o script views/menu/menu_top_msg.inc.php
**************************************************************************************************/
session_start();

$inc ="sim";

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/perfil.inc.php');
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');

$con_correio = $mysqli->query("SELECT COUNT(id) AS qtde_msg FROM correio_recebidos WHERE lida = 'nao' AND pasta = 'entrada' AND destinatario = '$id_usuario'");
$row_correio = $con_correio->fetch_assoc();

$con_ultimo_correio = $mysqli->query("SELECT ce.id_correio, ce.assunto, ce.data, cr.lida, p.posto, u.nome_guerra, u.codom, u.avatar FROM correio_enviados ce, correio_recebidos cr, postos p, usuarios u WHERE cr.destinatario = '$id_usuario' and cr.lida = 'nao' and ce.id_correio = cr.id_correio and ce.remetente = u.cpf and p.id_posto = u.id_posto  ORDER BY ce.data desc");
$row_ultimo_correio = $con_ultimo_correio->fetch_assoc();

$sql_sigla_ultimo_correio = "SELECT sigla FROM cciex_om WHERE codom = '$row_ultimo_correio[codom]' limit 1";
$con_sigla_ultimo_correio = $mysqli1->query($sql_sigla_ultimo_correio);
$row_sigla_ultimo_correio = $con_sigla_ultimo_correio->fetch_assoc();

if($row_correio['qtde_msg'] == 0){
	$qtde_msg = 0;
}
else {
	$qtde_msg = $row_correio['qtde_msg'];
}

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
$flag1 = $row_ultimo_correio['posto']." ". $row_ultimo_correio['nome_guerra'] . " - " . $row_sigla_ultimo_correio['sigla'];

if(strlen($remetente) > 26){
	$remetente = substr($remetente, 0, 26)."...";
}

if(strlen($row_ultimo_correio['assunto']) > 31){
	$assunto = substr($row_ultimo_correio['assunto'], 0, 36)."...";
}
else {
	$assunto =  $row_ultimo_correio['assunto'];
}
/********** AVISOS ADM *****************************/
$con_aviso = $mysqli->query("SELECT id_aviso, titulo, texto, dt_aviso FROM adm_avisos WHERE status = 'Ativo' AND publico like '%$perfil_om%' ORDER BY dt_aviso DESC");
$qtde_aviso = $con_aviso->num_rows;
$row_aviso = $con_aviso->fetch_assoc();

/********** ALERTAS DO SISTEMA ********************/
?>
<div class="navbar-custom-menu">
	<ul class="nav navbar-nav">
		<li class="dropdown messages-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope" title="Correios"></i><span class="label label-default"><?php echo $qtde_msg;?></span></a>
			<?php if($qtde_msg > 0){?>
				<ul class="dropdown-menu">
					<li class="header">
						<span>
							<b>
								Há
								<?php echo $qtde_msg;
								if($qtde_msg == 1){
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
								<a href="mailbox_view.php?flag=<?php echo $row_ultimo_correio['id_correio'];?>&flag0=i&flag1=<?php echo $flag1;?>">
									<div class="pull-left">
										<img src="views/avatar/<?php echo $row_ultimo_correio['avatar'];?>" class="img-circle" alt="User Image">
									</div>
									<h4>
										<?php echo $remetente;?>
										<br />
										<?php echo "(".$row_sigla_ultimo_correio['sigla'].")";?>
									</h4>
									<p><?php echo $assunto;?>
									<br /><small>&nbsp;&nbsp;<?php echo $data;?></small></p>
								</a>
							</li>
						</ul>
					</li>
					<li class="footer"><a href="mailbox_input.php">Ver todos os correios</a></li>
				</ul>
			<?php } ?>
		</li>
		<li class="dropdown notifications-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-warning" title="Alertas"></i><span class="label label-warning">10</span></a>
			<!--
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
			-->
		</li>
		<li class="dropdown messages-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell" title="Avisos"></i><span class="label label-danger"><?php echo $qtde_aviso;?></span></a>
			<?php
			if($qtde_aviso > 0){?>
				<ul class="dropdown-menu">
					<li class="header">
						<span>
							<b>
								Há
								<?php echo $qtde_aviso;
								if($qtde_aviso == 1){
									echo ' Aviso Administrativo.';
								}
								else{
									echo ' Avisos Administrativos.';
								}
								?>
							</b>
						</span>
					<li>
						<li>
							<ul class="menu">
								<li>
								<a href="#">
									<p><b>Aviso mais recente:</b></p>
									<br />
									<h4><?php echo $row_aviso['titulo'];?></h4>
									<p><?php echo nl2br($row_aviso['texto']);?></p>
									<br />
									<p><small>(Publicado em <?php echo converter_data($row_aviso['dt_aviso'],'BR', true);?>)</small></p>
								</a>
								</li>
							</ul>
						</li>
					<li class="footer"><a href="user.php">Ver todos os avisos</a></li>
				</ul>
			<?php
			} ?>
		</li>
	</ul>
</div>