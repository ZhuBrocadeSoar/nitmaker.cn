<?php
//设置session
session_start();
//定义session变量
$_SESSION['fileName'] = "index.php";
$_SESSION['trueName'] = "";
$_SESSION['nickName'] = "";
$_SESSION['sex'] = -1;
$_SESSION['passwd'] = "";
$_SESSION['fullTellNumber'] = "";
$_SESSION['shortTellNumber'] = "";
$_SESSION['confirm'] = 0;

//连接数据库
$con = mysql_pconnect("localhost", "nitmaker_cn", "nitmaker.cn");

?>

<html>
<body>

<h1>Welcome to NITmaker</h1>
<p>在此处登录账户</p>
<form method = "post" action = "<?php
echo htmlspecialchars($_SERVER['PHP_SELF']);
?>">
<table border = 1>
<tr> <th>昵称</th> <td><input type = "text" name = "nickName" value = "nick_name"></td> </tr>
<tr> <th>密码</th> <td><input type = "password" name = "passwd" value = "password"></td> </tr>
</table>
<input type = "submit" value = "登录">
</form>
</body>
</html>
