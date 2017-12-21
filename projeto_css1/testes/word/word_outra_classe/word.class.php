<?php

/**
 * Classe para geracao de arquivos em formato word da microsoft
 *
 * @author Tayron Miranda <dev@tayron.com.br>
 */
class Word
{
    /**
     * Método que recebe os parametros necessários para geração do arquivo word
     *
     * @param string $html HTML a ser usado na geração do word
     * @param string $nome Nome do arquivo word + extensão .doc
     * @param string $destino Nome do diretório no servidor onde se deseja que o arquivo seja gravado
     *
     * @return mixed Exibe o arquivo para download ou cria o arquivo em um diretório no servidor
     */
    public function __construct( $html, $nome = 'file.doc', $destino = null )
    {
        if (!$destino){
             header('Content-type: application/vnd.ms-word');
             header('Content-type: application/force-download');
             header('Content-Disposition: attachment; filename="' . $nome . '"');
             header('Pragma: no-cache');
             echo $html;
         }else{
             file_put_contents($destino.'/'.$nome, $html);
         }
    }
}
?>