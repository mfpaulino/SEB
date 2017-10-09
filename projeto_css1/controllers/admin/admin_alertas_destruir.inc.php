<?php
//localidade_cadastrar
unset($_SESSION['localidade_duplicada']);
unset($_SESSION['sucesso_cadastro']);
unset($_SESSION['erro_cadastro']);
unset($_SESSION['erro_validacao_cadastrar']);
unset($_SESSION['lista_erro_validacao_cadastrar']);

//localidade_alterar
unset($_SESSION['alterar_erro_validacao']);
unset($_SESSION['alterar_localidade']);
unset($_SESSION['alterar_nada']);
unset($_SESSION['alterar_lista_erro_validacao']);

//localidade excluir
unset($_SESSION['localidade_excluir_sucesso']);
unset($_SESSION['localidade_excluir_erro']);
?>