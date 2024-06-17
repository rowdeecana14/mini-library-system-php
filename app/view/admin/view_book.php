<?php 
  include_once("../../controller/auth.php");
  adminAuth();
  $data = userData();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <title>View book | LMS</title>
 <?php
    include '../include/header.php';
  ?>
</head>
<body class="sidebar-mini layout-navbar-fixed sidebar-open">
<div class="wrapper">

  <!-- Navbar -->
  <?php  include '../include/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php  include '../include/panel.php'; ?>
  <!-- /.panel -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View book</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">
                  <div class=" d-flex">
                    <div>
                      <img src="../../../img/book_details.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">View book</div> 
                  </div>
                </h5>

              
                <div class="btn-group float-right">
                  <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-list-ul"></i>
                    Option
                  </button>
                  <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -2px, 0px); margin-left: -60px">
                    <li><a class="dropdown-item" href="edit_book.php? id=<?php echo $_GET['id']; ?>"><i class="fa fa-edit"></i> Edit book</a></li>
                    <li><a class="dropdown-item" href="list_of_book.php"><i class="fa fa-table"></i> List of books</a></li>
                  </ul>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 col-xs-12">

                      <!-- Profile Image -->
                      <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <img style="padding: 3px; border: 3px solid #b1b5b9;" width="200px" height="230px" src="../../../img/unknown.png" alt="User profile picture" id="image-detail">
                          </div>
                         
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                      <!-- About Me Box -->
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><i class="fa fa-book"></i> Book details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <strong  class="strong-font"><i class="fa fa-circle-o mr-1  "></i> ISBN</strong>
                          <p class="text-muted ml-3 mb-1" id="isbn-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> TITLE</strong>
                          <p class="text-muted ml-3 mb-1" id="title-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0"><hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> SUMMARY</strong>
                          <p class="text-muted ml-3 mb-1" id="summary-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> PAGES</strong>
                          <p class="text-muted ml-3 mb-1" id="pages-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> AUTHOR</strong>
                          <p class="text-muted ml-3 mb-1" id="author-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> GENRE</strong>
                          <p class="text-muted ml-3 mb-1" id="genre-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> FEES</strong>
                          <p class="text-muted ml-3 mb-1" id="fee-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> STATUS</strong>
                          <p class="text-muted ml-3 mb-1" id="status-detail">
                            535325-325235
                          </p>

                          <div id="due_date">
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->

                  <div class="col-md-9 col-xs-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-book"></i> Book card
                        </h3>
                        <div class="card-tools">
                          <div class="input-group input-group-md" style="width: 300px;">
                            <input type="text" name="search-book" id="search-book" class="form-control float-right input-bg" placeholder="SEARCH BOOK">

                            <div class="input-group-append">
                              <button type="button" class="btn btn-default" id="search-book-icon"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="col-12">

                            <div class="card-body table-responsive p-0">
                              <table class="table table-bordered">
                                  <thead>   
                                      <th>#</th>
                                      <th>Lessee name</th>
                                      <th>Date rented</th>
                                      <th>Date returned</th>
                                      <th>Status</th>
                                  </thead>
                                  <tbody class='tbody-book'>
                                    <tr>
                                      <td colspan='6' class="text-center">NO RECORDS AVAILABLE</td>
                                    </tr>
                                    
                                  </tbody>
                                </table>
                            </div>
                              <div class="row mt-4">
                                <div class="col-xs-12 col-md-6">
                                  <p id="p-total-list">Showing 0 to 0 of 0 entries</p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                  <div class="btn-group pull-right ">
                                    <button type="button" class="btn btn-outline-info" id="btn-prev" disabled="disabled"><i class="fa fa-angle-double-left"></i> Prev</button>
                                    <button type="button" class="btn btn-outline-info" id="btn-next" disabled="disabled">Next <i class="fa fa-angle-double-right"></i> </button>
                                  </div>
                                </div>
                              </div>
                              
                            <!-- /.card-body -->

                           <div class="card-footer">
                            
                          </div>
                        </div>
                        <!-- /.row -->
                      </div>
                    
                    </div>

                  </div>
                </div>
                <!-- /.row -->
              </div>
              
            </div>
          </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include '../include/footer.php'; ?>
  <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php include '../include/js.php'; ?>
<script src="../../../template/plugins/moment/moment.min.js"></script>
<script type="text/javascript">
  let data = {};
  let LIMIT = 10;
  let PREVIUS_CONSTANT = 0;
  let NEXT_CONSTANT = LIMIT;
  let prev = PREVIUS_CONSTANT;
  let next = NEXT_CONSTANT;
   loadBook();
  loadInit('');


  $(document).ready(function(){
    
     //Initialize Select2 Elements
    $('.select2').select2();

     

    $('#btn-refresh').click(function() {
      $('#form-filter')[0].reset();
      $('#search-user').val('');
      loadInit();
      $('.select2').select2()
    });

    $('#btn-next').click(function() {
      prev = next;
      next += LIMIT;
      displayList(prev, next);
    });

    $('#btn-prev').click(function() {
      prev -= LIMIT;
      next -= LIMIT;
      displayList(prev, next);
    });


    $('#search-book').keyup(function() {
        $("#search-book-icon").html("<span class='fa fa-spinner fa-spin'></span>");
        if($(this).val() == '') {
            displayList(prev, next);
         }


        var rex = new RegExp($(this).val(), 'i');
        $('.tbody-book tr').hide();
        $('.tbody-book tr').filter(function() {
            return rex.test($(this).text());
        }).show();

        
         var total_book = $('.tbody-book tr').length;
         var rows = $('.tbody-book tr:hidden').length;

         $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + (prev + (total_book - rows)) + ' of ' + data.length + ' entries');

         if(rows == total_book) {
            $(".tbody-book").html('\
              <tr>\
                <td colspan="8" class="text-center">NO RECORDS AVAILABLE</td>\
              </tr>\
            ');
        }

        setTimeout(function() {
            $("#search-book-icon").html("<span class='fa fa-search' ></span>");
        }, 2000);
    });
  });

 

  function loadInit(view) {
     try {
      let param = {
        action: 'admin-view-book',
        book_id: '<?php echo $_GET['id']; ?>'
      };
      let  response = [];
      let query =  CRUD;

      query.path = '../../controller/rent.php';
      query.param =  param;
      response = query.run();
      response = JSON.parse(response);
      data = response;
      displayList(prev, next);
      console.log(data)
     
    }
    catch(err) {
      showError('System error.')
    }
  }



  function displayList(prev, next) {
    let html = '';
    let status = '';
    let book_status = '';

    if(data.length == 0) {
      $(".tbody-book").html('\
        <tr>\
          <td colspan="8" class="text-center">NO RECORDS AVAILABLE</td>\
        </tr>\
      ');
      $('#p-total-list').text('Showing ' + 0 + ' to ' + 0 + ' of ' + data.length + ' entries');
    }

    if(next > data.length) {
      next = data.length;
      $("#btn-next").attr("disabled", "disabled");
    }
    else {
      $("#btn-next").removeAttr("disabled", "disabled");
    }

    if(prev <= 0) {
      $("#btn-prev").attr("disabled", "disabled");
    }
    else {
      $("#btn-prev").removeAttr("disabled", "disabled");
    }
    console.log(data.length)
    if(data.length > prev) {
      for(let i = prev; i < next; i++) {
      if(data[i].diff_date > 0) {
        status = '<span class="badge bg-warning p-2">OVERDUE</span>';
       }

       else {
        status = '<span class="badge bg-success p-2">ONDATE</span>';
       }

        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
             <td>' + data[i].first_name + ' ' + data[i].last_name + '</td>\
              <td>' + data[i].rent_date + '</td>\
              <td>' + data[i].return_date + '</td>\
              <td>' + status + '</td>\
          </tr>\
        ';
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('.tbody-book').html(html);
    }
  }


  
  function loadBook() {
    try {
      let query =  CRUD;
      let response = {};
      query.path = '../../controller/book.php';
      query.param = {
        action: 'load_book',
        book_id: '<?php echo $_GET['id']; ?>'
      };
      response = query.run();
      response = JSON.parse(response);
      viewBook(response);
    }
    catch(error) {
      showError('System error.')
    }
  }


  function viewBook(response) {
    author_global = response[0].author;
    genre_global = response[0].genre;
    $('#isbn').val(response[0].isbn);
    $('#title').val(response[0].title);
    $('#summary').val(response[0].summary);
    $('#pages').val(response[0].pages);
    $('#fee').val(response[0].fee);


    if(response[0].isbn == '') {
      response[0].isbn = '--------------------';
    }

    if(response[0].title == '') {
      response[0].title = '--------------------';
    }

    if(response[0].summary == '') {
      response[0].summary = '--------------------';
    }

    if(response[0].pages == '') {
      response[0].pages = '--------------------';
    }

    if(response[0].fee == '') {
      response[0].fee = '--------------------';
    }

    if(response[0].author == '') {
      response[0].author = '--------------------';
    }

    if(response[0].genre == '') {
      response[0].genre = '--------------------';
    }


    $('#isbn-detail').text(response[0].isbn);
    $('#title-detail').text(response[0].title);
    $('#summary-detail').text(response[0].summary);
    $('#pages-detail').text(response[0].pages + ' page(s)');
    $('#fee-detail').html('<i class="fa fa-rub"></i> ' +response[0].fee);
    $('#author-detail').text(response[0].author);
    $('#genre-detail').text(response[0].genre);
    $('#status-detail').text(response[0].status);
    $('#image-detail').attr("src", '../../../img/upload/'+response[0].image);
    $('#image-preview').attr("src", '../../../img/upload/'+response[0].image);
    $('#modal-update-image').modal('hide');

    if(response[0].status == "Rented") {
      getDate();
    }
  }


  function getDate() {
    try {
      let query =  CRUD;
      let response = {};
      query.path = '../../controller/book.php';
      query.param = {
        action: 'get_date',
        book_id: '<?php echo $_GET['id']; ?>'
      };
      response = query.run();
      response = JSON.parse(response);

      $('#due_date').html(
        `<strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> DUE DATE:</strong>
          <p class="text-muted ml-3 mb-1" >
           ` + response + `
          </p>`
      );
    }
    catch(error) {
      showError('System error.')
    }
  }



</script>
</body>
</html>
