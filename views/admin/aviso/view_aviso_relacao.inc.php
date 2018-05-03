<?php
$sql = "SELECT id_aviso, titulo, texto, autor, dt_aviso, dt_validade, publico, aa.status, p.posto, u.nome_guerra from usuarios u, postos p, adm_avisos aa where u.id_posto = p.id_posto and u.cpf = aa.autor and aa.status = 'Ativo' order by aa.dt_aviso desc";
$con_avisos = $mysqli->query($sql);

$qtde = $con_avisos->num_rows;

if($qtde == 0){
	$atributo_aviso="disabled";
}
?>
<div class="modal fade" id="modalExibirAviso" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Avisos Cadastrados (Ativos)</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printAviso" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_avisos->fetch_assoc()){?>
								<tr>
									<td class="text-justify"><?php echo "<b>".$i . " - " . $row['titulo']. "</b><br />". $row['texto'];?>  </td>
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
				<button id="btnPrintAviso" class="btn btn-default" <?php echo $atributo_aviso;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>