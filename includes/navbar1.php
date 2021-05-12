<?php
  session_start();
  include("config/db_class.php");
  $object = new DbQueries();
  // print_r($_SESSION['cart']);
  // if(!isset($_SESSION['user'])){
  //   header("Location: login");
  // }
  $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
  @$count_cart = count($cart_items);
  $location = isset($_SESSION['location']) ? $_SESSION['location'] : '';
  // echo $location;
?>
<nav class="navbar navbar-expand-lg ml-5" style="background-color: #fff">
  <div class="container-fluid mt-3 mb-1">
    <a class="navbar-brand" href="#"><img src="assets/images/sac_logo3.png" alt="sac_logo" class="img-fluid"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars navbar-toggler-icon" style="color: #000000;"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <form class="d-flex">
          <input class="form-control me-2 search_form" type="search" placeholder="Name of hair, style, brand" aria-label="Search">
          <button class="search_btn btn" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <ul class="navbar-nav">
        <li class="nav-item ms-5 me-4 mt-1">
          <form>
            <select class="form-select location location_dropdown" name="location">
              <option value=""><i class="fas fa-map-marker-alt"></i> Choose Location</option>
              <option value="Lagos" <?= ($location == 'Lagos') ? 'selected' : '';?>>Lagos</option>
              <option value="Port-Harcourt" <?= ($location == 'Port-Harcourt') ? 'selected' : ''; ?>>Port-Harcourt City</option>
            </select>
          </form>
        </li>
        <!-- <li class="nav-item margin_class mt-1"> -->
          <li class="nav-item margin_class mt-1 dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user fa-2x user_icon"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
                if(isset($_SESSION['user'])){
                  echo '<a class="dropdown-item" href="logout">Logout <i class="fas fa-sign-out-alt text-danger"></i></a></li>';
                  echo '<a class="dropdown-item" href="dashboard">Dashboard <i class="fas fa-tachometer-alt text-success"></i></a></li>';
                }
                else{
                  echo '<a class="dropdown-item" href="login">Login <i class="fas fa-sign-in-alt"></i></a></li>';
                }
              ?>
            </ul>
          </li>
        <!-- </li> -->
        <li class="nav-item margin_class_mobile mt-1">
          <a class="nav-link" aria-current="page" id="toggle_sidebar1" style="cursor: pointer;"><i class="fas fa-shopping-cart fa-2x user_icon"></i></a>
          <?php
            if($count_cart > 0){
              ?>
               <span class="cart_count" style="" id="badge"><strong><?php echo $count_cart;?></strong></span>
              <?php
            }else{
          ?>
          <span class="cart_count" style="display: none" id="badge"><strong></strong></span>
        <?php } ?>
        </li>
      </ul>
      </ul>
    </div>
  </div>
</nav>
<div class="card sidenav1" style="display: none;" id="mySidebar1">
  <div class="cart_top">
    <span class="fw-bold">Cart
    <button id="close_cart" class="btn float-end close_cart" style="">&times;</button></span>
  </div>
  <div class="container mt-4 mb-5">
    <?php
      if($cart_items != null){
        $subtotal = 0; 
        foreach ($cart_items as $item) {
          $get_product = $object->get_one_row_from_one_table('products', 'unique_id', $item['product_id']);
    ?>
      <div class="row" id="cart_item">
        <div class="col-md-4">
          <img src="admin/<?= $get_product['product_image'];?>" class="img-fluid" style="border-radius: 10px">
        </div>
        <div class="col-md-5">
          <p class="fw-bold"><?= $get_product['name']?></p>
          <div>
            <button type="button" class="me-2 btn btn-warning decrement_counter" id="<?= $item['product_id'];?>" style="padding: 0 10px 0 10px!important; height: 5%;">&minus;</button>
             <span class="fw-bold" id="counter_value1<?= $item['product_id'];?>"><?= $item['counter_value']?></span> 
             <button type="button" class="btn ms-2 add_button increment_counter" id="<?= $item['product_id'];?>">&plus;</button>
           </div>
        </div>
        <div class="col-md-3">
          <button style="border: none;" class ="remove_from_cart" id="<?= $item['product_id'];?>"><i class="fas fa-trash-alt" style="color: #AAAAAA"></i></button>
          <p class="mt-3 fw-bold" style="color: #1C174C">&#8358;<span id="increment_price<?= $item['product_id'];?>"><?= number_format($item['price']);?></span></p>
          <span id="increment_price_hidden<?= $item['product_id'];?>" style="display: none"><?= $get_product['price'];?></span>
        </div>
      </div>
      <hr>
    <?php $subtotal+=$item['price'];} ?>
        <div class="row">
          <div class="col-md-7"><p class="fw-bold">Subtotal</p></div>
          <div class="col-md-5"><p class="fw-bold">&#8358;<span id="subtotal"><?= number_format($subtotal);?></span></p></div>
          <input type="hidden" name="" id="subtotal_hidden" value="<?= $subtotal?>">
        </div>
        <div class="row">
          <div class="col-md-7"><p class="fw-bold">Tax</p></div>
          <div class="col-md-5"><p class="fw-bold" style="color: #1C174C">&#8358;1320</p></div>
        </div>
        <div class="row">
          <div class="col-md-7"><p class="fw-bold">Total</p></div>
          <div class="col-md-5"><p class="fw-bold" style="color: #1C174C">&#8358;<span id="subtotal"><?= number_format($subtotal);?></span></p></div>
          <input type="hidden" name="" id="total_hidden" value="<?= $subtotal?>">
        </div>
        <hr>
        <div class="d-flex justify-content-center">
          <a href="cart"><button type="button" class="btn cart_button" id="view_cart" style="">View Cart</button></a>
        </div>
        <div class="d-flex justify-content-center">
          <a href="checkout"><button type="button" class="btn mt-3 checkout_btn">Checkout</button></a>
        </div>
    <?php }
      else{
        ?>
        <h5 class="text-center">Your cart is empty</h5>
        <div class="d-flex justify-content-center">
          <a href="index"><button type="button" class="btn mt-3 checkout_btn">Continue Shopping</button></a>
        </div>
      <?php
      }
    ?>
    <!-- <hr> -->
  </div>
</div>