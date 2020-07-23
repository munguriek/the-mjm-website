<?php include "admin-includes/admin-header.php"; ?>

<?php 
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_profile = mysqli_query($connection, $query);
        if(!$select_profile){
            die('Query Failed '.mysqli_error($connection));
        }
        while($row = mysqli_fetch_array($select_profile)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $userfirstname = $row['userfirstname'];
            $userlastname = $row['userlastname'];
            $useremail = $row['useremail'];
            $userrole = $row['userrole'];
            $userimage = $row['userimage'];
        }
        
        if(isset($_POST['update_profile'])){
        $userfirstname = $_POST['userfirstname'];
        $userlastname = $_POST['userlastname'];
        $username = $_POST['username'];
        $useremail = $_POST['useremail'];
        $userrole = $_POST['userrole'];
        
        $userimage = $_FILES['userimage']['name'];
        $user_image_temp = $_FILES['userimage']['tmp_name'];
                
        move_uploaded_file($user_image_temp, "./images/$userimage");
        
        if(empty($userimage)){
            $query = "SELECT * FROM users WHERE username = $username ";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)){
                $userimage = $row['userimage'];
            }
        }
        
        $query = "UPDATE users SET userfirstname = '{$userfirstname}', userlastname = '{$userlastname}',  username = '{$username}', useremail='{$useremail}', userimage = '{$userimage}', userrole = '{$userrole}' WHERE username = '{$username}'";
        $update_user_query = mysqli_query($connection, $query);
        if(!$update_user_query){
            die('Query Failed '.mysqli_error($connection));
        }

    }
    }
?>

    <body class="sb-nav-fixed">
        <?php include "admin-includes/admin-topnav.php"; ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
               <?php include "admin-includes/admin-sidenav.php"; ?>
            </div>
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12">
                                                                
                            </div>                   
                                
                        </div>
                        
                    </div>
                </main>
                <?php include "admin-includes/admin-footer.php"; ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
