<?php
session_start();
if(isset($_SESSION['loginStatus'])){//释放原有登录会话
	session_unset();
}
if(isset($_POST)){
	$_SESSION['userTypedUserName'] = htmlspecialchars($_POST['userTypedUserName']);
	$_SESSION['userTypedPassword'] = htmlspecialchars($_POST['userTypedPassword']);
	$_SESSION['modifiedUserTypedPassword'] = substr(sha1($_SESSION['userTypedPassword']), 0, strlen($_SESSION['userTypedPassword']));
	$_SESSION['userTypedEmail'] = htmlspecialchars($_POST['userTypedEmail']);
	$_SESSION['userTypedVerifCode'] = htmlspecialchars($_POST['userTypedVerifCode']);
}
?>

<script>
	function emptyPassword(){
		document.getElementById('passwordObjuct').value = '';
	}
	function ruleOfUserName(id){
		document.getElementById()
	}
</script>

<html>
	<head>
		<title>NITmaker-注册</title>
	</head>

	<body>
		<h1>注册</h1>
		<form method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
			<table border = 1>
				<tr> <th>用户名</th> <td><input type = 'text' id = 'usernameObjuct' name = 'userTypedUserName' value = <?php echo  '\''.$_SESSION['userTypedUserName'].'\'';?> onfocus = "ruleOfUserName()"></td> </tr> <tr id = 'ruleOfUserNameObjuct'>test</tr>
				<tr> <th>密码</th> <td><input type = 'password' id = 'passwordObjuct' name = 'userTypedPassword' value = <?php echo '\''.$_SESSION['modifiedUserTypedPassword'].'\'';?> onclick = "emptyPassword()" onfocus = "ruleOfPassword()"></td> </tr> <tr id = 'ruleOfPasswordObjuct'>test222222</tr>
				<tr> <th>邮箱</th> <td><input type = 'text' id = 'emailObjuct' name = 'userTypedEmail' value = <?php echo '\''.$_SESSION['userTypedEmail'].'\'';?> onfocus = "ruleOfEmail()"></td> </tr>
				<tr> <th>验证码</th> <td><input type = 'text' name = 'userTypedVerifCode' value = <?php echo '\''.$_SESSION['userTypedVerifCode'].'\'';?>></td> </tr>
			</table>
			<img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src='../src/verification_class.php?'+Math.random();"></img>
			<input type = 'submit' value = '注册'>
		</form>
	</body>
</html>
