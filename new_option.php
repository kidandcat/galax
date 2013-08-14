<?php
session_start();
$user = $_SESSION["user"];
$data = $_GET["data"];


$link = mysql_connect("localhost", "root", "akatsuki"); 
mysql_select_db("galax", $link); 

$data2 = explode(";",$data);
$data3 = $data2[0];
$data4 = $data2[1];

$result = mysql_query("SELECT
main.`user`,
main.admin
FROM
main
", $link);

$resu = false;
while($val = mysql_fetch_array($result)){
    if($val[0] == $user)
        $resu = $val[1];
}
if($resu > 0){
    $res = mysql_query("INSERT INTO options VALUES ('$data3','$data4')");
}
echo $res;
?>