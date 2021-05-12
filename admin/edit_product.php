<?php
  include("includes/header.php");
  include("../config/db_class.php");
  $object = new DbQueries();
  $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
  $get_product = $object->get_one_row_from_one_table('products', 'unique_id', $product_id);
  $get_product_category = $object->get_one_row_from_one_table('category', 'unique_id', $get_product['category']);
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
            <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
          </div>

          <!-- Content Row -->
          <div class="row justify-content-center">
            <div class="col-md-8">
              <form id="edit_product_form">
                <div class="row">
                  <label>Product Name</label><br>
                  <input type="text" name="name" class="form-control" id="name" value="<?= $get_product['name'];?>">
                </div>
                <div class="row">
                  <label>Product Decription</label><br>
                  <textarea name="description" cols="50" rows="10" class="form-control"><?= $get_product['description'];?></textarea>
                </div>
                <div class="row">
                  <label>Product Category</label><br>
                  <select name="category" class="form-control">
                    <option value="">Select a Category</option>
                    <option value="<?= $get_product_category['unique_id']?>" selected><?= $get_product_category['name'];?></option>
                    <?php
                      foreach ($get_category as  $category) {
                    ?>
                      <option value="<?= $category['unique_id']?>"><?= $category['name'];?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="row">
                  <label>Product Sub Category</label><br>
                  <input type="text" name="sub_category" class="form-control" value="<?= $get_product['sub_category'];?>">
                </div>
                <div class="row">
                  <label>Product Price</label><br>
                  <input type="number" name="price" class="form-control" value="<?= $get_product['price'];?>">
                </div>
                <div class="row">
                  <label>Product Weight</label><br>
                  <input type="text" name="weight" class="form-control" value="<?= $get_product['weight'];?>">
                </div>
                <div class="row">
                  <label>Product Dimensions</label><br>
                  <input type="text" name="dimensions" class="form-control" value="<?= $get_product['dimensions'];?>">
                </div>
                <div class="row">
                  <label>Product Colors (separate with comma)</label><br>
                  <textarea name="colors" cols="60" rows="10" class="form-control"><?= $get_product['colours'];?></textarea>
                </div>
                <div class="row">
                  <label>Product SKU</label><br>
                  <input type="text" name="sku" class="form-control" value="<?= $get_product['sku'];?>">
                </div>
                <div class="row">
                  <label>Number of Product Available</label><br>
                  <input type="number" name="available_no" class="form-control" value="<?= $get_product['available_no'];?>">
                </div>
                <div class="row">
                  <label>Product Image</label>
                  <input type="file" name="file" class="form-control" id="file">
                  <span id="uploaded_image1"></span>
                  <input type="hidden" name="product_image" id="product_image" value="<?= $get_product['product_image']?>">
                </div>
                <div class="row">
                  <label>Other Product Images</label>
                  <input type="file" name="files[]" class="form-control" id="files" multiple >
                  <span id="uploaded_image"></span>
                  <input type="hidden" name="image_url" id="image_url" value="<?= $get_product['image_url'];?>">
                </div>
                <div class="row">
                  <label>Does the product have discount?</label><br>
                  <select class="form-control" id="discount_form">
                    <option value="">Select an option</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
                <div class="row" style="display: none" id="show_discount_price">
                  <label>Price Before Discount</label><br>
                  <input type="number" name="price_before_discount" class="form-control" value="<?= $get_product['price_before_discount'];?>">
                </div> <br>
                <input type="hidden" name="product_id" value="<?= $get_product['unique_id'];?>">
                <button class="btn btn-primary mb-5" id="edit_product_btn" style="background-color: #1C174C; border-radius: 10px;">Edit Product</button>
              </form>
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
    $(document).ready(function(){
      $("select#discount_form").change(function(){
        var selected_option = $("select#discount_form").children("option:selected").val();
          if(selected_option == ''){
            $("#show_discount_price").hide();
            alert("Please select an option");
          }
          else if(selected_option == "yes"){
            $("#show_discount_price").show();
          }
          else if(selected_option == "no"){
            $("#show_discount_price").hide();
          }
        });

         $(document).on('change', '#files', function(){
            let unique_id3 = $("#name").val();
            var form_data = new FormData();
        // Read selected files
        var totalfiles = document.getElementById('files').files.length;
        for (var index = 0; index < totalfiles; index++) {
          form_data.append("files[]", document.getElementById('files').files[index]);
        }

        // AJAX request
        $.ajax({
         url: 'upload_image.php', 
         type: 'post',
         data: form_data,
         dataType: 'json',
         contentType: false,
         processData: false,
         beforeSend:function(){
                  $('#uploaded_image').html("<label class='text_primary'><b>Image Uploading, please wait...</b></label>");
                },
        success: function (response) {
             $('#uploaded_image').html("<label class='text_success'><b>Image Uploaded</b></label>");
              $('#image_url').val(response);
           // for(var index = 0; index < response.length; index++) {
           //   var src = response[index];

           //   // Add img element in <div id='preview'>
           //
           // }

         }
        });

        });

        $(document).on('change', '#file', function(){
            let unique_id3 = $("#name").val();;
            var property = document.getElementById("file").files[0];
            var image_name = property.name;
            var image_size = property.size;
            var image_extension = image_name.split(".").pop().toLowerCase();
            if(jQuery.inArray(image_extension, ['png', 'jpg', 'jpeg']) == -1){
              alert("Invalid Image File");
              $('#uploaded_image').html("<label class='text_primary'><b>Image Upload failed, please try again</b></label>");
            }
            else if(image_size > 5000000){
              alert("Image File size is very big");
              $('#uploaded_image').html("<label class='text_primary'><b>Image Upload failed, please try again</b></label>");
            }else{
              var form_data = new FormData();
              form_data.append("file", property);
              form_data.append("unique_id3", unique_id3);
              $.ajax({
                url: "upload_image1.php",
                method: "POST",
                data: form_data,
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                  $('#uploaded_image1').html("<label class='text_primary'><b>Image Uploading, please wait...</b></label>");
                },
                success: function(data){
                  $('#uploaded_image1').html("<label class='text_success'><b>Image Uploaded</b></label>");
                  $('#product_image').val(data);
                }
              })
            }
        });
    })
  </script>

</html>
