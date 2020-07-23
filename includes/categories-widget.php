<h3 class="sidebar-title">Categories</h3>
  <?php
    $query = "SELECT * FROM categories";
    $select_side_category_query = mysqli_query($connection, $query);
  ?>
              <div class="sidebar-item categories">
                <ul>
                <?php 
                    while($row = mysqli_fetch_assoc($select_side_category_query)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='categories.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                ?>     
                </ul>

              </div>