			<!-- Messages: style can be found in dropdown.less-->
			<li class="dropdown messages-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-default"><?php echo $row_qtde_correio['qtde_msg'];?></span></a>
				<?php if($row_qtde_correio['qtde_msg'] > 0){?>
					<ul class="dropdown-menu">
						<li class="header">
							<span><b>Você tem <?php echo $row_qtde_correio['qtde_msg'];?> novas mensagens de correio</b></span>
						<li>
						<li>
							<!-- inner menu: contains the messages -->
							<ul class="menu">
								<!-- start message -->
								<li>
									<a href="#">
										<div class="pull-left">
											<!-- User Image -->
											<img src="views/avatar/<?php echo $row_ultimo_correio['avatar'];?>" class="img-circle" alt="User Image">
										</div>
										<!-- Message title and timestamp -->
										<h4>
											<?php echo $remetente;?>
											<br />
											<?php echo "(".$row_sigla_ultimo_correio['sigla'].")";?>
										</h4>
										<!-- The message -->
										<p><?php echo $assunto;?>
										<br /><small><i class="fa fa-clock"></i>&nbsp;&nbsp;<?php echo $data;?></small></p>
									</a>
								</li>
								<!-- end message -->
							</ul>
							<!-- /.menu -->
						</li>
						<li class="footer"><a href="mailbox_input.php">Ver Todas as Mensagens</a></li>
					</ul>
				<?php } ?>
			</li>
			<!-- /.messages-menu -->
			<!-- Notifications Menu -->
			<li class="dropdown notifications-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-warning"></i><span class="label label-warning">10</span></a>
				<ul class="dropdown-menu">
					<li class="header">You have 10 notifications</li>
					<li>
						<!-- Inner Menu: contains the notifications -->
						<ul class="menu">
							<li>
								<!-- start notification -->
								<a href="#">
								  <i class="fa fa-users text-aqua"></i> 5 new members joined today
								</a>
								<!-- end notification -->
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">View all</a></li>
				</ul>
			</li>
			<!-- Tasks Menu -->
			<li class="dropdown tasks-menu">
				<!-- Menu Toggle Button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="label label-danger">9</span></a>
				<ul class="dropdown-menu">
					<li class="header">You have 9 tasks</li>
					<li>
						<!-- Inner menu: contains the tasks -->
						<ul class="menu">
							<li>
								<!-- Task item -->
								<a href="#">
									<!-- Task title and progress text -->
									<h3>Design some buttons<small class="pull-right">20%</small></h3>
									<!-- The progress bar -->
									<div class="progress xs">
										<!-- Change the css width attribute to simulate progress -->
										<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">20% Complete</span>
										</div>
									</div>
								</a>
								<!-- end task item -->
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">View all tasks</a></li>
				</ul>
			</li>