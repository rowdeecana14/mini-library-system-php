<?php
  $user_image = '../../../img/upload/'.$data['image'];
  $fullname = ucwords(strtolower($data['first_name'].' '.$data['last_name']));

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="../../../img/lms-sm.png" alt="AdminLTE Logo" style="height: 45px;"
         >
    <span class="text-sm font-weight-light">Library Management System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3">
      <div class="image d-flex">

        <img src="<?php echo $user_image; ?>" class="admin-img" alt="User Image">

        <div style="padding-top: 15px; padding-left: 10px; font-weight: bold">
          <a>Administrator</a><br>
          <a ><i class="fa fa-circle text-success"></i> <?php echo $fullname; ?></a>

        </div>
      </div>
      <!-- <div class="info" >
        <a style="font-weight: bold;">Administrator
        </a>
        
      </div>
 -->
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="dashboard.php" class="nav-link" id="dashboard">
            <i class="nav-icon fa fa-dashboard "></i>
            <p>
              Dashboard
              <i class="right "></i>
            </p>
          </a>
          
        </li>

        <li class="nav-item has-treeview" id="form-menu-open">
          <a href="#" class="nav-link" id="form-index">
            <i class="nav-icon fa fa-edit"></i>
            <p>
              Form
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="create_book.php" class="nav-link" id="form-add-book-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>Add books</p>
              </a>
            </li>
           
            <li class="nav-item">
              <a href="add_rented.php" class="nav-link" id="form-add-rented-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>Rent request</p>
              </a>
            </li>

           <li class="nav-item">
              <a href="add_returned.php" class="nav-link" id="form-add-returned-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>Return book</p>
              </a>
            </li>

          </ul>
        </li>


        <li class="nav-item has-treeview" id="book-menu-open">
          <a href="#" class="nav-link" id="book-index">
            <i class="nav-icon fa fa-copy"></i>
            <p>
              Records
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="list_of_book.php" class="nav-link" id="book-index-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>List of books</p>
              </a>
            </li>
           
            <li class="nav-item">
              <a href="rented_book.php" class="nav-link" id="book-rented-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>Rented book</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="returned_book.php" class="nav-link" id="book-returned-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>Returned book</p>
              </a>
            </li>
            
             <li class="nav-item">
              <a href="overdue_book.php" class="nav-link" id="book-overdue-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>Overdue book</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item ">
          <a href="report.php" class="nav-link "  id="report-index">
            <i class="nav-icon fa fa-table"></i>
            <p>
              Report
            </p>
          </a>
    
        </li>

       <li class="nav-item has-treeview" id="setting-menu-open">
          <a href="#" class="nav-link" id="setting-index">
            <i class="nav-icon fa fa-users"></i>
            <p>
              Users
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="user.php" class="nav-link" id="setting-user-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>List of user</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="user_logs.php" class="nav-link" id="setting-logs-item">
                <i class="fa fa-circle-o nav-icon text-info"></i>
                <p>User logs</p>
              </a>
            </li>
            
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>