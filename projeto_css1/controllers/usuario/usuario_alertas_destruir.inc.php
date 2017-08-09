<?php
session_start();
//usuario_cadastrar
unset($_SESSION['duplo_cpf']);
unset($_SESSION['duplo_email']);
unset($_SESSION['sucesso_cadastro']);
unset($_SESSION['erro_cadastro']);
unset($_SESSION['erro_validacao_cadastrar']);
unset($_SESSION['lista_erro_validacao_cadastrar']);

//senha_recuperar
unset($_SESSION['senha_enviada']);
unset($_SESSION['senha_usuario_inexistente']);
unset($_SESSION['senha_nao_enviada']);

//usuario_acessar
unset($_SESSION['acesso_usuario_inexistente']);
unset($_SESSION['senha_errada']);

//usuario_alterar
unset($_SESSION['alterar_rg']);
unset($_SESSION['alterar_posto']);
unset($_SESSION['alterar_nome_guerra']);
unset($_SESSION['alterarnome']);
unset($_SESSION['alterar_email_erro']);
unset($_SESSION['alterar_erro_validacao']);
unset($_SESSION['alterar_lista_erro_validacao']);

unset($_SESSION['botao']);
?>