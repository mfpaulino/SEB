<?php
//tela1.php
//$inc = "sim";
require_once (__DIR__ .'/componentes/internos/php/constantes.inc.php');
require_once (__DIR__ .'/componentes/internos/php/conexao.inc.php');
require_once (__DIR__ .'/autenticacao/autentica.inc.php');

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
<a href='usuario/form_altera_senha.inc.php?flag=<?php echo $_SESSION['cpf'];?>'>alterar senha</a>
<br />

<a href="tela2.php">Tela 2</a>
