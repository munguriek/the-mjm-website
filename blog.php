<?php include "includes/header.php"; ?>

<body>

  <!-- ======= Top Bar ======= -->
  <?php include "includes/top-bar.php"; ?>
  <!-- ======= Header ======= -->
    <?php include "includes/navigation.php"; ?>
  <!-- End Header -->


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Blog</li>
        </ol>
        <h2>Blog</h2>

      </div>
    </section><!-- End Breadcrumbs -->
    

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">
      
        <div class="row">

          <div class="col-lg-8 entries">
          <?php
            $query = "SELECT * FROM posts";
            $select_all_posts_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_comment_count = $row['post_comment_count'];
                $post_content = substr($row['post_content'], 0, 150);           
        ?>

            <article class="entry">

              <div class="entry-img">
                <img src="./assets/img/blog/<?php echo $post_image; ?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.php?p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.php?p_id=<?php echo $post_id; ?>"><time datetime="2020-01-01"><?php echo $post_date; ?></time></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.php?p_id=<?php echo $post_id; ?>"><?php echo $post_comment_count; ?></a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?php echo $post_content; ?>
                </p>
                <div class="read-more">
                  <a href="blog-single.php?p_id=<?php echo $post_id; ?>">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
            <?php  }?>

            <div class="blog-pagination">
              <ul class="justify-content-center">
                <li class="disabled"><i class="icofont-rounded-left"></i></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
              </ul>
            </div>

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="icofont-search"></i></button>
                </form>

              </div><!-- End sidebar search form-->

              <?php include "includes/categories-widget.php"; ?>
              <!-- End sidebar categories-->

              <?php include "includes/recentposts-widget.php"; ?>
              <!-- End sidebar recent posts-->

              <?php include "includes/tags-widget.php"; ?>
              <!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<!-- ======= Footer ======= -->
    <?php include "includes/footer.php"; ?>
<!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>