<?php
include_once 'Sample_Header.php';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/template.docx');

// Variables on different parts of document
$templateProcessor->setValue('data', htmlspecialchars('19 fevereiro de 2014'));
$templateProcessor->setValue('om', htmlspecialchars('Comando da 1� Regi�o Militar'));
$templateProcessor->setValue('num_rel', htmlspecialchars('023176-2014-1'));
$templateProcessor->setValue('num_os', htmlspecialchars('003'));
$templateProcessor->setValue('periodo', htmlspecialchars('JAN/2000 a JAN/2014, referente a pendências constantes nos Relatórios de Auditoria do CCIEx de 2012 e 2013. Os demais procedimentos foram apreciados com base na folha de pagamentos de inativos e pensionistas do mês de maio de 2014'));
$templateProcessor->setValue('plan1', htmlspecialchars('05/05/2014'));
$templateProcessor->setValue('plan2', htmlspecialchars('23/05/2014'));
$templateProcessor->setValue('exec1', htmlspecialchars('26/05/2014'));
$templateProcessor->setValue('exec2', htmlspecialchars('30/05/2014'));
$templateProcessor->setValue('nome1', htmlspecialchars('Ten Cel QCO/Adm Luiz Antônio Izel de Freitas'));
$templateProcessor->setValue('nome2', htmlspecialchars('Cap QCO/Adm Jorge Luiz Gomes Silva'));
$templateProcessor->setValue('nome3', htmlspecialchars('1º Ten OTT/Cont Cleide Martins de Souza'));
$templateProcessor->setValue('citacao1', htmlspecialchars('2- Trata-se de apelação interposta pela Autora, postulando pela reforma, in totum, da r. Sentença. Em suas razões de apelação, sustentou, em síntese, que o óbito de seu pai adotivo ocorreu em 24.06.1990, quando em vigor a Lei nº 3.765/60, a qual admite a possibilidade de acumulação de duas pensões militares, tendo, assim, o direito garantido por lei, em perceber a pensão deixada por seu falecido pai adotivo junto com a pensão que percebe de seu pai biológico.'));

$templateProcessor->saveAs('results/template_ok.docx');

echo getEndingNotes(array('Word2007' => 'docx'));
if (!CLI) {
    include_once 'Sample_Footer.php';
}
