<?php
$user = $_GET["user"];
$pass = $_GET["password"];



$link = mysql_connect("localhost", "root", "akatsuki"); 
mysql_select_db("galax", $link); 

$va = mysql_query("INSERT INTO main VALUES ('$user','','$pass','0','0','0')");
echo 'registered'.$va;
?>