<?php
session_start();
if(!isset($_SESSION['loginTrying'])){
    session_unset();
}

$_SESSION['loginTrying'] = '1';
$_SESSION['conOfMysql'] = mysql_pconnect("localhost", "nitmaker_cn", "nitmaker.cn");
mysql_select_db("nitmaker_cn", $_SESSION['conOfMysql']);

?>

<html>
    <head>
        <title>NITmaker-登陆</title>
<?php

if(isset($_POST['submitStatus'])){
    $_SESSION['userTypedUserName'] = htmlspecialchars($_POST['userTypedUserName']);
    $_SESSION['userTypedPassword'] = htmlspecialchars($_POST['userTypedPassword']);
    $_SESSION['userTypedVerifCode'] = htmlspecialchars($_POST['userTypedVerifCode']);

    if(!strcasecmp($_SESSION['userTypedVerifCode'], $_SESSION['verifCode'])){
        //验证码匹配
        $result = mysql_query("SELECT uid,userName,password FROM userList WHERE BINARY userName = \"".$_SESSION['userTypedUserName']."\"", $_SESSION['conOfMysql']);
        if($row = mysql_fetch_array($result)){
            //用户名匹配
            if(!strcmp($row['password'], sha1($_SESSION['userTypedPassword']))){
                //用户密码匹配
                //登陆成功
                echo "<meta http-equiv = \"refresh\" content = \"0;url = http://123.206.204.23/nitmaker.cn/reborn/center.php\">";
                echo "<p><font size = '2' color = 'red'>登陆成功，2秒后转跳到用户中心</font></p>";
            }else{
                //用户名和密码不匹配
                echo "<p><font size = '2' color = 'red'>用户名和密码不匹配</font></p>";
            }
        }else{
            //用户名不存在
            echo "<p><font size = '2' color = 'red'>用户名不存在</font></p>";
        }
    }else{
        //验证码错误
        echo "<p><font size = '2' color = 'red'>验证码错误</font></p>";
    }
}
?>
    </head>
    <body>
        <h1>登陆</h1>
        <form method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
            <table border = 0>
                <tr> <th>用户名</th> <td><input type = 'text' name = 'userTypedUserName' value = '<?php echo $_SESSION['userTypedUserName'];?>'></td> </tr>
                <tr> <th>密码</th> <td><input type = 'password' name = 'userTypedPassword'></td></tr>
                <tr> <th>验证码</th> <td><input type= 'text' name = 'userTypedVerifCode'></td> </tr>
            </table>
            <img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src = '../src/verification_class.php?'+Math.random();"></img>
            <input type = 'hidden' name = 'submitStatus' value = '1'>
            <input type = 'submit' value = '登陆'>
        </form>
    </body>
</html>
