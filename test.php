<?php
$con = mysql_connect("123.206.204.23", "nitmaker_cn", "nitmaker.cn");
if(!$con){
    die("Could not connect to mysql: " . mysql_error());
}else{
    echo "<p>Successfully connected</p>";
}
phpinfo();
?>
