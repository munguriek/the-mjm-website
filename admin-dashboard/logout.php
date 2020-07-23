<?php 
    include session_start();

            $_SESSION['username'] = null;
            $_SESSION['userfirstname'] = null;
            $_SESSION['userlastname'] = null;
            $_SESSION['userrole'] = null;
            session_destroy();
            header("Location: ../index.php");
       
?>
