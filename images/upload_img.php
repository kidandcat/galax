<?php
session_start();
$res = '';
foreach($_FILES['images']['error'] as $key => $error){
        if($error == UPLOAD_ERR_OK){
            require_once 'ModifiedImage.php';
 
            $image = new ModifiedImage($_FILES['images']['tmp_name'][$key]);
            $img = $_FILES['images']['name'][$key];
            $image->resizeToFit(200, 200, true, 'ffffff');
            $image->save($img);
        }
        $res = $res.$error;
    }

    echo $res;
?>