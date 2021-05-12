<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $get_users = $object->get_rows_from_one_table('users');
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
            <h1 class="h3 mb-0 text-gray-800">Manage Users</h1>
          </div>

          <!-- Content Row -->
            <div class="row">
              <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Fullname</th>
                        <th>Email Address</th>
                        <th>Country</th>
                        <th>Address</th>
                        <th>Post Code</th>
                        <th>Phone Number</th>
                        <th>Date Registered</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($get_users != null){
                          $count = 1;
                          foreach ($get_users as $user) {
                            $user_id = $user['unique_id'];
                      ?>
                          <tr>
                            <td><?= $count;?></td>
                            <td><?= $user['fullname'];?></td>
                            <td><?= $user['email'];?></td>
                            <td><?= $user['country'];?></td>
                            <td><?= $user['address'];?></td>
                            <td><?= $user['postcode'];?></td>
                            <td><?= $user['phone'];?></td>
                            <td><?= $user['date_created'];?></td>
                            <td>
                              <?php
                                if($user['status'] == 1){
                                  echo '<small class="badge badge-success">Active</small>';
                                }
                                else if($user['status'] == 0){
                                  echo '<small class="badge badge-danger">Not Active</small>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php
                                if($user['status'] == 1){
                                  echo '<button class="btn btn-sm btn-danger disable_user_modal" data-unique_id="'.$user_id.'">Disable</button>';
                                }
                                else if($user['status'] == 0){
                                  echo '<button class="btn btn-sm btn-success enable_user_modal" data-unique_id="'.$user_id.'">Enable</button>';
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
                        <th>Fullname</th>
                        <th>Email Address</th>
                        <th>Country</th>
                        <th>Address</th>
                        <th>Post Code</th>
                        <th>Phone Number</th>
                        <th>Date Registered</th>
                        <th>Status</th>
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
    $(".disable_user_modal").click(function(){
      $("#modal1").modal("show");
      var unique_id1 = $(this).data('unique_id');
      $("#unique_id1").val(unique_id1);
    });
    $(".enable_user_modal").click(function(){
      $("#modal2").modal("show");
      var unique_id2 = $(this).data('unique_id');
      $("#unique_id2").val(unique_id2);
    });
  </script>

</body>

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Disable User</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#modal1').modal('hide')" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to disable user?
        <form id="disable_user_form" method="post">
          <input type="hidden" name="unique_id" id="unique_id1">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal1').modal('hide')">Close</button>
        <button type="button" id="disable_user_btn" class="btn btn-danger">Disable User</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enable User</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#modal2').modal('hide')" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to enable user?
        <form id="enable_user_form" method="post">
          <input type="hidden" name="unique_id" id="unique_id2">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal2').modal('hide')">Close</button>
        <button type="button" id="enable_user_btn" class="btn btn-success">Enable User</button>
      </div>
    </div>
  </div>
</div>

</html>
