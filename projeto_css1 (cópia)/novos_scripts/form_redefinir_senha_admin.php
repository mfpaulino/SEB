<?php
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);
$inc = "sim";
include_once('config.inc.php');
include_once(PATH . '/controllers/usuario/usuario_alertas_criar.inc.php');
echo $_SESSION['senha_enviada'];
?>
<form action="controllers/usuario/senha_recuperar.php" method="POST">
	<input name="cpf" type="text" value = "17251784009" />
	<input type="hidden" name="flag" />
	<input type="hidden" name = "flag1" value = <?php echo $pagina;?>/>
	<input type="submit" />
</form>