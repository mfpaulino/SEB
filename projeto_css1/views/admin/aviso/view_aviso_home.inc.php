<?php
include_once(PATH.'/controllers/admin/aviso/aviso_home.inc.php');

if($tot_avisos > 0){
	$status_avisos = "(Quantidade: ". $tot_avisos . ")";
}
else {
	$status_avisos = "(Nenhum aviso)";
}
?>
<div class="col-md-6">
	<div class="row">
		<div class="col-md-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-bell"></i></span>
				<div class="info-box-content">
					<span class="info-box-number">Avisos Administrativos</span>
					<span class="info-box-text"><?php echo $status_avisos;?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php
			if($tot_avisos > 0){?>
				<?php
				while($row_avisos = $con_avisos_home->fetch_assoc()){?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><?php echo $row_avisos['titulo'];?></h4>
						<h5><?php echo nl2br($row_avisos['texto']);?></h5>
						<i><small>(Publicado em <?php echo converter_data($row_avisos['dt_aviso'],'BR', true);?>)</small></i>
					</div>
				<?php
				}
			}
			?>
		</div>
	</div>
</div>



