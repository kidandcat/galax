<?php
session_start();

$user = $_GET["user"];


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

$result3 = mysql_query("SELECT
`options`.specialty
FROM
`options`
", $link);
$resu = false;
$resu2 = false;
$resu3 = false;
while($val = mysql_fetch_array($result)){
    if($val[0] == $user)
        $resu = $val[1];
}
while($val2 = mysql_fetch_array($result2)){
        $resu2 = $resu2.$val2[0]." ";
}
while($val3 = mysql_fetch_array($result3)){
        $resu3 = $resu3.$val3[0]." ";
}
if($resu != false){
    if($user == $_SESSION["user"]){
        $res = explode(" ",$resu);
        echo $resu2.$res[0].";".$resu3.$res[1];
        //echo "asd qwe ert;qwe zxc asd";
    }else{
        echo $resu;
    }
}else{
    if($user == $_SESSION["user"]){
        echo $resu2.";".$resu3;
        //echo "asd qwe ert;qwe zxc asd";
    }else{
    echo 'Error loading user list.';
    }
}
?>