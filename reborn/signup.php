<?php
session_start();
if(isset($_SESSION['loginStatus'])){//释放原有登录会话
	session_unset();
}
if(isset($_POST)){
	$_SESSION['userTypedUserName'] = htmlspecialchars($_POST['userTypedUserName']);
	$_SESSION['userTypedPassword'] = htmlspecialchars($_POST['userTypedPassword']);
	$sha1Of = sha1($_SESSION['userTypedPassword']);
	for($i = 0; $i < strlen($_POST[userTypedPassword]); $i ++){
		$_SESSION['modifiedUserTypedPassword'][$i] = $sha1Of[$i];
	}
	$_SESSION['modifiedUserTypedPassword'][$i] = '\0';
	$_SESSION['userTypedEmail'] = htmlspecialchars($_POST['userTypedEmail']);
	$_SESSION['userTypedVerifCode'] = htmlspecialchars($_POST['userTypedVerifCode']);
}
?>

<html>
	<head>
		<title>NITmaker-注册</title>
	</head>

	<body>
		<h1>注册</h1>
		<form method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
			<table border = 1>
				<tr> <th>用户名</th> <td><input type = 'text' name = 'userTypedUserName' value = <?php echo  '\''.$_SESSION['userTypedUserName'].'\'';?>></td> </tr>
				<tr> <th>密码</th> <td><input type = 'password' name = 'userTypedPassword' value = <?php echo '\''.$_SESSION['modifiedUserTypedPassword'].'\'';?></td> </tr>
				<tr> <th>邮箱</th> <td><input type = 'text' name = 'userTypedEmail' value = <?php echo '\''.$_SESSION['userTypedEmail'].'\'';?>></td> </tr>
				<tr> <th>验证码</th> <td><input type = 'text' name = 'userTypedVerifCode' value = <?php echo '\''.$_SESSION['userTypedVerifCode'].'\'';?>></td> </tr>
			</table>
			<img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src='../src/verification_class.php?'+Math.random();"></img>
			<input type = 'submit' value = '注册'>
		</form>
	</body>
</html>
