<?php
//categoria_cadastrar
unset($_SESSION['categoria_duplicada']);
unset($_SESSION['localidade_duplicada']);
unset($_SESSION['sucesso_cadastro']);
unset($_SESSION['erro_cadastro']);
unset($_SESSION['erro_validacao_cadastrar']);
unset($_SESSION['lista_erro_validacao_cadastrar']);

//categoria_alterar
unset($_SESSION['alterar_erro_validacao']);
unset($_SESSION['alterar_categoria']);
unset($_SESSION['alterar_nada']);
unset($_SESSION['alterar_lista_erro_validacao']);

//categoria excluir
unset($_SESSION['categoria_excluir_sucesso']);
unset($_SESSION['categoria_excluir_erro']);
?>