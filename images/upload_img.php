<?php
session_start();
$user = $_GET["user"];
$res = '';
foreach($_FILES['images']['error'] as $key => $error){
        if($error == UPLOAD_ERR_OK){
            require_once 'ModifiedImage.php';
 
            $image = new ModifiedImage($_FILES['images']['tmp_name'][$key], true);
            $img = $_FILES['images']['name'][$key];
            if($image->getHeight() > 40){
                $image->resizeToHeight(40);
            }
            if($image->getWidth() > 40){
                $image->resizeToWidth(40);
            }
            //$image->resizeToFit(40, 40, true, 'ffffff');
            $image->setTransparent(true);
            $image->save($img);
        }
        $res = $res.$error;
    }

    echo $res;
?>