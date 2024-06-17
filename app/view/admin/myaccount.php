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
  <title>My account | LMS</title>
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
              <li class="breadcrumb-item active">My profile</li>
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
                      <img src="../../../img/tenant-profile.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1">My profile</div> 
                  </div>
                </h5>

              

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 col-xs-12">

                      <!-- Profile Image -->
                      <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <img style="padding: 3px; border: 3px solid #b1b5b9;" width="150px" height="150px" src="../../../img/unknown.png" alt="User profile picture" id="image-detail">
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
                          <h3 class="card-title"><i class="fa fa-info-circle"></i> My details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <strong  class="strong-font"><i class="fa fa-circle-o mr-1  "></i> NAME:</strong>
                          <p class="text-muted ml-3 mb-1" id="name-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> GENDER:</strong>
                          <p class="text-muted ml-3 mb-1" id="gender-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0"><hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> EMAIL:</strong>
                          <p class="text-muted ml-3 mb-1" id="email-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> CONTACT NO:</strong>
                          <p class="text-muted ml-3 mb-1" id="contactno-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> ADDRESS:</strong>
                          <p class="text-muted ml-3 mb-1" id="address-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> REGISTERED AT:</strong>
                          <p class="text-muted ml-3 mb-1" id="createdat-detail">
                            535325-325235
                          </p>
                          <hr class="mb-0 mt-0">

                          <strong class="strong-font"><i class="fa fa-circle-o mr-1"></i> UPDATED AT:</strong>
                          <p class="text-muted ml-3 mb-1" id="updatedat-detail">
                            535325-325235
                          </p>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->

                  <div class="col-md-9 col-xs-12">
                   <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><i class="fa fa-user"></i> Update details</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><i class="fa fa-lock"></i> Upadate account</a></li>
                        </ul>
                      </div><!-- /.card-header -->
                      <div class="card-body">
                        <div class="tab-content">

                          <div class="tab-pane active" id="activity">
                            <form role="form" id="form-update-datails">
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="isbn">FIRST NAME: </label>
                                  <input type="text" class="form-control input-lg" name="first_name" id="first_name" placeholder="First name" required>
                                </div>

                                <div class="form-group">
                                  <label for="title">LAST NAME: </label>
                                  <input type="text" class="form-control input-lg" id="last_name" name="last_name" placeholder="Last name" required>
                                </div>

                          
                                <div class="input-group input-group-md mb-3">
                                  <label for="genre">GENDER: </label>
                                  <select class="form-control" id="gender" name="gender" style="width: 100%;">
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
                                 
                                </div>

                                <div class="form-group">
                                  <label for="pages">EMAIL:</label>
                                  <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                  <label for="pages">CONTACT NO:</label>
                                  <input type="number" class="form-control input-lg" id="contactno" name="contactno" placeholder="Contact no">
                                </div>

                                <div class="form-group">
                                  <label>ADDRESS:</label>
                                  <textarea class="form-control" rows="3" id="address" name="address" placeholder="Address"></textarea>
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

                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="timeline">
                              <form role="form" id="form-update-account">
                                <div class="card-body">
                                  <div class="form-group">
                                    <label for="Username">USERNAME: </label>
                                    <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Username" required>
                                    <input type="hidden" class="form-control input-lg" name="action" value="profile_update_account">
                                  </div>

                                  <div class="form-group">
                                    <label for="new_password">NEW PASSWORD: </label>
                                    <div class="input-group input-group-md">
                                      <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password" autofocus required>
                                      <span class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-flat" id="btn-new-pass">Show</button>
                                      </span>
                                    </div>
                                  </div>

                                   <div class="form-group">
                                    <label for="current_password">CURRENT PASSWORD: </label>
                                    <div class="input-group input-group-md">
                                      <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current password" autofocus required>
                                      <span class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-flat" id="btn-current-pass">Show</button>
                                      </span>
                                    </div>
                                  </div>


                                  <div id="alert-message">
                                    
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
                          <!-- /.tab-pane -->

                         
                        </div>
                        <!-- /.tab-content -->
                      </div><!-- /.card-body -->
                    </div>


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
                      <input type="hidden" name="user_id"  id="user_id" value="<?php echo $data['user_id']; ?>">
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
 
  loadUser();

  $(document).ready(function(){
    
     //Initialize Select2 Elements
    $('.select2').select2();

    $("#form-update-datails").submit(function(e){
      e.preventDefault();
      updateDetails();
    });

    $("#form-update-account").submit(function(e){
      e.preventDefault();
      updateAccount();
    });

    $("#current_password").keyup(function(){
      checkCurrentPassword($(this).val());
    });

    $("#current_password").keydown(function(){
      checkCurrentPassword($(this).val());
    });


    $('#btn-update-image').click(function() {
      $('#modal-update-image').modal('show');
    });

    $("#form-update-image").submit(function(e){
      e.preventDefault();
      updateImage();
    });

    $('#btn-current-pass').click(function() {
      showHide('#btn-current-pass', '#current_password');
    });

    $('#btn-new-pass').click(function() {
      showHide('#btn-new-pass', '#new_password');
    });

  });


  function loadUser() {

    try {
      let query =  CRUD;
      let response = {};
      query.path = '../../controller/user.php';
      query.param = {
        action: 'load_user',
        user_id: '<?php echo $data['user_id']; ?>'
      };
      response = query.run();
      response = JSON.parse(response);
      //console.log(response);
      viewDetail(response);
    }
    catch(error) {
      console.log(error)
      showError('System error.')
    }
  }

  function showHide(btn_name, input_name) {
    let btn_value = $(btn_name).text();

    if(btn_value == 'Show') {
      $(btn_name).text('Hide');
      $(input_name).attr('type', 'text');
    }
    else {
      $(btn_name).text('Show');
      $(input_name).attr('type', 'password');
    }
  }


  function updateImage() {
    let form = document.getElementById('form-update-image');
    $.ajax({
      url: "../../controller/user.php",
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
        loadUser();

      },
      error: function(error){
        console.log(error);
        showError('System error.')
      }
    });
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


  function updateDetails() {
    try {
      let query =  CRUD;
      let response = {};
      let data = $("#form-update-datails").serializeArray();
      data.push({ name: 'action', value: 'update_profile_details' });
      data.push({ name: 'user_id', value: '<?php echo $data['user_id']; ?>' });

      query.path = '../../controller/user.php';
      query.param = data;
      response = query.run();
      response = JSON.parse(response);

      if(response == false) {
        showSuccess('Record is successfully updated.')
        
      }
      else {
        showError('Record not updated.')
      }

      loadUser();

    }
    catch(error) {
      console.log(error)
      showError('System error.')
    }
    
  }

  function updateAccount() {
    try {
      let query =  CRUD;
      let response = {};
      let data = $("#form-update-account").serializeArray();
      data.push({ name: 'action', value: 'update_profile_account' });
      data.push({ name: 'user_id', value: '<?php echo $data['user_id']; ?>' });

      query.path = '../../controller/user.php';
      query.param = data;
      response = query.run();
      response = JSON.parse(response);

      if(response.password_match == true && response.error == false) {
        showSuccess('Record is successfully updated.')
      }
      else {
        showError('Incorrect current password.')
      }

      $('#form-update-account')[0].reset();
      $('#alert-message').html('');
      loadUser();

    }
    catch(error) {
      console.log(error)
      showError('System error.')
    }
    
  }


  function checkCurrentPassword(input) {

    if(input == '') {
       $('#alert-message').html('');
       return;
    }
   try {
      let query =  CRUD;
      let response = {};

      query.path = '../../controller/user.php';
      query.param = {
        action: 'check_password',
        password: input,
        user_id: '<?php echo $data['user_id']; ?>'
      };
      response = query.run();
      response = JSON.parse(response);

      if(response == true) {
        $('#alert-message').html(`
          <div class="alert alert-success" role="alert">
            <strong>
                <span class="fa fa-check-circle"></span> Password match.
              </strong>
            </div>
        `);
      }
      else {
        $('#alert-message').html(
          `<div class="alert alert-warning" role="alert">          
              <strong>
                <span class="fa fa-times-circle"></span> Incorrect current password.
              </strong>
            </div>
        `);
      }

    }
    catch(error) {
      console.log(error)
      showError('System error.')
    }
  }


  function viewDetail(data) {
    $('#first_name').val(data[0].first_name);
    $('#last_name').val(data[0].last_name);
    $('#gender').val(data[0].gender);
    $('#email').val(data[0].email);
    $('#contactno').val(data[0].contact_no);
    $('#address').val(data[0].address);
    $('#username').val(data[0].username);


    $('#name-detail').text(data[0].first_name + ' ' + data[0].last_name);
    $('#gender-detail').text(data[0].gender);
    $('#email-detail').text(data[0].email);
    $('#contactno-detail').text(data[0].contact_no);
    $('#address-detail').text(data[0].address);
    $('#createdat-detail').text(data[0].created_at);
    $('#updatedat-detail').text(data[0].updated_at);
    $('#image-detail').attr("src", '../../../img/upload/'+data[0].image);

    $('#image-preview').attr("src", '../../../img/upload/'+data[0].image);
    $('#modal-update-image').modal('hide');

  }





</script>
</body>
</html>
