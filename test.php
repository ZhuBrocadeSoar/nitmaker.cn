<?php
$con = mysql_connect("localhost", "nitmaker_cn", "nitmaker.cn");
if(!$con){
    die("Could not connect to mysql: " . mysql_error());
}else{
    echo "<p>Successfully connected</p>";
}
phpinfo();
?>
