<?php
    if(isset($_GET['u_id'])){
        $the_user_id = $_GET['u_id'];
    }

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query){
        die("Query Failed ".mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($select_user_query)){
        $user_id = $row['user_id'];
        $userfirstname = $row['userfirstname'];
        $userlastname = $row['userlastname'];
        $username = $row['username'];
        $useremail = $row['useremail'];
        $userimage = $row['userimage'];
        $userrole = $row['userrole'];
        $userpassword = $row['userpassword'];
    }

    if(isset($_POST['update_user'])){
        $userfirstname = $_POST['userfirstname'];
        $userlastname = $_POST['userlastname'];
        $username = $_POST['username'];
        $useremail = $_POST['useremail'];
        $userrole = $_POST['userrole'];
        
        $userimage = $_FILES['userimage']['name'];
        $user_image_temp = $_FILES['userimage']['tmp_name'];
                
        move_uploaded_file($user_image_temp, "../assets/img/users/$userimage");
        
        if(empty($userimage)){
            $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)){
                $userimage = $row['userimage'];
            }
        }
        
        if(!empty($userpassword)){
            $query_password = "SELECT userpassword FROM users WHERE user_id = $the_user_id";
            $user_query = mysqli_query($connection, $query_password);
            if(!$user_query){
                die('Query Failed '.mysqli_error($connection));
            }
            $row = mysqli_fetch_array($user_query);
            $db_user_password = $row['userpassword'];
            
                if($db_user_password != $userpassword){
                $hashed_userpassword = password_hash($userpassword, PASSWORD_BCRYPT, array('cost' => 12));
            }
        
            $query = "UPDATE users SET userfirstname = '{$userfirstname}', userlastname = '{$userlastname}',  username = '{$username}', useremail='{$useremail}', userimage = '{$userimage}', userrole = '{$userrole}' WHERE user_id = {$the_user_id}";
            $update_user_query = mysqli_query($connection, $query);
            if(!$update_user_query){
                die('Query Failed '.mysqli_error($connection));
            }
            header("Location: users.php");
        }
        
        

    }
?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="userfirstname">First Name</label>
        <input type="text" name="userfirstname" class="form-control" value="<?php echo $userfirstname; ?>">
    </div>
        
    <div class="form-group">
        <label for="userlastname">Last Name</label>
        <input type="text" name="userlastname" class="form-control" value="<?php echo $userlastname; ?>">
    </div>
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
    </div>
    
    <div class="form-group">
        <label for="useremail">Email</label>
        <input type="text" name="useremail" class="form-control" value="<?php echo $useremail; ?>">
    </div>
    
    <div class="form-group">
        <label for="userimage">Image</label>
        <img src="../assets/img/users/<?php echo $userimage; ?>" width="100" class="img-responsive"><input type="file" name="userimage" class="form-control">
    </div>
    <div class="form-group">
        <label for="userrole">User Role</label>
        <select class="form-control" name="userrole">
            <option value="<?php echo $userrole; ?>"><?php echo $userrole; ?></option>
            <option value="Admin">Administrator</option>
            <option value="Editor">Editor</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>
      
        
    <div class="form-group">
        <input type="submit" name="update_user" class="btn btn-warning text-white" value="Edit User">
    </div>
</form>