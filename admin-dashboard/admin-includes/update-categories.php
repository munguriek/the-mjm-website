<form action="" method="post">
<?php insertCategories(); ?>
    <div class="form-group">
     <?php
        if(isset($_GET['edit'])){
                $the_cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = {$the_cat_id}";
                $select_cat_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_cat_query)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                ?>
        <label for="category">Edit Category</label>
        <input type="text" name="cat_title" value="<?php if(isset($cat_title)) echo $cat_title; ?>" class="form-control">
        <?php  } } ?>
    </div>
    <?php 
        if(isset($_POST['update_category'])){
            $cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
            $update_query = mysqli_query($connection, $query);
            header("Location: categories.php");
            if(!$update_query){
                die('Query Failed'.mysqli_error($connection));
            }

        }
    ?>
    <div class="form-group">
        <input type="submit" class="btn btn-success" name="update_category" value="Update Category">
    </div>
</form>