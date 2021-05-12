<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $my_location = $_POST['location'];
    $_SESSION['location'] = $my_location;
    $object = new DbQueries();
    $get_location = $object->get_rows_from_one_table_by_one_param('shipping_location', 'town', $my_location);
	foreach ($get_location as $value) {
?>
	<div class=" mt-3">
		<div class="form-check">
		  <input class="form-check-input shipping_method" type="radio" name="shipping_method" id="<?= $value['unique_id'];?>">
		  <label class="form-check-label" for="">
		    <small>Same Day Delivery (<?= $value['delivery_location'];?>) if Order is before 12 Noon otherwise next Day: <span class="fw-bold">&#8358;<?= number_format($value['shipping_fee']);?></span></small>
		  </label>
		</div>
	</div>
<?php } ?>