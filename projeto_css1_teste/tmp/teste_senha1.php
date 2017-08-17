<?php
include_once('../componentes/internos/php/bcript.inc.php');


// Encriptando a senha
$senha = '11111';
$hash = Bcrypt::hash($senha);
// $hash = $2a$08$MTgxNjQxOTEzMTUwMzY2OOc15r9yENLiaQqel/8A82XLdj.OwIHQm
// Salve $hash no banco de dados
// Verificando a senha
echo $hash."<br />";
$senha = '11111';
$hash = '$2a$08$MTI3OwftyNDI1NzU5OGNhM.w1riQItW1lScwXqCk9gFXDA3BBq9UYi'; // Valor retirado do banco
if (Bcrypt::check($senha, $hash)) {
	echo 'Senha OK!';
} else {
	echo 'Senha incorreta!';
}
?>