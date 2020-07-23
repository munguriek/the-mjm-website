<?php
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_post_query = mysqli_query($connection, $query);
    if(!$select_post_query){
        die("Query Failed ".mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($select_post_query)){
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
    }

    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;
        
        move_uploaded_file($post_image_temp, "../assets/img/blog/{$post_image}");
        
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
            }
        }
        
        $query = "UPDATE posts SET post_category_id = '{$post_category_id}', post_title = '{$post_title}',  post_author = '{$post_author}', post_date = now(), post_image = '{$post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', post_comment_count = '{$post_comment_count}', post_status = '{$post_status}' WHERE post_id = {$the_post_id}";
        $update_post_query = mysqli_query($connection, $query);
        if(!$update_post_query){
            die('Query Failed '.mysqli_error($connection));
        }
        header("Location: posts.php");


    }
?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
    </div>
    
    <div class="form-group">
        <label for="post_category_id">Post Category</label>        
        <select name="post_category_id" class="form-control">
            <?php 
            $query = "SELECT * FROM categories";
            $select_category = mysqli_query($connection, $query);
            if(!$select_category){
                die('Query Failed '.mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($select_category)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
        ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control" value="<?php echo $post_author; ?>">
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img src="../assets/img/blog/<?php echo $post_image; ?>" width="100" class="img-responsive"><input type="file" name="post_image" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
    </div>
    
    <div class="form-group">
        <label for="">Post Content</label>
        <textarea name="post_content" class="form-control" id="" cols="30" rows="20"><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" name="update_post" class="btn btn-primary" value="Update Post">
    </div>
</form>