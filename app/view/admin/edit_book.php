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
  <title>Edit book | MLS</title>
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
              <li class="breadcrumb-item active">Edit book</li>
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
                      <img src="../../../img/book_edit.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">Edit book</div> 
                  </div>
                </h5>

              
                <div class="btn-group float-right">
                  <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-list-ul"></i>
                    Option
                  </button>
                  <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -2px, 0px); margin-left: -60px">
                    <li><a class="dropdown-item" href="view_book.php? id=<?php echo $_GET['id']; ?>"><i class="fa fa-eye"></i> View book</a></li>
                    <li><a class="dropdown-item" href="list_of_book.php"><i class="fa fa-table"></i> List of books</a></li>
                  </ul>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 col-xs-12 mt-4">

                      <!-- Profile Image -->
                      <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <img style="padding: 3px; border: 3px solid #b1b5b9;" width="160px" height="200px" src="../../img/unknown.png" alt="User profile picture" id="image-detail">
                          </div>
                          <center class="mt-2">
                            <button type="button" class="btn btn-outline-primary" id="btn-update-image"><b><i class="fa fa-camera"></i> Update image</b></button>
                          </center>
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
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->

                  <div class="col-md-9 col-xs-12">
                    <form role="form" id="form-update-book" class="ml-3">
                      <div class="card-body">
                       
                        <div class="form-group">
                          <label for="isbn">ISBN: </label>
                          <input type="text" class="form-control input-lg" id="isbn" name="isbn" placeholder="isbn">
                          <input type="hidden" class="form-control input-lg" name="action" value="update">
                          <input type="hidden" class="form-control input-lg" name="id" value="<?php echo $_GET['id']; ?>">
                        </div>

                        <div class="form-group">
                          <label for="title">TITLE: </label>
                          <input type="text" class="form-control input-lg" id="title" name="title" placeholder="title" required>
                        </div>

                        <div class="form-group">
                          <label>SUMMARY:</label>
                          <textarea class="form-control" rows="3" id="summary" name="summary" placeholder="summary"></textarea>
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
                          <input type="number" class="form-control input-lg" id="pages" name="pages" placeholder="total pages">
                        </div>

                        <div class="form-group">
                          <label for="fee">RENTED FEE:</label>
                          <input type="number" class="form-control input-lg" id="fee" name="fee" placeholder="rented fee">
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
                </div>
                <!-- /.row -->
              </div>
              
            </div>
          </div>


           <form id='form-update-image'>
            <div class="modal fade" id="modal-update-image">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-camera"></i> UPDATE IMAGE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="col-10 offset-1 mt-3 mb-1">
                      <input type="hidden" name="action" value="update-image">
                      <input type="hidden" name="id"  id="id" value="<?php echo $_GET['id']; ?>">
                      <center>
                          <img  id="image-preview" src="../../img/upload/unknown.png" class="image-preview" style="border: 2px solid gray;"/>
                           <input type="file" class="form-control" id="image-source" onchange="previewImage();" name="image-source"  accept="image/png, image/jpeg, image/gif" required>
                      </center>
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
  let author_global = '';
  let genre_global = '';

  $(document).ready(function(){
    
     //Initialize Select2 Elements
    $('.select2').select2();

    // Button events
    $('#btn-add-author').click(function() {
      $('#modal-add-author').modal('show');
    });

    $('#btn-add-genre').click(function() {
      $('#modal-add-genre').modal('show');
    });

    $('#btn-update-image').click(function() {
      $('#modal-update-image').modal('show');
    });

    $("#form-update-image").submit(function(e){
      e.preventDefault();
      updateImage();
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
    $("#form-update-book").submit(function(e){
      e.preventDefault();
      updateBook();
    });

  });



  loadBook();
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
      if(author_global == data[i].author) {
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
      if(genre_global == data[i].genre) {
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
  function updateBook() {
    try {
      let query =  CRUD;
      let response = {};
      let data = $("#form-update-book").serializeArray();

      query.path = '../../controller/book.php';
      query.param = data;
      response = query.run();
      response = JSON.parse(response);

      if(response == false) {
        showSuccess('Data is successfully updated.')
        
      }
      else {
        showError('Record not updated.')
      }

      loadBook();
      loadInit('');
    }
    catch(error) {
      showError('System error.')
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


  function viewBook(data) {
    author_global = data[0].author;
    genre_global = data[0].genre;
    $('#isbn').val(data[0].isbn);
    $('#title').val(data[0].title);
    $('#summary').val(data[0].summary);
    $('#pages').val(data[0].pages);
    $('#fee').val(data[0].fee);

    if(data[0].isbn == '') {
      data[0].isbn = '--------------------';
    }

    if(data[0].title == '') {
      data[0].title = '--------------------';
    }

    if(data[0].summary == '') {
      data[0].summary = '--------------------';
    }

    if(data[0].pages == '') {
      data[0].pages = '--------------------';
    }

    if(data[0].fee == '') {
      data[0].fee = '--------------------';
    }

    if(data[0].author == '') {
      data[0].author = '--------------------';
    }

    if(data[0].genre == '') {
      data[0].genre = '--------------------';
    }


    $('#isbn-detail').text(data[0].isbn);
    $('#title-detail').text(data[0].title);
    $('#summary-detail').text(data[0].summary);
    $('#pages-detail').text(data[0].pages + ' page(s)');
    $('#fee-detail').html('<i class="fa fa-rub"></i> ' +data[0].fee);
    $('#author-detail').text(data[0].author);
    $('#genre-detail').text(data[0].genre);
    $('#status-detail').text(data[0].status);
    $('#image-detail').attr("src", '../../../img/upload/'+data[0].image);
    $('#image-preview').attr("src", '../../../img/upload/'+data[0].image);
    $('#modal-update-image').modal('hide');
  }


  //preview the user image selected
  function previewImage() {
      document.getElementById("image-preview").style.display = "block";
      var oFReader = new FileReader();
       oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
      };
  };


  function updateImage() {
    let form = document.getElementById('form-update-image');
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
          showSuccess('Image is successfully updated.')
        }
        else {
          showError('Image not updated.')
        }

        loadBook();
        loadInit('');
      },
      error: function(error){
        showError('System error.')
      }
    });
  }


</script>
</body>
</html>
