<!DOCTYPE html>
<html>
  <head>
    <title>Galax</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link href="default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ1tPLFgaGlgsXzopYcUbQtmCwoTOkP38&v=3.exp&sensor=true"></script>
    <script type="text/javascript" src="/includes/galax.js"></script>
    <script type="text/javascript" src="/includes/ajax.js"></script>
    <script type="text/javascript">
        var get_session = "<?php 
        session_start(); 
        if(isset($_SESSION['user'])){
            echo $_SESSION['user'];
        }else{
            echo 'false';
        }
        ?>";
        if(get_session != 'false'){
            user = get_session;
            cargaXML('action.php',false);
        }
    </script>
  </head>
  <body onload="document.getElementById('user').focus()">
      

      
      <input name="user" class="input" id="user" type="text">
      <input name="pass" class="input2" id="pass" onKeyPress="return checkSubmit(event);" type="password">
      <div class="user"><b>Nickname:</b></div>
      <div class="pass"><b>Password:</b></div>
      <input id="submit" type="submit" class="sub" onclick="cargaXML('action.php',false);">
      <div class="detalles" id="detalles"></div>
      <div id="reg" class="register" onclick="register();">Register</div>
    <div id="map-canvas">
    </div>
      <div id="abs" class="abs">
          <iframe src="chat.php" class="frame"></iframe>
     </div>
  </body>
</html>