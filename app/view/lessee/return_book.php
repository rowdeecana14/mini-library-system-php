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
         

          <li class="nav-item active-link">
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
              <div class="card-header">
                <h5 class="card-title">
                  <div class=" d-flex">
                    <div>
                      <img src="../../../img/book_return.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">Return book</div> 
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
                                <th>Rent no</th>
                                <th>Total payment</th>
                                <th>Date rent</th>
                                <th>Due date</th>
                                <th>Status</th>
                                <th>Action</th>
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

            <div class="modal fade" id="modal-view" aria-modal="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"><i class="fa fa-table"></i> List of books</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered">
                            <thead>   
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Rent fee</th>
                                <th class="text-center"></th>
                            </thead>
                            <tbody class='tbody-view'>
                               
                            </tbody>
                           
                          </table>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                    <button type="button" class="btn btn-outline-primary" id="btn-return"><i class="fa fa-check-circle"></i> Save </button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
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
  let data = {};
  let LIMIT = 10;
  let PREVIUS_CONSTANT = 0;
  let NEXT_CONSTANT = LIMIT;
  let prev = PREVIUS_CONSTANT;
  let next = NEXT_CONSTANT;
  let my_rent_no = '';
  loadInit();
  
  $(document).ready(function(){
    $('#form-index').addClass('active');
    $('#form-menu-open').addClass('menu-open');
    $('#form-add-rented-item').addClass('active');

      
    $('#btn-return').click(function() {
      returnBook();
    });

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
                <td colspan="7" class="text-center">NO RECORDS AVAILABLE</td>\
              </tr>\
            ');
        }

        setTimeout(function() {
            $("#search-book-icon").html("<span class='fa fa-search' ></span>");
        }, 2000);
    });

  });

  function returnBook() {
    let bookid_list = [];
    $(':checkbox:checked').each(function(){
      let get_id = $(this).val();
      bookid_list.push(get_id);
    });

    if(bookid_list.length > 0) {
      let data_form = {
        action: 'return-book',
        bookid_list: bookid_list,
        rent_no: my_rent_no
      };

      let query =  CRUD;
      let response = {};

      query.path = '../../controller/rent.php';
      query.param = data_form;
      response = query.run();
      console.log(response);
      response = JSON.parse(response);

      if(response == false) {
        showSuccess('Return book has been submited.')
      }
      else {
        showError('Record not submited.')
      }

      $('#modal-view').modal('hide');
      loadInit();
    }
    else {
      showError('Select book first.');
    }
  }


  function loadInit() {
    try {
      let query =  CRUD;
      let response = [];
      query.path = '../../controller/rent.php';
      query.param = { action: 'rent-list' };
      response = query.run();
      response = JSON.parse(response);
      data = response;
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
          <td colspan="7" class="text-center">NO RECORDS AVAILABLE</td>\
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
       
       if(data[i].diff_date >= 0) {
        status = '<span class="badge bg-warning p-2">0 day(s) (OVERDUE)</span>';
       }
       else {
        status = '<span class="badge bg-success p-2">' + Math.abs(data[i].diff_date) + ' day(s) (ONGOING)</span>';
       }

        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + data[i].rent_no + '</td>\
            <td>Php. ' + data[i].total_fee +'</td>\
            <td>' + data[i].rent_date +'</td>\
            <td>' + data[i].due_date +'</td>\
            <td>' + status +'</td>\
            <td>\
                <div class="btn-group">\
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick=returnRented("'+data[i].rent_no+'")><i class="fa fa-save"></i> Return </button>\
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick=viewRented("'+data[i].rent_no+'")><i class="fa fa-eye"></i> View </button>\
                  </div>\
            </td>\
          </tr>\
        ';
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('.tbody-book').html(html);
    }
  }

  function returnRented(rent_no) {
    try {
      let query =  CRUD;
      let response = [];
      query.path = '../../controller/rent.php';
      query.param = { 
        action: 'return-book-all',
        rent_no: rent_no
      };
      response = query.run();
      response = JSON.parse(response);
      //console.log(response);

      if(response == false) {
        showSuccess('Return book has been submited.')
      }
      else {
        showError('Record not submited.')
      }

      $('#modal-view').modal('hide');
      loadInit();
    }
    catch(err) {
      showError('System error.');
      console.log(err);
    }
  }

  function viewRented(rent_no) {
    my_rent_no = rent_no;
    $('#modal-view').modal('show');
     try {
      let query =  CRUD;
      let response = [];
      query.path = '../../controller/rent.php';
      query.param = { 
        action: 'rent-view',
        rent_no: rent_no
      };
      response = query.run();
      response = JSON.parse(response);
      console.log(response)
      viewBookList(response);
    }
    catch(err) {
      showError('System error.');
      console.log(err);
    }
  }


  function viewBookList(response) {
    let html = '';
    let total = 0.00;

    for(let i = 0; i < response.length; i++) {
        let fee = Number(response[i].fee);
        total += fee;
        fee = fee.toFixed(2);
       
        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + response[i].title + '</td>\
            <td>' + response[i].author + '</td>\
            <td>' + response[i].genre +'</td>\
            <td>' + fee +'</td>\
            <td><center>\
              <div class="icheck-primary d-inline">\
                <input type="checkbox" id="checkboxPrimary-' + response[i].book_id  +'" value="'+ response[i].book_id +'">\
                <label for="checkboxPrimary-' + response[i].book_id  +'">\
                </label>\
              </div>\
              </center>\
            </td>\
          </tr>\
        ';
      }

      if(response.length == 0) {
         $('#tbody-view').html(`
           <tr>
              <td colspan="6" class="text-center">NO RECORDS AVAILABLE</td>\
            </tr>
          `);
      }
      else {
         $('.tbody-view').html(html);
      }
     
  }

</script>
</body>
</html>
