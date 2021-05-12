<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $get_products = $object->get_rows_from_one_table('products');
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
            <h1 class="h3 mb-0 text-gray-800">Add Hot Now Product</h1>
          </div>

          <!-- Content Row -->
          <div class="row justify-content-center">
            <div class="container">
              <div class="card">
                <div class="card-header">
                  Hot Products
                </div>
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-8">
                      <form id="add_hot_now_form" method="post">
                        <label>Choose Products</label>
                        <select name="product_id[]" class="select2 form-control" multiple="">
                          <option value="">Select an option</option>
                          <?php
                            foreach ($get_products as $product) {
                          ?>
                          <option value="<?= $product['unique_id'];?>"><?= $product['name'];?></option>
                        <?php } ?>
                        </select>
                        <button type="button" class="btn btn-primary mt-3 mb-5" id="add_hot_now_btn" style="background-color: #1C174C; border-radius: 10px;">Add Products</button>
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
