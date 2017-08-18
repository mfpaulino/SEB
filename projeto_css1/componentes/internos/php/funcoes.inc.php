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
?>