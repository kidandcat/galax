<?php
session_start();


$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$result = mysql_query("SELECT
main.`user`,
main.icon
FROM
main
", $link);

$resu = '';

while($val = mysql_fetch_array($result)){
    $resu = $resu.";".$val[0]." ".$val[1];
}

if($resu != false){
    echo $resu;
}else{
    echo 'Error loading user icon.';
}
?>