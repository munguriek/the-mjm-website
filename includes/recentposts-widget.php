<h3 class="sidebar-title">Recent Posts</h3>
        <div class="sidebar-item recent-posts">
        <?php
            $query = "SELECT * FROM posts ORDER BY post_date DESC
            LIMIT 5";
            $select_all_posts_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
        ?>
        <div class="post-item clearfix">
            <img src="./assets/img/blog/<?php echo $post_image; ?>" alt="">
            <h4><a href="blog-single.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h4>
            <time datetime="2020-01-01"><?php echo $post_date; ?></time>
        </div>

        <?php  }?>

        </div>