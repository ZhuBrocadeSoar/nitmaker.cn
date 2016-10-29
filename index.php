<?php
if($_SESSION['isSet'] != "YES"){
    //设置session
    session_start();
    //定义session变量
    $_SESSION['isSet'] = "YES";
    $_SESSION['trueName'] = "";
    $_SESSION['nickName'] = "nick_name";
    $_SESSION['sex'] = -1;
    $_SESSION['passwd'] = "password";
    $_SESSION['fullTellNumber'] = "";
    $_SESSION['shortTellNumber'] = "";
    $_SESSION['confirm'] = 0;
}
//连接数据库
$con = mysql_pconnect("localhost", "nitmaker_cn", "nitmaker.cn");
?>

<?php
$_SESSION['nickName'] = htmlspecialchars(stripslashes(trim($_POST['nickName'])));
$_SESSION['password'] = htmlspecialchars(stripslashes(trim($_POST['passwd'])));

?>

<html>
<body>
<?php
foreach($_SESSION as $key=>$value){
    echo "\t" . $key . "\t\t" . $value . "<br/>";
}
?>
<h1>Welcome to NITmaker</h1>
<p>在此处登录账户</p>
<form method = "post" action = "<?php
echo htmlspecialchars($_SERVER['PHP_SELF']);
?>">
<table border = 1>
<tr> <th>昵称</th> <td><input type = "text" name = "<?php echo $_SESSION['nickName'];?>" value = "nick_name"></td> </tr>
<tr> <th>密码</th> <td><input type = "password" name = "passwd" value = "<?php echo $_SESSION['passwd'];?>"></td> </tr>
</table>
<input type = "submit" value = "登录">
</form>
</body>
</html>
