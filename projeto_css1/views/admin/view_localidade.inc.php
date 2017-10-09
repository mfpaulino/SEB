<div class="col-md-3">
	<div class="box box-solid bg-blue collapsed-box">
		<div class="box-header">
			<i class="fa fa-globe"></i>
			<h3 class="box-title">Localidades</h3>
			<div class="pull-right box-tools">
				<div class="btn-group">
					<button type="button" class="btn bg-yellow btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
					<ul class="dropdown-menu pull-right" role="menu">
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
					<table class="table">
						<tbody>
							<tr>
								<td>
									<?php include_once('listas/admin/select_alterar_localidade.inc.php');?>
								</td>
								<td>
									<!--botao Alterar localidade-->
									<button id="btnAlteraLocalidade" type="button" class="btn btn-xs btn-warning"
										data-tooltip="tooltip" title=""
										data-toggle="modal"
										data-target="#modalAlterarLocalidade"
										data-localidade="">
										<i class="fa fa-pencil"></i> Alterar
									</button>
									<!--botao Excluir localidade-->
									<?php $flag = md5("localidade_excluir");?>
									<a href="controllers/admin/localidade_excluir.php?flag=<?php echo $flag; ?>&flag1=<?php echo str_replace('.php','',$pagina);?>" data-tooltip="tooltip" title="" >
										<button id="btnExcluiLocalidade" type="button" class="btn btn-xs btn-danger" data-toggle="confirmation"
											data-placement="left"
											data-btn-ok-label="Continuar"
											data-btn-ok-icon="glyphicon glyphicon-share-alt"
											data-btn-ok-class="btn-success"
											data-btn-cancel-label="Parar"
											data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
											data-btn-cancel-class="btn-danger"
											data-title="Confirma exclusão da Localidade?"
											data-content="">
											<i class="fa fa-trash"></i> Excluir
										</button>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>