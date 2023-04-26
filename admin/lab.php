<?php
include './includes/session.php';
$conn = $pdo->open();
 ?>
 <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables.js -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/datatables.min.js"></script>

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
                 
                </tbody>
              </table>

              <script>
  $(function() {
    $("#scrapedData").DataTable({
      // "responsive": true,
      //"processing": true,
      //"deferRender": true,
      "lengthChange": true,
      "autoWidth": false,
      //"stateSave": true,
      "lengthMenu": [50, 100, 200, 300, 400],
      "scrollCollapse": true,
      "search": {
        "smart": false,
        "select": 'single',
        "info": false,
        "keys": true
      },
      scroller: {
        loadingIndicator: true
      },
      "ajax": {
        "url": "./data_fetch.php",
        dataSrc: '',
        //"data": "data"
      },
      
      //*
      "columns": [

        {
          data: 'id'
        },
        {
          data: 'time'
        },
        {
          data: 'title',
          render: function(data, type, row) {
            return '<div style="width:250px; overflow-y:hidden">' + data + '</div>'; 
          }
        },
        {
          data: 'deep_link',
          render: function(data, type, row) {
            return '<a href="' + data + '" class="btn btn-info btn-sm" target="_blank">Deep Link</a>'; 
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: 'type'
        },
        {
          data: 'photo_url',
          render: function(data, type, row) {
            return '<img src="' + data + '" height="50px" />'; 
          }
        },
        {
          data: 'category'
        },
        {
          data: 'sub_1'
        },
        {
          data: 'sub_2'
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: 'tag_1'
        },
        {
          data: 'tag_2'
        },
        {
          data: 'tag_3'
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: 'id', 
          render: function(data, type, row) {
            return '<a class="btn btn-info btn-sm" href="article_stats.php?id=' + data + '">STATS</a>'; 
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: 'author'
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },
        {
          data: 'source'
        },
        {
          data: 'input',
          render: function(data, type, row) {
            return data === 'manual' ? '<div class="badge badge-danger">ADMINISTRATION</div>' : '<div class="badge badge-primary">SCRAPE</div>'; // Return 'ADMIN' if 'input' is 'manual', otherwise return 'USER'
          }
        },
        {
          data: 'hide_status',
          render: function(data, type, row) {
            if (data === '2') {
              return '<div class="badge badge-success">NOT HIDDEN</div>';
            }
            if (data === '1') {
              return '<div class="badge badge-warning">HIDDEN PARTIALLY</div>';
            }
            if (data === '0') {
              return '<div class="badge badge-danger">FULLY HIDDEN</div>';
            }
          }
        },
        {
          data: null,
          defaultContent: '', 
          render: function(data, type, row) {
            return ''; 
          }
        },

      ],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      //*/
    }).buttons().container().appendTo('#scrapedData_wrapper .col-md-6:eq(0)');

  });
</script>