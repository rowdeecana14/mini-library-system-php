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
  <title>List of book | MLS</title>
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
              <li class="breadcrumb-item active">List of book</li>
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

          <div class="col-12">

            <div class="card card-default collapsed-card">
              <div class="card-header">
                <h3 class="card-title">
                  <div class=" d-flex">
                    <div>
                      <img src="../../../img/book_search.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1" style="font-weight: bold">ADVANCE FILTER</div> 
                  </div>
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
                        <label for="genre">STATUS: </label>
                        <select class="form-control filter-option" id="status" name="status" style="width: 100%;">
                          <option value="" selected="selected" disabled>Select status</option>
                          <option value="Rented">Rented</option>
                          <option value="Available">Available</option>
                          <option value="Deactivated">Deactivated</option>
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
                <h3 class="card-title">
                  <div class=" d-flex">
                    <div>
                      <img src="../../../img/book_inventory.jpg" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1" style="font-weight: bold">LIST OF BOOK</div> 
                  </div>
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
                            <th width="1%">#</th>
                            <th width="10%">ISBN</th>
                            <th width="25%">TITLE</th>
                            <th width="15%">AUTHOR</th>
                            <th width="15%">GENRE</th>
                            <th width="5%">PAGES</th>
                            <th width="10%">FEES</th>
                            <th width="10%">STATUS</th>
                            <th width="5%">ACTION</th>
                        </thead>
                        <tbody class='tbody-book'>
                          <tr>
                            <td colspan='8' class="text-center">NO RECORDS AVAILABLE</td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                      <div class="row mt-4">
                        <div class="col-xs-12 col-md-6">
                          <p id='p-total-list'>Showing 51 to 57 of 57 entries</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                          <div class="btn-group pull-right ">
                            <button type="button" class="btn btn-outline-info" id="btn-prev"><i class="fa fa-angle-double-left"></i> Prev</button>
                            <button type="button" class="btn btn-outline-info" id="btn-next">Next <i class="fa fa-angle-double-right"></i> </button>
                          </div>
                        </div>
                      </div>
                      
                    <!-- /.card-body -->

                   <div class="card-footer">
                    
                  </div>
                </div>
                <!-- /.row -->
              </div>
             <!--   <div class="overlay dark">
                  <i class="fa fa-refresh fa-spin" style="font-size: 100px;"></i>
                </div> -->
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
  $('[data-toggle="tooltip"]').tooltip();   
  $('#book-index').addClass('active');
  $('#book-menu-open').addClass('menu-open');
  $('#book-index-item').addClass('active');
   //Initialize Select2 Elements
  $('.select2').select2()

  let data = {};
  let LIMIT = 10;
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

  $('.filter-option').change(function() {
    let genre = $('#genre').val();
    let author = $('#author').val();
    let status = $('#status').val();

    if(genre == null) {
      genre = '';
    }

    if(author == null) {
      author = '';
    }

    if(status == null) {
      status = '';
    }

    getFilter(genre, author, status);
  });

  function loadInit() {
    try {
      var query =  CRUD;
      query.path = '../../controller/book.php';
      query.param = { action: 'list' };
      var response = query.run();
      response = JSON.parse(response);
      data = response.my_data;
      displayList(prev, next);
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
        if(data[i].status == 'Available') {
          status = '<span class="badge bg-primary p-1">AVAILABLE</span>';
          book_status = 'AVAILABLE';
        }
        else if(data[i].status == 'Rented') {
          status = '<span class="badge bg-success">RENTED</span>';
          book_status = 'RENTED';
        }
        else {
          status = '<span class="badge bg-danger">DEACTIVATED</span>';
          book_status = 'DEACTIVATED';
        }

        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + data[i].isbn + '</td>\
            <td>' + data[i].title + '</td>\
            <td>' + data[i].author + '</td>\
            <td>' + data[i].genre + '</td>\
            <td class="text-center">' + data[i].pages + '</td>\
            <td>' + data[i].fee + '</td>\
            <td id="status_id_'+ data[i].book_id + '">' + status + '</td>\
            <td>\
              <div class="btn-group float-right">\
                  <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">\
                    <i class="fa fa-list-ul"></i>\
                    Option\
                  </button>\
                  <ul class="dropdown-menu" style="margin-left: -45px;">\
                    <li><a class="dropdown-item" href="edit_book.php? id='+data[i].book_id +'"><i class="fa fa-edit"></i> Edit book</a></li>\
                    <li><a class="dropdown-item" href="view_book.php? id='+ data[i].book_id +'"><i class="fa fa-eye"></i> View book</a></li>\
                    <li><a class="dropdown-item" onclick=activateDeactivate("'+data[i].book_id+'","activate","'+book_status+'") style="cursor:pointer"><i class="fa fa-refresh"></i> Activate</a></li>\
                    <li><a class="dropdown-item" onclick=activateDeactivate("'+data[i].book_id+'","deactivated","'+book_status+'")  style="cursor:pointer"><i class="fa fa-trash"></i> Deactivate</a></li>\
                  </ul>\
                </div>\
            </td>\
          </tr>\
        ';
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('.tbody-book').html(html);
    }
  }

  function activateDeactivate(id, category, book_status) {

    if(book_status == 'RENTED') {
      showError("You can't deactivate the rented book.");
      return;
    }

    try {
     
      let query =  CRUD;
      let response = {};
      let status = '';
      query.path = '../../controller/book.php';
      query.param =  {
        action: 'activate_deactivate',
        category: category,
        id: id
      };
      response = query.run();
      response = JSON.parse(response);

      if(response == false) {
        if(category == 'activate') {
          showSuccess('Record is succeffully activated.');
          status = '<span class="badge bg-primary p-1">AVAILABLE</span>';
        }
        else {
          showSuccess('Record is succeffully deactivated.');
          status = '<span class="badge bg-danger">DEACTIVATED</span>';
        }

        $('#status_id_'+id).html(status);
        
      }

    }
    catch(err) {
      showError('System error.')
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


  function getFilter(genre, author, status) {
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../../controller/book.php';
      query.param =  {
        action: 'filter',
        genre: genre,
        author: author,
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
      showError('System error.')
    }
  }
  
</script>
</body>
</html>
