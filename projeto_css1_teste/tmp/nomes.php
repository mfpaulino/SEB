<?php
function formata_nome($nome){

	$nome_formatado = mb_strtolower($nome,'UTF-8')." ";
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

	return $nome_formatado;
}
echo formata_nome("jfv rig ifj fiv jigij08tu9tu  fivj 0q 09gj ");
?>