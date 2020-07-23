<?php
    if(isset($_POST['create_post'])){
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
        
        move_uploaded_file($post_image_temp, "../assets/img/blog/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_image, post_content, post_date, post_tags, post_status, post_comment_count) VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', '{$post_image}', '{$post_content}', now(),  '{$post_tags}', '{$post_status}', '{$post_comment_count}')";
        $create_post_query = mysqli_query($connection, $query);
        if(!$create_post_query){
            die('Query Failed '.mysqli_error($connection));
        }
    }
?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
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
        <input type="text" name="post_author" class="form-control">
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
        <input type="file" name="post_image" class="form-control-input">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="">Post Content</label>
        <textarea name="post_content" class="form-control" id="" cols="30" rows="20"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
    </div>
</form>