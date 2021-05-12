<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $get_delivered_orders = $object->get_rows_from_one_table_by_id('orders', 'status', 2);
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
            <h1 class="h3 mb-0 text-gray-800">All Orders</h1>
          </div>

          <!-- Content Row -->
            <div class="row">
              <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($get_delivered_orders != null){
                          $count = 1;
                          foreach ($get_delivered_orders as $order) {
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

</body>
</html>
