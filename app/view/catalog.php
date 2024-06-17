<?php 
  include_once("../controller/auth.php");
  loginAuth();
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

  <title>Catalog | LMS</title>
  <link rel="shortcut icon" href="../../img/lms-sm.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../template/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../template/plugins/select2/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../template/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../template/mycss/style.css">
  <!-- sweet alert -->
  <link href="../../template/plugins/swa/dist/sweetalert.css" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition layout-navbar-fixed layout-footer-fixed layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-cyan">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <img src="../../img/lms-sm.png" alt="AdminLTE Logo" class="brand-image"
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
            <a href="index.php" class="nav-link"><i class="fa fa-home"></i> Login</a>
          </li>
         
          <li class="nav-item">
            <a href="register.php" class="nav-link"><i class="fa fa-edit"></i> Register</a>
          </li>
           <li class="nav-item active-link">
            <a href="catalog.php" class="nav-link"><i class="fa fa-newspaper-o"></i> Catalog</a>
          </li>

        </ul>

    
      </div>


    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">

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

                       <div class="input-group mb-4">
                        <label for="genre">GENRE: </label>
                        <select class="form-control select2 filter-option" id="genre" name="genre"  style="width: 100%;">
                        </select>
                      </div>
                    </div>

                     <div class="col-md-4 col-xs-12">

                       <div class="input-group  mb-4">
                        <label for="genre">AUTHOR: </label>
                        <select class="form-control select2 filter-option" id="author" name="author"  style="width: 100%;">
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12">

                       <div class="input-group  mb-4">
                        <label for="category">CATEGORY: </label>
                        <select class="form-control filter-option" id="category" name="category"  style="width: 100%;">
                          <option value="" selected disabled>Select category</option>
                          <option>New</option>
                          <option>Old</option>
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
                <h5 class="card-title"><i class="fa fa-book"></i> Book catalog
                </h5>
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
                <div id="alert-message" class="col-md-12 col-xs-12" >
                                    
                </div>
                 <div class="row d-flex align-items-stretch" id='book-content'>
                  

                

                 </div>
                 <hr>
                  <div class="row mt-4" >
                    <div class="col-xs-12 col-md-6">
                      <p id='p-total-list'>Showing 51 to 57 of 57 entries</p>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="btn-group float-right">
                        <button type="button" class="btn btn-outline-info" id="btn-prev"><i class="fa fa-angle-double-left"></i> Prev</button>
                        <button type="button" class="btn btn-outline-info" id="btn-next">Next <i class="fa fa-angle-double-right"></i> </button>
                      </div>
                    </div>
                  </div>

              </div>
          </div>

      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container ">
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
<script src="../../template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../template/dist/js/adminlte.min.js"></script>
<!-- CRUD JS -->
<script src="../../template/myjs/crud.js"></script>
<!-- sweet alert JS -->
<script src="../../template/plugins/swa/dist/sweetalert.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="../../template/plugins/select2/js/select2.full.min.js"></script>
<script src="../../template/plugins/moment/moment.min.js"></script>
<script type="text/javascript">
  $('[data-toggle="tooltip"]').tooltip();
  $('.select2').select2();


  let data = {};
  let LIMIT = 30;
  let PREVIUS_CONSTANT = 0;
  let NEXT_CONSTANT = LIMIT;
  let prev = PREVIUS_CONSTANT;
  let next = NEXT_CONSTANT;
  loadInit();
  loadFilter();

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


  $('#search-book').keyup(function() {
      if($(this).val() == '') {
          loadInit();
      }
      else {
        searchBook($(this).val());
      }
  });

  $('.filter-option').change(function() {
    let genre = $('#genre').val();
    let author = $('#author').val();
    let category = $('#category').val();

    if(genre == null) {
      genre = '';
    }

    if(author == null) {
      author = ''; 
    }

    if(category == null) {
      category = '';
    }

    getFilter(genre, author, category);
  });


  function searchBook(value) {
    $("#search-book-icon").html("<span class='fa fa-spinner fa-spin'></span>");
    try {
      let query =  CRUD;
      let response = {};
      query.path = '../controller/book.php';
      query.param = { 
        action: 'input-search',
        search: value
      };
      response = query.run();
      response = JSON.parse(response);

      data = response;
      prev = PREVIUS_CONSTANT;
      next = NEXT_CONSTANT;

      displayList(prev, next);
      $("#search-book-icon").html("<span class='fa fa-search' ></span>");

    }
    catch(err) {
      showError('System error.')
    }
  }

  function loadInit() {
    try {
      var query =  CRUD;
      query.path = '../controller/book.php';
      query.param = { action: 'list-book-rent' };
      var response = query.run();
      response = JSON.parse(response);
      data = response;
      displayList(prev, next);
      //console.log(response);
    }
    catch(err) {
      showError('System error.')
    }
  }

  function displayList(prev, next) {
    let html = '';
    let category = '';
    let current_date = data.current_date;
    let rent_status = '';
    data = data.my_data
    console.log(data)

    if(data.length == 0) {
      $('#alert-message').html(`
          <div class="alert alert-warning" role="alert">
            <strong>
                <span class="fa fa-times-circle"></span> No records available.
              </strong>
            </div>
        `);
      $("#book-content").html('');
      $('#p-total-list').text('Showing ' + 0 + ' to ' + 0 + ' of ' + data.length + ' entries');
    }
    else {
      $('#alert-message').html('');
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

        if(data[i].created_at == current_date) {
          category = `
            <div class="ribbon bg-success">
                  New
            </div>`;
        }
        else {
          category = `
            <div class="ribbon bg-warning">
                  Old
            </div>`;
        }

        if(data[i].rent_status == 'Rented-process') {
          rent_status = '<span class="right badge badge-warning float-left p-2 pl-3 pr-3">Reserved</span>';
        }
        else if(data[i].rent_status == 'Rented' || data[i].rent_status == 'Returned-process' ) {
          rent_status = '<span class="right badge badge-success float-left p-2 pl-3 pr-3">Rented</span>';
        }
        else {
          rent_status = '<span class="right badge badge-info float-left p-2 pl-3 pr-3">Available</span>';
        }
        
        html += `
        <div class="col-xs-12 col-sm-12 col-md-4 d-flex align-items-stretch ">
            <div class="card bg-light book-item">
              <div class="card-header border-bottom-0" style="font-size: 18px; font-weight: bold"> 
              ` + data[i].title + `
              </div>
              <div class="ribbon-wrapper">
                ` + category + `
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <p class="text-muted text-sm"><b>Summary: </b> ` + data[i].summary + ` </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small li-small"><span class="fa-li"><i class="fa fa-circle-o"></i></span> <strong>Author</strong>: ` + data[i].author + `</li>
                      <li class="small li-small"><span class="fa-li"><i class="fa fa-circle-o"></i></span> <strong>Genre</strong>: ` + data[i].genre + `</li>
                      <li class="small li-small"><span class="fa-li"><i class="fa fa-circle-o"></i></span> <strong>Pages</strong>: ` + data[i].pages + `</li>
                       <li class="small li-small"><span class="fa-li"><i class="fa fa-circle-o"></i></span> <strong>ISBN</strong>: ` + data[i].isbn + `</li>
                      <li class="small li-small"><span class="fa-li"><i class="fa fa-circle-o"></i></span> <strong>Rent fee: </strong>Php ` + data[i].fee + `</li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="../../img/upload/` + data[i]['image'] + `" alt="" class="img-book img-thumbnail">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                ` + rent_status + `
                  <a href="../" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Add to bag
                  </a>
                </div>
              </div>
            </div>
          </div>`;
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('#book-content').html(html);
    }
  }

  
  function loadFilter() {
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../controller/book.php';
      query.param =  {
        action: 'load'
      };
      response = query.run();
      response = JSON.parse(response);

      loadAuthor(response.author);
      loadGenre(response.genre);

    }
    catch(err) {
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


  function getFilter(genre, author, category) {
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../controller/book.php';
      query.param =  {
        action: 'filter-catalog',
        genre: genre,
        author: author,
        category: category
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
      showError('System error.')
    }
  }
</script>
</body>
</html>
