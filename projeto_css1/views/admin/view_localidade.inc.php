<div class="col-md-6">
	<div class="box box-solid bg-blue collapsed-box">
		<div class="box-header">
			<i class="fa fa-globe"></i>
			<h3 class="box-title">grey</h3>
			<div class="pull-right box-tools">
				<div class="btn-group">
					<button type="button" class="btn bg-yellow btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li><a href="#" data-toggle="modal" data-target="#modalAlterarLocalidade">Alterar Localidade</a></li>
						<li><a href="#" data-toggle="modal" data-target="#modalCadastrarLocalidade">Incluir Localidade</a></li>
						<li class="divider"></li>
						<li><a href="#">Imprimir</a></li>
					</ul>
				</div>
				<button type="button" class="btn bg-yellow btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
				<button type="button" class="btn bg-yellow btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body no-padding" style="display:none;">
		</div>
		<div class="box-footer text-black">
			<div class="row">
				<div class="col-sm-12">
					formulário aqui
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once("form_localidade_cadastrar.inc.php");?>
<?php include_once("form_localidade_alterar.inc.php");?>