<?php
session_start();

$inc ="sim";

include('config.inc.php');
include(PATH . '/controllers/autenticacao/perfil.inc.php');

$agora = date("Y-m-d H:i:s");
$tempo_inatividade = (strtotime($agora)-strtotime($ultimoAcesso));
$ultimoAcesso = $_SESSION['ultimoAcesso'];
$tempo_restante = TEMPO_MAX_INATIVIDADE - $tempo_inatividade;


if ($tempo_inatividade >= (TEMPO_MAX_INATIVIDADE)){
	?>
	<a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
	<p></p>
	<p><a href="index.php"><span style="color:#ffffff;"><u>Logar novamente</u></span></a></p>
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
	<p><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></p>
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
	<p><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></p>
	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	<?php
}
?>