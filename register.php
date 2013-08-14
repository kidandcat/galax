<?php
$user = $_GET["user"];
$pass = $_GET["password"];
$icon = $_GET["icon"];


$link = mysql_connect("localhost", "root", "akatsuki"); 
mysql_select_db("galax", $link); 

$pass2 = md5($pass);

if($icon == '' || $icon == null)
    $icon = 'images/icon.png';

$va = mysql_query("INSERT INTO main VALUES ('$user','','$pass2','0','0','0','$icon')");
echo 'registered'.$va;
?>