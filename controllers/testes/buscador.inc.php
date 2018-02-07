<?php
//controllers/testes/buscador.inc.php

session_start();


$inc = "sim";
include_once('../../config.inc.php');
//if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	$palavra = $_POST['palavra'];

	$sql = "SELECT posto, nome_guerra, nome, email FROM usuarios, postos WHERE usuarios.id_posto = postos.id_posto and nome LIKE '%$palavra%' ORDER BY usuarios.id_posto, nome_guerra";
	$con = $mysqli->query($sql);
	$qtde = $con->num_rows;

	?>
	<section class="panel col-lg-9">

		<header class="panel-heading">
			Dados da busca:
		</header>
		<?php
		if($qtde > 0){
		?>
		<table class="table table-striped table-advance table-hover">
			<tbody>
				<tr>
					<th><i class="icon_profile"></i> Id</th>
					<th><i class="icon_profile"></i> Nome</th>
					<th><i class="icon_mail_alt"></i> E-mail</th>
				</tr>
				<?php
				while($linha = $con->fetch_assoc()){
				?>
				<tr>
					<td><?=$linha['posto'].' '.$linha['nome_guerra'];?></td>
					<td><?=$linha['nome'];?></td>
					<td><?=$linha['email'];?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<?php }else{?>
		<h4>Nao foram encontrados registros com esta palavra.</h4>
		<?php }?>
	</section>
	<?php
//}
//else {
	//include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
//}
?>