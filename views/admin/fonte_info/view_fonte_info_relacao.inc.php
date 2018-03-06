<?php
$sql = "SELECT fonte_info FROM adm_fontes_informacao ORDER BY fonte_info";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_fonte_info="disabled";
}
?>
<div class="modal fade" id="modalExibirFonteInfo" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Fontes de Informação Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printFonteInfo" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td class="text-justify"><?php echo "<b>".$i . " -</b> " . $row['fonte_info'];?></td>
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
				<button id="btnPrintFonteInfo" class="btn btn-default" <?php echo $atributo_fonte_info;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>