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

  <title>Register | LMS</title>
  <link rel="shortcut icon" href="../../img/lms-sm.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../template/plugins/font-awesome/css/font-awesome.min.css">
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
          <li class="nav-item">
            <a href="index.php" class="nav-link"><i class="fa fa-home"></i> Login</a>
          </li>
          
          <li class="nav-item active-link">
            <a href="register.php" class="nav-link"><i class="fa fa-edit"></i> Register</a>
          </li>
          <li class="nav-item">
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
        <div class="row mb-2">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container ">
        <div class="col-md-5  col-xs-12" style="padding-top: 1%;margin: auto;">
         <div class="card ">
          <div class="card-header">
            <h2 class="card-title" style="font-size: 22px; font-weight: bold"><i class="fa fa-edit"></i> REGISTRATION </h2>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="form-register">
            <div class="card-body ">
              <div class="form-group pl-4 pr-4">
                <label for="first_name">First name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter fistname" required>
                <input type="hidden" class="form-control" id="action" name="action" value="add">
              </div>
              <div class="form-group pl-4 pr-4">
                <label for="last_name">Last name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter lastname" required>
              </div>
              <div class="form-group pl-4 pr-4">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
              </div>
              <div class="form-group pl-4 pr-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
              </div>
              
              <div class="col-12 mt-4" style="width: 92%; margin: auto;">
                <button type="submit" class="btn btn-block btn-outline-primary"><i class="fa fa-save"></i> Save</button>
                <a href="login.php" class="btn btn-block btn-outline-success"><i class="fa fa-unlock-alt"></i> Login</a>
              </div>
            </div>
            <!-- /.card-body -->

           
          </form>
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
<script src="../../template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../template/dist/js/adminlte.min.js"></script>
<!-- CRUD JS -->
<script src="../../template/myjs/crud.js"></script>
<!-- sweet alert JS -->
<script src="../../template/plugins/swa/dist/sweetalert.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $("#form-register").submit(function(e){
      e.preventDefault();
      registerUser();
    });

  });

 
  function registerUser() {
    try {
      let query =  CRUD;
      let response = {};
      let data = $("#form-register").serializeArray();

      query.path = '../controller/user.php';
      query.param = data;
      response = query.run();
      response = JSON.parse(response);

      if(response.duplicate == false && response.error == false) {
        showSuccess('User is successfully saved.');
        
      }
      else {
        if(response.duplicate == true) {
          showError('Username is already taken.');
        }
        else {
          showError('User not saved.');
        }
        
      }

      $('#form-register')[0].reset();
    }
    catch(error) {
      showError('System error.')
    }
  }
   
</script>
</body>
</html>
