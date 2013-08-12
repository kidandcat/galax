<?php
$user = $_GET["user"];


$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$result = mysql_query("SELECT
main.`user`,
main.posX,
main.posY
FROM
main
", $link);
$resu = false;
while($val = mysql_fetch_array($result)){
    if($val[0] == $user)
        $resu = "(".$val[1].",".$val[2].")";
}
if($resu != false){
    echo $resu;
}else{
    echo 'Error loading user pos.';
}
?>