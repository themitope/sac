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
            <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
          </div>

          <!-- Content Row -->
          <div class="row justify-content-center">
            <div class="container">
              <div class="card">
                <div class="card-header">
                  Category Details
                </div>
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-8">
                      <form id="add_category_form">
                        <div class="row">
                          <label>Category Name</label><br>
                          <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="row">
                          <label>Category Description</label><br>
                          <textarea name="description" cols="50" rows="10" class="form-control"></textarea>
                        </div><br>
                        <button class="btn btn-primary mb-5" id="add_category_btn" style="background-color: #1C174C; border-radius: 10px;">Add Category</button>
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
