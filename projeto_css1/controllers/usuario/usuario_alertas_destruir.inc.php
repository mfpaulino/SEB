<?php
session_start();

unset($_SESSION['duplo_cpf']);
unset($_SESSION['duplo_email']);
unset($_SESSION['sucesso_cadastro']);
unset($_SESSION['erro_cadastro']);
unset($_SESSION['erro_validacao']);
unset($_SESSION['lista_erro_validacao']);

unset($_SESSION['senha_enviada']);
unset($_SESSION['senha_usuario_inexistente']);
unset($_SESSION['senha_nao_enviada']);

unset($_SESSION['acesso_usuario_inexistente']);
unset($_SESSION['senha_errada']);

unset($_SESSION['botao']);
?>