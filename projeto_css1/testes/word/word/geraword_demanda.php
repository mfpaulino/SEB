<?php
	require_once 'src/PhpWord/Autoloader.php';
	\PhpOffice\PhpWord\Autoloader::register();

	$phpWord = new \PhpOffice\PhpWord\PhpWord();

	// Template processor instance creation
	$templateProcessor =  $phpWord->loadTemplate('samples/resources/modelo_solicitacao_aud.docx');

	//$con_demanda = new Consulta("SELECT origem_doc, situacao, descricao, historico, obs FROM sist15_demanda where cod_demanda = '$cod_demanda'");
	//$con_demanda->desconecta();

	//while($row = mysql_fetch_assoc($con_demanda->recordset)){
		//if ($row['obs'] == ""){
		//	$obs = "Nenhuma.";
	//	}
	//	else {
	//		$obs = $row['obs'];
	//	}
		// Variables on different parts of document
		$templateProcessor->setValue('icfex', '1ª');
		$templateProcessor->setValue('tipo_auditoria', 'historico');
		$templateProcessor->setValue('descricao', 'descricao');
		$templateProcessor->setValue('situacao', 'situacao');
		$templateProcessor->setValue('obs', 'obs');
		$templateProcessor->setValue('data', 'data');
	//}
	$file = "demanda.doc";
	$file1 = "demanda.doc";
	$templateProcessor->saveAs($file);

	if(!$file) {
        // File doesn't exist, output error
        die('file not found');
    }
    else {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file1");
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Transfer-Encoding: binary");
        readfile($file);
    }
    unlink($file);
    exit;
?>
