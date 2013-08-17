<?php 
//iniciamos la sesión 
session_start(); 



    $ahora = date("Y-n-j H:i:s"); 
    $user = $_SESSION["user"];
    
    $link = mysql_connect("localhost", "root", "akatsuki"); 
    mysql_select_db("galax", $link); 

    
    $query = "UPDATE main SET lastTime='$ahora' WHERE user='$user'";
    $res = mysql_query($query);
    $_SESSION["ultimoAcceso"] = $ahora; 
    echo $res;
?>