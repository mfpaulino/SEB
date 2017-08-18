<?php
session_start();

$inc ="sim";

include('config.inc.php');
include(PATH . '/controllers/autenticacao/perfil.inc.php');

$agora = date("Y-m-d H:i:s");
$tempo_inatividade = (strtotime($agora)-strtotime($ultimoAcesso));
$ultimoAcesso = $_SESSION['ultimoAcesso'];

if($tempo_inatividade >= TEMPO_MAX_INATIVIDADE){ // TEMPO_SESSAO vem de constantes.inc.php
	session_destroy();
}
if(isset($_SESSION['cpf'])){?>
	<p><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></p>
	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	<?php
}
else { ?>
	<a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
	<p></p>
	<p><a href="index.php"><span style="color:#ffffff;"><u>Logar novamente</u></span></a></p>

	<script>
		$(document).ready(function(){
			$('#modalFimSessao').modal('show');
		});
	</script>
	<?php
}
?>