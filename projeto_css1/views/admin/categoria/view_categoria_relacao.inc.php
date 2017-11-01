<?php
$sql = "SELECT * FROM adm_categorias ORDER BY categoria";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_categoria="disabled";
}
?>
<div class="modal fade" id="modalExibirCategoria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Categorias Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printCategoria" class="box-body no-padding ">
						<table class="table table-striped">
							<tr>
								<td class="text-center"><b>Categoria</b></td>
								<td><b>Localidades</b></td>
							</tr>
							<?php
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td class="text-center"><?php echo $row['categoria'];?></td>
									<td><?php echo $row['localidades'];?></td>
								</tr>
								<?php
							} ?>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintCategoria" class="btn btn-default" <?php echo $atributo_categoria;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>