<?php

session_start();
echo "<table border = 1>";
echo "<tr><th>_SESSION</th><th>value</th></tr>";
foreach($_SESSION as $key=>$value){
    echo "<tr><th>$key</th><td>$value</td></tr>";
}
echo "<tr><th>_POST</th><th>value</th></tr>";
foreach($_POST as $key=>$value){
    echo "<tr><th>$key</th><td>$value</td></tr>";
}
echo "<tr><th>result</th><td>$result</td></tr>";
echo "<tr><th>row</th><th>value</th></tr>";
foreach($row as $key=>$value){
    echo "<tr><th>$key</th><td>$value</td></tr>";
}
echo "</table>";

//判断表单提交次数
if($_SESSION['submitCount']){
    //提交数已经记录，发生过至少一次提交。
    $_SESSION['submitCount']++;
    //接受提交的表单并安全化
    $_SESSION['nickName'] = htmlspecialchars(stripslashes(trim($_POST['nickName'])));
    $_SESSION['passwd'] = htmlspecialchars(stripslashes(trim($_POST['passwd'])));
    //密码转换为SHA1值
    $_SESSION['passwd'] = sha1($_SESSION['passwd']);
    //匹配nickName和passwd
    //选择数据库
    mysql_select_db("nitmaker_cn", $_SESSION['conOfMysql']);
    /////////////////数据库名////
    //转储字符串
    $tmp = $_SESSION['nickName'];
    //查询数据库匹配nickName, 转义字符\"很关键
    $result = mysql_query("SELECT id,nickName,passwd FROM userInfo WHERE nickName = \"$tmp\"", $_SESSION['con']);
    if($row = mysql_fetch_array($result)){
        //匹配到nickName
        if($row['passwd'] == $_SESSION['passwd']){
            //密码匹配
            $_SESSION['logInInfoState'] = "allMached";
        }else{
            //密码不匹配
            $_SESSION['logInInfoState'] = "passwdNotMach";
        }
    }else{
        //昵称不匹配
        $_SESSION['logInInfoState'] = "nickNameNotMach";
    }
}else{
    //未提交任何表单，判定为第一次进入该站点
    //记录访问时间;
    $_SESSION['accessTime'] = time();
    //第一次访问设定为第1次提交表单;
    $_SESSION['submitCount'] = 1;
    //初始化的登录信息
    $_SESSION['nickName'] = "nick_name";
    $_SESSION['passwd'] = "password";
    $_SESSION['logInState'] = "notLogIn";
    $_SESSION['logInInfoState'] = "noInput";
    //建立持久的数据库连接
    $_SESSION['conOfMysql'] = mysql_pconnect("localhost", "nitmaker_cn", "nitmaker.cn");
    //////////////////////////////////////////数据库地址///数据库名///////用户名///////
}
?>
<html>

<head>
<?php
if($_SESSION['logInInfoState'] == "allMached"){
    //2秒转跳到用户中心
    $_SESSION['logInState'] = "logIned";
    echo "<meta http-equiv = \"refresh\" content = \"2;url = http://123.206.204.23/nitmaker_cn/center.php\">";
}
?>
</head>

<body>
<h1>Welcome to NITmaker</h1>
<p>在此页面登录<p>
<?php
if($_SESSION['logInState'] == "notLogIn"){
    //打印表单
    //转储字符串
    $tmp = htmlspecialchars($_SERVER['PHP_SELF']);
    echo "<form method = \"post\" action = \"$tmp\">";
    echo "<table border = 1>";
    $tmp = $_SESSION['nickName'];
    echo "<tr> <th>昵称</th> <td><input type = \"text\" name = \"nickName\" value = \"$tmp\"></td> </tr>";
    $tmp = $_SESSION['passwd'];
    echo "<tr> <th>密码</th> <td><input type = \"password\" name = \"passwd\" value = \"$tmp\"></td> </tr>";
    echo "</table>";
    echo "<input type = \"submit\" value = \"登录\">";
    echo "</table>";
    echo "</form>";
    //打印登录信息错误
    if($_SESSION['logInInfoState'] != "allMached"){
        echo "<br/>输入的信息不匹配<br/>";
    }
}else{
    //打印2秒后自动转跳到用户中心
    echo "<p>登录成功，2秒后自动转跳到用户中心</p>";
}
?>
</body>

</html>
