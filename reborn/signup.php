<?php
session_start();
if(isset($_SESSION['loginStatus'])){//释放原有登录会话
	session_unset();
}
if(isset($_POST)){
	$_SESSION['userTypedUserName'] = htmlspecialchars($_POST['userTypedUserName']);
	$_SESSION['userTypedPassword'] = htmlspecialchars($_POST['userTypedPassword']);
	$_SESSION['userTypedEmail'] = htmlspecialchars($_POST['userTypedEmail']);
	$_SESSION['userTypedVerifCode'] = htmlspecialchars($_POST['userTypedVerifCode']);
}
?>

<script language = 'php'>
	$x = document.getElementById('signupinfo');
	function changeValueOfPassword($status){
		if($status == 'currect'){
			x.elements[1].value = $_SESSION['userTypedPassword'];
		}else if($status == 'sha1value'){
			x.elements[1].value = sha1($_SESSION['userTypedPassword']);
		}
	}
</script>

<html>
	<head>
		<title>NITmaker-注册</title>
	</head>

	<body>
		<h1>注册</h1>
		<form id = 'signupinfo' method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
			<table border = 1>
				<tr> <th>用户名</th> <td><input type = 'text' name = 'userTypedUserName' value = <?php echo  '\''.$_SESSION['userTypedUserName'].'\'';?>></td> </tr>
				<tr> <th>密码</th> <td><input type = 'password' name = 'userTypedPassword' onfocus = "changeValueOfPassword('curect')" onblur = "changeValueOfPassword('sha1value')"></td> </tr>
				<tr> <th>邮箱</th> <td><input type = 'text' name = 'userTypedEmail' value = <?php echo '\''.$_SESSION['userTypedEmail'].'\'';?>></td> </tr>
				<tr> <th>验证码</th> <td><input type = 'text' name = 'userTypedVerifCode' value = <?php echo '\''.$_SESSION['userTypedVerifCode'].'\'';?>></td> </tr>
			</table>
			<img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src='../src/verification_class.php?'+Math.random();"></img>
			<input type = 'submit' value = '注册'>
		</form>
	</body>
</html>
