<!DOCTYPE html>
<?php
session_start();  




  
if(isset($_POST['enter'])){  
    if($_POST['name'] != ""){  
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));  
        $_SESSION['enter'] = stripslashes(htmlspecialchars($_POST['enter']));  
    }  
    else{  
        $_SESSION['name'] = 'Anon'.mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
        $_SESSION['enter'] = 'Anon'.mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
    }  
    $link = mysql_connect("localhost", "root", "akatsuki");
    mysql_select_db("galax", $link);
    $_user_insert = $_SESSION["user"];
    $_enter_insert = $_SESSION["enter"];

    $result1 = mysql_query("SELECT
chats.`user`,
chats.target,
chats.log
FROM
chats
WHERE
user = '$_user_insert' AND 
target = '$_enter_insert'
    ", $link);
    
    $result2 = mysql_query("SELECT
chats.`user`,
chats.target,
chats.log
FROM
chats
WHERE
user = '$_enter_insert' AND 
target = '$_user_insert'
", $link);

    

    $_SESSION["log"] = "logs/log_default_default.html";
    if($val1 = mysql_fetch_array($result1)){
        $_SESSION["log"] = $val1[2];
    }else if($val2 = mysql_fetch_array($result2)){
        $_SESSION["log"] = $val2[2];
    }else{
        $logg = "logs/log_".$_SESSION["user"]."_".$_SESSION["enter"].".html";
        $_SESSION["log"] = $logg;
        $_user_insert = $_SESSION["user"];
        $_enter_insert = $_SESSION["enter"];
        $dater = date("Y-n-j H:i:s");
        mysql_query("INSERT INTO chats VALUES ('$_user_insert','$_enter_insert','$logg','$dater','$dater','$dater')");
    }
    
}  


if(isset($_GET['logout'])){   
      
    //guardo en una variable el nuevo texto
    $a = "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>";
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
}  
?>


<html>
    <head>
        <script>
        function clicked(){     
    var clientmsg = $("#usermsg").val();  
    $.post("post.php", {text: clientmsg});
    $("#usermsg").attr("value", "");  
    return false;  
};  
        </script>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="chat.css" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript">  
// jQuery Document  
var l_log = '<?php 
            if(isset($_SESSION['log']))
                echo $_SESSION['log'];
            else
                echo "logs/log_default.html";
        ?>';

$(document).ready(function(){  
    loadLog();
    setInterval (loadLog, 1500);
    //If user wants to end session  
    $("#exit").click(function(){  
        var exit = confirm("Are you sure you want to end the session?");  
        if(exit==true){window.location = 'chat.php?logout=true';}        
    });  
  
});
//If user submits the form  


//Load the file containing the chat log  
function loadLog(){       
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request  
    $.ajax({  
        url: l_log,  
        cache: false,  
        success: function(html){          
            $("#chatbox").html(html); //Insert chat log into the #chatbox div     
              
            //Auto-scroll             
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request  
            if(newscrollHeight > oldscrollHeight){  
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div  
            }                 
        },  
    });  
}  

</script> 
<?php

?>
    </head>
    <body onload="$('#usermsg').focus()">
<div id="wrapper">  
    <div id="menu">  
        <p class="welcome">Welcome, <b><?php 
        if(isset($_SESSION['name']))
            echo $_SESSION['name']; 
        else
            echo "Anon";
        ?></b></p>  
        <div style="clear:both"></div>  
    </div>      
    <div id="chatbox"><?php  
if(file_exists($_SESSION["log"]) && filesize($_SESSION["log"]) > 0){  
    $handle = fopen($_SESSION["log"], "r");  
    $contents = fread($handle, filesize($_SESSION["log"]));  
    fclose($handle);  
      
    echo $contents;  
}  
?></div>  
      
    <form name="message" action="">  
        <input name="usermsg" type="text" id="usermsg" size="63" />  
        <input name="submitmsg" type="submit" onclick="clicked()" id="submitmsg" value="Send" />  
    </form>  
</div>  
    </body>

</html>
