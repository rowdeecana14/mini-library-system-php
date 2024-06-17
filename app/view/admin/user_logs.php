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
  <title>User logs | LMS</title>
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
              <li class="breadcrumb-item active">User logs</li>
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
                   <div class="row col-10 offset-1">

                    <div class="col-md-4 col-xs-12">

                       <div class="input-group mb-4">
                        <label for="username">USER: </label>
                        <select class="form-control select2  filter-option" id="username" name="username"  style="width: 100%;">
                          <option value="" disabled selected>Select user</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12">

                       <div class="input-group mb-4">
                        <label for="action">ACTIVITY: </label>
                        <select class="form-control  filter-option" id="action" name="action"  style="width: 100%;">
                          <option value="" disabled selected>Select activity</option>
                          <option>Login</option>
                          <option>Logout</option>
                          <option>Error</option>
                        </select>
                      </div>
                    </div>

                     <div class="col-md-4 col-xs-12">

                       <div class="form-group">
                          <label for="date">DATE: </label>
                          <input type="date" class="form-control filter-option" id="date" name="date" placeholder="Date">
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
                      <img src="../../../img/logs.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">User logs</div> 
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
                            <th>PROFILE</th>
                            <th>USERNAME</th>
                            <th>DESCRIPTION</th>
                            <th>ACTIVITY</th>
                            <th>DATE AND TIME</th>
                        </thead>
                        <tbody class='tbody-user'>
                          <tr>
                            <td colspan='6' class="text-center">NO RECORDS AVAILABLE</td>
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
  $('#setting-logs-item').addClass('active');
   //Initialize Select2 Elements
  $('.select2').select2()

  let data = {};
  let PREVIUS_CONSTANT = 0;
  let LIMIT = 50;
  let NEXT_CONSTANT = LIMIT;
  let prev = PREVIUS_CONSTANT;
  let next = NEXT_CONSTANT;
  loadInit();
  loadUser();

  $('#btn-refresh').click(function() {
    $('#form-filter')[0].reset();
    $('#search-user').val('');
    loadInit();
    loadUser();
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
              <td colspan="6" class="text-center">NO RECORDS AVAILABLE</td>\
            </tr>\
          ');
      }

      setTimeout(function() {
          $("#search-user-icon").html("<span class='fa fa-search' ></span>");
      }, 2000);
  });

  $('.filter-option').change(function() {
    let user = $('#username').val();
    let action = $('#action').val();
    let date = $('#date').val();

    if(user == null) {
      user = '';
    }

    if(action == null) {
      action = '';
    }

    if(date == null) {
      date = '';
    }
    getFilter(user, action, date);
  });

  function loadInit() {
    try {
      let query =  CRUD;
      let response = {};
      query.path = '../../controller/user.php';
      query.param = { action: 'logs' };
      response = query.run();
      response = JSON.parse(response);
      data = response;
      //console.log(response);
      displayList(prev, next);
    }
    catch(err) {
      showError('System error.')
    }
  }


  function loadUser() {
    try {
      let query =  CRUD;
      let response = {};
      query.path = '../../controller/user.php';
      query.param = { action: 'load-list' };
      response = query.run();
      response = JSON.parse(response);
      //console.log(response);
      displayUser(response);
    }
    catch(err) {
      showError('System error.')
    }
  }


  function displayUser(response) {
    let len = response.length;
    let html = '<option value="" selected disabled>Select user</option><option value="0">unknown user</option>';

    for(var i = 0; i < len; i++) {
      html += '<option value="'+response[i].user_id+'">' + response[i].username + '</option>';
    }

    $('#username').html(html);
  }

  function displayList(prev, next) {
    let html = '';
    let action = '';
    let image = '';
    let name = 'unknown user';

    if(data.length == 0) {
      $(".tbody-user").html('\
        <tr>\
          <td colspan="6" class="text-center">NO RECORDS AVAILABLE</td>\
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
        if(data[i].action == 'Login') {
          action = '<span class="badge bg-success p-1 pr-2 - pl-2">LOGIN</span>';
        }
        else if(data[i].action == 'Logout') {
          action = '<span class="badge bg-warning p-1 1 pr-2 - pl-2">LOGOUT</span>';
        }
        else {
          action = '<span class="badge bg-danger p-1 1 pr-2 - pl-2">ERROR</span>';
        }

        if(data[i].user_id > 0 && data[i].user_id != null) {
          image = '<img src="' + '../../../img/upload/' + data[i].image +'" class="display_img">';
        }
        else {
          image = '<img src="' + '../../../img/upload/error.png" class="display_img" style=" border: 2px solid red;">';
        }

        if(data[i].username == null) {
          name = 'unknown user';
        }
        else {
          name = data[i].username;
        }


        html += '\
        <tr>\
            <td>' + (i + 1) + '</td>\
            <td>' + image + '</td>\
            <td>' + name + '</td>\
            <td>' + data[i].description + '</td>\
            <td>' + action + '</td>\
            <td>' + data[i].date + '</td>\
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
      //console.log(response)

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


  function getFilter(user, activity, date) {
   
    try {
     
      let query =  CRUD;
      let response = {}; 

      query.path = '../../controller/user.php';
      query.param =  {
        action: 'filter-logs',
        user_id: user,
        activity: activity,
        date: date
      };
      response = query.run();
      response = JSON.parse(response);
      data = response;
      prev = PREVIUS_CONSTANT;
      next = NEXT_CONSTANT;

      displayList(prev, next);
      //console.log(response);
    }
    catch(err) {
      showError('System error.')
    }
  }
  
</script>
</body>
</html>
