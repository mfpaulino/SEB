<?php
require 'componentes/externos/vendor/autoload.php';

/* =================
   Instanciando o Slim
   Escolha uma das opções abaixo.
   A primeira não exibe os erros, ideal para ambiente de produção
   A segunda exibe erros, ideal para debug em ambiente de desenvolvimento
   ================ */

// Esta linha instancia o Slim, sem habilitar os erros
//$app = new \Slim\App();

// Estas linhas instanciam o Slim, habilitando os erros (útil para debug, em desenvolvimento)
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);


/* ============
   Rotas da aplicação
   ============ */


$app->get('/', function ()
{
    echo "Página inicial";
   // header(sprintf("Location:index_bck.php"));

});

$app->get('/contato', function ()
{
    //echo "Fale conosco";

    header("Location:/index_antigo.php");

});

$app->get('/artigos/{id}', function ( $request )
{
    $id = $request->getAttribute('route')->getArgument('id');
    printf( "Exibindo artigo %d", $id );
});

$app->run();
?>