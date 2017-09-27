<?php
$inc = "sim";
include_once('config.inc.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo TITULO;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrapValidator.min.css" />
	<link rel="stylesheet" href="componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-green.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">
</head>
<body>
<?php
$con_usuarios = $mysqli->query("SELECT * FROM usuarios ORDER BY ID_usuario desc");
//$con_update->bind_param('s', $nova_senha);
$mysqli->close();
while ($rows =  $con_usuarios->fetch_assoc()){
$cpf = $rows['cpf'];
$status = $rows['status'];
	include('views/usuario/view_usuario_status.inc.php');
}
?>
<script src="componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
	<script src="componentes/externos/dist/js/adminlte.min.js"></script>
	<script src="controllers/usuario/usuario_alterar.js"></script>
	<script src="controllers/usuario/senha_alterar.js"></script>
</body>
</html>
