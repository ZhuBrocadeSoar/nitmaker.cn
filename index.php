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
<input type = "submit" value = "Test">
</form>

</body>
</html>
