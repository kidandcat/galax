<?php
session_start();


$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$us = $_SESSION['user'];

$result = mysql_query("SELECT
main.`user`,
main.admin
FROM
main
WHERE
main.`user` = '$us'
", $link);


while($val = mysql_fetch_array($result)){
    $res = $val[1];
}

if($res != false && isset($res)){
    echo $res;
}else{
    echo '0';
}
?>