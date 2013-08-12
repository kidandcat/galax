<?php
$user = $_GET["user"];
$isLocal = $_GET["isLocal"];


$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$result = mysql_query("SELECT
main.`user`,
main.list
FROM
main
", $link);

$result2 = mysql_query("SELECT
`options`.`options`
FROM
`options`
", $link);
$resu = false;
$resu2 = false;
while($val = mysql_fetch_array($result)){
    if($val[0] == $user)
        $resu = $val[1];
}
while($val2 = mysql_fetch_array($result2)){
        $resu2 = $resu2.$val2[0]." ";
}
if($resu != false){
    if($isLocal == 'true'){
        echo $resu2.$resu;
    }else{
        echo $resu;
    }
}else{
    echo 'Error loading user list.';
}
?>