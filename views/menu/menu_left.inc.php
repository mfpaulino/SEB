<?php
if ($inc == "sim"){?>
<div class="user-panel">
	<div class="pull-left image">
		<img src="views/avatar/<?php echo $avatar_usuario;?>" class="img-circle" alt="User Image">
	</div>
	<div id="status_sessao" class="pull-left info">
		<p><?php echo $usuario;?></p>
		<!-- Status-->
		<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	</div>
</div>
<ul class="sidebar-menu" data-widget="tree">
	<li class="<?php echo $active_home;?>"><a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
	<li class="<?php echo $active_admin;?>"><a href="admin.php"><i class="fa fa-gears"></i> <span>Administração</span></a></li>
	<li class="treeview <?php echo $active_auditoria;?>">
		<a href="#">
			<i class="fa fa-search"></i> <span>Auditoria</span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="treeview <?php echo $active_planejamento;?>">
				<a href="#">
					<i class="fa fa-map"></i> <span>Planejamento</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo $active_plan_piv;?>"><a href="#"><i class="fa fa-caret-right"></i> PAAA</a></li>
					<li class="<?php echo $active_plan_auditoria;?>"><a href="auditoria.php"><i class="fa fa-caret-right"></i> Programa de Trabalho</a></li>
				</ul>
			</li>
			<li class="treeview <?php echo $active_execucao;?>">
				<a href="#">
					<i class="fa fa-edit"></i> <span>Execução</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo $active_exec_mtz_achados;?>"><a href="#"><i class="fa fa-caret-right"></i> Matriz de Achados</a></li>
				</ul>
			</li>
			<li class="<?php echo $active_relatorios;?>"><a href="#"><i class="fa fa-book"></i> Relatórios</a></li>
			<li class="<?php echo $active_monitoramento;?>"><a href="#"><i class="fa fa-tv"></i> Monitoramento</a></li>
			<li class="<?php echo $active_documentos;?>"><a href="#"><i class="fa fa-file-text"></i> Documentos</a></li>
		</ul>
	</li>
	<li <?php echo $active_correio;?>>
		<a href="mailbox_input.php">
			<i class="fa fa-envelope"></i> <span>Correio</span>
		</a>
	</li><!--
	<li <?php echo $active_teste;?>>
		<a href="teste.php">
			<i class="fa fa-file-text"></i> <span>Teste</span>
		</a>
	</li>-->
</u>
<?php
}
else {
	include_once('../../controllers/autenticacao/acesso_negado.php');//exibe msg de ACESSO NEGADO
}
?>