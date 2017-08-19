<?php
//conexao.inc.php

$servidor = "localhost";
$bd = "cciex_siaudi";
$usuario = "cciex_siaudi-con";
$senha = "adintra#$@";

//conexao usando o mysqli
$mysqli = new mysqli($servidor, $usuario, $senha, $bd);

if ($mysqli->connect_errno) {
    echo "Falha ao conectar ao banco de dados: " . $mysqli->connect_error;
}

// setando  utf8
mysqli_set_charset($mysqli,"utf8");

//conexao para a tabela de OM no servidor do SISADE
$servidor1 = "localhost";
$bd1 = "cciex_sistemas";

//conexao usando o mysqli
$mysqli1 = new mysqli($servidor1, $usuario, $senha, $bd1);

if ($mysqli1->connect_errno) {
    echo "Falha ao conectar ao banco de dados: " . $mysqli1->connect_error;
}

// setando  utf8
mysqli_set_charset($mysqli1,"utf8");
?>
