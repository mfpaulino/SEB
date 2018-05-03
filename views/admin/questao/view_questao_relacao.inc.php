<?php
$sql = "SELECT questao FROM adm_questoes ORDER BY questao";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_questao="disabled";
}
?>
<div class="modal fade" id="modalExibirQuestao" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Questões Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printQuestao" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td class="text-justify"><?php echo "<b>".$i . " -</b> " . nl2br($row['questao']);?></td>
								</tr>
								<?php
							$i++;
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintQuestao" class="btn btn-default" <?php echo $atributo_questao;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>