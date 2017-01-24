<?php
session_start();

if(!isset($_SESSION['verifQuery'])){
	die("Permition Denied!");
}else{
	echo "hello";
	unset($_SESSION['verifQuery']);
}
?>