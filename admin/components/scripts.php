<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- jQuery -->
<script src="../bower/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../bower/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Sparkline -->
<script src="../bower/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../bower/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../bower/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower/plugins/moment/moment.min.js"></script>
<script src="../bower/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../bower/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../bower/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../bower/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../bower/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../bower/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../bower/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="../bower/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../bower/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../bower/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../bower/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../bower/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../bower/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../bower/plugins/jszip/jszip.min.js"></script>
<script src="../bower/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../bower/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../bower/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../bower/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../bower/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="../bower/plugins/chart.js/Chart.min.js"></script>
<!-- Ekko Lightbox -->
<script src="../bower/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="../bower/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../bower/plugins/moment/moment.min.js"></script>
<script src="../bower/plugins/fullcalendar/main.js"></script>
<!-- CK Editor -->
<script src="../bower/ckeditor/ckeditor.js"></script>
<script>
  $(function() {
    //CK Editor
    var mathElements = [
      'math',
      'maction',
      'maligngroup',
      'malignmark',
      'menclose',
      'merror',
      'mfenced',
      'mfrac',
      'mglyph',
      'mi',
      'mlabeledtr',
      'mlongdiv',
      'mmultiscripts',
      'mn',
      'mo',
      'mover',
      'mpadded',
      'mphantom',
      'mroot',
      'mrow',
      'ms',
      'mscarries',
      'mscarry',
      'msgroup',
      'msline',
      'mspace',
      'msqrt',
      'msrow',
      'mstack',
      'mstyle',
      'msub',
      'msup',
      'msubsup',
      'mtable',
      'mtd',
      'mtext',
      'mtr',
      'munder',
      'munderover',
      'semantics',
      'annotation',
      'annotation-xml'
    ];

    CKEDITOR.plugins.addExternal('ckeditor_wiris', 'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/plugins/ckeditor_wiris/', 'plugin.js');

    CKEDITOR.replace('editor1', {
      extraPlugins: 'colordialog,tableresize,embed,autoembed,image2,colorbutton,colordialog,ckeditor_wiris',
      height: 470,

      // Load the default contents.css file plus customizations for this sample.
      contentsCss: [
        'http://cdn.ckeditor.com/4.18.0/full-all/contents.css',
        'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
      image2_disableResizer: true,
    })
  });
</script>
<script>
  $(function() {
    // Function to create Bootstrap modal
    function createBootstrapModal(id) {
      // Create modal HTML
      var modalHTML = '<div class="modal" tabindex="-1" role="dialog">' +
        '<div class="modal-dialog" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h5 class="modal-title">Deleting article</h5>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>' +
        '<div class="modal-body">' +
        ' <div class="callout callout-info">' +
        '<h4 class="text-danger"> Are you sure you want to completely delete this article?</h4>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>' +
        '<a type="button" class="btn btn-success" href="article/article_delete.php?id=' + id + '">Yes</a>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

      // Append modal HTML to the body
      $('body').append(modalHTML);

      // Add onclick event listener to the modal button

      // Toggle the modal
      $('.modal').modal('toggle');

    }

    function toggleBootstrapModal(title, body, footer) {
      // Set the modal title, body, and footer
      $('.modal-title').text(title);
      $('.modal-body').html(body);
      $('.modal-footer').html(footer);

      // Toggle the modal
      $('#myModal').modal('toggle');
    }

    var myTitle = 'My Modal Title';
    var myBody = '<p>My modal body content goes here.</p>';
    var myFooter = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';


    $("#scrapedData").DataTable({
      // "responsive": true,
      "processing": true,
      "deferRender": true,
      "lengthChange": true,
      "autoWidth": false,
      "stateSave": true,
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
        "url": "./data_fetch.php?query=<?php echo urlencode($search_where) ?>",
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
            return 'Text';
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
            return 'News';
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
          defaultContent: '',
          render: function(data, type, row) {
            if (data === 2) {
              return '<div class="badge badge-success">NOT HIDDEN</div>';
            }
            if (data === 1) {
              return '<div class="badge badge-warning">HIDDEN PARTIALLY</div>';
            }
            if (data === 0) {
              return '<div class="badge badge-danger">FULLY HIDDEN</div>';
            }
          }
        },
        {
          data: 'id',
          defaultContent: '',
          render: function(data, type, row) {

            return '<div class="dropdown">' +
              '<button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">' +
              'Admin action' +
              '</button>' +
              '<div class="dropdown-menu">' +
              '<a class="dropdown-item" href="pending_news.php?id=' + data + '&cnt=scrap">Edit article</a>' +
              '<a class="dropdown-item" href="article/article_action.php?action=2&id=' + data + '">Unhide</a>' +
              '<a class="dropdown-item" href="article/article_action.php?action=1&id=' + data + '">Hide partially</a>' +
              '<a class="dropdown-item" href="article/article_action.php?action=0&id=' + data + '">Hide fully</a>' +
              '<a class="dropdown-item" type="button" onclick="'+toggleBootstrapModal('My Modal Title', '<p>My modal body content goes here.</p>', '<button type=&quot;button&quot; class=&quot;btn btn-secondary&quot; data-dismiss=&quot;modal&quot;>Close</button>')+'"">Delete article</a>' +
              '</div>';
          }
        },

      ],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      //*/
    }).buttons().container().appendTo('#scrapedData_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "stateSave": true,
      "lengthMenu": [50, 100, 200, 300, 400],
      "scrollCollapse": true,
      "search": {
        "smart": false,
        "select": 'single',
        "info": false
      },
      //"responsive": true,
      "keys": true,
    });
  });
</script>
<!-- Select2 -->
<script src="../bower/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../bower/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../bower/plugins/moment/moment.min.js"></script>
<script src="../bower/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- bootstrap color picker -->
<script src="../bower/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../bower/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../bower/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../bower/plugins/dropzone/min/dropzone.min.js"></script>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({
      tags: true,
      tokenSeparators: [',', ' ']
    })

    //Initialize Select3 Elements
    $('.select3').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({
      icons: {
        time: 'far fa-clock'
      }
    });

    //Date and time picker
    $('#reservationdatetimeT').datetimepicker({
      icons: {
        time: 'far fa-clock'
      }
    });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/file/post", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    maxFiles: 1,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    paramName: "image", // The name that will be used to transfer the file
    maxfilesexceeded: function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'error',
        title: 'Maximum files allowed is 1.'
      })
    },
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() {
      myDropzone.enqueueFile(file)
    }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<!-- Summernote -->
<script src="../bower/plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="../bower/plugins/codemirror/codemirror.js"></script>
<script src="../bower/plugins/codemirror/mode/css/css.js"></script>
<script src="../bower/plugins/codemirror/mode/xml/xml.js"></script>
<script src="../bower/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script>
  $(function() {
    // Summernote
    $('#summernote').summernote()
    $('#summernote2').summernote()
    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>