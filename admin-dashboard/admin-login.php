<?php 
    include '../config/db.php';
    session_start();

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $userpassword = $_POST['userpassword'];
        $useremail = $_POST['useremail'];
        $username = mysqli_real_escape_string($connection, $username);
        $userpassword = mysqli_real_escape_string($connection, $userpassword);
        $useremail = mysqli_real_escape_string($connection, $useremail);
        
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_query = mysqli_query($connection, $query);
        if(!$select_user_query){
            die('Query Failed '.mysqli_error($connection));
        }
        while($row = mysqli_fetch_array($select_user_query)){
            $db_id = $row['user_id'];
            $db_userfirstname = $row['userfirstname'];
            $db_userlastname = $row['userlastname'];
            $db_userrole = $row['userrole'];
            $db_username = $row['username'];
            $db_useremail = $row['email'];
            $db_userpassword = $row['userpassword'];
        }
        if(password_verify($userpassword, $db_userpassword)){
            $_SESSION['username'] = $db_username;
            $_SESSION['userfirstname'] = $db_userfirstname;
            $_SESSION['userlastname'] = $db_userlastname;
            $_SESSION['userrole'] = $db_userrole;
            $_SESSION['useremail'] = $db_useremail;
            header("Location: dashboard.php");
        } else {
            header("Location: ../index.php");
        }
    }
?>
