<div class="box box-solid bg-yellow collapsed-box">
	<div class="box-header">
		<i class="fa fa-bars"></i>
		<h3 class="box-title">Questões de Auditoria</h3>
		<div class="pull-right box-tools">
			<div class="btn-group">
				<button type="button" title="Exibir Menu" class="btn bg-yellow-gradient btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-lg"></i></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#" data-toggle="modal" data-target="#modalCadastrarQuestao">Cadastrar Questão</a></li>
					<li class="divider"></li>
					<li><a href="#" data-toggle="modal" data-target="#modalExibirQuestao">Exibir Lista</a></li>
				</ul>
			</div>
			<button type="button" title="Expandir/Encolher" class="btn bg-yellow-gradient btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-yellow-gradient btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body no-padding" style="display:none;">
	</div>
	<div class="box-footer text-black" style="border:1px solid black;">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-horizontal" method="POST" action="controllers/admin/questao/questao_alterar.php">
					<div class="box-body">
						<?php include('listas/admin/select_questao.inc.php');?>
					</div>
					<div class="box-footer pull-right">
						<dl class="text-right">
							<dd>
								<!--botao Alterar questao-->
								<button id="btnAlteraQuestao" type="button" class="btn btn-xs btn-warning"
									data-tooltip="tooltip" title=""
									data-toggle="modal"
									data-target="#modalAlterarQuestao">
									<i class="fa fa-pencil"></i> Alterar
								</button>
								<!--botao Excluir questao-->
								<button id="btnExcluiQuestao" type="submit" class="btn btn-xs btn-danger" data-toggle="confirmation"
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
							</dd>
						</dl>
						<dl>
							<dt class="text-center"><u>Vinculação</u></dt>
						</dl>
						<dl>
							<dd class="text-center">
								<!--botao Vincular Subarea-->
								<button id="btnQuestaoVinculaSubarea" type="button" class="btn btn-xs btn-primary"
									data-tooltip="tooltip" title="Vincular Subárea/Subprocesso"
									data-toggle="modal"
									data-target="#modalQuestaoVincularSubarea">
									<i class="fa fa-share-alt"></i> Subárea
								</button>
								<!--botao Vincular Info Requerida-->
								<button id="btnQuestaoVinculaInfoReq" type="button" class="btn btn-xs btn-primary"
									data-tooltip="tooltip" title="Vincular Informação Requerida"
									data-toggle="modal"
									data-target="#modalQuestaoVincularInfoReq">
									<i class="fa fa-share-alt"></i> Info Requeridas
								</button>
								<!--botao Vincular Possiveis Achados-->
								<button id="btnQuestaoVinculaPossAchado" type="button" class="btn btn-xs btn-primary"
									data-tooltip="tooltip" title="Vincular Possíveis Achados"
									data-toggle="modal"
									data-target="#modalQuestaoVincularPossAchado">
									<i class="fa fa-share-alt"></i> Poss Achados
								</button>
								<!--botao Vincular Proc Análise Dados-->
								<button id="btnQuestaoVinculaProcAna" type="button" class="btn btn-xs btn-primary"
									data-tooltip="tooltip" title="Vincular Procedimento Análise Dados"
									data-toggle="modal"
									data-target="#modalQuestaoVincularProcAna">
									<i class="fa fa-share-alt"></i> Proced Análise Dados
								</button>
								<!--botao Vincular Proc Coleta Dados-->
								<button id="btnQuestaoVinculaProcColeta" type="button" class="btn btn-xs btn-primary"
									data-tooltip="tooltip" title="Vincular Proc Coleta Dados"
									data-toggle="modal"
									data-target="#modalQuestaoVincularProcColeta">
									<i class="fa fa-share-alt"></i> Proced Coleta Dados
								</button>
							</dd>
						</dl>
					</div>
					<input type="hidden" name="flag" value="excluir" />
				</form>
			</div>
		</div>
	</div>
</div>