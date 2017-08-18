<?php
$senha = '111111111111111111111111';
$custo = '08';
$salt = 'Cf1f11ePArKlBJomM0F6aJ';
// Gera um hash baseado em bcrypt
$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

echo $hash;
?>