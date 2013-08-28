<?php 
session_start();
            if(isset($_SESSION['log']))
                echo $_SESSION['log'];
?>