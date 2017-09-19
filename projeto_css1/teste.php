<?php

$pag = strtr(end(explode('/', $_SERVER['REQUEST_URI'])),'', true);

echo $pag;
?>