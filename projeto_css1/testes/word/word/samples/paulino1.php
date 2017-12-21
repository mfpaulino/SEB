<?php
require_once __DIR__ . '/../src/PhpWord/Autoloader.php';

date_default_timezone_set('UTC');

/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

Autoloader::register();
Settings::loadConfig();

// Set writers
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

// Set PDF renderer
if (null === Settings::getPdfRendererPath()) {
    $writers['PDF'] = null;
}

// Return to the caller script when runs by CLI
if (CLI) {
    return;
}

// Set titles and names
$pageHeading = str_replace('_', ' ', SCRIPT_FILENAME);
$pageTitle = IS_INDEX ? 'Welcome to ' : "{$pageHeading} - ";
$pageTitle .= 'PHPWord';
$pageHeading = IS_INDEX ? '' : "<h1>{$pageHeading}</h1>";

// Populate samples
$files = '';
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle))) {
        if (preg_match('/^Sample_\d+_/', $file)) {
            $name = str_replace('_', ' ', preg_replace('/(Sample_|\.php)/', '', $file));
            $files .= "<li><a href='{$file}'>{$name}</a></li>";
        }
    }
    closedir($handle);
}

/**
 * Write documents
 *
 * @param \PhpOffice\PhpWord\PhpWord $phpWord
 * @param string $filename
 * @param array $writers
 *
 * @return string
 */
function write($phpWord, $filename, $writers)
{
    $result = '';

    // Write documents
    foreach ($writers as $format => $extension) {
        $result .= date('H:i:s') . " Write to {$format} format";
        if (null !== $extension) {
            $targetFile = __DIR__ . "/results/{$filename}.{$extension}";
            $phpWord->save($targetFile, $format);
        } else {
            $result .= ' ... NOT DONE!';
        }
        $result .= EOL;
    }

    $result .= getEndingNotes($writers);

    return $result;
}

/**
 * Get ending notes
 *
 * @param array $writers
 *
 * @return string
 */
function getEndingNotes($writers)
{
    $result = '';

    // Do not show execution time for index
    if (!IS_INDEX) {
        $result .= date('H:i:s') . " Done writing file(s)" . EOL;
        $result .= date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" . EOL;
    }

    // Return
    if (CLI) {
        $result .= 'The results are stored in the "results" subdirectory.' . EOL;
    } else {
        if (!IS_INDEX) {
            $types = array_values($writers);
            $result .= '<p>&nbsp;</p>';
            $result .= '<p>Results: ';
            foreach ($types as $type) {
                if (!is_null($type)) {
                    $resultFile = 'results/' . SCRIPT_FILENAME . '.' . $type;
                    if (file_exists($resultFile)) {
                        $result .= "<a href='{$resultFile}' class='btn btn-primary'>{$type}</a> ";
                    }
                }
            }
            $result .= '</p>';
        }
    }

    return $result;
}
?>
<title><?php echo $pageTitle; ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="bootstrap/css/font-awesome.min.css" />
<link rel="stylesheet" href="bootstrap/css/phpword.css" />
</head>
<body>
<div class="container">
<div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">PHPWord</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-code fa-lg"></i>&nbsp;Samples<strong class="caret"></strong></a>
                    <ul class="dropdown-menu"><?php echo $files; ?></ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://github.com/PHPOffice/PHPWord"><i class="fa fa-github fa-lg" title="GitHub"></i>&nbsp;</a></li>
                <li><a href="http://phpword.readthedocs.org/"><i class="fa fa-book fa-lg" title="Docs"></i>&nbsp;</a></li>
                <li><a href="http://twitter.com/PHPWord"><i class="fa fa-twitter fa-lg" title="Twitter"></i>&nbsp;</a></li>
            </ul>
        </div>
    </div>
</div>
<?php echo $pageHeading; ?>
<?php
// New Word Document
echo date('H:i:s') , ' Create new PhpWord object' , EOL;
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$phpWord->addFontStyle('rStyle', array('bold' => true, 'italic' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true));
$phpWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceAfter' => 100));
$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));

// New portrait section
$section = $phpWord->addSection();

// Simple text
$section->addTitle(htmlspecialchars('Welcome to PhpWord'), 1);
$section->addText(htmlspecialchars('Hello World!'));

// Two text break
$section->addTextBreak(2);

// Defined style
$section->addText(htmlspecialchars('I am styled by a font style definition.'), 'rStyle');
$section->addText(htmlspecialchars('I am styled by a paragraph style definition.'), null, 'pStyle');
$section->addText(htmlspecialchars('I am styled by both font and paragraph style.'), 'rStyle', 'pStyle');

$section->addTextBreak();

// Inline font style
$fontStyle['name'] = 'Times New Roman';
$fontStyle['size'] = 20;

$textrun = $section->addTextRun();
$textrun->addText(htmlspecialchars('I am inline styled '), $fontStyle);
$textrun->addText(htmlspecialchars('with '));
$textrun->addText(htmlspecialchars('color'), array('color' => '996699'));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('bold'), array('bold' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('italic'), array('italic' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('underline'), array('underline' => 'dash'));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('strikethrough'), array('strikethrough' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('doubleStrikethrough'), array('doubleStrikethrough' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('superScript'), array('superScript' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('subScript'), array('subScript' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('smallCaps'), array('smallCaps' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('allCaps'), array('allCaps' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('fgColor'), array('fgColor' => 'yellow'));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('scale'), array('scale' => 200));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('spacing'), array('spacing' => 120));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('kerning'), array('kerning' => 10));
$textrun->addText(htmlspecialchars('. '));

// Link
$section->addLink('http://www.google.com', htmlspecialchars('Google'));
$section->addTextBreak();

// Image
$section->addImage('resources/_earth.jpg', array('width'=>18, 'height'=>18));

// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);
if (!CLI) {

/**
 * Footer file
 */
if (CLI) {
    return;
}
?>
</div>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>

