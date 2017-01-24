<?php
session_start();
if(isset($_SESSION['idtype'])){
    //保持idtype
}else{
    $_SESSION['idtype'] = 'youke';
}

if($_SESSION['idtype'] == )
?>


<html>
<head>
<title>欢迎来到NITmaker</title>
</head>
<body>
<h1>关于本站点</h1><br />
<p>本站点是NITmaker的一个线上服务站点，目前提供的主要功能是Shadowsocks福利资源的申请、发放、查询</p>
<h1>
<a href = "signup.php">注册</a>或者<a href = "login.php">登录</a>
</h1>
</body>
</html>
