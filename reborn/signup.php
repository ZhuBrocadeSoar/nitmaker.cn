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
	function ruleOfUserName(operate){
		if(operate == 1){
			document.getElementById('ruleOfUserNameObjuct').innerHTML = '用户名由字母(区分大小写)、数字或者下划线组成，最多32个字符，用于用户登录';
		}
		else if(operate == 0){
			document.getElementById('ruleOfUserNameObjuct').innerHTML = '';
		}
	}
	function ruleOfPassword(){
		if(operate == 1){
			document.getElementById('ruleOfPasswordObjuct').innerHTML = '密码可包含字母(区分大小写)、数字或标点符号，不能有空格等空白符，长度为6~14个字符';
		}else if(operate == 0){
			document.getElementById('ruleOfPasswordObjuct').innerHTML = '';
		}
	}
</script>

<html>
	<head>
		<title>NITmaker-注册</title>
	</head>

	<body>
		<h1>注册</h1>
		<form method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
			<table border = 0>
				<tr> <th>用户名</th> <td><input type = 'text' id = 'usernameObjuct' name = 'userTypedUserName' value = <?php echo  '\''.$_SESSION['userTypedUserName'].'\'';?> onfocus = "ruleOfUserName(1)" onblur = "ruleOfUserName(0)"></td> <td id = 'ruleOfUserNameObjuct'></td> </tr>
				<tr> <th>密码</th> <td><input type = 'password' id = 'passwordObjuct' name = 'userTypedPassword' value = <?php echo '\''.$_SESSION['modifiedUserTypedPassword'].'\'';?> onclick = "emptyPassword(1)" onfocus = "ruleOfPassword(0)"></td> <td id = 'ruleOfPasswordObjuct'></td> </tr>
				<tr> <th>邮箱</th> <td><input type = 'text' id = 'emailObjuct' name = 'userTypedEmail' value = <?php echo '\''.$_SESSION['userTypedEmail'].'\'';?> onfocus = "ruleOfEmail()"></td> </tr>
				<tr> <th>验证码</th> <td><input type = 'text' name = 'userTypedVerifCode' value = <?php echo '\''.$_SESSION['userTypedVerifCode'].'\'';?>></td> </tr>
			</table>
			<img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src='../src/verification_class.php?'+Math.random();"></img>
			<input type = 'submit' value = '注册'>
		</form>
	</body>
</html>
