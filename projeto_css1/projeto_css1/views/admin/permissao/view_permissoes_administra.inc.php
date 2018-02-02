<div class="box box-solid bg-red collapsed-box">
	<div class="box-header">
		<i class="fa fa-user"></i>
		<h3 class="box-title">Permissões (Administração)</h3>
		<div class="pull-right box-tools">
			<div class="btn-group">
				<button disabled type="button" title="Exibir Menu" class="btn bg-red-gradient btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-lg"></i></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#" data-toggle="modal" data-target="#modalExibirTipoEvento">Impressão</a></li>
				</ul>
			</div>
			<button type="button" title="Expandir/Encolher" class="btn bg-red-gradient btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-red-gradient btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body no-padding" style="display:none;">
	</div>
	<div class="box-footer text-black" style="border:1px solid black;">
		<div class="row">
			<div class="col-sm-12">
				<form name="form_admin_permissao" id="form_admin_permissao" class="form-horizontal" method="POST" action="controllers/admin/permissao/permissao_administra.php">
					<div class="box-body">
						<?php $selectpicker="selectpicker"; include('listas/admin/select_permissoes_administra.inc.php');?>
					</div>
					<div class="box-footer pull-right">
						<!--botao Administrar permissao-->
						<button id="btnAdminPermissao0" type="button" class="btn btn-xs btn-warning"
							data-tooltip="tooltip"
							data-toggle="modal"
							data-target="#modalAdminPermissao0">
							<i class="fa fa-pencil"></i> Administrar
						</button>
					</div>
					<div class="box-body">
						<?php $selectpicker="selectpicker"; include('listas/admin/select_perfis_administra.inc.php');?>
					</div>
					<div class="box-footer pull-right">
						<!--botao Administrar permissao-->
						<button id="btnAdminPermissao1" type="button" class="btn btn-xs btn-primary"
							data-tooltip="tooltip"
							data-toggle="modal"
							data-target="#modalAdminPermissao1">
							<i class="fa fa-pencil"></i> Administrar
						</button>
					</div>
					<input type="hidden" name="flag" value="excluir" />
				</form>
			</div>
		</div>
	</div>
</div>