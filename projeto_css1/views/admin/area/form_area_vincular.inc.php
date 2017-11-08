<?php
$sql = "SELECT id_subarea, subarea FROM adm_subareas ORDER BY subarea";
$con_lista = $mysqli->query($sql);
?>
<div id="lista_subarea"><!--conteudo vem do script componentes/internos/js/admin/view_area.js--></div>
<div class="modal fade" data-backdrop="static" id="modalVincularArea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Vincular Subárea/Subprocesso</h4>
			</div>
			<div class="modal-body">
				<form name="form_area_vincular" id="form_area_vincular" action="controllers/admin/area/area_vincular.php" method="POST">
					<div class="form-group">
						<label for="area" class="control-label">Área:</label>
						<textarea class="form-control" type="text" name="area"  id="area" disabled placeholder="" ></textarea>
					</div>
					<div class="form-group">
						<label for="subarea" class="control-label">Subáreas:</label><br />
						<select class="form-control" name="subarea[]" id="subarea"  multiple="multiple" data-placeholder = "Selecionar Subáreas/Subprocessos:">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<option value="<?php echo $row['id_subarea'];?>"><?php echo "<b>".$i . "- </b>".$row['subarea'];?></option>
							<?php
							$i++;
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<input type="hidden" name="id_area"      id="id_area" />
						<input type="hidden" name="flag" value="vincular" />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>