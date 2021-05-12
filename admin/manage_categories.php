<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $get_categories = $object->get_rows_from_one_table('category');
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
            <h1 class="h3 mb-0 text-gray-800">Manage Categories</h1>
          </div>

          <!-- Content Row -->
            <div class="row">
              <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date Added</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($get_categories != null){
                          $count = 1;
                          foreach ($get_categories as $category) {
                            $category_id = $category['unique_id'];
                      ?>
                          <tr>
                            <td><?= $count;?></td>
                            <td><?= $category['name'];?></td>
                            <td><?= $category['description'];?></td>
                            <td><?= $category['date_created'];?></td>
                            <td>
                             <div class="d-flex">
                               <button title="Edit category" class="btn edit_category_modal" 
                               data-category_id="<?php echo $category_id;?>"
                               data-name="<?php echo $category['name'];?>"
                               data-description="<?php echo $category['description'];?>"
                               >
                               <i class="fa fa-edit text-primary"></i>
                             </button>
                                <button title="Delete category" class="btn delete_category_modal" data-category_id="<?php echo $category_id;?>"><i class="fas fa-trash text-danger"></i></button>
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
                        <th>Description</th>
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
    $(".delete_category_modal").click(function(){
      $("#modal1").modal("show");
      var category_id = $(this).data('category_id');
      $("#category_id1").val(category_id);
    });

    $(".edit_category_modal").click(function(){
      $("#modal2").modal("show");
      var category_id = $(this).data('category_id');
      var name = $(this).data('name');
      var description = $(this).data('description');
      $("#category_id2").val(category_id);
      $("#name").val(name);
      $("#description").html(description);
    });
  </script>

</body>

  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="$('#modal1').modal('hide')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this category?
          <form id="delete_category_form" method="post">
            <input type="hidden" name="category_id" id="category_id1">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal1').modal('hide')">Close</button>
          <button type="button" id="delete_category_btn" class="btn btn-danger">Delete Category</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="$('#modal1').modal('hide')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="edit_category_form" method="post">
            <div class="container">
              <div class="row">
                <label>Category Name</label><br>
                <input type="text" name="name" class="form-control" id="name">
              </div>
              <div class="row">
                <label>Category Description</label><br>
                <textarea name="description" cols="50" rows="10" class="form-control" id="description"></textarea>
              </div><br>
              <input type="hidden" name="category_id" id="category_id2">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal2').modal('hide')">Close</button>
          <button type="button" id="edit_category_btn" class="btn btn-success">Edit Category</button>
        </div>
      </div>
    </div>
  </div>
</html>
