<div class="box box-solid bg-olive collapsed-box">
	<div class="box-header">
		<i class="fa fa-globe"></i>
		<h3 class="box-title">Categorias</h3>
		<div class="pull-right box-tools">
			<div class="btn-group">
				<button type="button" title="Exibir Menu" class="btn bg-olive btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-lg"></i></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#" data-toggle="modal" data-target="#modalCadastrarCategoria">Cadastrar Categoria</a></li>
					<li class="divider"></li>
					<li><a href="#" data-toggle="modal" data-target="#modalExibirCategoria">Exibir Lista</a></li>
				</ul>
			</div>
			<button type="button" title="Expandir/Encolher" class="btn bg-olive btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-olive btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body no-padding" style="display:none;">
	</div>
	<div class="box-footer text-black" style="border:1px solid black;">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-horizontal" method="POST" action="controllers/admin/categoria/categoria_alterar.php">
					<div class="box-body">
						<?php include('listas/admin/select_alterar_categoria.inc.php');?>
						<input type="hidden" name="flag" value="excluir" />
					</div>
					<div class="box-footer pull-right">
						<!--botao Alterar categoria-->
						<button id="btnAlteraCategoria" type="button" class="btn btn-xs btn-warning"
							data-tooltip="tooltip" title=""
							data-toggle="modal"
							data-target="#modalAlterarCategoria"
							data-categoria="">
							<i class="fa fa-pencil"></i> Alterar
						</button>
						<!--botao Excluir categoria-->
						<button id="btnExcluiCategoria" type="submit" class="btn btn-xs btn-danger" data-toggle="confirmation"
							data-placement="left"
							data-btn-ok-label="Continuar"
							data-btn-ok-icon="glyphicon glyphicon-share-alt"
							data-btn-ok-class="btn-success"
							data-btn-cancel-label="Parar"
							data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
							data-btn-cancel-class="btn-danger"
							data-title="Confirma exclusão da Categoria?"
							data-content="">
							<i class="fa fa-trash"></i> Excluir
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>