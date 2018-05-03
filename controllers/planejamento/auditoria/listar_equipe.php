<?php
//listar_equipe.php

$inc = 'sim';
include_once('../../../config.inc.php');

foreach($_POST['auditor'] as $auditor){
	$lista_equipe = $lista_equipe . $auditor . ",";
}
$lista_equipe = substr_replace($lista_equipe, '', -1);

$sql = "SELECT id_usuario, posto, nome_guerra FROM usuarios, postos WHERE id_usuario IN ($lista_equipe) AND usuarios.id_posto = postos.id_posto ORDER BY  postos.id_posto, nome_guerra";
$con = $mysqli->query($sql);

echo "<option value=''>Selecione...</option>";

while($row = $con->fetch_assoc()){
	echo "<option value='".$row['id_usuario']."'>".$row['posto']." ".$row['nome_guerra']."</option>";
}
?>

