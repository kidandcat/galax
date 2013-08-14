<?php
session_start();
$user = $_GET["user"];
$pass = $_GET["password"];

$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$result = mysql_query("SELECT
main.`user`,
main.`password`
FROM
main
", $link);
$isUser = false;
$isPass = false;
while($val = mysql_fetch_array($result)){
    if($val[0] == $user && $val[1] == md5($pass))
        $isUser = true;
}

if($isUser){
    $_SESSION['user'] = $user;
    echo 'allow';
}else{
    session_destroy();
    echo 'notAllow';
}
?>