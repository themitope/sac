<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../assets/fontawesome/js/all.min.js"></script>
<script type="text/javascript" src="../assets/js/toaster/build/toastr.min.js"></script>
<!-- <script src="multi_step/dist/js/MultiStep.min.js"></script> -->
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/select2.min.js"></script>
  <script src="vendor/ckeditor5/ckeditor.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../js/scripts.js"></script>
<script type="text/javascript">
  // $(document).ready(function(){
  // 	$("#toggle_sidebar").click(function(){
  //     $("#mySidebar").toggle();
  //   });

  //   $("#toggle_sidebar1").click(function(){
  //     $("#mySidebar1").toggle();
  //   });

  //   $("#close_navbar").click(function(){
  //     $("#mySidebar").hide();
  //   });

  //   $("#close_cart").click(function(){
  //     $("#mySidebar1").hide();
  //   });
  // $("#increment_counter").click(function(){
  //     var counter_value = $("#counter_value").html();
  //     var price = $("#increment_price_hidden").html();
  //     counter_value++;
  //     var new_price = price * counter_value;
  //     $("#counter_value").html(counter_value);
  //     $("#increment_price").html(new_price);
  //   });

  //   $("#decrement_counter").click(function(){
  //     var counter_value = $("#counter_value").html();
  //     var price = $("#increment_price_hidden").html();
  //     if(counter_value != 1){
  //       counter_value--;
  //       var new_price = price * counter_value;
  //       $("#counter_value").html(counter_value);
  //       $("#increment_price").html(new_price);
  //     }
  //   });
  //   });

  $(document).ready(function() {
    $('.select2').select2();
});

    ClassicEditor
    .create( document.querySelector( '#editor' ), {
    })
    .then( editor => {
      window.editor = editor;
    })
    .catch( err => {
      console.error( err.stack );
    });
</script>
</script>