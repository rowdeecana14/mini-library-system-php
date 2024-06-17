<?php 
  include_once("../../controller/auth.php");
  lesseeAuth();
  $data = userData();
  $user_image = '../../../img/upload/'.$data['image'];
  $fullname = ucwords(strtolower($data['first_name'].' '.$data['last_name']));
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Rent book | LMS</title>
  <link rel="shortcut icon" href="../../../img/lms-sm.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../template/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../../template/plugins/select2/css/select2.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../../template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../../template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="../../../template/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../../template/mycss/style.css">
  <!-- sweet alert -->
  <link href="../../../template/plugins/swa/dist/sweetalert.css" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition layout-navbar-fixed layout-footer-fixed layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-cyan">
    <div class="container">
    <a href="../" class="navbar-brand">
        <img src="../../../img/lms-sm.png" alt="AdminLTE Logo" class="brand-image"
             >
        <span class="brand-text font-weight-light">Library Management System</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a href="dashboard.php" class="nav-link"><i class="fa fa-home"></i> Home</a>
          </li>
         

          <li class="nav-item ">
            <a href="return_book.php" class="nav-link"><i class="fa fa-history"></i> Return </a>
          </li>

          <li class="nav-item dropdown active-link">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-copy"></i> Record</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li ><a href="rented_book.php" class="dropdown-item active"><i class="fa fa-circle-o"></i> Rented book </a></li>
              <li><a href="returned_book.php" class="dropdown-item"><i class="fa fa-circle-o"></i> Returned book</a></li>

            </ul>
          </li>
        </ul>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <span class="user-info">
              <img class="user-image" src="<?php echo $user_image; ?>"  alt="Users Photo">
              <label id="fullname"><?php echo $fullname; ?> <span class=" fa fa-angle-down"></span></label>
            </span>
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
            <h6 class=" ml-4 mt-2">Settings</h6>
          <div class="dropdown-divider"></div>
            <a href="myaccount.php" class="dropdown-item">
              <i class="fa fa-user mr-2"></i> My account
            </a>
            <div class="dropdown-divider"></div>
            <a href="../../controller/logout.php" class="dropdown-item">
              <i class="fa fa-sign-out mr-2"></i> Logout
            </a>
          </div>

        </li>
      </ul>


    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container ">

        <div class="card card-default collapsed-card">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-filter"></i> Advance filter
            </h3>

            <div class="card-tools">
             <button type="button" class="btn btn-outline-info" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
              <button type="button" class="btn btn-outline-info" data-card-widget="collapse" data-toggle="tooltip" data-placement="top" title="Show or hide"><i class="fa fa-plus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: none;">
            <form id="form-filter">
              <div class="row col-10 offset-1">

                <div class="col-md-4 col-xs-12">

                   <div class="form-group">
                      <label for="date">DATE RETURNED: </label>
                      <input type="date" class="form-control filter-option" id="date" name="date" placeholder="Date returned" required>
                    </div>
                </div>


                <div class="col-md-4 col-xs-12">

                   <div class="input-group mb-4">
                    <label for="genre">GENRE: </label>
                    <select class="form-control select2 filter-option" id="genre" name="genre"  style="width: 100%;">
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-xs-12">

                   <div class="input-group  mb-4">
                    <label for="category">STATUS: </label>
                    <select class="form-control filter-option" id="status" name="status"  style="width: 100%;">
                      <option value="" selected disabled>Select status</option>
                      <option>Ondate</option>
                      <option>Overdue</option>
                    </select>
                  </div>
                </div>

              </div>
            </form>
            <!-- /.row -->
          </div>
        </div>


        <div class="card">
              <div class="card-header">
                <h5 class="card-title">
                  <div class=" d-flex">
                    <div>
                      <img src="../../../img/book_list.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">Returned book</div> 
                  </div>
                </h5>
                 <div class="card-tools">
                  <div class="input-group input-group-md" style="width: 300px;">
                    <input type="text" name="search-book" id="search-book" class="form-control float-right input-bg" placeholder="SEARCH HERE">

                    <div class="input-group-append">
                      <button type="button" class="btn btn-default" id="search-book-icon"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
           
                <div class="col-12 ">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered">
                            <thead>   
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Pages</th>

                                <th>Rent fee</th>
                                <th>Date rented</th>
                                <th>Date returned</th>
                                <th>Status</th>
                            </thead>
                            <tbody class='tbody-book'>
                               
                            </tbody>
                          </table>
                      </div>
                      <div class="row mt-4">
                        <div class="col-xs-12 col-md-6">
                          <p id='p-total-list'></p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                          <div class="btn-group pull-right ">
                            <button type="button" class="btn btn-outline-info" id="btn-prev"><i class="fa fa-angle-double-left"></i> Prev</button>
                            <button type="button" class="btn btn-outline-info" id="btn-next">Next <i class="fa fa-angle-double-right"></i> </button>
                          </div>
                        </div>
                      </div>
                </div>
              </div><!-- /.card-body -->
            </div>

        

      </div>

    </div>
    <!-- /.content -->
     <a id="back-to-top" href="#" class="btn btn-primary back-to-top" style="margin-bottom: 3%" role="button" aria-label="Scroll to top">
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
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline" style="margin-right: 60px">
      Version 1.0
    </div>
    <!-- Default to the left -->
    <strong class="ml-5">Copyright &copy; 2019-2020 <a href="">LIBRARY MANAGEMENT SYSTEM</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../../template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../../template/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- AdminLTE App -->
<script src="../../../template/dist/js/adminlte.min.js"></script>
<!-- CRUD JS -->
<script src="../../../template/myjs/crud.js"></script>
<!-- sweet alert JS -->
<script src="../../../template/plugins/swa/dist/sweetalert.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="../../../template/plugins/select2/js/select2.full.min.js"></script>
<script src="../../../template/plugins/moment/moment.min.js"></script>

<script type="text/javascript">
  $('[data-toggle="tooltip"]').tooltip();
  $('.select2').select2();
  let data = {}; 
  let LIMIT = 10;
  let PREVIUS_CONSTANT = 0;
  let NEXT_CONSTANT = LIMIT;
  let prev = PREVIUS_CONSTANT;
  let next = NEXT_CONSTANT;
  let my_rent_no = '';
  loadInit();
  loadFilter();
  
  $(document).ready(function(){
    $('#form-index').addClass('active');
    $('#form-menu-open').addClass('menu-open');
    $('#form-add-rented-item').addClass('active');

  
    $('#btn-refresh').click(function() {
      $('#form-filter')[0].reset();
      $('#search-user').val('');
      loadInit();
      loadFilter();
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

    $('.filter-option').change(function() {
      let genre = $('#genre').val();
      let date = $('#date').val();
      let status = $('#status').val();

      if(genre == null) {
        genre = '';
      }

      if(date == null || date == "") {
        date = ''; 
      }

      if(status == null) {
        status = '';
      }
      getFilter(date, genre, status);
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
                <td colspan="9" class="text-center">NO RECORDS AVAILABLE</td>\
              </tr>\
            ');
        }

        setTimeout(function() {
            $("#search-book-icon").html("<span class='fa fa-search' ></span>");
        }, 2000);
    });

  });


  function loadInit() {
    try {
      let query =  CRUD;
      let response = [];
      query.path = '../../controller/rent.php';
      query.param = { action: 'lessee-returned-list' };
      response = query.run();
      response = JSON.parse(response);
      data = response;
      console.log(response);
      displayList(prev, next);
    }
    catch(err) {
      showError('System error.');
      console.log(err);
    }
  }

  function displayList(prev, next) {
    let html = '';
    let status = '';

    if(data.length == 0) {
      $(".tbody-book").html('\
        <tr>\
          <td colspan="9" class="text-center">NO RECORDS AVAILABLE</td>\
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

    if(data.length > prev) {
      for(let i = prev; i < next; i++) {
       
       if(data[i].date_diff > 0) {
        status = '<span class="badge bg-warning p-2">OVERDUE</span>';
       }
       else {
        status = '<span class="badge bg-success p-2">ONDATE</span>';
       }

        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + data[i].title + '</td>\
            <td>' + data[i].author + '</td>\
            <td>' + data[i].genre + '</td>\
            <td class="text-center">' + data[i].pages + '</td>\
            <td>' + data[i].fee +'</td>\
            <td>' + data[i].rent_date +'</td>\
            <td>' + data[i].return_date +'</td>\
            <td>' + status +'</td>\
          </tr>\
        ';
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('.tbody-book').html(html);
    }
  }


  function loadFilter() {
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../../controller/book.php';
      query.param =  {
        action: 'load'
      };
      response = query.run();
      response = JSON.parse(response);

      loadAuthor(response.author);
      loadGenre(response.genre);

    }
    catch(err) {
      console.log(err);
      showError('System error.')
    }
  }

  function loadAuthor(response) {

    let len = response.length;
    let html = '<option value="" selected disabled>Select author</option>';

    for(var i = 0; i < len; i++) {
      html += '<option value="'+response[i].author_id+'">' + response[i].author + '</option>';
    }

    $('#author').html(html);
  }

  function loadGenre(response) {
    let len = response.length;
    let html = '<option value="" selected disabled>Select genre</option>';

    for(var i = 0; i < len; i++) {
      html += '<option value="'+response[i].genre_id+'">' + response[i].genre + '</option>';
    }

    $('#genre').html(html);
  }


  function getFilter(date, genre, status) {
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../../controller/rent.php';
      query.param =  {
        action: 'filter-lessee-return',
        genre: genre,
        date: date,
        status: status
      };
      response = query.run();
      response = JSON.parse(response);
      data = response;
      prev = PREVIUS_CONSTANT;
      next = NEXT_CONSTANT;

      displayList(prev, next);
      console.log(response);
    }
    catch(err) {
      console.log(err);
      showError('System error.')
    }
  }


</script>
</body>
</html>
