<?php
$user = $_GET["user"];
$data = $_GET["data"];


$link = mysql_connect("localhost", "root", "akatsuki"); 
mysql_select_db("galax", $link); 



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
    $res = mysql_query("INSERT INTO options VALUES ('$data','')");
}
echo $res;
?>