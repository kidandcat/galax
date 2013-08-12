<?php
$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$result = mysql_query("SELECT
main.`user`,
main.posX,
main.posY
FROM
main
", $link);
$res = "";
while($val = mysql_fetch_array($result)){
    $res = $res.$val[0]."%".$val[1]."%".$val[2]."%";
}


echo $res;
?>