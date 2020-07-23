<?php
    if(isset($_POST['checkBoxArray'])){
                foreach($_POST['checkBoxArray'] as $checkBoxValue){
                    $bulkOptions = $_POST['bulkOptions'];
                    switch($bulkOptions){
                        case 'published':
                            $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxValue}";
                            $update_to_published = mysqli_query($connection, $query);
                            if(!$update_to_published){
                                die('Query Failed '.mysqli_error($connection));
                            }
                            break;
                        case 'draft':
                            $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxValue}";
                            $update_to_draft = mysqli_query($connection, $query);
                            if(!$update_to_draft){
                                die('Query Failed '.mysqli_error($connection));
                            }
                            break;
                        case 'delete':
                            $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                            $bulk_delete_post = mysqli_query($connection, $query);
                            if(!$bulk_delete_post){
                                die('Query Failed '.mysqli_error($connection));
                            }
                            break;
                    }
                }
            }
?>
<form method="post" action="">
    <table class="table table-bordered table-hover">
            <div class="row">
            <div class="col-xl-4" id="bulkOptionContainer">
                <select name="bulkOptions" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xl-4">
                <input type="submit" name="bulkAction" class="btn btn-success" value="Apply">
                <a href="./users.php?source=add-user" class="btn btn-primary">Add New</a> 
            </div>
            </div>
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes" class="form-check-input"></th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM posts";
            $select_posts_query = mysqli_query($connection, $query);
            if(!$select_posts_query){
                die("Query Failed ".mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($select_posts_query)){
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

                echo "<tr>";
                ?>
                <td><input type='checkbox' class='checkBoxes form-check-input' name='checkBoxArray[]' value='<?php echo $post_id;?>'></td>;
            <?php 
                    echo "<td>{$post_author}</td>";
                    echo "<td>{$post_title}</td>";
                
                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                    $select_category = mysqli_query($connection, $query);
                    if(!$select_category){
                        die('Query Failed '.mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($select_category)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<td>{$cat_title}</td>";
                    }
                    echo "<td>{$post_status}</td>";
                    echo "<td><img src='../assets/img/blog/{$post_image}' class='img-responsive' width='100'></td>";
                    echo "<td>{$post_tags}</td>";
                    echo "<td>{$post_comment_count}</td>";
                    echo "<td>{$post_date}</td>";
                    echo "<td><a href='../blog.php?p_id={$post_id}' class='btn btn-info text-white' target='_blank'>View</a></td>";
                    echo "<td><a href='posts.php?source=edit-post&p_id={$post_id}' class='btn btn-warning text-white'>Edit</a></td>";
                    echo "<td><a href='posts.php?delete={$post_id}' class='btn btn-danger text-white'>Delete</a></td>";
                echo "</tr>";
            }
        
        ?>
    </tbody>
</table>
</form>

<?php 
    if(isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
        $delete_post_query = mysqli_query($connection, $query);
        if(!$delete_post_query){
            die('Query Failed '.mysqli_error($connection));
        }
        header("Location: posts.php");
    }
?>