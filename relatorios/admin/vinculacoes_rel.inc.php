<!-- ./relatorios/admin/vinculacoes_rel.inc.php-->
<?php
if($inc == "sim"){
?>
<div class="box box-solid bg-aqua collapsed-box">
	<div class="box-header">
		<i class="fa fa-share-alt"></i>
		<h3 class="box-title">Visualizar Vinculações</h3>
		<div class="pull-right box-tools">
			<button type="button" title="Expandir/Encolher" class="btn bg-aqua-gradient btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-aqua-gradient btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-footer text-black" style="border:1px solid black;background-color:#eeeeee;"><?php
		/********************************** lista as areas ***********************************************/
		$con_area = $mysqli->query("SELECT * FROM adm_areas ORDER BY area");

		for($h = 0; $h < $con_area->num_rows; $h++){
			$row_area = $con_area->fetch_array();
			echo '
			<div class="box box-solid bg-default collapsed-box col-sm-12">';
				if($row_area[2] <> ""){//possui subareas vinculadas?
					echo '<br /><button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_areas'.$row_area[0].'"></button>'."&nbsp;<b>Área:</b>  ".$row_area[1]. "<br />";
				}
				else{
					echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Área:</b> $row_area[1]<br />";
				}

				/*************************** lista as subareas vinculadas a cada area  ************************************************/
				if($row_area[2] <> ""){
					$lista_subarea = unserialize($row_area[2]);
					$qtde_subarea = count($lista_subarea);
				}
				else{
					$qtde_subarea = 0;
				}

				echo '
				<div class="col-sm-1"></div>
				<div id="div_areas'.$row_area[0].'" class="collapse col-sm-11">';

					for($i = 0; $i < $qtde_subarea; $i++){
						$con_subarea = $mysqli->query("SELECT * FROM adm_subareas WHERE id_subarea = '$lista_subarea[$i]' ORDER BY subarea");
						$row_subarea = $con_subarea->fetch_array();

						if($row_subarea[2] <> ""){
							echo "<br />".'<button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_subareas'.$row_area[0].$row_subarea[0].'"></button>'."&nbsp;<b>Subárea:</b> ".$row_subarea[1]. "<br />";
						}
						else {
							echo "<br /><b>Subárea:</b> ".$row_subarea[1]. "<br />";
						}

						/************************** lista as questoes vinculadas a cada subarea ****************************************************/
						if($row_subarea[2] <> ""){
							$lista_questao = unserialize($row_subarea[2]);
							$qtde_questao = count($lista_questao);
						}
						else{
							$qtde_questao = 0;
						}

						echo '
						<div class="col-sm-1"></div>
						<div id="div_subareas'.$row_area[0].$row_subarea[0].'" class="collapse text-justify col-sm-11">';

							for($j = 0; $j < $qtde_questao; $j++){
								$con_questao = $mysqli->query("SELECT * FROM adm_questoes WHERE id_questao = '$lista_questao[$j]'");
								$row_questao = $con_questao->fetch_array();

								if($row_questao[2] <> ""){
									echo "<br />".'<button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_questoes'.$row_area[0].$row_subarea[0].$row_questao[0].'"></button>'."&nbsp;<b>Questão:</b> ".$row_questao[1]. "<br />";
								}
								else{
									echo "<br /><b>Questão:</b> ".$row_questao[1]. "<br />";
								}

								/*************************************************** lista as informações requeridas de cada questao ***********************************/
								if($row_questao[2] <> ""){
									$lista_info_req = unserialize($row_questao[2]);
									$qtde_info_req = count($lista_info_req);
								}
								else{
									$qtde_info_req = 0;
								}

								echo '
								<div class="col-sm-1"></div>
								<div id="div_questoes'.$row_area[0].$row_subarea[0].$row_questao[0].'" class="collapse col-sm-11">';

									for($k = 0; $k < $qtde_info_req; $k++){
										$con_info_req = $mysqli->query("SELECT * FROM adm_info_requeridas WHERE id_info_req = '$lista_info_req[$k]'");
										$row_info_req = $con_info_req->fetch_array();

										if($row_info_req[2] <> ""){
											echo "<br />".'<button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_info_req'.$row_area[0].$row_subarea[0].$row_questao[0].$row_info_req[0].'"></button>'."&nbsp;<b>Informação Requerida:</b> ".$row_info_req[1]. "<br />";
										}
										else{
											echo "<br /><b>Info Requerida:</b> ".$row_info_req[1]. "<br />";
										}

										/************************************* lista as fontes de informações de cada informação requerida *****************************************/
										if($row_info_req[2] <> ""){
											$lista_fonte_info = unserialize($row_info_req[2]);
											$qtde_fonte_info= count($lista_fonte_info);
										}
										else{
											$qtde_fonte_info = 0;
										}

										echo '
										<div class="col-sm-1"></div>
										<div id="div_info_req'.$row_area[0].$row_subarea[0].$row_questao[0].$row_info_req[0].'" class="collapse col-sm-11">';

											echo "<br />".'<button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_fonte_info'.$row_area[0].$row_subarea[0].$row_questao[0].$row_info_req[0].'"></button>'."&nbsp;<b>Fontes de Informação</b> <br />";

											echo '
											<div class="col-sm-1"></div>
											<div id="div_fonte_info'.$row_area[0].$row_subarea[0].$row_questao[0].$row_info_req[0].'" class="collapse col-sm-11">';

												for($l = 0; $l < $qtde_fonte_info; $l++){
													$con_fonte_info = $mysqli->query("SELECT * FROM adm_fontes_informacao WHERE id_fonte_info = '$lista_fonte_info[$l]'");
													$row_fonte_info = $con_fonte_info->fetch_array();

													echo "- ".$row_fonte_info[1]. "<br />";
												}
												echo '
												<br />
											</div>
											<br />
										</div>';
									}

									/************************************ lista os procedimentos de coleta de dados de cada questão ******************************************/
									if($row_questao[5] <> ""){
										$lista_proc_coleta = unserialize($row_questao[5]);
										$qtde_proc_coleta = count($lista_proc_coleta);
									}
									else{
										$qtde_proc_coleta = 0;
									}

									if($qtde_proc_coleta > 0){
											echo "<br />".'<button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_proc_coleta'.$row_area[0].$row_subarea[0].$row_questao[0].'"></button>'."&nbsp;<b>Procedimentos de Coleta de Dados</b> <br />";
									}

									echo '
									<div class="col-sm-1"></div>
									<div id="div_proc_coleta'.$row_area[0].$row_subarea[0].$row_questao[0].'" class="collapse col-sm-11">';

									for($m = 0; $m < $qtde_proc_coleta; $m++){
										$con_proc_coleta = $mysqli->query("SELECT * FROM adm_proc_coleta WHERE id_proc_coleta = '$lista_proc_coleta[$m]'");
										$row_proc_coleta = $con_proc_coleta->fetch_array();

										echo "- ".$row_proc_coleta[1]. "<br />";
									}
									echo '<br />
									</div>';

									/************************************ lista os procedimentos de analise de cada questao *******************************************/
									if($row_questao[4] <> ""){
										$lista_proc_ana = unserialize($row_questao[4]);
										$qtde_proc_ana = count($lista_proc_ana);
									}
									else{
										$qtde_proc_ana = 0;
									}

									if($qtde_proc_ana > 0){
											echo "<br />".'<button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_proc_ana'.$row_area[0].$row_subarea[0].$row_questao[0].'"></button>'."&nbsp;<b>Procedimentos de Análise de Dados</b> <br />";
									}

									echo '
									<div class="col-sm-1"></div>
									<div id="div_proc_ana'.$row_area[0].$row_subarea[0].$row_questao[0].'" class="collapse col-sm-11">';

									for($n = 0; $n < $qtde_proc_ana; $n++){
										$con_proc_ana = $mysqli->query("SELECT * FROM adm_proc_analise WHERE id_proc_ana = '$lista_proc_ana[$n]'");
										$row_proc_ana = $con_proc_ana->fetch_array();

										echo "- ".$row_proc_ana[1]. "<br />";
									}
									echo '<br />
									</div>';

									/***************************** lista os possíveis achados de cada questao **********************************************/
									if($row_questao[3] <> ""){
										$lista_poss_achado = unserialize($row_questao[3]);
										$qtde_poss_achado = count($lista_poss_achado);
									}
									else{
										$qtde_poss_achado = 0;
									}

									if($qtde_poss_achado > 0){
											echo "<br />".'<button type="button" class="btn btn-xs btn-default tree collapsed" data-toggle="collapse" data-target="#div_poss_achado'.$row_area[0].$row_subarea[0].$row_questao[0].'"></button>'."&nbsp;<b>Possíveis Achados</b> <br />";
									}

									echo '
									<div class="col-sm-1"></div>
									<div id="div_poss_achado'.$row_area[0].$row_subarea[0].$row_questao[0].'" class="collapse col-sm-11">';

									for($o = 0; $o < $qtde_poss_achado; $o++){
										$con_poss_achado = $mysqli->query("SELECT * FROM adm_poss_achados WHERE id_poss_achado = '$lista_poss_achado[$o]'");
										$row_poss_achado = $con_poss_achado->fetch_array();

										echo "- ".$row_poss_achado[1]. "<br />";
									}
									echo '<br />
									</div>';
									echo '<br />
								</div>';
							}
							echo '<br />
						</div>';
					}
					echo '<br />
				</div>
				<br />
			</div>';
		}
		?>
	</div>
</div>
<?php }
else {
	$inc = "sim";
	include_once('../../config.inc.php');
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>