<?php
session_start();

if(!isset($_SESSION['verifQuery'])){
	die("Permition Denied!");
}else{
	unset($_SESSION['verifQuery']);
	$to = $_SESSION['userTypedEmail'];
	$subjuct = '欢迎注册NITmaker';
	$_SESSION['verifCodeByEmail'] = bin2hex(openssl_random_pseudo_bytes(3));
	$message = "
	<p><font size = '3' color = 'black'>亲爱的</font><font size = '3' color = 'green'>".$_SESSION['userTypedUserName']."</font></p>
	<p><font size = '3' color = 'black'>  您正在注册NITmaker，下面是您刚才注册时服务器向您发起的邮箱验证码：</font></p>
	<p><font size = '6' color = 'blue'>".$_SESSION['verifCodeByEmail']."</font></p>
	<p><font size = '3'>本站目前处于建设阶段，向注册用户提供SS服务的申请和查询服务。注册完成后请及时登录并填写基本信息。</font></p>
	<p><font size = '3' color = 'red'>若非邮箱所有者您发起该验证，有扰您忽略本邮件。</font></p>
	\n";
	$addHeader = "From:NITmaker<nitmaker@163.com>\r\nContent-type:text/html\r\n";
	mail($to, $subjuct, $message, $addHeader);
    echo "<html>
				<head>
					<title>NITmaker-注册-邮箱验证</title>
				</head>
				<body>
				<p><font size = '3' color = 'black'>服务器已经给您指定的邮箱</font></p>
				<p><font size = '6' color = 'blue'>".$_SESSION['userTypedEmail']."</font></p>
				<p><font size = '3' color = 'black'>发送了一封附有验证码的电子邮件。</font></p>
				<p><font size = '3' color = 'black'>将邮件中的验证码填写到下面框中并点击\"验证\"按钮提交该验证码。</font></p>
				<p><font size = '2' color = 'red'>请确保该邮箱归属于您，若要更改邮箱，请返回注册页面重新注册。</font></p>
					<form method = 'post' action = ".htmlspecialchars($_SERVER['PHP_SELF']).">
						<table border = 0>
							<tr> <th>邮箱验证码</th> <td><input type = 'text' name = 'userTypedVerifCodeByEmail'></td> <td><input type = 'submit' value = '验证'></td> </tr>
						</table>
					</form>
				<body>
	</html>";
}
?>
