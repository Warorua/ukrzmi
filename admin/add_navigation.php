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
           if (isset($_GET['id'])) {
                        $stmt = $conn->prepare("SELECT * FROM navlinks WHERE id=:id");
                        $stmt->execute(['id' => $_GET['id']]);
                        $navf = $stmt->fetch();
                        if (count($navf) != 0) {
                            $namenav = $navf['name'];
                            $linknav = $navf['link'];
                            $statusnav = $navf['status'];
                            $btnnav = 'Update Navigation';
                            $uptnav = '
                            <input type="hidden" name="update" value="TRUE" />
                            <input type="hidden" name="id" value="'.$_GET['id'].'" />'
                            ;
                            $pgst = 'Update';
                        } else {
                            $namenav = '';
                            $linknav = '';
                            $statusnav = '';
                            $btnnav = 'Add New';
                            $uptnav = '';
                            $pgst = 'Add';
                        }
                    } else {
                        $namenav = '';
                        $linknav = '';
                        $statusnav = '';
                        $btnnav = 'Add New';
                        $uptnav = '';
                        $pgst = 'Add';
                    }
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?php echo $pgst; ?> Navigation Link</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Navigation Links</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php
                    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                 
                    ?>
                    <form id="newsAdd" action="./navigation_process.php" method="post" enctype="multipart/form-data">

                        <?php echo $uptnav; ?>

                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                                <h3 class="card-title">Navigation Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Navigation Link Title</label>
                                    <input type="text" class="form-control" value="<?php echo $namenav; ?>" name="name" placeholder="Navigation Link Title" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Navigation Link Address</label>
                                            <input type="text" class="form-control" name="link" value="<?php echo $linknav; ?>" placeholder="Number of articles to be in the Navigation Link" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Status</label>
                                        <div class="form-group">

                                            <select class="form-control select2bs4" data-placeholder="Navigation Link Status" name="status" style="width: 100%;" required>
                                                <?php
                                                if ($statusnav == 1) {
                                                    echo '
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                                    ';
                                                } elseif ($statusnav == 0) {
                                                    echo '
                                                    <option value="1">Active</option>
                                                    <option value="0" selected>Inactive</option>
                                                    ';
                                                } else {
                                                    echo '
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                    ';
                                                }

                                                ?>

                                            </select>
                                        </div>

                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><?php echo $btnnav; ?></button>
                            </div>
                            <!-- /.card-body -->


                        </div>
                        <!-- /.card -->




                    </form>

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

    include 'components/alert.php';
    ?>
</body>

</html>