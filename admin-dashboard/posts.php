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
                        <h1 class="mt-4">Blog Posts</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashbaord.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    if(isset($_GET['source'])){
                                        $source = $_GET['source'];
                                    } else {
                                        $source = '';
                                    }
                                    switch ($source){
                                        case 'add-post':
                                            include "admin-includes/add-post.php";
                                            break;
                                        case 'edit-post':
                                            include "admin-includes/edit-post.php";
                                            break;
                                        default: include "admin-includes/view-all-posts.php";
                                    }
                                ?>
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
