<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM comments";
            $select_comments_query = mysqli_query($connection, $query);
            if(!$select_comments_query){
                die("Query Failed ".mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($select_comments_query)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<tr>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";
                    echo "<td>{$comment_email}</td>";
                    echo "<td>{$comment_status}</td>";
                
                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $select_post = mysqli_query($connection, $query);
                    if(!$select_post){
                        die('Query Failed '.mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($select_post)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        echo "<td>{$post_title}</td>";
                    }
                    echo "<td>{$comment_date}</td>";
                    echo "<td><a href='comments.php?approve=$comment_id' class='btn btn-info text-white'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove=$comment_id' class='btn btn-warning text-white'>Disapprove</a></td>";
                    echo "<td><a href='comments.php?delete={$comment_id}' class='btn btn-danger text-white'>Delete</a></td>";
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
        $comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
        $delete_comment_query = mysqli_query($connection, $query);
        if(!$delete_comment_query){
            die('Query Failed '.mysqli_error($connection));
        }
        header("Location: comments.php");
    }
?>