<?php
$link = mysql_connect("localhost", "root", "akatsuki");

mysql_select_db("galax", $link);

$result = mysql_query("SELECT
main.`user`,
main.posX,
main.posY,
main.lastTime
FROM
main
", $link);
$res = "";

$ahora = date("Y-n-j H:i:s");
    
while($val = mysql_fetch_array($result)){
    $fechaGuardada = $val[3]; 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    
    if($tiempo_transcurrido < 300)
        $res = $res.$val[0]."%".$val[1]."%".$val[2]."%";
}


echo $res;
?>