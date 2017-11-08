<?php
$inc = "sim";
include_once ('../../../config.inc.php');

$id_area = $_POST['id_area'];

$sql = "SELECT subarea FROM adm_subareas ORDER BY subarea";
$con_lista = $mysqli->query($sql);
$linhas = $con_lista->num_rows;

$qtde_por_coluna = ($linhas / 3) - ($linhas % 3/3);

if ($linhas % 3 <> 0){
	$colspan = "4";
}
else {
	$colspan="3";
}
$linha=1;
?>
<!-- checkbox -->
<div class="form-group">
	<table>
	<?php
	$i = 1;
	while($row = $con_lista->fetch_assoc()){?>
		<!--
		<tr>
			<td>
				<div class="checkbox">
					<label>
						<input type="checkbox">
						<?php echo "<b>".$i . ".</b> " .$row['subarea'];?>
					</label>
				</div>
			</td>
			<td>&nbsp;&nbsp;</td>
			<td>
				<div class="checkbox">
					<label>
						<input type="checkbox">
						<?php echo "<b>".($i + 1) . ".</b> " .$row['subarea'];?>
					</label>
				</div>
			</td>
		</tr>
		-->
		<?php
		if($linha<=$qtde_por_coluna){
			$menu_correio_om=$menu_correio_om.'<input name="destinatarios[]" type="checkbox" value="'.$abreviatura.'-'.$codom.'">&nbsp;&nbsp;'.$row['subarea'].'&nbsp;&nbsp;&nbsp;&nbsp;<br>';
		}
		elseif($linha>$qtde_por_coluna and $linha<=($qtde_por_coluna * 2)){
			$menu_correio_om2=$menu_correio_om2.'<input name="destinatarios[]" type="checkbox" value="'.$abreviatura.'-'.$codom.'">&nbsp;&nbsp;'.$row['subarea'].'&nbsp;&nbsp;&nbsp;&nbsp;<br>';
		}
		elseif($linha>($qtde_por_coluna * 2) and $linha<=($qtde_por_coluna * 3)){
			$menu_correio_om3=$menu_correio_om3.'<input name="destinatarios[]" type="checkbox" value="'.$abreviatura.'-'.$codom.'">'.$row['subarea'].'<br>';
		}
				elseif($linha>($qtde_por_coluna * 3) and $linha<=($qtde_por_coluna * 4)){
					$menu_correio_om4=$menu_correio_om4.'<input name="destinatarios[]" type="checkbox" value="'.$abreviatura.'-'.$codom.'">'.$abreviatura.'<br>';
				}
				elseif($linha>($qtde_por_coluna * 4) and $linha<=($qtde_por_coluna * 5)){
					$menu_correio_om5=$menu_correio_om5.'<input name="destinatarios[]" type="checkbox" value="'.$abreviatura.'-'.$codom.'">'.$abreviatura.'<br>';
				}
				elseif($linha>($qtde_por_coluna * 5) and $linha<=($qtde_por_coluna * 6)){
					$menu_correio_om6=$menu_correio_om6.'<input name="destinatarios[]" type="checkbox" value="'.$abreviatura.'-'.$codom.'">'.$abreviatura.'<br>';
				}
				if($linha>($qtde_por_coluna * 6)){
					$menu_correio_om7=$menu_correio_om7.'<input name="destinatarios[]" type="checkbox" value="'.$abreviatura.'-'.$codom.'">'.$abreviatura.'<br>';
				}
		$linha=$linha+1;
		//$i = $i + 2;
	}

			echo'
			<tr>
				<td style="vertical-align: top;">'.$menu_correio_om.'</td>
				<td style="vertical-align: top;">'.$menu_correio_om2.'</td>
				<td style="vertical-align: top;">'.$menu_correio_om3.'</td>
				<td style="vertical-align: top;">'.$menu_correio_om4.'</td>
				<td style="vertical-align: top;">'.$menu_correio_om5.'</td>
				<td style="vertical-align: top;">'.$menu_correio_om6.'</td>';
			if ($colspan == "4"){
				echo '
				<td style="vertical-align: top;">'.$menu_correio_om7.'</td>';
			}
			echo '
			</tr>';
		?>
	</table>
</div>