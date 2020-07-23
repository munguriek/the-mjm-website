<?php
     //Insert Categories Function
     function insertCategories(){
        global $connection;
        if(isset($_POST['login'])){
            $cat_title = $_POST['cat_title'];
            if ($cat_title == "" || empty($cat_title)){
                echo "Please Enter a Category Title";
            } else {
                $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
                $create_category_query = mysqli_query($connection, $query);
                if(!$create_category_query){
                    die('Query Failed'.mysqli_error($connection));
                }
            }
        }
    }

    //Find All Categories
    function findAllCategories(){
        global $connection;
        $query = "SELECT * FROM categories";
        $select_category_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_category_query)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
                echo "<td>$cat_title</td>";
                echo "<td><a href='categories.php?delete={$cat_id}' class='btn btn-danger text-white'>Delete</a></td>";
                echo "<td><a href='categories.php?edit={$cat_id}' class='btn btn-warning text-white'>Edit</a></td>";
            echo "</tr>";
        }        
    }

    //Delete Category
    function deleteCategory(){
        global $connection;
        if(isset($_GET['delete'])){
            $the_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
            $delete_query = mysqli_query($connection, $query);
            header("Location: categories.php");

        }
    }
?>