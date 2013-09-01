<?php
$user = $_GET["user"];
$pass = $_GET["password"];
$icon = $_GET["icon"];


$link = mysql_connect("localhost", "root", "akatsuki"); 
mysql_select_db("galax", $link); 

$pass2 = md5($pass);
$time = date("Y-n-j H:i:s");
if($icon == '' || $icon == null){
    $icon = 'images/icon.png';
}else{
    $icon2 = explode("fakepath", $icon);
    $icon = "images\/".$icon2[1];
}

if($user != ''){
    $va = mysql_query("INSERT INTO main VALUES ('$user','undefined undefined','$pass2','0','0','0','$icon','$time')");
    echo 'registered'.$va;
}else{
    echo 'nameNotAllowed';
}
?>