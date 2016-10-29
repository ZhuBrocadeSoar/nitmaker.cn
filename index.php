<?php
if($_SESSION['state'] == ""){
    //设置session
    session_start();
    //定义session变量
    $_SESSION['state'] = "0";
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
if($_SESSION['state'] != "0"){
    $_SESSION['nickName'] = htmlspecialchars(stripslashes(trim($_POST['nickName'])));
    $_SESSION['passwd'] = htmlspecialchars(stripslashes(trim($_POST['passwd'])));
    $_SESSION['state'] = "1";
}
?>

<html>
<body>
<?php
foreach($_SESSION as $key=>$value){
    echo $key . "=>" . $value . "<br/>";
}
foreach($_POST as $key=>$value){
    echo $key . "=>" . $value . "<br/>";
}
?>
<h1>Welcome to NITmaker</h1>
<p>在此处登录账户</p>
<form method = "post" action = "<?php
echo htmlspecialchars($_SERVER['PHP_SELF']);
?>">
<table border = 1>
<tr> <th>昵称</th> <td><input type = "text" name = "nickName" value = "<?php echo $_SESSION['nickName'];?>"></td> </tr>
<tr> <th>密码</th> <td><input type = "password" name = "passwd" value = "<?php echo $_SESSION['passwd'];?>"></td> </tr>
</table>
<input type = "submit" value = "登录">
</form>
</body>
</html>
