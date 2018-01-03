<div class="box box-solid bg-teal collapsed-box">
	<div class="box-header">
		<i class="fa fa-bars"></i>
		<h3 class="box-title">Informações Requeridas</h3>
		<div class="pull-right box-tools">
			<div class="btn-group">
				<button type="button" title="Exibir Menu" class="btn bg-teal-gradient btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-lg"></i></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#" data-toggle="modal" data-target="#modalCadastrarInfoReq">Cadastrar Informação Requerida</a></li>
					<li class="divider"></li>
					<li><a href="#" data-toggle="modal" data-target="#modalExibirInfoReq">Listar/Imprimir</a></li>
				</ul>
			</div>
			<button type="button" title="Expandir/Encolher" class="btn bg-teal-gradient btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-teal-gradient btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body no-padding" style="display:none;">
	</div>
	<div class="box-footer text-black" style="border:1px solid black;">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-horizontal" method="POST" action="controllers/admin/info_req/info_req_alterar.php">
					<div class="box-body">
						<?php include('listas/admin/select_info_req.inc.php');?>
					</div>
					<div class="box-footer pull-right">
						<!--botao Alterar info req-->
						<button id="btnAlteraInfoReq" type="button" class="btn btn-xs btn-warning"
							data-tooltip="tooltip" title=""
							data-toggle="modal"
							data-target="#modalAlterarInfoReq">
							<i class="fa fa-pencil"></i> Alterar
						</button>
						<!--botao Excluir info req-->
						<button id="btnExcluiInfoReq" type="submit" class="btn btn-xs btn-danger" data-toggle="confirmation"
							data-placement="left"
							data-btn-ok-label="Continuar"
							data-btn-ok-icon="glyphicon glyphicon-share-alt"
							data-btn-ok-class="btn-success"
							data-btn-cancel-label="Parar"
							data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
							data-btn-cancel-class="btn-danger"
							data-title="Confirma a exclusão?"
							data-content="">
							<i class="fa fa-trash"></i> Excluir
						</button>
						<!--botao Vincular Questao-->
						<button id="btnInfoReqVinculaQuestao" type="button" class="btn btn-xs btn-primary"
							data-tooltip="tooltip" title="Vincular Questão"
							data-toggle="modal"
							data-target="#modalInfoReqVincularQuestao">
							<i class="fa fa-share-alt"></i> Vincular Questão
						</button>
					</div>
					<input type="hidden" name="flag" value="excluir" />
				</form>
			</div>
		</div>
	</div>
</div>