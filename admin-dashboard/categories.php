<?php include "admin-includes/admin-header.php"; ?>
    <body class="sb-nav-fixed">
        <?php include "admin-includes/admin-topnav.php"; ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
               <?php include "admin-includes/admin-sidenav.php"; ?>
            </div>
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Post Categories</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                        <div class="row">
                        <div class="col-md-6">
                                    <form action="" method="post">
                                    <?php insertCategories(); ?>
                                        <div class="form-group">
                                            <label for="category">Add Category</label>
                                                <input type="text" class="form-control" name="cat_title">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" name="login" value="Add Category">
                                        </div>
                                    </form>
                                    <?php 
                                        if(isset($_GET['edit'])){
                                            $cat_id = $_GET['edit'];
                                            include "admin-includes/update-categories.php";
                                        }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Category Title</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php findAllCategories(); ?>
                                            <?php deleteCategory(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                        </div>
                        
                    </div>
                </main>
                <?php include "admin-includes/admin-footer.php"; ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
