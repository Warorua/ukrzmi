<?php

include 'components/header.php';

if (!isset($_GET['id'])) {
  $_SESSION['error'] = 'Invalid redirection!';
  header('location: block_view.php');
} else {
  $stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM blocks WHERE id=:id");
  $stmt->execute(['id' => $_GET['id']]);
  $auth = $stmt->fetch();
  if ($auth['numrows'] < 1) {
    $_SESSION['error'] = 'Invalid query passed!';
    header('location: block_view.php');
  } else {
    $stmt = $conn->prepare("SELECT * FROM blocks WHERE id=:id");
    $stmt->execute(['id' => $_GET['id']]);
    $block = $stmt->fetch();
  }
}
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
              <h1 class="m-0">Edit Block Information</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Block Edit</li>
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
          <form id="newsAdd" action="block_system/block_edit_process.php" method="post" enctype="multipart/form-data">


            <input type="hidden" name="id" value="<?php echo $block['id'] ?>" />
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
                <h3 class="card-title">Meta Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Block Title</label>
                  <input type="text" class="form-control" name="title" value="<?php echo $block['name'] ?>" placeholder="Block Title" required>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Article size</label>
                      <input type="number" class="form-control" name="size" value="<?php echo $block['articles'] ?>" placeholder="Number of articles to be in the block" max="64" min="8" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Position</label>
                      <div class="form-group">

                        <select class="form-control select2bs4" data-placeholder="Enter keywords" name="position" style="width: 100%;" required>
                          <optgroup label="Selected Position">
                            <option selected value="<?php
                                                    if ($block['position'] == 0) {
                                                      $position = '*Top(Headlines)';
                                                    } elseif ($block['position'] == "") {
                                                      $position = '*Last Position';
                                                    } elseif ($block['position'] == 404) {
                                                      $position = '*NEUTRAL';
                                                    } else {
                                                      $position = '*Position ' . $block['position'] + 1;
                                                    }

                                                    echo $block['position'];
                                                    ?>"><?php echo $position ?></option>
                          </optgroup>
                          <option value="404">NEUTRAL</option>
                          <option value="0">Top(Headlines)</option>
                          <?php
                          for ($i = 1; $i <= 99; $i++) {
                            if ($i != 99) {
                              $title = $i + 1;
                            } else {
                              $title = $i;
                            }

                            echo '<option value="' . $i . '">Position ' . $title . '</option>';
                          }
                          ?>
                          <option value="100">Last Position</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Status</label>
                    <div class="form-group">

                      <select class="form-control select2bs4" data-placeholder="Block Status" name="status" style="width: 100%;" required>
                        <optgroup label="Selected Status">
                          <?php
                          if ($block['active'] == 0) {
                            echo '<option selected value="0">Inactive</option>';
                          } elseif ($block['active'] == 1) {
                            echo '<option selected value="1">Active</option>';
                          }

                          ?>
                        </optgroup>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>

                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Content</label>
                  <div class="form-group">

                    <select class="form-control  select2bs4" data-placeholder="Enter keywords" name="type" style="width: 100%;" required>
                      <optgroup label="Selected Category Content">
                        <option selected value="<?php echo $block['type'] ?>"><?php echo $block['type'] ?></option>
                      </optgroup>
                      <?php
                      $stmt = $conn->prepare("SELECT DISTINCT category FROM news");
                      $stmt->execute();
                      $cat = $stmt->fetchAll();
                      foreach ($cat as $row) {
                        $stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM blocks WHERE type=:type");
                        $stmt->execute(['type' => $row['category']]);
                        $cat_count = $stmt->fetch();
                        if ($cat_count['numrows'] > 0) {
                          echo '<option disabled="disabled">' . $row['category'] . ' <b class="bg-secondary">(Unavailable)</b></option>';
                        } else {
                          echo '<option value="' . $row['category'] . '">' . $row['category'] . '</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->


            </div>
            <!-- /.card -->




            <!-- Color Frame Picker -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
                <h3 class="card-title">
                  <i class="fa fa-object-group"></i>
                  Block Background Color
                </h3>
              </div>
              <div class="card-body">

                <div class="tab-content" id="custom-content-above-tabContent">
                  <!-- Color Picker -->
                  <div class="form-group">
                    <label>Background color picker:</label>

                    <div class="input-group my-colorpicker2">
                      <input type="text" class="form-control" name="color" value="<?php echo $block['bg_color'] ?>" required>

                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <button class="btn btn-success" type="submit">Update Block</button>
              </div>
              <!-- /.card -->
            </div>
            <!-- Color Picker -->




          </form>

          <?php
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          ?>
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
  <script>
    $(function() {

      $('#newsAdd').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },

          terms: {
            required: true
          },
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>

  <script>
    $(".js-example-tokenizer").select2({
      tags: true,
      tokenSeparators: [',', ' ']
    })
  </script>
  <?php
  include 'components/alert.php';
  ?>
</body>

</html>