<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM users";
            $select_users_query = mysqli_query($connection, $query);
            if(!$select_users_query){
                die("Query Failed ".mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($select_users_query)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $userfirstname = $row['userfirstname'];
                $userlastname = $row['userlastname'];
                $useremail = $row['useremail'];
                $userrole = $row['userrole'];
                $userimage = $row['userimage'];

                echo "<tr>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$userfirstname}</td>";
                    echo "<td>{$userlastname}</td>";
                    echo "<td>{$useremail}</td>";
                    echo "<td>{$userrole}</td>";   
                    echo "<td><img src='../assets/img/users/{$userimage}' class='img-responsive' width='50'></td>";
                    echo "<td><a href='users.php?source=edit-user&u_id={$user_id}' class='btn btn-info'>Edit</a></td>";
                    echo "<td><a href='users.php?delete={$user_id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php 

    if(isset($_GET['unapprove'])){
        $the_comment = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'disapproved' WHERE comment_id = $the_comment";
        $disapprove_query = mysqli_query($connection, $query);
        if(!$disapprove_query){
            die('Query Failed '.mysqli_error($connection));
        }
        header("Location: comments.php");
    }

    if(isset($_GET['approve'])){
        $the_comment = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment";
        $approve_query = mysqli_query($connection, $query);
        if(!$approve_query){
            die('Query Failed '.mysqli_error($connection));
        }
        header("Location: comments.php");
    }

    if(isset($_GET['delete'])){
        $user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $delete_user_query = mysqli_query($connection, $query);
        if(!$delete_user_query){
            die('Query Failed '.mysqli_error($connection));
        }
        header("Location: users.php");
    }
?>