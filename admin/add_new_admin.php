<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $get_category = $object->get_rows_from_one_table('category');
?>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/sidebar.php');?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include("includes/navbar1.php");?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Admin</h1>
          </div>

          <!-- Content Row -->
          <div class="row justify-content-center">
            <div class="container">
              <div class="card">
                <div class="card-header">
                  Admin Details
                </div>
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-8">
                      <form id="add_new_admin_form" method="post">
                        <div class="row">
                          <label>Fullname</label><br>
                          <input type="text" name="fullname" class="form-control" id="fullname">
                        </div>
                        <div class="row">
                          <label>Email</label><br>
                          <input type="email" name="email" class="form-control" id="email">
                        </div><br>
                        <button type="button" class="btn btn-primary mb-5" id="add_new_admin_btn" style="background-color: #1C174C; border-radius: 10px;">Add Admin</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include("includes/footer.php");?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>

  <?php include("includes/scripts.php");?>
</html>
