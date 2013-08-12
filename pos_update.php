<?php
$user = $_GET["user"];
$posX = $_GET["posX"];
$posY = $_GET["posY"];

$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$res = mysql_query("UPDATE main SET posX='$posX',posY='$posY' WHERE user='$user'");
echo $res;
?>