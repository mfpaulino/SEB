<?php
//tela1.php
require_once ('../componentes/internos/php/constantes.inc.php');
require_once ('../componentes/internos/php/conexao.inc.php');
$nivel = "1";
require_once ('../autenticacao/autentica.inc.php');

echo "autenticação funcionou<br />";
echo $nome_usuario."<br />";
echo $sigla_usuario."<br />";
echo $codom_usuario."<br />";
echo $ultimo_acesso."<br />";
?>
TELA 1
<br />
<?php $flag = md5("logout");?>
<a href='autenticacao/logout.php?flag=<?php echo $flag;?>'>logout</a>
<br />

<a href="tela2.php">Tela 2</a>
