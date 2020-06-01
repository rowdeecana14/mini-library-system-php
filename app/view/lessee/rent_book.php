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

    <title>Rent book | MLS</title>
  <link rel="shortcut icon" href="../../../img/app_logo.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../template/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../../template/plugins/select2/css/select2.min.css">
  <!-- Theme style -->
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
      <a href="index.php" class="navbar-brand">
        <img src="../../../img/app_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Mini Library System</span>
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
          <li class="nav-item active-link">
            <a href="rent_book.php" class="nav-link"><i class="fa fa-book"></i> Rent</a>
          </li>

          <li class="nav-item">
            <a href="return_book.php" class="nav-link"><i class="fa fa-history"></i> Return </a>
          </li>

          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-copy"></i> Record</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="rented_book.php" class="dropdown-item"><i class="fa fa-circle-o"></i> Rented book </a></li>
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

        <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><i class="fa fa-book"></i> Book catalog</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><i class="fa fa-archive"></i> Book bag <span class="badge badge-warning" id="total-selected">0</span></a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="tab-pane active" id="activity">

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

          
                  </div>

                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">

                      <form id="form-rent">
                    <div class="row">
                      <div class="col-md-4 col-xs-12 col-sm-12">
                        <div class="card card-default">
                          <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-edit"></i> Rent form
                            </h3>

                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <div class="form-group">
                                  <label for="rent_no" style="font-size: 16px">Rent no: </label>
                                  <input type="text" class="form-control input-lg" id="rent_no" name="rent_no" placeholder="Rent no" required readonly >
                                  <input type="hidden" class="form-control input-lg" name="action" value="rent-book">
                                </div>

                                <div class="form-group">
                                  <label for="name" style="font-size: 16px">Name: </label>
                                  <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Name" required value="<?php echo $fullname; ?>" readonly>
                                </div>

                                <div class="form-group">
                                  <label for="date_rent" style="font-size: 16px">Date rent: </label>
                                  <input type="date" class="form-control input-lg" id="date_rent" name="date_rent" placeholder="Date rent" required>
                                </div>
                                
                                <div class="form-group">
                                  <label for="date_returned" style="font-size: 16px">Date returned: </label>
                                  <input type="date" class="form-control input-lg" id="date_returned" name="date_returned" placeholder="Date returned" required>
                                
                                </div>
                            <!-- /.row -->
                          </div>
                        </div>

                      </div>
                       <div class="col-md-8 col-xs-12 col-sm-12">
                         <div class="card card-default">
                          <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-table"></i> List of selected book
                            </h3>

                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table class="table table-bordered">
                            <thead>                  
                                <tr>
                                  <th style="width: 10%">#</th>
                                  <th style="width: 50%">TITLE</th>
                                  <th colspan="2" style="width: 40%">RENT FEE</th>
                                </tr>
                              </thead>
                              <tbody id='tbody-selected-book'>
                                <tr>
                                <td colspan='6' class="text-center">NO RECORDS AVAILABLE</td>
                              </tr>
                              </tbody>
                              <tfooter>
                                <tr>
                                  <td colspan="2" style="font-weight: bold">TOTAL PAYMENT: </td>
                                  <td id="total-payment" colspan="2" style="font-weight: bold">PHP. 0.00</td>
                                </tr>
                              </tfooter>
                            </table>
                          </div>
                        </div>
                        
                       </div>
                   </div>

                      <div class="col-12">
                        <hr>
                        <button type="submit" class="btn btn-primary float-right ml-3 form-btn" id="btn-rent"><i class="fa fa-send-o"></i> Rent request</button>
                        <button type="button" class="btn btn-danger float-right form-btn" id="btn-cancelall"><i class="fa fa-times-circle"></i> Cancel all</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                 
                </div>
                <!-- /.tab-content -->
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
    <strong class="ml-5">Copyright &copy; 2019-2020 <a href="">MINI LIBRARY SYSTEM</a>.</strong> All rights reserved.
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
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  let data_selected = [];
  // if(localStorage.getItem("data") == null) {
  //   localStorage.setItem("data", data_selected);
  // }
  // else {
  //   data_selected = localStorage.getItem("data");
  // }
  
  let list_id = [];
  let data = {};
  let LIMIT = 30;
  let PREVIUS_CONSTANT = 0;
  let NEXT_CONSTANT = LIMIT;
  let prev = PREVIUS_CONSTANT;
  let next = NEXT_CONSTANT;
  loadInit(); 
  loadFilter();

  $('#btn-cancelall').click(function() {
    for(let i = 0; i < data_selected.length; i++) {
      $('#btn-addbag-id-' + data_selected[i].book_id).removeAttr('disabled');
      $('#btn-addbag-id-' + data_selected[i].book_id).removeClass('btn-warning');
      $('#btn-addbag-id-' + data_selected[i].book_id).addClass('btn-primary');
    }
    data_selected = [];
    loadSelectedBook();
  });


  $("#form-rent").submit(function(e){
      e.preventDefault();
      rentBook();
  });
 
  $('#btn-refresh').click(function() {
    $('#form-filter')[0].reset();
    $('#search-book').val('');
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


  function rentBook() {

    if(list_id.length == 0) {
      showError('Select book first.')
      return;
    }

    try {
      let query =  CRUD;
      let response = {};
      let data_form = {
        action: 'rent-book',
        list_id: list_id,
        rent_no: $("#rent_no").val(),
        date_rent: $("#date_rent").val(),
        date_returned: $('#date_returned').val()
      };

      query.path = '../../controller/rent.php';
      query.param = data_form;
      response = query.run();
      console.log(response);
      response = JSON.parse(response);

     if(response.success == true) {
        showSuccess('Request is successfully send.')
        $('#form-rent')[0].reset();
        list_id = [];
        data_selected = [];
        loadInit(); 
        loadFilter();
        loadSelectedBook();
      }
      else {
        showError('Record not save.')
        console.log(response.data_error);

        showRentError(response.data_error)
      }

      

    }
    catch(err) {
      console.log(err);
      showError('System error.')
    }
  }


  function showRentError(rent_error) {
    for(let i = 0; i < rent_error.length; i++) {
      $('#rent-error-'+rent_error[i].book_id).html('<span class="badge badge-warning">This book is already reserved now.</span>');
    }
  }

  function addToBag(index, book_id) {
    let count = 0;
   

    for(let i = 0; i < data_selected.length; i++) {
      if(data_selected[i].book_id == data[index].book_id) {
        count++;
      }
    }

    if(count == 0) {
      list_id.splice(0, 0, data[index].book_id);
      data_selected.splice(0, 0, data[index]);
       console.log(list_id)
       console.log(data_selected);
      //localStorage.setItem("data", data_selected);
     
      Toast.fire({
        type: 'success',
        title: 'Book is successfully added to list.'
      });

      $('#btn-addbag-id-'+book_id).attr('disabled','disabled');
      $('#btn-addbag-id-'+book_id).removeClass('btn-primary');
      $('#btn-addbag-id-'+book_id).addClass('btn-warning');

      //$("#month").removeAttr('disabled');
      loadSelectedBook();
      
    }
    else {
      Toast.fire({
        type: 'warning',
        title: 'Book is selected already.'
      });
    }
  }

  function loadSelectedBook() {
    let html ='';
    let total = 0.00;

    if(data_selected.length > 0) {
      for(let i = 0; i < data_selected.length; i++) {
        total = (total + Number(data_selected[i].fee));
        html += `
        <tr>
            <td>` + (i + 1) + `</td>
            <td>` + data_selected[i].title + `<div id="rent-error-`+ data_selected[i].book_id +`"></div></td>
            <td class="text-right">` + data_selected[i].fee + `</td>
            <td>
                <button type="button" class="btn btn-outline-danger btn-sm btn-selectedCancel" onclick="selectedCancel(`+i+`,`+data_selected[i].book_id+`)"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel book"><i class="fa fa-times-circle"></i></button>
            </td>
          </tr>`;
      }

      $('#total-selected').text(data_selected.length);
      $("#tbody-selected-book").html(html);
    }
    else {
      $('#total-selected').text(data_selected.length);
      $("#tbody-selected-book").html(`
          <tr>
            <td colspan='6' class="text-center">NO RECORDS AVAILABLE</td>
          </tr>
        `);
    }

    $('#total-payment').text(total.toFixed(2));
    $('[data-toggle="tooltip"]').tooltip();
    
  }

  function selectedCancel(index, book_id) {
    list_id.splice(index, 1);
    data_selected.splice(index, 1);
    //localStorage.setItem("data", data_selected);
    loadSelectedBook();

    $('#btn-addbag-id-'+book_id).removeAttr('disabled');
    $('#btn-addbag-id-'+book_id).removeClass('btn-warning');
    $('#btn-addbag-id-'+book_id).addClass('btn-primary');

  }




  function searchBook(value) {
    $("#search-book-icon").html("<span class='fa fa-spinner fa-spin'></span>");
    try {
      let query =  CRUD;
      let response = {};
      query.path = '../../controller/book.php';
      query.param = { 
        action: 'input-search',
        search: value
      };
      response = query.run();
      response = JSON.parse(response);
      //console.log(response)

      data = response;
      prev = PREVIUS_CONSTANT;
      next = NEXT_CONSTANT;

      displayList(prev, next);
      $("#search-book-icon").html("<span class='fa fa-search' ></span>");

    }
    catch(err) {
      console.log(err);
      showError('System error.')
    }
  }

  function loadInit() {
    try {
      var query =  CRUD;
      query.path = '../../controller/book.php';
      query.param = { action: 'list-book-rent' };
      var response = query.run();
      response = JSON.parse(response);
      data = response;
      displayList(prev, next);
    }
    catch(err) {
      console.log(err);
      showError('System error.')
    }
  }

  function displayList(prev, next) {
    let html = '';
    let category = '';
    let rent_status = '';
    let current_date = data.current_date;
    let rent_no = data.rent_no;
    let btn_selected = '';
    data = data.my_data

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

        let count_item = 0;

        for(let ii = 0; ii < list_id.length; ii++) {
          if(data[i].book_id == list_id[ii]) {
            count_item++;
          }
        }

        if(count_item == 0 && data[i].rent_status == 'Returned') {
          btn_selected = `
          <button class="btn btn-sm btn-primary" onclick="addToBag(`+i+`, `+data[i].book_id+`)" id="btn-addbag-id-`+ data[i].book_id +`">
              <i class="fa fa-plus"></i> Add to bag
            </button>`;
        }
        else {
           btn_selected = `
          <button class="btn btn-sm btn-warning" onclick="addToBag(`+i+`, `+data[i].book_id+`)" id="btn-addbag-id-`+ data[i].book_id +`" disabled="disabled">
              <i class="fa fa-plus"></i> Add to bag
            </button>`;
        }


        
        html += `
        <div class="col-12 col-sm-12 col-md-4 d-flex align-items-stretch" id="item-` + i + `">
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
                    <img src="../../../img/upload/` + data[i]['image'] + `" alt="" class="img-book img-thumbnail">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">`
                  + rent_status + btn_selected + `
                </div>
              </div>
            </div>
          </div>`;
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('#book-content').html(html);
      $('#rent_no').val(rent_no);
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


  function getFilter(genre, author, category) {
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../../controller/book.php';
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
      console.log(err);
      showError('System error.')
    }
  }
</script>
</body>
</html>
