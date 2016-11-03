<?php
$im = imagecreatefrompng("test.png");
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
?>
