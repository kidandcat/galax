<?php  
session_start();  

if(isset($_SESSION['user'])){  
    $text = $_GET['text'];  
    if($text != '' && $text != null){
    $link = mysql_connect("localhost", "root", "akatsuki"); 
    mysql_select_db("galax", $link); 
      
    $user = $_SESSION['user'];
    $target = $_SESSION['enter'];
    $now = date("Y-n-j H:i:s"); 
    mysql_query("UPDATE chats SET last_access='$now' WHERE user='$user' AND target='$target'");
    mysql_query("UPDATE chats SET last_access='$now' WHERE user='$target' AND target='$user'");
    
    mysql_query("UPDATE chats SET last_check_first_user='$now' WHERE user='$user' AND target='$target'");
    mysql_query("UPDATE chats SET last_check_second_user='$now' WHERE user='$target' AND target='$user'");
    
    
    
    
    
    
    
    //http://www.forosdelweb.com/f18/fopen-anadir-principio-873176/
      
    //guardo en una variable el nuevo texto
    $a = "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['user']."</b>: ".stripslashes($text)."<br></div>";
    //guardo en otra variable el contenido actual
    $get = file_get_contents($_SESSION["log"]);
    //creo una variable con el nuevo+actual
    $t=$a.$get;
    //borro el texto
    unlink($_SESSION["log"]);
    //creo un nuevo archivo y escribo el nuevo texto xD
    $control = fopen($_SESSION["log"],"c");
    $write = fwrite($control, $t);
    fclose($control);  
    echo $text;
}  
}
?> 
