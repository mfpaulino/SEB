<?php
//categoria_cadastrar
unset($_SESSION['categoria_duplicada']);
unset($_SESSION['localidade_duplicada']);
unset($_SESSION['sucesso_cadastro_categoria']);
unset($_SESSION['erro_cadastro_categoria']);
unset($_SESSION['erro_validacao_cadastrar_categoria']);
unset($_SESSION['lista_erro_validacao_cadastrar_categoria']);

//diaria_cadastrar
unset($_SESSION['diaria_duplicada']);
unset($_SESSION['sucesso_cadastro_diaria']);
unset($_SESSION['erro_cadastro_diaria']);
unset($_SESSION['erro_validacao_cadastrar_diaria']);
unset($_SESSION['lista_erro_validacao_cadastrar_diaria']);

//categoria_alterar
unset($_SESSION['alterar_erro_validacao_categoria']);
unset($_SESSION['alterar_categoria']);
unset($_SESSION['alterar_nada_categoria']);
unset($_SESSION['alterar_lista_erro_validacao_categoria']);

//diaria_alterar
unset($_SESSION['alterar_erro_validacao_diaria']);
unset($_SESSION['alterar_diaria']);
unset($_SESSION['alterar_nada_diaria']);
unset($_SESSION['alterar_lista_erro_validacao_diaria']);

//categoria excluir
unset($_SESSION['categoria_excluir_sucesso']);
unset($_SESSION['categoria_excluir_erro']);

//diaria excluir
unset($_SESSION['diaria_excluir_sucesso']);
unset($_SESSION['diaria_excluir_erro']);
?>