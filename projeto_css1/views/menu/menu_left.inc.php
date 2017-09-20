<ul class="sidebar-menu" data-widget="tree">
	<li <?php echo $active_home;?>><a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
	<li <?php echo $active_admin;?>><a href="#"><i class="fa fa-gears"></i> <span>Administração</span></a></li>
	<li <?php echo $active_correio;?>>
		<a href="mailbox_input.php">
			<i class="fa fa-envelope"></i> <span>Correio</span>
		</a>
	</li>
	<li class="treeview <?php echo $active_auditoria;?>">
		<a href="#">
			<i class="fa fa-search"></i> <span>Auditoria</span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li <?php echo $active_planejamento;?>><a href="#"><i class="fa fa-map"></i> Planejamento</span></a></li>
			<li <?php echo $active_execucao;?>><a href="#"><i class="fa fa-edit"></i> Execução</a></li>
			<li <?php echo $active_monitoramento;?>><a href="#"><i class="fa fa-tv"></i> Monitoramento</a></li>
			<li <?php echo $active_documentos;?>><a href="#"><i class="fa fa-book"></i> Documentos</a></li>
		</ul>
	</li>
</u>