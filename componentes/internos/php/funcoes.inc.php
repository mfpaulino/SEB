<?php
/*******************************************************************
 Coloca a 1ª letra de cada palavra em caixa alta, com exceção de II, III, IV e VI
 $var = formata_nom($var);
*******************************************************************/
function formata_nome($nome){

	$nome_formatado = mb_strtolower($nome,'UTF-8')." "; //acrescentei um espaço para o caso de os romanos (II,III,IV VI)nao estarem no final do nome.
	$nome_formatado = ucwords($nome_formatado);
	$nome_formatado = str_replace (" De "," de ",$nome_formatado);
	$nome_formatado = str_replace (" Des "," des ",$nome_formatado);
	$nome_formatado = str_replace (" Do "," do ",$nome_formatado);
	$nome_formatado = str_replace (" Dos "," dos ",$nome_formatado);
	$nome_formatado = str_replace (" Da "," da ",$nome_formatado);
	$nome_formatado = str_replace (" Das "," das ",$nome_formatado);
	$nome_formatado = str_replace (" Ii "," II ",$nome_formatado);
	$nome_formatado = str_replace (" Iii "," III ",$nome_formatado);
	$nome_formatado = str_replace (" Iv "," IV ",$nome_formatado);
	$nome_formatado = str_replace (" Vi"," VI ",$nome_formatado);
	$nome_formatado = str_replace ("  "," ",$nome_formatado);//retiro os espaços a mais

	return $nome_formatado;
}
/**************************************************************************************/

/**************************************************************************************
* converte datas do formato americano para o brasileiro e vice-versa
* *************************************************************************************/
function converter_data($data_ori,$tipo='BR',$hora='false')
{
     if ($data_ori <> "")
     {
          $data = explode(' ',$data_ori);

		if ($tipo == 'BR')
          {
			$resul = explode("-",$data[0]);
			$resul = $resul[2].'/'.$resul[1].'/'.$resul[0];
		}

		else if ($tipo == 'EN')
          {
			$resul = explode("/",$data[0]);
			$resul = $resul[2].'-'.$resul[1].'-'.$resul[0];
		}

		if ($hora=="true")
          {
			return $resul.' '.$data[1];
		}
		else
          {
			return $resul;
		}
	}
}
/******************************************************************************************/

/***************** recebe o codigo da unidade de controle interno e retorna a sigla da icfex/cciex */

function exibir_uci($cod_uci){
	switch ($cod_uci) {
		case 0:
			$sigla_uci = 'CCIEx';//sigla unidade de controle interno do usuario atual
			break;
		case 1:
			$sigla_uci = '1ª ICFEx';
			break;
		case 2:
			$sigla_uci = '2ª ICFEx';
			break;
		case 3:
			$sigla_uci = '3ª ICFEx';
			break;
		case 4:
			$sigla_uci = '4ª ICFEx';
			break;
		case 5:
			$sigla_uci = '5ª ICFEx';
			break;
		case 6:
			$sigla_uci = '6ª ICFEx';
			break;
		case 7:
			$sigla_uci = '7ª ICFEx';
			break;
		case 8:
			$sigla_uci = '8ª ICFEx';
			break;
		case 9:
			$sigla_uci = '9ª ICFEx';
			break;
		case 10:
			$sigla_uci = '10ª ICFEx';
			break;
		case 11:
			$sigla_uci = '11ª ICFEx';
			break;
		case 12:
			$sigla_uci = '12ª ICFEx';
			break;
	   default:
			$sigla_uci = '';
			break;
	}
	return $sigla_uci;
}
/*******************************************************************************************/

?>