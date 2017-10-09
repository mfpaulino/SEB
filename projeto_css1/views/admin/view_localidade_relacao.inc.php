<?php
$sql = "SELECT descricao FROM adm_localidades ORDER BY descricao";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;
?>
<div class="modal fade" id="modalExibirLocalidade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Localidades Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_print" class="box-body no-padding ">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td><?php echo $i.".";?></td>
									<td><?php echo $row['descricao'];?></td>
								</tr>
								<?php
								$i++;
							} ?>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrint" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>