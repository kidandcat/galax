<?php
session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user'] == 'kidandcat')
        echo phpinfo();
    else
        echo '<b>Not enough level of authorization, access not allowed.</b>';
}else{
    echo '<b>Not enough level of authorization, access not allowed.</b>';
}
?>