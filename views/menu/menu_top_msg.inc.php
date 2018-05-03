<?php
include_once(PATH . '/controllers/menu/menu_top_msg.inc.php');
?>
<div class="navbar-custom-menu">
	<ul class="nav navbar-nav">
		<!-- correio-->
		<li class="dropdown messages-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope" title="Correios"></i><span class="label label-default"><?php echo $qtde_msg;?></span></a>
			<?php if($qtde_msg > 0){?>
				<ul class="dropdown-menu">
					<li class="header">
						<span>
							<b>
								Há
								<?php echo $qtde_msg;
								if($qtde_msg == 1){
									echo ' novo correio';
								}
								else{
									echo ' novos correios';
								}
								?>
							</b>
						</span>
					<li>
					<li>
						<ul class="menu">
							<li>
								<a href="mailbox_view.php?flag=<?php echo $row_ultimo_correio['id_correio'];?>&flag0=i&flag1=<?php echo $flag1;?>">
									<div class="pull-left">
										<img src="views/avatar/<?php echo $row_ultimo_correio['avatar'];?>" class="img-circle" alt="User Image">
									</div>
									<h4>
										<?php echo $remetente;?>
										<br />
										<?php echo "(".$row_sigla_ultimo_correio['sigla'].")";?>
									</h4>
									<p><?php echo $assunto;?>
									<br /><small>&nbsp;&nbsp;<?php echo $data;?></small></p>
								</a>
							</li>
						</ul>
					</li>
					<li class="footer"><a href="mailbox_input.php">Ver todos os correios</a></li>
				</ul>
			<?php } ?>
		</li>
		<!-- alertas do sistema -->
		<li class="dropdown notifications-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-warning" title="Alertas"></i><span class="label label-warning"><?php echo $tot_alertas;?></span></a>
			<?php if($tot_alertas > 0){?>
			<ul class="dropdown-menu">
				<li class="header"><b>Alertas do Sistema</b></li>
				<li>
					<ul class="menu">
						<li>
							<a href="#">
							  <i class="fa fa-warning text-yellow"></i> Há <?php echo $tot_alertas;?> alerta(s) de sistema!
							</a>
						</li>
					</ul>
				</li>
				<li class="footer"><a href="user.php">Ver todos os alertas</a></li>
			</ul>
			<?php } ?>
		</li>
		<!-- avisos administrativos -->
		<li class="dropdown notifications-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell" title="Avisos"></i><span class="label label-danger"><?php echo $tot_avisos;?></span></a>
			<?php
			if($tot_avisos > 0){?>
				<ul class="dropdown-menu">
					<li class="header">
						<span>
							<b>
								Há
								<?php echo $tot_avisos;
								if($tot_avisos == 1){
									echo ' Aviso Administrativo.';
								}
								else{
									echo ' Avisos Administrativos.';
								}
								?>
							</b>
						</span>
					</li>
					<li>
						<ul class="menu">
							<li>
								<a href="#">
									<p>Aviso mais recente:</p>
									<b><?php echo $row_avisos['titulo'];?></b>
									<br />
									<?php echo nl2br($row_avisos['texto']);?>
									<br />
									<br />
									<p><small>(Publicado em <?php echo converter_data($row_avisos['dt_aviso'],'BR', true);?>)</small></p>
								</a>
							</li>
						</ul>
					</li>
					<li class="footer"><a href="user.php">Ver todos os avisos</a></li>
				</ul>
			<?php
			} ?>
		</li>
	</ul>
</div>