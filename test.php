<?php
$con = mysql_connect("localhost", "nitmaker_cn", "nitmaker.cn");
if(!$con){
    die("Could not connect to mysql: " . mysql_error() . "contast with zhujinteng2012@163.com");
}else{
    echo "<p>Successfully connected</p>";
}
mysql_select_db("nitmaker_cn");
$result = mysql_query("SELECT * FROM userInfo");
$row = mysql_fetch_array($result);
foreach($row as $key=>$value){
    echo $key . "    " . $value;
    echo "<br/>";
}
phpinfo();
?>
