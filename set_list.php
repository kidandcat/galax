<?php
session_start();
$user = $_SESSION["user"];
$data = $_GET["data"];


$link = mysql_connect("localhost", "root", "akatsuki"); 
mysql_select_db("galax", $link); 

$res = mysql_query("UPDATE main SET list='$data' WHERE user='$user'");
echo $res;
?>