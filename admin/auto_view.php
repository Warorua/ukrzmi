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
              <h1 class="m-0">Scraped Data</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Scraped Data</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <?php
      // Current Page Value
      $page = isset($_GET['page']) ? $_GET['page'] - 1 : 0;

      // Current Display Entry Length
      $length = (isset($_GET['length'])) ? $_GET['length'] : 50;

      // Tag 1 Search value
      $tag_1 = isset($_GET['tag_1']) ? $_GET['tag_1'] : '';
      // Tag 2 Search value
      $tag_2 = isset($_GET['tag_2']) ? $_GET['tag_2'] : '';
      // Tag 3 Search value
      $tag_3 = isset($_GET['tag_3']) ? $_GET['tag_3'] : '';
      // Type Search value
      $type = isset($_GET['type']) ? $_GET['type'] : '';
      // Tag 1 Search value
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      // Tag 1 Search value
      $tag_id = isset($_GET['tag_id']) ? $_GET['tag_id'] : '';

      // Search query where clause :: Execute only when search keyword exists

      if ($tag_1 != '') {
        $tag_1_fin = " AND tag_1 ='" . $tag_1 . "'";
      } else {
        $tag_1_fin = '';
      }
      ///////////////////////////////////////
      if ($tag_2 != '') {
        $tag_2_fin = " AND tag_2 ='" . $tag_2 . "'";
      } else {
        $tag_2_fin = '';
      }
      ///////////////////////////////////////
      if ($tag_3 != '') {
        $tag_3_fin = " AND tag_3 ='" . $tag_3 . "'";
      } else {
        $tag_3_fin = '';
      }
      ///////////////////////////////////////
      if ($type != '') {
        $type_fin = " AND type = '" . $type . "'";
      } else {
        $type_fin = '';
      }

      $search_where = " WHERE NOT category='international'
                " . $type_fin . "
                " . $tag_1_fin . "
                " . $tag_2_fin . "
                " . $tag_3_fin . "             
                 AND (tag_1 =N'$tag_id'
                 OR tag_2 =N'$tag_id'
                 OR tag_3 =N'$tag_id')
                 
                 ";

      // Total data row count in the database
      $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM `news`");
      $stmt->execute();
      $dt_c = $stmt->fetch();
      $data_count = $dt_c['numrows'];

      // Number of page buttons
      $page_btn_count = ($data_count > 0 && intval($length) > 0) ? ceil($data_count / $length) : 1;

      // Setting up pagination query :: uses OFFSET and LIMIT clauses
      $offset = ($page > 0 && $length > 0) ? $page * $length : 0;
      $paginate = "";
      if (intval($length) > 0)
        $paginate = " LIMIT {$length} OFFSET {$offset} ";

      // Data Query :: Fetching Query of data from database
      $sql = "SELECT * FROM `news` " . $search_where . " order by id desc {$paginate}";

      // Setting up url $_GET Data if display length and search keyword is set.
      $with_length = (isset($_GET['length'])) ? "&length=" . $_GET['length'] : 50;
      $with_search = (isset($_GET['search'])) ? "&search=" . $_GET['search'] : '';
      ?>
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
              <h3 class="card-title">Data scraped from scraping scripts.</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <div class='row d-flex justify-content-between'>
                <!-- Display Entries Length Select/Dropdown Block-->
                <div class="col-md-2">
                  <div class="input-group input-group-sm mb-3">
                    <select id="length" class="form-control select2bs4 w-100" onchange="
                    location.replace('auto_view.php?tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&length='+this.value)
                    ">
                      <option selected>Process Entries</option>
                      <option <?php echo (isset($_GET['length']) && $_GET['length'] == 500) ? 'selected' : '' ?>>500</option>
                      <option <?php echo (isset($_GET['length']) && $_GET['length'] == 1000) ? 'selected' : '' ?>>1000</option>
                      <option <?php echo (isset($_GET['length']) && $_GET['length'] == 2000) ? 'selected' : '' ?>>2000</option>
                      <option <?php echo (isset($_GET['length']) && $_GET['length'] == 3000) ? 'selected' : '' ?>>3000</option>
                      <option <?php echo (isset($_GET['length']) && $_GET['length'] == $data_count) ? 'selected' : '' ?> value="<?php echo $data_count ?>">All</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="input-group input-group-sm mb-3">
                    <select class="form-control select2bs4" id="inputGroupSelect04" onchange="
                    location.replace('auto_view.php?tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&type='+this.value)
     ">
                      <option selected disabled>Items</option>
                      <?php
                      $stmt = $conn->prepare("SELECT DISTINCT type FROM news");
                      $stmt->execute();
                      $type_fetch = $stmt->fetchAll();
                      foreach ($type_fetch as $row) {
                        if ($row['type'] == '') {
                          $item_type = 'News';
                          $item_type_value = '';
                        } else {
                          $item_type = $row['type'];
                          $item_type_value = $row['type'];
                        }

                        echo '<option value="' . $item_type_value . '"';

                        echo (isset($_GET['type']) && $_GET['type'] == $item_type_value) ? 'selected' : '';

                        echo '>' . $item_type . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>


                <div class="col-md-2">
                  <div class="input-group input-group-sm mb-3">
                    <select class="form-control select2bs4" id="inputGroupSelect01" onchange="
                    location.replace('auto_view.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_1='+this.value)
     ">
                      <option selected>Tag 1</option>
                      <?php
                      $stmt = $conn->prepare("SELECT DISTINCT tag_1 FROM news");
                      $stmt->execute();
                      $tag_1_fetch = $stmt->fetchAll();
                      foreach ($tag_1_fetch as $row) {
                        if ($row['tag_1'] == '') {
                          $item_tag_1 = 'NO TAG 1';
                          $item_tag_1_value = '';
                        } else {
                          $item_tag_1 = $row['tag_1'];
                          $item_tag_1_value = $row['tag_1'];
                        }

                        echo '<option value="' . $item_tag_1_value . '"';

                        echo (isset($_GET['tag_1']) && $_GET['tag_1'] == $item_tag_1_value) ? 'selected' : '';

                        echo '>' . $item_tag_1 . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group input-group-sm mb-3">
                    <select class="form-control select2bs4" id="inputGroupSelect03" onchange="
                    location.replace('auto_view.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2='+this.value)
     ">
                      <option selected disabled>Tag 2</option>
                      <?php
                      $stmt = $conn->prepare("SELECT DISTINCT tag_2 FROM news");
                      $stmt->execute();
                      $tag_2_fetch = $stmt->fetchAll();
                      foreach ($tag_2_fetch as $row) {
                        if ($row['tag_2'] == '') {
                          $item_tag_2 = 'NO TAG 2';
                          $item_tag_2_value = '';
                        } else {
                          $item_tag_2 = $row['tag_2'];
                          $item_tag_2_value = $row['tag_2'];
                        }

                        echo '<option value="' . $item_tag_2_value . '"';

                        echo (isset($_GET['tag_2']) && $_GET['tag_2'] == $item_tag_2_value) ? 'selected' : '';

                        echo '>' . $item_tag_2 . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group input-group-sm mb-3">
                    <select class="form-control select2bs4" id="inputGroupSelect02" onchange="
                    location.replace('auto_view.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_3='+this.value)
     ">
                      <option selected disabled>Tag 3</option>
                      <?php
                      $stmt = $conn->prepare("SELECT DISTINCT tag_3 FROM news");
                      $stmt->execute();
                      $tag_3_fetch = $stmt->fetchAll();
                      foreach ($tag_3_fetch as $row) {
                        if ($row['tag_3'] == '') {
                          $item_tag_3 = 'NO TAG 3';
                          $item_tag_3_value = '';
                        } else {
                          $item_tag_3 = $row['tag_3'];
                          $item_tag_3_value = $row['tag_3'];
                        }

                        echo '<option value="' . $item_tag_3_value . '"';

                        echo (isset($_GET['tag_3']) && $_GET['tag_3'] == $item_tag_3_value) ? 'selected' : '';

                        echo '>' . $item_tag_3 . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class=" mb-3">
                    <button class="btn btn-warning" onclick="location.replace('auto_view.php')"><i class="fa fa-undo" aria-hidden="true"></i></button>
                  </div>
                </div>
                <!-- End Display Entries Length Select/Dropdown Block-->
                <!-- Search Block -->

                <!-- End of Search Block -->
              </div>



              <table id="scrapedData" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Date</th>

                    <th>Title</th>
                    <th>Link</th>
                    <th>Content type (Main)</th>
                    <th>Content type (2nd)</th>

                    <th>Image</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Subnavigation</th>
                    <th>Block type</th>
                    <th>Block name</th>
                    <th>Tag 1</th>
                    <th>Tag 2</th>
                    <th>Tag 3</th>
                    <th>Last seen</th>
                    <th>Clicks</th>
                    <th>Relevancy</th>
                    <th>Evaluation</th>
                    <th>Stats</th>
                    <th>Broken Links</th>
                    <th>Author 1</th>
                    <th>Author 2</th>
                    <th>Author 3</th>
                    <th>Source</th>
                    <th>Uploader</th>
                    <th>Status</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  /*
                  $conn = $pdo->open();
                  $stmt = $conn->prepare("SELECT * FROM news " . $search_where . " ORDER BY id DESC LIMIT {$length}");
                  $stmt->execute();
                  $scrape = $stmt->fetchAll();
                  foreach ($scrape as $row) {
                    if ($row['hide_status'] == 2) {
                      $status = '<div class="badge badge-success">NOT HIDDEN</div>';
                    } elseif ($row['hide_status'] == 1) {
                      $status = '<div class="badge badge-warning">HIDDEN PARTIALLY</div>';
                    } elseif ($row['hide_status'] == 0) {
                      $status = '<div class="badge badge-danger">FULLY HIDDEN</div>';
                    }

                    if ($row['input'] == 'manual') {
                      $uploader = '<div class="badge badge-danger">ADMINISTRATION</div>';
                    } else {
                      $uploader = '<div class="badge badge-primary">SCRAPE</div>';
                    }
                    $data1 = '
                    <tr style="font-size:14px">
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['time'] . '</td>
                     <td><div style="width:250px; overflow-y:hidden">' . $row['title'] . '</div></td>
                    <td><a href="' . $row['deep_link'] . '" class="btn btn-info btn-sm" target="_blank">Deep Link</a></td>
                    <td>Text</td>
                    <td>' . $row['type'] . '</td>
                    <td><img src="' . $row['photo_url'] . '" height="50px" /></td>
                   <td>' . $row['category'] . '</td>
                   <td>' . $row['sub_1'] . '</td>
                   <td>' . $row['sub_2'] . '</td>
                   <td>News</td>
                   <td></td>
                   <td>' . $row['tag_1'] . '</td>
                   <td>' . $row['tag_2'] . '</td>
                   <td>' . $row['tag_3'] . '</td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><a class="btn btn-info btn-sm" href="article_stats.php?id=' . $row['id'] . '">STATS</a></td>
                   <td></td>
                   <td>' . $row['author'] . '</td>
                   <td></td>
                   <td></td>
                    <td>' . $row['source'] . '</td>
                    <td>' . $uploader . '</td>
                    <td>' . $status . '</td>
         
          <td>
                     <div class="dropdown">
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                     Admin action
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="pending_news.php?id=' . $row['id'] . '&cnt=scrap">Edit article</a>
                    <a class="dropdown-item" href="article/article_action.php?action=2&id=' . $row['id'] . '">Unhide</a>
                    <a class="dropdown-item" href="article/article_action.php?action=1&id=' . $row['id'] . '">Hide partially</a>
                    <a class="dropdown-item" href="article/article_action.php?action=0&id=' . $row['id'] . '">Hide fully</a>
                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#myModal' . $row['id'] . '">Delete article</a>
                 </div>
  
                 <!-- The Modal -->
                 <div class="modal" id="myModal' . $row['id'] . '">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Deleting article</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                           <div class="modal-body text-center">
       
                             <div class="callout callout-info">
                              <h4 class="text-danger"> Are you sure you want to completely delete this article?</h4>
            
                                ' . $row['title'] . '
                            </div>
        
                           </div>
                         
                           <!-- Modal footer -->
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                  <a type="button" class="btn btn-success" href="article/article_delete.php?id=' . $row['id'] . '">Yes</a>
                               </div>

                    </div>
                 </div>
               </div>
             </div>
          </td>
                  </tr>
  
   ';
                  }
                  */
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