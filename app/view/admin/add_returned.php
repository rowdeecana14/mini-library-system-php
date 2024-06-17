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
  <title>Returned book | LMS</title>
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
                      <img src="../../../img/book_return.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1" style="font-weight: bold">RETURN BOOK</div> 
                  </div>
                </h5>
                 <div class="card-tools">
                            <div class="input-group input-group-md" style="width: 300px;">
                              <input type="text" name="search-book" id="search-book" class="form-control float-right input-bg" placeholder="SEARCH RENT">

                              <div class="input-group-append">
                                <button type="button" class="btn btn-default" id="search-book-icon"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                          </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-12 ">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered">
                            <thead>   
                                <th>#</th>
                                <th>RENT NO</th>
                                <th>NAME</th>
                                <th>DATE RENT</th>
                                <th>DUE DATE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
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
                <!-- /.row -->
              </div>
              
            </div>
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
                                <th>TITLE</th>
                                <th>AUTHOR</th>
                                <th>GENRE</th>
                                <th>RENT FEE</th>
                                <th></th>
                            </thead>
                            <tbody class='tbody-view'>
                               
                            </tbody>
                            <tfooter>
                                <tr>
                                  <td colspan="2" style="font-weight: bold">TOTAL PAYMENT: </td>
                                  <td colspan="2"></td>
                                  <td id="total-payment" cstyle="font-weight: bold"  colspan="2">PHP. 0.00</td>
                                </tr>
                              </tfooter>
                          </table>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                    <button type="button" class="btn btn-outline-primary" id="btn-received"><i class="fa fa-check-circle"></i> Received </button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
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
  let my_rent_no = '';
  loadInit();
  
  $(document).ready(function(){
    $('#form-index').addClass('active');
    $('#form-menu-open').addClass('menu-open');
    $('#form-add-returned-item').addClass('active');

    $('#btn-received').click(function() {
        receivedReturn();
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


  function receivedReturn() {
    let bookid_list = [];
    $(':checkbox:checked').each(function(){
      let get_id = $(this).val();
      bookid_list.push(get_id);
    });

    if(bookid_list.length > 0) {
      let data_form = {
        action: 'received-return',
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
        showSuccess('Book has been received.')
      }
      else {
        showError('Book not received.')
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
      query.param = { action: 'returned-list' };
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
        status = '<span class="badge bg-warning p-1">OVERDUE</span>';
       }
       else {
        status = '<span class="badge bg-success p-1">ONGOING</span>';
       }

        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + data[i].rent_no + '</td>\
            <td>' + data[i].first_name + ' ' + data[i].last_name +'</td>\
            <td>' + data[i].rent_date + '</td>\
            <td>' + data[i].due_date + '</td>\
            <td>' + status + '</td>\
            <td>\
                <div class="btn-group">\
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick=approveReturned("'+data[i].rent_no+'")><i class="fa fa-save"></i> Receive </button>\
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick=viewReturned("'+data[i].rent_no+'")><i class="fa fa-eye"></i> View</button>\
                  </div>\
            </td>\
          </tr>\
        ';
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('.tbody-book').html(html);
    }
  }


  function approveReturned(rent_no) {
    try {
      let query =  CRUD;
      let response = [];
      query.path = '../../controller/rent.php';
      query.param = { 
        action: 'returned-approve',
        rent_no: rent_no
      };
      response = query.run();
      //console.log(response);

      response = JSON.parse(response);
      if(response == false) {
        showSuccess('Book has been received.')
      }
      else {
        showError('Book not received.')
      }

      loadInit();
      
    }
    catch(err) {
      showError('System error.');
      console.log(err);
    }
  }

  function viewReturned(rent_no) {
     my_rent_no = rent_no;
    $('#modal-view').modal('show');
     try {
      let query =  CRUD;
      let response = [];
      query.path = '../../controller/rent.php';
      query.param = { 
        action: 'returned-view',
        rent_no: rent_no
      };
      response = query.run();
      //console.log(response);

      response = JSON.parse(response);
      viewBookList(response);
      //response = JSON.parse(response);
    }
    catch(err) {
      showError('System error.');
      console.log(err);
    }
  }


  function viewBookList(response) {
    let html = '';
    let status = '';
    let total = 0.00;

    for(let i = 0; i < response.length; i++) {
        let fee = Number(response[i].fee);
        total += fee;
        fee = fee.toFixed(2);

         if(response[i].rent_status == 'Returned-process') {
          status = '<center>\
              <div class="icheck-primary d-inline">\
                <input type="checkbox" id="checkboxPrimary-' + response[i].book_id  +'" value="'+ response[i].book_id +'">\
                <label for="checkboxPrimary-' + response[i].book_id  +'">\
                </label>\
              </div>\
              </center>';
        }
        else {
          status = '<center>\
                <span class="badge bg-warning p-1">UNRETURNED</span>\
              </center>';
        }
       
        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + response[i].title + '</td>\
            <td>' + response[i].author + '</td>\
            <td>' + response[i].genre +'</td>\
            <td>' + fee +'</td>\
            <td>' +
              status +
            '</td>\
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


      $('#total-payment').text("Php " +total.toFixed(2));
     
  }

</script>
</body>
</html>
