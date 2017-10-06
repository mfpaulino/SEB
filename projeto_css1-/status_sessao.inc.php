<?php
session_start();

$inc ="sim";

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/perfil.inc.php');

$agora = date("Y-m-d H:i:s");
$tempo_inatividade = (strtotime($agora)-strtotime($ultimoAcesso));
$ultimoAcesso = $_SESSION['ultimoAcesso'];
$tempo_restante = TEMPO_MAX_INATIVIDADE - $tempo_inatividade;

$usuario = $posto_usuario . " " . $nome_guerra_usuario;

if(strlen($usuario) > 19){
	$usuario = substr($usuario, 0, 19)."...";
}

if ($tempo_inatividade >= (TEMPO_MAX_INATIVIDADE)){
	?>
	<a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
	<p></p>
	<p><a href="index.php"><span style="color:#ffffff;">Logar novamente</span></a></p>
	<?php
	if($_SESSION['contador_sessao'] == 1){?>
	<script>
		$(document).ready(function(){
			$('#modalFimSessao').modal('show');
		});
	</script>
	<?php
	}
	session_destroy();
}
else if($tempo_inatividade >= (TEMPO_MAX_INATIVIDADE - 120)){ // TEMPO_SESSAO vem de constantes.inc.php ?>
	<p><?php echo $usuario;?></p>
	<a href="#"><i class="fa fa-circle text-success"></i> Online (<?php echo $tempo_restante;?> s)</a>
	<?php
	if ($_SESSION['contador_sessao'] == 0){?>
	<script>
		$(document).ready(function(){
			$('#modalAlertaSessao').modal('show');
		});
	</script>
	<?php
	}
	$_SESSION['contador_sessao'] = 1;
}
else {?>
	<p><?php echo $usuario;?></p>
	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	<?php
}
?>