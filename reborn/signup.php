<?php
session_start();
if(isset($_SESSION['loginStatus'])){//释放原有登录会话
	session_unset();
}
?>

<html>
	<head>
		<title>注册</title>
	</head>

	<body>
		<h1>注册</h1>
		<form method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
			<table border = 1>
				<tr> <th>用户名</th> <td><input type = 'text' name = 'userTypedUserName' value = <?php echo $_SESSION['userTypedUserName']?>></td> </tr>
				<tr> <th>密码</th> <td><input type = 'password' name = 'userTypedPassword' value = <?php echo $_SESSION['userTypedPassword']?>></td> </tr>
				<tr> <th>验证码</th> <td><input type = 'text' name = 'userTypedVerifCode' value = <?php echo $_SESSION['userTypedVerifCode']?>></td> </tr>
			</table>
			<img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src='../src/verification_class.php?'+Math.random();"></img>
			<input type = 'submit' value = '注册'>
		</form>
	</body>
</html>
