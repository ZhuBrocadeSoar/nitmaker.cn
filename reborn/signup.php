<?php
session_start();
if(isset($_SESSION['loginStatus'])){//释放原有登录会话
	session_unset();
}

$_SESSION['conOfMysql'] = mysql_pconnect("localhost", "nitmaker_cn", "nitmaker.cn");
mysql_select_db("nitmaker_cn", $_SESSION['conOfMysql']);

if(isset($_POST['submitStatus'])){
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
	function ruleOfPassword(operate){
		if(operate == 1){
			emptyPassword();
			document.getElementById('ruleOfPasswordObjuct').innerHTML = '密码可包含字母(区分大小写)、数字或英文标点符号，不能有空格等空白符，长度为6~14个字符';
		}else if(operate == 0){
			document.getElementById('ruleOfPasswordObjuct').innerHTML = '';
		}
	}
	function ruleOfEmail(operate){
		if(operate == 1){
			document.getElementById('ruleOfEmailObjuct').innerHTML = '填写一个有效的电子邮箱地址，用于接收验证码';
		}else if(operate == 0){
			document.getElementById('ruleOfEmailObjuct').innerHTML = '';
		}
	}
</script>

<html>
	<head>
		<title>NITmaker-注册</title>
	</head>

	<body>
		<h1>注册</h1>
		<?php
			if(isset($_POST['submitStatus'])){
				if(strcasecmp($_SESSION['userTypedVerifCode'], $_SESSION['verifCode'])){
					echo "<font size = '2' color = 'red'>验证码错误</font>";
				}else if(!preg_match("/^[0-9a-zA-Z_]{1,32}$/" , $_SESSION['userTypedUserName'])){
					echo "<font size = '2' color = 'red'>用户名不合法</font>";
				}else if(!preg_match("/^[0-9a-zA-Z`~!@#$%^&*()\-_=+\[\{\]\}\|\\\;\:\'\"\,\<\.\>\/\?]{6,14}$/", $_SESSION['userTypedPassword'])){
					echo "<font size = '2' color = 'red'>密码不合法</font>";
				}else if(!preg_match("/^[a-z0-9](\.?[a-z0-9_\-]){0,}@[a-z0-9\-]+\.([a-z]{1,6}\.)*[a-z]{2,6}$/", $_SESSION['userTypedEmail'])){
					echo "<font size = '2' color = 'red'>邮箱地址不合法</font>";
				}else{
					$tmp = $_SESSION['userTypedUserName'];
					$result = mysql_query("SELECT userName FROM userList WHERE userName = \"$tmp\"", $_SESSION['conOfMysql']);
					if($row = mysql_fetch_array($result)){
						echo "<font size = '2' color = 'red'>用户名被占用</font>";
					}else{
						$_SESSION['verifCodeByEmail'] = bin2hex(openssl_random_pseudo_bytes(6));
						$to = $_SESSION['userTypedEmail'];
						$subjuct = "欢迎注册NITmaker";
						$message = "<html><p><font size = '2' color = 'black'>在验证界面输入下面的验证码以完成注册</font></p><p><font size = '6' color = 'blue'>".$_SESSION['verifCodeByEmail']."</font></p><p><font size = '2' color = 'black'>这是一封系统邮件，请勿回复</font></p></html>\n";
						$addHeader = "From:NITmaker<nitmaker@163.com>\r\nContent-type:text/html\r\n";
						mail($to, $subjuct, $message, $addHeader);
					}
				}
			}
		?>
		<form method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
			<table border = 0>
				<tr> <th>用户名</th> <td><input type = 'text' id = 'usernameObjuct' name = 'userTypedUserName' value = <?php echo  '\''.$_SESSION['userTypedUserName'].'\'';?> onfocus = "ruleOfUserName(1)" onblur = "ruleOfUserName(0)"></td> <td id = 'ruleOfUserNameObjuct'></td> </tr>
				<tr> <th>密码</th> <td><input type = 'password' id = 'passwordObjuct' name = 'userTypedPassword' value = <?php echo '\''.$_SESSION['modifiedUserTypedPassword'].'\'';?> onfocus = "ruleOfPassword(1)" onblur = "ruleOfPassword(0)"></td> <td id = 'ruleOfPasswordObjuct'></td> </tr>
				<tr> <th>邮箱</th> <td><input type = 'text' id = 'emailObjuct' name = 'userTypedEmail' value = <?php echo '\''.$_SESSION['userTypedEmail'].'\'';?> onfocus = "ruleOfEmail(1)" onblur = "ruleOfEmail(0)"></td> <td id = 'ruleOfEmailObjuct'></td> </tr>
				<tr> <th>验证码</th> <td><input type = 'text' name = 'userTypedVerifCode' value = <?php echo '\''.$_SESSION['userTypedVerifCode'].'\'';?>></td> </tr>
			</table>
			<img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src='../src/verification_class.php?'+Math.random();"></img>
			<input type = 'hidden' name = 'submitStatus' value = '1'>
			<input type = 'submit' value = '注册'>
		</form>
	</body>
</html>
