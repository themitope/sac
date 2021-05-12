<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $get_pending_orders = $object->get_pending_orders('orders','status', 0, 'status', 1);
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
            <h1 class="h3 mb-0 text-gray-800">Pending Orders</h1>
          </div>

          <!-- Content Row -->
            <div class="row">
              <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Pending Orders</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>User</th>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Shipping Address</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Color</th>
                        <th>Amount Paid</th>
                        <th>Date Ordered</th>
                        <th>Order Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($get_pending_orders != null){
                          $count = 1;
                          foreach ($get_pending_orders as $order) {
                            $get_user = $object->get_one_row_from_one_table('users', 'unique_id', $order['user_id']);
                            $get_product = $object->get_one_row_from_one_table('products', 'unique_id', $order['product_id']);
                      ?>
                          <tr>
                            <td><?= $count;?></td>
                            <td><?= $get_user['fullname'];?></td>
                            <td><?= $order['order_id'];?></td>
                            <td class="text-capitalize"><?= $order['payment_method'];?></td>
                            <td><?= $get_user['address'];?></td>
                            <td><?= $get_product['name'];?></td>
                            <td><?= $order['quantity'];?></td>
                            <td><?= $order['color'];?></td>
                            <td>&#8358;<?= number_format($order['subtotal']);?></td>
                            <td><?= $order['date_created'];?></td>
                            <td>
                              <?php
                                if($order['status'] == 0){
                                  echo "<small class='badge badge-primary'>Pending</small>";
                                }
                                else if($order['status'] == 1){
                                  echo "<small class='badge badge-info'>In Process</small>";
                                }
                                else if($order['status'] == 2){
                                  echo "<small class='badge badge-success'>Delivered</small>";
                                }
                              ?>
                            </td>
                            <td>
                             <div class="dropdown no-arrow" title="Update Order">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-edit text-primary"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item in_process_modal" data-order_id="<?= $order['unique_id'];?>" data-order_status = "1" style="cursor: pointer;">In process</a>
                                  <a class="dropdown-item delivered_modal" data-order_id="<?= $order['unique_id'];?>" data-order_status = "2" style="cursor: pointer;">Delivered</a>
                                </div>
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
                        <th>User</th>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Shipping Address</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Color</th>
                        <th>Amount Paid</th>
                        <th>Date Ordered</th>
                        <th>Order Status</th>
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
    $(".in_process_modal").click(function(){
      $("#modal1").modal("show");
      var order_id = $(this).data('order_id');
      var order_status = $(this).data('order_status');
      $("#order_id1").val(order_id);
      $("#order_status1").val(order_status);
    });

    $(".delivered_modal").click(function(){
      $("#modal2").modal("show");
      var order_id = $(this).data('order_id');
      var order_status = $(this).data('order_status');
      $("#order_id2").val(order_id);
      $("#order_status2").val(order_status);
    });
  </script>

</body>

  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="$('#modal1').modal('hide')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to update this order's status to in process?
          <form id="in_process_form" method="post">
            <input type="hidden" name="order_id" id="order_id1">
            <input type="hidden" name="order_status" id="order_status1">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal1').modal('hide')">Close</button>
          <button type="button" id="in_process_btn" class="btn btn-success">Update Order</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="$('#modal2').modal('hide')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to update this order's status to delivered?
          <form id="delivered_form" method="post">
            <input type="hidden" name="order_id" id="order_id2">
            <input type="hidden" name="order_status" id="order_status2">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal2').modal('hide')">Close</button>
          <button type="button" id="delivered_btn" class="btn btn-success">Update Order</button>
        </div>
      </div>
    </div>
  </div>
</html>
