$(document).ready(function(){

	$(document).ready( function () {
	    $('#myTable').DataTable();
	});

	function formatNumber(num) {
  		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
	}

	$("#register_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax/register_user.php",
			method: "POST",
			data: $("#register_form").serialize(),
			beforeSend: function(){
				$("#register_btn").attr("disabled", true);
				$("#register_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully registered and your password has been sent to your mail', 'Success')
					setTimeout(function(){window.location.href= "login"}, 3000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#register_btn").attr("disabled", false);
				$("#register_btn").text("Register");
			}
		})
	});

	$("#login_btn").click(function(e){
		e.preventDefault();
		var prev_page = $("#prev_page").val();
		$.ajax({
			url:"ajax/login_user.php",
			method: "POST",
			data: $("#login_form").serialize(),
			beforeSend: function(){
				$("#login_btn").attr("disabled", true);
				$("#login_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					if(prev_page == ''){
						toastr.success('You have successfully logged in', 'Success')
						setTimeout(function(){window.location.href= "dashboard"}, 3000);
					}
					else{
						toastr.success('You have successfully logged in', 'Success')
						setTimeout(function(){window.location.href= prev_page}, 3000);
					}
					
				}else{
					toastr.error(data, 'Error!')
				}
				$("#login_btn").attr("disabled", false);
				$("#login_btn").text("Login");
			}
		})
	});

	$("#add_product_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/add_product.php",
			method: "POST",
			data: $("#add_product_form").serialize(),
			beforeSend: function(){
				$("#add_product_btn").attr("disabled", true);
				$("#add_product_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully added product', 'Success')
					setTimeout(function(){window.location.href= "add_product"}, 3000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#add_product_btn").attr("disabled", false);
				$("#add_product_btn").text("Add Product");
			}
		})
	});

	$("#add_category_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/add_category.php",
			method: "POST",
			data: $("#add_category_form").serialize(),
			beforeSend: function(){
				$("#add_category_btn").attr("disabled", true);
				$("#add_category_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully added category', 'Success')
					setTimeout(function(){window.location.href= "add_category"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#add_category_btn").attr("disabled", false);
				$("#add_category_btn").text("Add Category");
			}
		})
	});

	$(".add_to_cart").click(function(e){
		e.preventDefault();
		var counter_value = $("#counter_value2").html();
		var product_id = $("#product_id").val();
		var color = $("select#color").children("option:selected").val();
		var price = $("#price").val();
		var cal_price = price * counter_value;
		$.ajax({
			url: "ajax/add_to_cart",
			method: "POST",
			data: {counter_value, product_id, color, cal_price},
			beforeSend: function(){
				$(".add_to_cart").attr("disabled", true);
				$(".add_to_cart").text("Adding...");
			},
			success: function(data){
				location.reload();
				// setTimeout(function(){location.reload()}, 200);
				// $("#mySidebar1").show();
				$(".add_to_cart").attr("disabled", false);
				$(".add_to_cart").text("Add to cart");
			}
		})
	});

	$(".increment_counter").click(function(e){
		e.preventDefault();
		var product_id2 = $(this).attr('id');
       	var counter_value2 = 1;
  		var price2 = $("#increment_price_hidden"+product_id2).html();
		var cal_price2 = price2 * counter_value2;
		console.log(price2);
		$.ajax({
			url: "ajax/add_to_cart",
			method: "POST",
			data: {
				counter_value: counter_value2, 
				product_id: product_id2, 
				cal_price: cal_price2
			},
			beforeSend: function(){
				$(".increment_counter").attr("disabled", true);
				// $(".add_to_cart").text("Adding...");
			},
			success: function(data){
				location.reload();
				// setTimeout(function(){location.reload()}, 200);
				// $("#mySidebar1").show();
				$(".increment_counter").attr("disabled", false);
				// $(".add_to_cart").text("Add to cart");
			}
		})
	})

	$(".decrement_counter").click(function(e){
		e.preventDefault();
		var product_id2 = $(this).attr('id');
       	var counter_value2 = 1;
       	var counter_value1 = $("#counter_value1"+product_id2).html();
  		var price2 = $("#increment_price_hidden"+product_id2).html();
		var cal_price2 = price2 * counter_value2;
		console.log(price2);
		if(counter_value1 > 1){
			$.ajax({
				url: "ajax/decrement_cart",
				method: "POST",
				data: {
					counter_value: counter_value2, 
					product_id: product_id2, 
					cal_price: cal_price2
				},
				beforeSend: function(){
					$(".decrement_counter").attr("disabled", true);
					// $(".add_to_cart").text("Adding...");
				},
				success: function(data){
					location.reload()
					// setTimeout(function(){location.reload()}, 200);
					// $("#mySidebar1").show();
					$(".decrement_counter").attr("disabled", false);
					// $(".add_to_cart").text("Add to cart");
				}
			})
		}
	})

	$(".remove_from_cart").click(function(e){
		e.preventDefault();
		var product_id2 = $(this).attr('id');
		$.ajax({
			url: "ajax/remove_from_cart",
			method: "POST",
			data: { 
				product_id: product_id2, 
			},
			beforeSend: function(){
				$(".remove_from_cart").attr("disabled", true);
				// $(".add_to_cart").text("Adding...");
			},
			success: function(data){
				location.reload();
				// setTimeout(function(){location.reload()}, 200);
				// $("#mySidebar1").show();
				$(".remove_from_cart").attr("disabled", false);
				// $(".add_to_cart").text("Add to cart");
			}
		})
	});

	$(".location").change(function(e){
		e.preventDefault();
		var location = $("select.location").children("option:selected").val();
		// console.log(location);
		if(location == ''){
			alert("Please choose a location");
		}else{
			$.ajax({
				url: "ajax/choose_location",
				method: "POST",
				data: {location},
				success: function(data){
					window.location.href=window.location.href;
					$("#location_div").empty();
					$("#location_div").html(data);
					$("input[name='shipping_method']").attr('checked', false);
				}
			})
		}
	});

	$(".change_address").change(function(e){
		e.preventDefault();
		var location = $("select.change_address").children("option:selected").val();
		console.log(location);
		if(location == ''){
			alert("Please choose a location");
		}else{
			$.ajax({
				url: "ajax/choose_location",
				method: "POST",
				data: {location},
				success: function(data){
					// window.location.href=window.location.href;
					$("#location_div").empty();
					$("#location_div").html(data);
					$("input[name='shipping_method']").attr('checked', false);
				}
			})
		}
	});

	$(".shipping_method").change(function(e){
		e.preventDefault();
		var shipping_id = $(this).attr("id");
		$.ajax({
			url:"ajax/get_shipping_price",
			method: "POST",
			data:{shipping_id},
			success: function(data){
				var subtotal_all = parseInt($("#subtotal_all").val());
				var data = parseInt(data);
				var total = subtotal_all + data;
				console.log(total);
				$("#total_price").html(formatNumber(total)); 
				$("#shipping_total").val(total);
			}
		})
	});

	$("#proceed_to_checkout_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax/proceed_to_checkout.php",
			method: "POST",
			data: $("#proceed_to_checkout_form").serialize(),
			beforeSend: function(){
				$("#proceed_to_checkout_btn").attr("disabled", true);
				$("#proceed_to_checkout_btn").text("Please wait...");
			},
			success: function(data){
				window.location.href="checkout";
				$("#proceed_to_checkout_btn").attr("disabled", false);
				$("#proceed_to_checkout_btn").text("Proceed to Checkout");
			}
		})
	});

	$("#place_order_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax/place_order.php",
			method: "POST",
			data: $("#place_order_form").serialize(),
			beforeSend: function(){
				$("#place_order_btn").attr("disabled", true);
				$("#place_order_btn").text("Please wait...");
			},
			success: function(data){
				if(data['status'] == "success"){
					toastr.success('Your order has been placed successfully', 'Success')
					setTimeout(function(){window.location.href= "order_complete"}, 3000);
				}else if(data['status'] == "redirect"){
					setTimeout(function(){window.location.href= data['url']}, 3000);
				}
				else if(data['status'] == "error"){
					toastr.error(data['message'], 'Error!')
				}
				// console(data);
				$("#place_order_btn").attr("disabled", false);
				$("#place_order_btn").text("Proceed to Checkout");
			}
		})
	});

	$("#payment_method_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax/add_payment_method.php",
			method: "POST",
			data: $("#payment_method_form").serialize(),
			beforeSend: function(){
				$("#payment_method_btn").attr("disabled", true);
				$("#payment_method_btn").text("Please wait...");
			},
			success: function(data){
				if(data == 'success'){
					toastr.success('Your payment method has been saved successfully', 'Success')
					setTimeout(function(){window.location.href= "payment_method"}, 3000);
				}else{
					toastr.error(data, 'Error!');
				}	
				$("#payment_method_btn").attr("disabled", false);
				$("#payment_method_btn").text("Add Payment Method");
			}
		})
	});

	$("#save_address").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax/save_address.php",
			method: "POST",
			data: $("#save_address_form").serialize(),
			beforeSend: function(){
				$("#save_address").attr("disabled", true);
				$("#save_address").text("Please wait...");
			},
			success: function(data){
				if(data == 'success'){
					toastr.success('Your address has been saved successfully', 'Success')
					setTimeout(function(){window.location.href= "address"}, 3000);
				}else{
					toastr.error(data, 'Error!');
				}	
				$("#save_address").attr("disabled", false);
				$("#save_address").text("Save Address");
			}
		})
	});

	$("#edit_profile_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax/edit_profile.php",
			method: "POST",
			data: $("#edit_profile_form").serialize(),
			beforeSend: function(){
				$("#edit_profile_btn").attr("disabled", true);
				$("#edit_profile_btn").text("Please wait...");
			},
			success: function(data){
				if(data == 'success'){
					toastr.success('Your account details have been updated successfully', 'Success')
					setTimeout(function(){window.location.href= "account_details"}, 3000);
				}else{
					toastr.error(data, 'Error!');
				}	
				$("#edit_profile_btn").attr("disabled", false);
				$("#edit_profile_btn").text("Save Changes");
			}
		})
	});

	$("#login_admin").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/login_admin.php",
			method: "POST",
			data: $("#login_admin_form").serialize(),
			beforeSend: function(){
				$("#login_admin").attr("disabled", true);
				$("#login_admin").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully logged in', 'Success')
					setTimeout(function(){window.location.href= "index"}, 3000);
					
				}else{
					toastr.error(data, 'Error!')
				}
				$("#login_admin").attr("disabled", false);
				$("#login_admin").text("Login");
			}
		})
	});

	$("#disable_user_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/disable_user.php",
			method: "POST",
			data: $("#disable_user_form").serialize(),
			beforeSend: function(){
				$("#disable_user_btn").attr("disabled", true);
				$("#disable_user_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					$("#modal1").modal("hide");
					toastr.success('You have successfully disabled this user', 'Success')
					setTimeout(function(){window.location.href= "manage_users"}, 3000);
					
				}else{
					toastr.error(data, 'Error!')
				}
				$("#disable_user_btn").attr("disabled", false);
				$("#disable_user_btn").text("Disable User");
			}
		})
	});

	$("#enable_user_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/enable_user.php",
			method: "POST",
			data: $("#enable_user_form").serialize(),
			beforeSend: function(){
				$("#enable_user_btn").attr("disabled", true);
				$("#enable_user_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					$("#modal2").modal("hide");
					toastr.success('You have successfully enabled this user', 'Success')
					setTimeout(function(){window.location.href= "manage_users"}, 3000);
					
				}else{
					toastr.error(data, 'Error!')
				}
				$("#enable_user_btn").attr("disabled", false);
				$("#enable_user_btn").text("Enable User");
			}
		})
	});

	$("#edit_product_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/edit_product.php",
			method: "POST",
			data: $("#edit_product_form").serialize(),
			beforeSend: function(){
				$("#edit_product_btn").attr("disabled", true);
				$("#edit_product_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully edited this product', 'Success')
					setTimeout(function(){window.location.href= "manage_products"}, 3000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#edit_product_btn").attr("disabled", false);
				$("#edit_product_btn").text("Edit Product");
			}
		})
	});

	$("#delete_product_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/delete_product.php",
			method: "POST",
			data: $("#delete_product_form").serialize(),
			beforeSend: function(){
				$("#delete_product_btn").attr("disabled", true);
				$("#delete_product_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully deleted this product', 'Success')
					setTimeout(function(){window.location.href= "manage_products"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#delete_product_btn").attr("disabled", false);
				$("#delete_product_btn").text("Delete Product");
			}
		})
	});

	$("#edit_category_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/edit_category.php",
			method: "POST",
			data: $("#edit_category_form").serialize(),
			beforeSend: function(){
				$("#edit_category_btn").attr("disabled", true);
				$("#edit_category_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully edited this category', 'Success')
					setTimeout(function(){window.location.href= "manage_categories"}, 3000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#edit_category_btn").attr("disabled", false);
				$("#edit_category_btn").text("Edit Category");
			}
		})
	});

	$("#delete_category_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/delete_category.php",
			method: "POST",
			data: $("#delete_category_form").serialize(),
			beforeSend: function(){
				$("#delete_category_btn").attr("disabled", true);
				$("#delete_category_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully deleted this category', 'Success')
					setTimeout(function(){window.location.href= "manage_categories"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#delete_category_btn").attr("disabled", false);
				$("#delete_category_btn").text("Delete Category");
			}
		})
	});

	$("#in_process_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/update_order.php",
			method: "POST",
			data: $("#in_process_form").serialize(),
			beforeSend: function(){
				$("#in_process_btn").attr("disabled", true);
				$("#in_process_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully updated this order', 'Success')
					setTimeout(function(){window.location.href= "pending_orders"}, 3000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#in_process_btn").attr("disabled", false);
				$("#in_process_btn").text("Update Order");
			}
		})
	});

	$("#delivered_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/update_order.php",
			method: "POST",
			data: $("#delivered_form").serialize(),
			beforeSend: function(){
				$("#delivered_btn").attr("disabled", true);
				$("#delivered_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully updated this order', 'Success')
					setTimeout(function(){window.location.href= "pending_orders"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#delivered_btn").attr("disabled", false);
				$("#delivered_btn").text("Update Order");
			}
		})
	});

	$("#add_new_admin_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/add_new_admin.php",
			method: "POST",
			data: $("#add_new_admin_form").serialize(),
			beforeSend: function(){
				$("#add_new_admin_btn").attr("disabled", true);
				$("#add_new_admin_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully added another admin, password has been sent to the email address provided', 'Success')
					setTimeout(function(){window.location.href= "add_new_admin"}, 5000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#add_new_admin_btn").attr("disabled", false);
				$("#add_new_admin_btn").text("Add Admin");
			}
		})
	});

	$("#add_best_selling_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/add_best_selling.php",
			method: "POST",
			data: $("#add_best_selling_form").serialize(),
			beforeSend: function(){
				$("#add_best_selling_btn").attr("disabled", true);
				$("#add_best_selling_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully added best selling products', 'Success')
					setTimeout(function(){window.location.href= "add_best_selling"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#add_best_selling_btn").attr("disabled", false);
				$("#add_best_selling_btn").text("Add Products");
			}
		})
	});

	$("#add_hot_now_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/add_hot_now_product.php",
			method: "POST",
			data: $("#add_hot_now_form").serialize(),
			beforeSend: function(){
				$("#add_hot_now_btn").attr("disabled", true);
				$("#add_hot_now_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully added hot products', 'Success')
					setTimeout(function(){window.location.href= "add_hot_now"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#add_hot_now_btn").attr("disabled", false);
				$("#add_hot_now_btn").text("Add Products");
			}
		})
	});

	$("#delete_best_selling_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/delete_best_selling.php",
			method: "POST",
			data: $("#delete_best_selling_form").serialize(),
			beforeSend: function(){
				$("#delete_best_selling_btn").attr("disabled", true);
				$("#delete_best_selling_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully deleted the product from best selling', 'Success')
					setTimeout(function(){window.location.href= "manage_best_selling"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#delete_best_selling_btn").attr("disabled", false);
				$("#delete_best_selling_btn").text("Delete");
			}
		})
	});

	$("#delete_hot_now_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax_admin/delete_hot_now.php",
			method: "POST",
			data: $("#delete_hot_now_form").serialize(),
			beforeSend: function(){
				$("#delete_hot_now_btn").attr("disabled", true);
				$("#delete_hot_now_btn").text("Please wait...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully deleted the product from hot now', 'Success')
					setTimeout(function(){window.location.href= "manage_hot_now"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#delete_hot_now_btn").attr("disabled", false);
				$("#delete_hot_now_btn").text("Delete");
			}
		})
	});

	$("#submit_rating_btn").click(function(e){
		e.preventDefault();
		$.ajax({
			url:"ajax/submit_rating.php",
			method: "POST",
			data: $("#submit_rating_form").serialize(),
			beforeSend: function(){
				$("#submit_rating_btn").attr("disabled", true);
				$("#submit_rating_btn").text("Submitting...");
			},
			success: function(data){
				if(data == "success"){
					toastr.success('You have successfully submitted your rating', 'Success')
					setTimeout(function(){window.location.href= "my_orders"}, 2000);
				}else{
					toastr.error(data, 'Error!')
				}
				$("#submit_rating_btn").attr("disabled", false);
				$("#submit_rating_btn").text("Submit");
			}
		})
	});

});