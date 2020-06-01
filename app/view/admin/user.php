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
  <title>List of user | MLS</title>
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
              <li class="breadcrumb-item active">List of user</li>
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
                      <img src="../../../img/tenant-search.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">Advance filter</div> 
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
                  <div class="row col-8 offset-2">

                    <div class="col-md-6 col-xs-12">

                       <div class="input-group mb-4">
                        <label for="gender">GENDER: </label>
                        <select class="form-control  filter-option" id="gender" name="gender"  style="width: 100%;">
                          <option value="" disabled selected>Select gender</option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                    </div>

                     <div class="col-md-6 col-xs-12">

                       <div class="input-group  mb-4">
                        <label for="status">STATUS: </label>
                        <select class="form-control filter-option" id="status" name="status"  style="width: 100%;">
                          <option value="" disabled selected>Select status</option>
                          <option>Active</option>
                          <option>Deactivated</option>
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
                      <img src="../../../img/tenant-list.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">List of user</div> 
                  </div>
                </h3>
                <div class="card-tools">
                  <div class="input-group input-group-md" style="width: 300px;">
                    <input type="text" name="search-user" id="search-user" class="form-control float-right input-bg" placeholder="SEARCH USER">

                    <div class="input-group-append">
                      <button type="button" class="btn btn-default" id="search-user-icon"><i class="fa fa-search"></i></button>
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
                            <th>NAME</th>
                            <th>GENDER</th>
                            <th>EMAIL</th>
                            <th>CONTACT NO</th>
                            <th>ADDRESS</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody class='tbody-user'>
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
  $('#setting-index').addClass('active');
  $('#setting-menu-open').addClass('menu-open');
  $('#setting-user-item').addClass('active');
   //Initialize Select2 Elements
  $('.select2').select2()

  let data = {};
  let LIMIT = 10;
  let PREVIUS_CONSTANT = 0;
  let NEXT_CONSTANT = LIMIT;
  let prev = PREVIUS_CONSTANT;
  let next = NEXT_CONSTANT;
  loadInit();

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


  $('#search-user').keyup(function() {
      $("#search-user-icon").html("<span class='fa fa-spinner fa-spin'></span>");
      if($(this).val() == '') {
          displayList(prev, next);
       }


      var rex = new RegExp($(this).val(), 'i');
      $('.tbody-user tr').hide();
      $('.tbody-user tr').filter(function() {
          return rex.test($(this).text());
      }).show();

      
       var total_book = $('.tbody-user tr').length;
       var rows = $('.tbody-user tr:hidden').length;

       $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + (prev + (total_book - rows)) + ' of ' + data.length + ' entries');

       if(rows == total_book) {
          $(".tbody-user").html('\
            <tr>\
              <td colspan="9" class="text-center">NO RECORDS AVAILABLE</td>\
            </tr>\
          ');
      }

      setTimeout(function() {
          $("#search-user-icon").html("<span class='fa fa-search' ></span>");
      }, 2000);
  });

  $('.filter-option').change(function() {
    let gender = $('#gender').val();
    let status = $('#status').val();

    if(gender == null) {
      gender = '';
    }

    if(status == null) {
      status = '';
    }

    getFilter(gender, status);
  });

  function loadInit() {
    try {
      let query =  CRUD;
      let response = {};
      query.path = '../../controller/user.php';
      query.param = { action: 'list' };
      response = query.run();
      response = JSON.parse(response);
      data = response;
      displayList(prev, next);
      console.log(response)
    }
    catch(err) {
      showError('System error.')
    }
  }

  function displayList(prev, next) {
    let html = '';
    let status = '';

    if(data.length == 0) {
      $(".tbody-user").html('\
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
        if(data[i].status == 'Active') {
          status = '<span class="badge bg-primary p-1 pl-2 pr-2">ACTIVE</span>';
        }
        else {
          status = '<span class="badge bg-danger">DEACTIVATED</span>';
        }

        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + data[i].first_name + ' ' + data[i].last_name + '</td>\
            <td>' + data[i].gender + '</td>\
            <td>' + data[i].email + '</td>\
            <td>' + data[i].contact_no + '</td>\
            <td>' + data[i].address + '</td>\
            <td id="status_id_'+ data[i].user_id + '">' + status + '</td>\
            <td>\
              <div class="btn-group float-right">\
                  <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">\
                    <i class="fa fa-list-ul"></i>\
                    Option\
                  </button>\
                  <ul class="dropdown-menu" style="margin-left: -45px;">\
                    <li><a class="dropdown-item" onclick=activateDeactivate("'+data[i].user_id+'","activate") style="cursor:pointer"><i class="fa fa-refresh"></i> Activate</a></li>\
                    <li><a class="dropdown-item" onclick=activateDeactivate("'+data[i].user_id+'","deactivated")  style="cursor:pointer"><i class="fa fa-trash"></i> Deactivate</a></li>\
                  </ul>\
                </div>\
            </td>\
          </tr>\
        ';
      }

      $('#p-total-list').text('Showing ' + (prev+1) + ' to ' + next + ' of ' + data.length + ' entries');
      $('.tbody-user').html(html);
    }
  }

  function activateDeactivate(id, category) {
    try {
     
      let query =  CRUD;
      let response = {};
      let status = '';
      query.path = '../../controller/user.php';
      query.param =  {
        action: 'activate_deactivate',
        category: category,
        id: id 
      };
      response = query.run();
      response = JSON.parse(response);
      console.log(response)

      if(response == false) {
        if(category == 'activate') {
          showSuccess('Record is succeffully activated.');
          status = '<span class="badge bg-primary p-1 pl-2 pr-2">ACTIVE</span>';
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


  function getFilter(gender, status) {
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../../controller/user.php';
      query.param =  {
        action: 'filter',
        gender: gender,
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
