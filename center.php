<?php
session_start();
if($_SESSION['logInState'] != "logIned"){
    //尚未登录，转跳操作
}else{
    //已经登录，
}
?>

<html>

<head>
<?php
if($_SESSION['logInState'] != "logIned"){
    //尚未登录，转跳
    echo "<meta http-equiv = \"refresh\" content = \"2;url = http://123.206.204.23/nitmaker.cn/\">";
}
?>
</head>

<body>
<?php
if($_SESSION['logInState'] != "logIned"){
    //尚未登录，打印转跳信息
    echo "<p>请登录，将在2秒后转跳到登录界面</p>";
}else{
    echo "<h1>Here is user\'s Center</h1>";
    $tmp = $_SESSION['nickName'];
    echo "<p>Hello \"$tmp\"</p>";
    echo "<p>Pick a function:</p>";
}
?>

</body>

</html>

