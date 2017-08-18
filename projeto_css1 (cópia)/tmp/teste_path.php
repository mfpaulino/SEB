<?php

$var = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);
echo $var;
?>
<a href ="<?php echo $var;?>">link</a>