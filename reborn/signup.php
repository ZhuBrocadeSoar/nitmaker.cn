<?php
session_start();
if(!isset($_SESSION['signupTrying'])){//释放原有登录会话
    session_unset();
}

$_SESSION['signupTrying'] = '1';
$_SESSION['conOfMysql'] = mysql_pconnect("localhost", "nitmaker_cn", "nitmaker.cn");
mysql_select_db("nitmaker_cn", $_SESSION['conOfMysql']);

if(isset($_POST['submitStatus'])){
    //安全接受用户表单
    $_SESSION['userTypedUserName'] = htmlspecialchars($_POST['userTypedUserName']);
    $_SESSION['userTypedPassword'] = htmlspecialchars($_POST['userTypedPassword']);
    $_SESSION['modifiedUserTypedPassword'] = substr(sha1($_SESSION['userTypedPassword']), 0, strlen($_SESSION['userTypedPassword']));
    $_SESSION['userTypedEmail'] = htmlspecialchars($_POST['userTypedEmail']);
    $_SESSION['userTypedVerifCode'] = htmlspecialchars($_POST['userTypedVerifCode']);
}
?>

<!--客户端脚本-->
<script>
function emptyPassword(){
    document.getElementById('passwordObjuct').value = '';
    }
    function ruleOfUserName(operate){
        if(operate == 1){
            document.getElementById('ruleOfUserNameObjuct').innerHTML = '用户名由字母(区分大小写)、数字或者下划线组成，最多32个字符，用于用户登录';
        }
        else if(operate == 0){
            document.getElementById('ruleOfUserNameObjuct').innerHTML = '';
        }
    }
    function ruleOfPassword(operate){
        if(operate == 1){
            emptyPassword();
            document.getElementById('ruleOfPasswordObjuct').innerHTML = '密码可包含字母(区分大小写)、数字或英文标点符号，不能有空格等空白符，长度为6~14个字符';
        }else if(operate == 0){
            document.getElementById('ruleOfPasswordObjuct').innerHTML = '';
        }
    }
    function ruleOfEmail(operate){
        if(operate == 1){
            document.getElementById('ruleOfEmailObjuct').innerHTML = '填写一个有效的电子邮箱地址，用于接收验证码';
        }else if(operate == 0){
            document.getElementById('ruleOfEmailObjuct').innerHTML = '';
        }
    }
</script>

<html>
    <head>
<?php
if(isset($_POST['submitStatus'])){
    //表单已提交
    if(strcasecmp($_SESSION['userTypedVerifCode'], $_SESSION['verifCode'])){
        //图片验证码不匹配
        echo "<font size = '2' color = 'red'>验证码错误</font>";
    }else if(!preg_match("/^[0-9a-zA-Z_]{1,32}$/" , $_SESSION['userTypedUserName'])){
        //用户名正则表达式不匹配
        echo "<font size = '2' color = 'red'>用户名不合法</font>";
    }else if(!preg_match("/^[0-9a-zA-Z`~!@#$%^&*()\-_=+\[\{\]\}\|\\\;\:\'\"\,\<\.\>\/\?]{6,14}$/", $_SESSION['userTypedPassword'])){
        //密码正则表达式不匹配
        echo "<font size = '2' color = 'red'>密码不合法</font>";
    }else if(!preg_match("/^[a-z0-9](\.?[a-z0-9_\-]){0,}@[a-z0-9\-]+\.([a-z]{1,6}\.)*[a-z]{2,6}$/", $_SESSION['userTypedEmail'])){
        //邮箱正则表达式不匹配
        echo "<font size = '2' color = 'red'>邮箱地址不合法</font>";
    }else{
        //查询数据库，检查用户名占用
        $tmp = $_SESSION['userTypedUserName'];
        $result = mysql_query("SELECT userName FROM userList WHERE BINARY userName = \"$tmp\"", $_SESSION['conOfMysql']);
        if($row = mysql_fetch_array($result)){
            //数据库查询结果：用户名被占用
            echo "<font size = '2' color = 'red'>用户名被占用</font>";
        }else{
            //查询数据库，检查邮箱已注册
            $tmp = $_SESSION['userTypedEmail'];
            $result = mysql_query("SELECT email FROM userList WHERE email = \"$tmp\"", $_SESSION['conOfMysql']);
            if($row = mysql_fetch_array($result)){
                //数据库查询结果：邮箱已注册
                echo "<font size = '2' color = 'red'>该邮箱已经被注册</font>";
            }else{
                //通过所有验证，前往邮箱验证码页面
                unset($_SESSION['signupTrying']);
                $_SESSION['verifQuery'] = '1';
                unset($_POST['submitStatus']);
                echo "<meta http-equiv = \"refresh\" content = \"0;url = http://123.206.204.23/nitmaker.cn/reborn/verification.php\">";
            }
        }
    }
}
?>
        <title>NITmaker-注册</title>
    </head>

    <body>
        <h1>注册</h1>
        <form method = 'post' action = '<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>'>
            <table border = 0>
                <tr> <th>用户名</th> <td><input type = 'text' id = 'usernameObjuct' name = 'userTypedUserName' value = <?php echo  '\''.$_SESSION['userTypedUserName'].'\'';?> onfocus = "ruleOfUserName(1)" onblur = "ruleOfUserName(0)"></td> <td id = 'ruleOfUserNameObjuct'></td> </tr>
                <tr> <th>密码</th> <td><input type = 'password' id = 'passwordObjuct' name = 'userTypedPassword' value = <?php echo '\''.$_SESSION['modifiedUserTypedPassword'].'\'';?> onfocus = "ruleOfPassword(1)" onblur = "ruleOfPassword(0)"></td> <td id = 'ruleOfPasswordObjuct'></td> </tr>
                <tr> <th>邮箱</th> <td><input type = 'text' id = 'emailObjuct' name = 'userTypedEmail' value = <?php echo '\''.$_SESSION['userTypedEmail'].'\'';?> onfocus = "ruleOfEmail(1)" onblur = "ruleOfEmail(0)"></td> <td id = 'ruleOfEmailObjuct'></td> </tr>
                <tr> <th>验证码</th> <td><input type = 'text' name = 'userTypedVerifCode' value = <?php echo '\''.$_SESSION['userTypedVerifCode'].'\'';?>></td> </tr>
            </table>
            <img title = '点击刷新' src = '../src/verification_class.php' align = 'absbottom' onclick = "this.src='../src/verification_class.php?'+Math.random();"></img>
            <input type = 'hidden' name = 'submitStatus' value = '1'>
            <input type = 'submit' value = '注册'>
        </form>
    </body>
</html>
