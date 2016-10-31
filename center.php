<?php
session_start();
$tmp = $_SESSION['nickName'];
echo $tmp;
echo "Hello $tmp";
?>
