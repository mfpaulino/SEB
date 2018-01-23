<?php
$sql = "SELECT id_aviso, titulo, texto, autor, dt_aviso, dt_validade, publico, aa.status, p.posto, u.nome_guerra from usuarios u, postos p, adm_avisos aa where u.id_posto = p.id_posto and u.cpf = aa.autor order by aa.dt_aviso desc";
$con_avisos = $mysqli->query($sql);

?>
<div class="box box-solid bg-blue collapsed-box">
	<div class="box-header">
		<i class="fa fa-bell"></i>
		<h3 class="box-title">Avisos Administrativos</h3>
		<div class="pull-right box-tools">
			<div class="btn-group">
				<button type="button" title="Exibir Menu" class="btn bg-blue-gradient btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-lg"></i></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#" data-toggle="modal" data-target="#modalCadastrarAviso">Cadastrar Aviso</a></li>
					<li><a href="#" data-toggle="modal" data-target="#modalExibirAviso">Listar/Imprimir</a></li>
				</ul>
			</div>
			<button type="button" title="Expandir/Encolher" class="btn bg-blue-gradient btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-blue-gradient btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-footer text-black" style="border:1px solid black;">
		<div class="col-sm-12">
			<table class="table table-striped">
				<tr class="text-bold">
					<td>Título</td>
					<td>Validade</td>
					<td>Status</td>
					<td class="text-center">Ação</td>
				</tr>
			<?php
			while ($rows =  $con_avisos->fetch_assoc()){

				if ($rows['status'] == 'Ativo'){
					$icone = "fa fa-window-close";
					$tooltip = "Desabilitar";
				}
				else {
					$icone = "fa fa-check";
					$tooltip = "Habilitar";
				}
				?>
				<tr>
					<td><?php echo $rows['titulo']; ?></td>
					<td><?php echo converter_data($rows['dt_validade'], 'BR');?></td>
					<td><?php echo $rows['status'];?></td>
					<td width="16%" class="text-center">
						<!--botao Aviso-->
						<button type="button" class="btn btn-xs btn-primary"
							data-tooltip="tooltip"
							data-title="Exibir"
							data-placement="left"
							data-toggle="modal"
							data-target="#modalAlterarAviso"
							data-id_aviso="<?php echo $rows['id_aviso'];?>"
							data-titulo="<?php echo $rows['titulo'];?>"
							data-texto="<?php echo $rows['texto'];?>"
							data-validade="<?php echo converter_data($rows['dt_validade'], 'BR');?>"
							data-atualizacao="<?php echo $rows['posto'].' '.$rows['nome_guerra']. ", em ".converter_data($rows['dt_aviso'], 'BR');?>"
							>
							<i class="fa fa-search"></i>
						</button>
						<!--botao Habilitar-->
						<button form="formHabilitar<?php echo $rows['id_aviso'];?>" type="submit" <?php echo $btn_status;?> class="btn btn-xs btn-primary"
							data-tooltip="tooltip"
							data-title="<?php echo $tooltip;?>"
							data-placement="left"
							>
							<i class="<?php echo $icone;?>"></i>
						</button>
						<!--botao Excluir-->
						<button form="formExcluir<?php echo $rows['id_aviso'];?>" type="submit" class="btn btn-xs btn-primary"
							data-tooltip="tooltip"
							data-toggle="confirmation"
							data-placement="left"
							data-btn-ok-label="Continuar"
							data-btn-ok-icon="glyphicon glyphicon-share-alt"
							data-btn-ok-class="btn-success"
							data-btn-cancel-label="Parar"
							data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
							data-btn-cancel-class="btn-danger"
							data-title="Excluir"
							data-content="Confirma?">
							<i class="fa fa-trash"></i>
						</button>
						<form id="formHabilitar<?php echo $rows['id_aviso'];?>" action="controllers/admin/aviso/aviso_alterar.php" method = "POST">
							<input type="hidden" name="flag" value="<?php echo $tooltip;?>" />
							<input type="hidden" name="id_aviso" value="<?php echo $rows['id_aviso'];?>" />
						</form>
						<form id="formExcluir<?php echo $rows['id_aviso'];?>" action="controllers/admin/aviso/aviso_alterar.php" method = "POST">
							<input type="hidden" name="flag" value="excluir" />
							<input type="hidden" name="id_aviso" value="<?php echo $rows['id_aviso'];?>" />
						</form>
					</td>
				</tr>
			<?php } ?>
			</table>
		</div>
	</div>
</div>