<?php
session_start();
$user = $_GET["user"];
$pass = $_GET["password"];


if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){$isUser = true;}else{
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
}

if($isUser){
    $res = mysql_query("SELECT
    main.`user`,
    main.admin
    FROM
    main
    WHERE
    main.`user` = '$user'
    ");
    
    while($value = mysql_fetch_array($res)){
        $adminLv = $value[1];
    }
    
    $_SESSION['admin'] = $adminLv;
    $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s"); 
    $_SESSION['user'] = $user;
    $_SESSION['logged'] = true;
    echo 'allow';
}else{
    session_destroy();
    echo 'notAllow';
}
?>