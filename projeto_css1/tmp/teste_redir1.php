<?php
$flag = "a";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);
?>
<a href ="teste_redir.php?flag=<?php echo $flag;?>&pagina=<?php echo $pagina;?>">link</a>
<?php
if(isset($_GET['flag'])){
	echo $_GET['flag'];
}
?>