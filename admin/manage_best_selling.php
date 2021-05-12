<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $get_best_selling = $object->get_rows_from_one_table('best_selling_products');
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
            <h1 class="h3 mb-0 text-gray-800">Manage Best Selling Products</h1>
          </div>

          <!-- Content Row -->
            <div class="row">
              <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Best Selling Products</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Product Name</th>
                        <th>Date Added</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($get_best_selling != null){
                          $count = 1;
                          foreach ($get_best_selling as $value) {
                            $get_product = $object->get_one_row_from_one_table('products', 'unique_id', $value['product_id'])
                      ?>
                          <tr>
                            <td><?= $count;?></td>
                            <td><?= $get_product['name'];?></td>
                            <td><?= $value['date_created'];?></td>
                            <td>
                              <button title="Delete Product" class="btn delete_modal" data-unique_id="<?php echo $value['unique_id'];?>"><i class="fas fa-trash text-danger"></i></button>
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
                        <th>Product Name</th>
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
    $(".delete_modal").click(function(){
      $("#modal1").modal("show");
      var unique_id = $(this).data('unique_id');
      $("#unique_id").val(unique_id);
    });
  </script>

</body>

  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete From Best Selling </h5>
          <button type="button" class="close" data-dismiss="modal" onclick="$('#modal1').modal('hide')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this product from best selling?
          <form id="delete_best_selling_form" method="post">
            <input type="hidden" name="unique_id" id="unique_id">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal1').modal('hide')">Close</button>
          <button type="button" id="delete_best_selling_btn" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
</html>
