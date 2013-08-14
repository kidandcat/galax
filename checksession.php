<?php 
//iniciamos la sesión 
session_start(); 


    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
    $user = $_SESSION["user"];
    
    $link = mysql_connect("localhost", "root", "akatsuki"); 
    mysql_select_db("galax", $link); 

    
      

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 600) {
     //si pasaron 10 minutos o más 
        echo 'destroy';
        session_destroy(); // destruyo la sesión 
        header("Location: index.html"); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
        $query = "UPDATE main SET lastTime='$ahora' WHERE user='$user'";
        $res = mysql_query($query);
        $_SESSION["ultimoAcceso"] = $ahora; 
        echo $res;
   } 
?>