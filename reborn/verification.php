<?php
session_start();

if(!isset($_SESSION['verifQuery'])){
	echo "<html>
	<head>
		<title></title>
		<meta http-equiv = \'refresh\' content = \'0;url = http://123.206.204.23/nitmaker.cn/reborn/\'>
	</head>
	<body>
	
	</body>
	</html>";
}else{
	echo "hello";
	unset($_SESSION['verifQuery']);
}
?>