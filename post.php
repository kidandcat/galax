<?php  
session_start();  
if(isset($_SESSION['name'])){  
    $text = $_POST['text'];  
    $link = mysql_connect("localhost", "root", "akatsuki"); 
    mysql_select_db("galax", $link); 
      
    $user = $_SESSION['name'];
    $target = $_SESSION['enter'];
    $now = date("Y-n-j H:i:s"); 
    mysql_query("UPDATE chats SET last_access='$now' WHERE user='$user' AND target='$target'");
    mysql_query("UPDATE chats SET last_access='$now' WHERE user='$target' AND target='$user'");
    
    mysql_query("UPDATE chats SET last_check_first_user='$now' WHERE user='$user' AND target='$target'");
    mysql_query("UPDATE chats SET last_check_second_user='$now' WHERE user='$target' AND target='$user'");
    
    
    $fp = fopen($_SESSION["log"], 'a');  
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");  
    fclose($fp);  
}  
?> 