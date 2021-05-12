<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="assets/fontawesome/js/all.min.js"></script>
<script type="text/javascript" src="assets/js/toaster/build/toastr.min.js"></script>
<script src="multi_step/dist/js/MultiStep.min.js"></script>
<script src="js/scripts.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  	$("#toggle_sidebar").click(function(){
      $("#mySidebar").toggle();
    });

    $("#toggle_sidebar1").click(function(){
      $("#mySidebar1").toggle();
    });

    $("#close_navbar").click(function(){
      $("#mySidebar").hide();
    });

    $("#close_cart").click(function(){
      $("#mySidebar1").hide();
    });
  // $(".increment_counter").click(function(){
  //     var id = $(this).attr('id');
  //     var counter_value = $("#counter_value"+id).html();
  //     var price = $("#increment_price_hidden"+id).html();
  //     var subtotal = $("#subtotal_hidden").val();
  //     counter_value++;
  //     var new_price = price * counter_value;
  //     var new_subtotal = subtotal + new_price;
  //     $("#counter_value"+id).html(counter_value);
  //     $("#increment_price"+id).html(new_price);
  //     $("#subtotal").html(new_subtotal);
  //     $("#total").html(new_subtotal);
  //   });

    // $(".decrement_counter").click(function(){
    //   var id = $(this).attr('id');
    //   var counter_value = $("#counter_value"+id).html();
    //   var price = $("#increment_price_hidden"+id).html();
    //   var subtotal = $("#subtotal_hidden").val();
    //   if(counter_value != 1){
    //     counter_value--;
    //     var new_price = price * counter_value;
    //     var new_subtotal = subtotal + new_price;
    //     $("#counter_value"+id).html(counter_value);
    //     $("#increment_price"+id).html(new_price);
    //     $("#subtotal").html(new_subtotal);
    //     $("#total").html(new_subtotal);
    //   }
    // });
    });
</script>