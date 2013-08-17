<?php
session_start();

$link = mysql_connect("localhost", "root", "akatsuki");
    mysql_select_db("galax", $link);
    $_user_insert = $_SESSION["user"];

    $result1 = mysql_query("SELECT
chats.`user`,
chats.target,
chats.last_access,
chats.last_check_first_user,
chats.last_check_second_user
FROM
chats
WHERE
user = '$_user_insert'
    ", $link);
    
    $result2 = mysql_query("SELECT
chats.`user`,
chats.target,
chats.last_access,
chats.last_check_first_user,
chats.last_check_second_user
FROM
chats
WHERE
target = '$_user_insert'
", $link);
    
    $new_msg = 'false';
    if($val1 = mysql_fetch_array($result1)){
        if((strtotime($val1[3]) < strtotime($val1[2]))){
            $new_msg = $val1[1];
            $wat = 1;
        }
    }else if($val2 = mysql_fetch_array($result2)){
        if((strtotime($val2[4]) < strtotime($val2[2]))){
            $new_msg = $val2[0];
            $wat = 2;
        }
    }
        $target = $new_msg;
        $now = date("Y-n-j H:i:s"); 
        mysql_query("UPDATE chats SET last_check_first_user='$now' WHERE user='$_user_insert' AND target='$target'");
        mysql_query("UPDATE chats SET last_check_second_user='$now' WHERE user='$target' AND target='$_user_insert'");

  
    echo $new_msg;
?>