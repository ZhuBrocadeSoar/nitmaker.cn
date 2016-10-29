<?php
//设置session
if($_POST['state'] != "done"){
    session_start();
    $_SESSION['state'] = "0";
    $_SESSION['nickName'] = "nick_name";
    $_SESSION['passwd'] = "password";
}
//连接数据库
$_SESSION['con'] = mysql_pconnect("localhost", "nitmaker_cn", "nitmaker.cn");
///////////////////////登录地址/////用户名/////////密码/////////
mysql_select_db("nitmaker_cn");
/////////////////数据库名/////
?>

<?php
if($_POST['state'] == "done"){
    $_SESSION['nickName'] = htmlspecialchars(stripslashes(trim($_POST['nickName'])));
    $_SESSION['passwd'] = htmlspecialchars(stripslashes(trim($_POST['passwd'])));
}

if($_POST['state'] == "done"){
    $result = mysql_query("SELECT id,nickName,passwd FROM userInfo WHERE nickName = " . $_SESSION['nickName'], $_SESSION['con']);
    if($row = mysql_fetch_array($result)){
        //匹配到nickName
        if($row['passwd'] == $_SESSION['passwd']){
            //密码匹配
            $_SESSION['machState'] = "allMach";
        }else{
            //密码不匹配
            $_SESSION['machState'] = "passwdNotMach";
        }
    }else{
            //昵称不匹配
            $_SESSION['machState'] = "nickNameNotMach";
    }
}
echo "<table>";
foreach($_SESSION as $key=>$value){
    echo "<tr><th>$key</th><td>$value</td></tr>";
}
foreach($_POST as $key=>$value){
    echo "<tr><th>$key</th><td>$value</td></tr>";
}
echo "</table>";
?>

<html>
<body>
<h1>Welcome to NITmaker</h1>
<p>在此处登录账户</p>
<form method = "post" action = "<?php
echo htmlspecialchars($_SERVER['PHP_SELF']);
?>">
<table border = 1>
<tr> <th>昵称</th> <td><input type = "text" name = "nickName" value = "<?php echo $_SESSION['nickName'];?>"></td> </tr>
<tr> <th>密码</th> <td><input type = "password" name = "passwd" value = "<?php echo $_SESSION['passwd'];?>"></td> </tr>
</table>
<?php
switch($_SESSION['machState']){
case "passwdNotMach":case "nickNameNotMach":
    echo "输入的信息不匹配，登录失败<br/>";
    break;
case "allMach":
    header("localhost/nitmaker.cn/center.php");
    exit;
    break;
}
?>
<input type = "hidden" name = "state" value = "done">
<input type = "submit" value = "登录">
</form>
</body>
</html>
