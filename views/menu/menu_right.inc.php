<?php
if ($inc == "sim"){?>
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-user" title="Perfil do Usuário"></i></a></li>
		<!--<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-list-alt"></i></a></li>-->
	</ul>
	<div class="tab-content"><!--
		<div class="tab-pane" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading">Recent Activity</h3>
			<ul class="control-sidebar-menu">
				<li>
					<a href="javascript:;">
						<i class="menu-icon fa fa-birthday-cake bg-red"></i>
						<div class="menu-info">
							<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
							<p>Will be 23 on April 24th</p>
						</div>
					</a>
				</li>
			</ul>
			<h3 class="control-sidebar-heading">Tasks Progress</h3>
			<ul class="control-sidebar-menu">
				<li>
					<a href="javascript:;">
						<h4 class="control-sidebar-subheading">
							Custom Template Design
							<span class="pull-right-container">
								<span class="label label-danger pull-right">70%</span>
							</span>
						</h4>
						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>-->
		<div class="tab-pane active" id="control-sidebar-settings-tab">
			<h3 class="control-sidebar-heading">Perfil do Usuário</h3>
			<div class="form-group">
				<p>O usuário poderá visualizar e/ou alterar as informações do seu perfil clicando nos links abaixo.</p>
				<br />
				<label class="control-sidebar-subheading">
					<a href="#" data-tooltip="tooltip" title="Exibir" data-toggle="modal" data-target="#modalVisualizar<?php echo $cpf; ?>"><i class="fa fa-search"></i> Dados pessoais</a>
				</label>
				<label class="control-sidebar-subheading">
					<a href="#" data-toggle="modal" data-target="#modalEditar"
					data-tooltip="tooltip" title="Editar"
					data-toggle="modal"
					data-target="#modalEditar"
					data-cpf="<?php echo $cpf; ?>"
					data-rg="<?php echo $rg_usuario; ?>"
					data-id_posto="<?php echo $id_posto_usuario; ?>"
					data-posto="<?php echo $posto_usuario; ?>"
					data-nome_guerra="<?php echo $nome_guerra_usuario; ?>"
					data-nome="<?php echo $nome_usuario; ?>"
					data-email="<?php echo $email_usuario; ?>"
					data-ritex="<?php echo $ritex_usuario; ?>"
					data-fixo="<?php echo $fixo_usuario; ?>"
					data-celular="<?php echo $celular_usuario; ?>"
					data-id_perfil="<?php echo $id_perfil_usuario; ?>"
					data-perfil="<?php echo $perfil_usuario; ?>"
					data-unidade="<?php echo $sigla_usuario; ?>">
					<i class="fa fa-pencil-square-o"></i>
					Dados pessoais
					</a>
				</label>
				<label class="control-sidebar-subheading">
					<a href="#" data-tooltip="tooltip" title="Alterar (O usuário deverá realizar novo login após alteração da senha!)" data-toggle="modal" data-target="#modalTrocarSenha"><i class="fa fa-pencil-square-o"></i> Senha</a>
				</label>
				<label class="control-sidebar-subheading">
					<a href="#" data-tooltip="tooltip" title="Alterar (O usuário será desabilitado na Unidade atual e ficará aguardando habilitação na nova Unidade!)" data-toggle="modal" data-target="#modalTrocarUnidade" data-unidade="<?php echo $sigla_usuario; ?>">
					<i class="fa fa-pencil-square-o"></i> Unidade
					</a>
				</label>
				<label class="control-sidebar-subheading">
					<a href="#" data-tooltip="tooltip" title="Cadastrar" data-toggle="modal" data-target="#modalHabilitacao"><i class="fa fa-plus-square"></i> Habilitações</a>
				</label>
				<label class="control-sidebar-subheading">
					<a href="user_habilitacao.php" data-tooltip="tooltip" title="Visualizar" ><i class="fa fa-search"></i> Habilitações</a>
				</label>
					<?php include_once(PATH.'/views/usuario/view_usuario_lista_admin.inc.php');?>
			</div>
		</div>
	</div>
<?php
}
else {
	include_once('../../controllers/autenticacao/acesso_negado.php');//exibe msg de ACESSO NEGADO
}
?>