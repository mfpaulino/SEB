<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><?php echo $row_avisos['titulo'];?></h4>
	<h5><?php echo nl2br($row_avisos['texto']);?></h5>
	<i><small>(Publicado em <?php echo converter_data($row_avisos['dt_aviso'],'BR', true);?>)</small></i>
</div>