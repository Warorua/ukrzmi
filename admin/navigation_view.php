<?php
include 'components/header.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../bower/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?php
        include 'components/topbar.php';
        include 'components/navbar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Navigation Linking</h1>
                            <a href="./add_navigation.php" class="btn btn-primary m-0">Add New</a>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Navigation Linking</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                            <h3 class="card-title">System Navigation Linking</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="scrapedData" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conn = $pdo->open();
                                    $stmt = $conn->prepare("SELECT * FROM navlinks");
                                    $stmt->execute();
                                    $cat = $stmt->fetchAll();
                                    foreach ($cat as $row) {
                                        if ($row['status'] == '1') {
                                            $status = '<div class="badge badge-success">ACTIVE</div>';
                                        } else {
                                            $status = '<div class="badge badge-danger">INACTIVE</div>';
                                        }

                                        echo '
                                             <tr>
                                               <td>' . $row['id'] . '</td>
                                               <td>' . $row['name'] . '</td>
                                               <td>' . $row['link'] . '</td>
                                               <td>' . $status . '</td>
                                               <td><a href="./add_navigation.php?id=' . $row['id'] . '" class="btn btn-warning">EDIT</a></td>
                                               <td><a href="./delete_navigation.php?id=' . $row['id'] . '" class="btn btn-danger">DELETE</a></td>
                                             </tr>
  
                                           ';
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        include 'components/footer.php';
        ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php
    include 'components/scripts.php';
    ?>
    <?php
    include 'components/alert.php';
    ?>
</body>

</html>