<?php
    if(isset($_POST['create_user'])){
        $userfirstname = $_POST['userfirstname'];
        $userlastname = $_POST['userlastname'];
        $username = $_POST['username'];
        $useremail = $_POST['useremail'];
        
        $userimage = $_FILES['userimage']['name'];
        $user_image_temp = $_FILES['userimage']['tmp_name'];
        
        $userrole = $_POST['userrole'];
        $userpassword = $_POST['userpassword'];
        
        move_uploaded_file($user_image_temp, "../assets/img/users/$userimage");
        
        
        $userpassword = password_hash($userpassword, PASSWORD_BCRYPT, array('cost' => 12));
        
        $query = "INSERT INTO users(username, userfirstname, userlastname, useremail,userpassword, userimage,userrole) VALUES ('{$username}', '{$userfirstname}', '{$userlastname}', '{$useremail}', '{$userpassword}', '{$userimage}', '{$userrole}')";
        $create_user_query = mysqli_query($connection, $query);
        if(!$create_user_query){
            die('Query Failed '.mysqli_error($connection));
        }
        echo "User ".$username." created successfully "."<a href='users.php'>View Users</a>";
    }
?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="userfirstname">First Name</label>
        <input type="text" name="userfirstname" class="form-control">
    </div>
        
    <div class="form-group">
        <label for="userlastname">Last Name</label>
        <input type="text" name="userlastname" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="useremail">Email</label>
        <input type="text" name="useremail" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="userimage">Image</label>
        <input type="file" name="userimage" class="form-control">
    </div>
    <div class="form-group">
        <label for="userrole">User Role</label>
        <select class="form-control" name="userrole">
            <option>Select Role</option>
            <option value="Admin">Administrator</option>
            <option value="Editor">Editor</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="userpassword">Create Password</label>
        <input type="password" name="userpassword" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="confirm_userpassword">Confirm Password</label>
        <input type="password" name="confirm_userpassword" class="form-control">
    </div>
    
        
    <div class="form-group">
        <input type="submit" name="create_user" class="btn btn-success" value="Create User">
    </div>
</form>