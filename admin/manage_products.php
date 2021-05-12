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
            <h1 class="h3 mb-0 text-gray-800">Manage Products</h1>
          </div>

          <!-- Content Row -->
            <div class="row">
              <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Price</th>
                        <th>Available Number</th>
                        <th>Date Added</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($get_products != null){
                          $count = 1;
                          foreach ($get_products as $product) {
                            $product_id = $product['unique_id'];
                            $get_category = $object->get_one_row_from_one_table('category', 'unique_id', $product['category']);
                      ?>
                          <tr>
                            <td><?= $count;?></td>
                            <td><?= $product['name'];?></td>
                            <td><?= $get_category['name'];?></td>
                            <td><?= $product['sub_category'];?></td>
                            <td><?= $product['price'];?></td>
                            <td><?= $product['available_no'];?></td>
                            <td><?= $product['date_created'];?></td>
                            <td>
                             <div class="d-flex">
                               <a href="edit_product?product_id=<?= $product_id;?>" title="Edit Product" class="btn"><i class="fa fa-edit text-primary"></i></a>
                                <button title="Delete Product" class="btn delete_product_modal" data-product_id="<?php echo $product_id;?>"><i class="fas fa-trash text-danger"></i></button>
                             </div>
                            </td>
                          </tr> 
                          <?php
                          $count++;}
                        }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Price</th>
                        <th>Available Number</th>
                        <th>Date Added</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
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
  <script type="text/javascript">
    $(".delete_product_modal").click(function(){
      $("#modal1").modal("show");
      var product_id = $(this).data('product_id');
      $("#product_id").val(product_id);
    });
  </script>

</body>

  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="$('#modal1').modal('hide')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this product?
          <form id="delete_product_form" method="post">
            <input type="hidden" name="product_id" id="product_id">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal1').modal('hide')">Close</button>
          <button type="button" id="delete_product_btn" class="btn btn-danger">Delete Product</button>
        </div>
      </div>
    </div>
  </div>
</html>
