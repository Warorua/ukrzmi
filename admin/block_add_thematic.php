<?php
include 'components/header.php';
if (!isset($_POST['page'])) {
  $_SESSION['error'] = "Thematic block processing error!";
  header("location:home.php");
} else {
  $page = $_POST['page'];
  $category = $_POST['type'];
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
              <h1 class="m-0">Thematic data processing...</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Block Add</li>
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
          <form id="newsAdd" action="block_system/block_add_thematic_process.php" method="post" enctype="multipart/form-data">



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
                  <label for="exampleInputEmail1">Page to place block:</label>
                  <input type="text" class="form-control" value="<?php echo $page ?>" disabled>
                  <input type="hidden" class="form-control" name="page" value="<?php echo $page ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Category type of the block</label>
                  <input type="text" class="form-control" value="<?php echo $category ?>" disabled>
                  <input type="hidden" class="form-control" name="type" value="<?php echo $category ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Block Title</label>
                  <input type="text" class="form-control" name="title" placeholder="Block Title" required>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Article size</label>
                      <input type="number" class="form-control" name="size" placeholder="Number of articles to be in the block" max="60" min="8" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Position</label>
                      <div class="form-group">

                        <select class="form-control select2bs4" data-placeholder="Enter keywords" name="position" style="width: 100%;" required>

                          <option value="0">First thematic</option>
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
                          <option value="100">Last Thematic</option>

                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Status</label>
                    <div class="form-group">

                      <select class="form-control select2bs4" data-placeholder="Block Status" name="status" style="width: 100%;" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>

                  </div>



                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City</label>
                      <div class="form-group">

                        <select class="form-control select2bs4" data-placeholder="Enter keywords" name="city" style="width: 100%;" required>
                          <option value="0">ALL</option>
                          <option value="kyiv">Kyiv</option>
                          <option value="lviv">Lviv</option>
                          <option value="odessa">Odessa</option>
                          <option value="kharkiv">Kharkiv</option>
                          <option value="dnepropetrovsk">Dnepropetrovsk</option>

                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Content type</label>
                      <div class="form-group">

                        <select class="form-control select2bs4" data-placeholder="Enter keywords" name="content" style="width: 100%;" required>
                          <option value="0">ALL</option>
                          <option value="">News</option>
                          <option value="interview">Interviews</option>
                          <option value="video">Videos</option>
                          <option value="voice">Voices</option>
                          <option value="publication">Podcast</option>

                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Animation speed(Seconds)</label>
                      <input type="number" class="form-control" name="speed" placeholder="Thematic animation speed" max="10" min="1" required>
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Sub-Category Content</label>
                  <div class="form-group">

                    <select class="form-control select2bs4" data-placeholder="Enter keywords" name="sub_cat" style="width: 100%;" required>
                      <option value="0">ALL</option>
                      <?php
                      $stmt = $conn->prepare("SELECT DISTINCT sub_1 FROM news WHERE category=:category");
                      $stmt->execute(['category' => $category]);
                      $cat = $stmt->fetchAll();
                      foreach ($cat as $row) {
                        $stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM blocks WHERE sub_cat=:sub_cat");
                        $stmt->execute(['sub_cat' => $row['sub_1']]);
                        $cat_count = $stmt->fetch();
                        if ($cat_count['numrows'] > 0) {
                          echo '<option disabled="disabled">' . $row['sub_1'] . ' <b class="bg-secondary">(Unavailable)</b></option>';
                        } else {
                          echo '<option value="' . $row['sub_1'] . '">' . $row['sub_1'] . '</option>';
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
                    <label>Color picker:</label>

                    <div class="input-group my-colorpicker2">
                      <input type="text" class="form-control" name="color" required>

                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label>Block badge:</label>

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="image" required>
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <button class="btn btn-success" type="submit">Add Block</button>
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
  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
</body>

</html>