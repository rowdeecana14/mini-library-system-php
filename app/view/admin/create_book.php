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
  <title>Add book | LMS</title>
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
              <li class="breadcrumb-item active">Add book</li>
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
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">
                  <div class=" d-flex">
                    <div>
                      <img src="../../../img/book_add.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1" style="font-weight: bold">ADD BOOK</div> 
                  </div>
                </h5>

              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-10 offset-1">
                  <form role="form" id="form-add-book">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="image">IMAGE: </label>
                        <input type="file" class="form-control" id="image" name="image" style="">
                      </div>
                      <div class="form-group">
                        <label for="isbn">ISBN: </label>
                        <input type="text" class="form-control input-lg" id="inputSuccess" name="isbn" placeholder="isbn" required>
                        <input type="hidden" class="form-control input-lg" name="action" value="add">
                      </div>

                      <div class="form-group">
                        <label for="title">TITLE: </label>
                        <input type="text" class="form-control input-lg" id="title" name="title" placeholder="title" required>
                      </div>

                      <div class="form-group">
                        <label>SUMMARY:</label>
                        <textarea class="form-control" rows="3" id="summary" name="summary" placeholder="summary" required></textarea>
                      </div>

                      <div class="input-group input-group-md mb-3">
                        <label for="author">AUTHOR: </label>
                        <select class="form-control select2" id="author" name="author"  style="width: 96%;">
                        </select>
                        <span class="input-group-append" style="width: 4%;">
                          <button type="button" class="btn btn-info btn-flat" id="btn-add-author"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>

                      <div class="input-group input-group-md mb-3">
                        <label for="genre">GENRE: </label>
                        <select class="form-control select2" id="genre" name="genre"  style="width: 96%;">
                        </select>
                        <span class="input-group-append" style="width: 4%;">
                          <button type="button" class="btn btn-info btn-flat" id="btn-add-genre"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>

                      <div class="form-group">
                        <label for="pages">TOTAL PAGES:</label>
                        <input type="number" class="form-control input-lg" id="pages" name="pages" placeholder="total pages" required>
                      </div>

                      <div class="form-group">
                        <label for="fee">RENTED FEE:</label>
                        <input type="number" class="form-control input-lg" id="fee" name="fee" placeholder="rented fee" required>
                      </div>
             
                    </div>
                    <!-- /.card-body -->

                   <div class="card-footer">
                     <div class="row ">

                      <div class="col-md-6 col-xs-12">
                      </div>

                      <div class="col-md-6 col-xs-12">

                        <button type="submit" class="btn btn-info float-right ml-3 form-btn"><i class="fa fa-check-circle"></i> Save</button>
                        <button type="reset" class="btn btn-danger float-right form-btn"><i class="fa fa-times-circle"></i> Cancel</button>
                      </div>
                     </div>
                    
                  </div>
                  </form>
                </div>
                <!-- /.row -->
              </div>
              
            </div>
          </div>

          <form id='form-add-author'>
            <div class="modal fade" id="modal-add-author">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-user-plus"></i> ADD AUTHOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="col-10 offset-1 mt-3 mb-5">
                      <div class="form-group">
                        <label for="input-author">AUTHOR NAME: </label>
                        <input type="text" class="form-control input-lg" id="input-author" name="input-author" placeholder="AUTHOR" required>
                      </div>

                      <div id="alert-message">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between col-10 offset-1">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-check-circle"></i> Save </button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          </form>


          <form id='form-add-genre'>
            <div class="modal fade" id="modal-add-genre">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus-circle"></i> ADD GENRE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="col-10 offset-1 mt-3 mb-5">
                      <div class="form-group">
                        <label for="input-genre">GENRE: </label>
                        <input type="text" class="form-control" id="input-genre" name="input-genre" placeholder="GENRE">
                      </div>

                      <div id="alert-message2">
                      </div>

                    </div>
                  </div>
                  <div class="modal-footer justify-content-between col-10 offset-1">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-check-circle"></i> Save </button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          </form>

          <div class="modal fade" id="modal-search-book">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="fa fa-search"></i> Search book</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center>
                    <img src="../../../img/book_search.png" width="100px" height="100px">
                  </center>
                  <div class="col-10 offset-1 mt-4">
                    <div class="input-group " >
                      <input type="text" class="form-control" id="search_book" name="search_book" placeholder="SEARCH BOOK">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                      </div>
                    </div>
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-table"></i> Search result</h3>

                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed">
                          <thead>
                            <tr>
                              <th>IMAGE</th>
                              <th>ISBN</th>
                              <th>TITLE</th>
                              <th>CATEGORY</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>183</td>
                              <td>John Doe</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-success">Approved</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                            <tr>
                              <td>219</td>
                              <td>Alexander Pierce</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-warning">Pending</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                            <tr>
                              <td>657</td>
                              <td>Bob Doe</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-primary">Approved</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                            <tr>
                              <td>175</td>
                              <td>Mike Doe</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-danger">Denied</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                            <tr>
                              <td>134</td>
                              <td>Jim Doe</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-success">Approved</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                            <tr>
                              <td>494</td>
                              <td>Victoria Doe</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-warning">Pending</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                            <tr>
                              <td>832</td>
                              <td>Michael Doe</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-primary">Approved</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                            <tr>
                              <td>982</td>
                              <td>Rocky Doe</td>
                              <td>11-7-2014</td>
                              <td><span class="tag tag-danger">Denied</span></td>
                              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>

                  </div>
                </div>
                <div class="modal-footer ">
                  <button type="button" class="btn btn-danger pull-right"><i class="fa fa-times-circle"></i> Close</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->


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
  
  $(document).ready(function(){
    $('#form-index').addClass('active');
    $('#form-menu-open').addClass('menu-open');
    $('#form-add-book-item').addClass('active');
    

     //Initialize Select2 Elements
    $('.select2').select2();

    // Button events
    $('#btn-add-author').click(function() {
      $('#modal-add-author').modal('show');
    });

    $('#btn-add-genre').click(function() {
      $('#modal-add-genre').modal('show');
    });


    // Input events
    $("#input-author").keydown(function(){
      var data = {
        action: 'validate',
        author: $(this).val()
      };
      validateAuthor(data);
    });

    $("#input-author").keyup(function(){
      var data = {
        action: 'validate',
        author: $(this).val()
      };
      validateAuthor(data);
    });

    $("#input-genre").keydown(function(){
      var data = {
        action: 'validate',
        genre: $(this).val()
      };
      validateGenre(data);
    });

    $("#input-genre").keyup(function(){
      var data = {
        action: 'validate',
        genre: $(this).val()
      };
      validateGenre(data);
    });



    // Add author form submision
    $("#form-add-author").submit(function(e){
      e.preventDefault();
      var data = {
        action: 'validate',
        author: $('#input-author').val()
      };

      if(validateAuthor(data)) {
        addAuthor(data);
        loadInit('author');
      }
    });


    // Add genre form submision
    $("#form-add-genre").submit(function(e){
      e.preventDefault();
      var data = {
        action: 'validate',
        genre: $('#input-genre').val()
      };

      if(validateGenre(data)) {
        addGenre(data);
        loadInit('genre');
      }
    });


    // Add book form submision
    $("#form-add-book").submit(function(e){
      e.preventDefault();
      addBook();
    });

  });



  loadInit('');

  function loadInit(view) {
     try {
      var data = {
        action: 'load'
      };
      var query =  CRUD;
      query.path = '../../controller/book.php';
      query.param = data;
      var response = query.run();
      response = JSON.parse(response);

      if(view == '') {
        loadAuthor(response.author);
        loadGenre(response.genre);
      }
      else {
        if(view == 'author') {
          loadAuthor(response.author);
        }
        else {
          loadGenre(response.genre);
        }
      }
      

    }
    catch(err) {
      showError('System error.')
    }
  }


  function loadAuthor(data) {

    let len = data.length;
    let html = '';
    for(var i = 0; i < len; i++) {
      if(i == 0) {
        html += '<option value="'+data[i].author_id+'" selected>' + data[i].author + '</option>';
      }
      else {
        html += '<option value="'+data[i].author_id+'">' + data[i].author + '</option>';
      }
    }

    $('#author').html(html);
  }

  function loadGenre(data) {
    let len = data.length;
    let html = '';
    for(var i = 0; i < len; i++) {
      if(i == 0) {
        html += '<option value="'+data[i].genre_id+'" selected>' + data[i].genre + '</option>';
      }
      else {
        html += '<option value="'+data[i].genre_id+'">' + data[i].genre + '</option>';
      }
    }

    $('#genre').html(html);
  }

  // ADD AUTHOR DATA
  function addAuthor(data) {
    try {
      data.action = 'add';
      var query =  CRUD;
      query.path = '../../controller/author.php';
      query.param = data;
      var response = query.run();
      response = JSON.parse(response);

      if(JSON.parse(response) == false) {
        $("#form-add-author")[0].reset();
        $('#input-author').removeClass('is-valid');
        $('#input-author').removeClass('is-invalid');
        $('#alert-message').html(
            '<div class="alert alert-success" role="alert">\
              <strong><span class="fa fa-check-circle"></span> Author name is successfully saved. </strong>\
            </div>'
          );

      }
      else {
        showError('System error.')
      }
    }
    catch(err) {
      showError('System error.')
    }
  }

  // ADD AUTHOR DATA
  function addGenre(data) {
    try {
      data.action = 'add';
      var query =  CRUD;
      query.path = '../../controller/genre.php';
      query.param = data;
      var response = query.run();
      response = JSON.parse(response);

      if(JSON.parse(response) == false) {
        $("#form-add-genre")[0].reset();
        $('#input-genre').removeClass('is-valid');
        $('#input-genre').removeClass('is-invalid');
        $('#alert-message2').html(
            '<div class="alert alert-success" role="alert">\
              <strong><span class="fa fa-check-circle"></span> Genre is successfully saved. </strong>\
            </div>'
          );

      }
      else {
       showError('System error.')
      }
    }
    catch(err) {
      showError('System error.')
    }
  }


  // Author data validation
  function validateAuthor(data) {
    let is_valid_data = false;
    try {
      
      if(data.author != "") {
        var query =  CRUD;
        query.path = '../../controller/author.php';
        query.param = data;
        var response = query.run();
        response = JSON.parse(response);

        if(response.length > 0) {
          $('#alert-message').html(
            '<div class="alert alert-warning" role="alert">\
              <strong><span class="fa fa-times-circle"></span> Author name is already exist. </strong>\
            </div>'
          );

          $('#input-author').removeClass('is-valid');
          $('#input-author').addClass('is-invalid');
          is_valid_data = false;
        }
        else {
          $('#alert-message').html('');
          $('#input-author').removeClass('is-invalid');
          $('#input-author').addClass('is-valid');
          is_valid_data = true;
        }
      }
      else {
        $('#alert-message').html('');
        $('#input-author').removeClass('is-valid');
        is_valid_data = false;
      }

    }
    catch(err) {
      showError('System error.')
    }

    return is_valid_data;
  }

  // Genre data validation
  function validateGenre(data) {
    let is_valid_data = false;
    try {
      
      if(data.genre != "") {
        var query =  CRUD;
        query.path = '../../controller/genre.php';
        query.param = data;
        var response = query.run();
        response = JSON.parse(response);

        if(response.length > 0) {
          $('#alert-message2').html(
            '<div class="alert alert-warning" role="alert">\
              <strong><span class="fa fa-times-circle"></span> Genre is already exist. </strong>\
            </div>'
          );

          $('#input-genre').removeClass('is-valid');
          $('#input-genre').addClass('is-invalid');
          is_valid_data = false;
        }
        else {
          $('#alert-message2').html('');
          $('#input-genre').removeClass('is-invalid');
          $('#input-genre').addClass('is-valid');
          is_valid_data = true;
        }
      }
      else {
        $('#alert-message2').html('');
        $('#input-genre').removeClass('is-valid');
        is_valid_data = false;
      }

    }
    catch(err) {
     showError('System error.')
    }

    return is_valid_data;
  }

  // Add book function
  function addBook(data) {
    let form = document.getElementById('form-add-book');
    $.ajax({
      url: "../../controller/book.php",
      type: "POST",
      dataType: 'json',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        if(data == false) {
          showSuccess('Data is successfully inserted.')
          $('#form-add-book')[0].reset();
          loadInit('');
        }
        else {
          showError('Record not save.')
        }
      },
      error: function(error){
        showError('System error.')
      }
  });
  }


</script>
</body>
</html>
