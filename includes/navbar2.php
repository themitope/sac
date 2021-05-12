<?php
  $get_category = $object->get_rows_from_one_table('category');
?>
<nav class="my_nav">
  <ul class="d-flex">
    <li class="my_nav_list">
      <span id="toggle_sidebar"><i class="fas fa-bars fa-2x" style="color: #fff; cursor: pointer;"></i></span>
    </li>
    <li class="my_nav_list d-none d-lg-block">
      <a href="index">Latest</a>
    </li>
    <?php
      if($get_category != null){
        foreach ($get_category as $category) {
    ?>
      <li class="my_nav_list d-none d-lg-block">
        <a href="product_category?category_id=<?=$category['unique_id'];?>"><?=$category['name'] ?></a>
      </li>
    <?php } }?>
    <!-- <li class="my_nav_list d-none d-lg-block">
      <a href="">Wigs</a>
    </li>
    <li class="my_nav_list d-none d-lg-block">
      <a href="">Twists</a>
    </li>
    <li class="my_nav_list d-none d-lg-block">
      <a href="">Braids</a>
    </li>
    <li class="my_nav_list d-none d-lg-block">
      <a href="">Locs</a>
    </li> -->
  </ul>
</nav>
<div class="sidenav" style="display: none" id="mySidebar">
  <button id="close_navbar" class="btn btn-danger me-3 float-end">&times;</button><br>
  <!-- <button class="btn-toggle">Toggle Dark-Mode</button> -->
  <a href="index" class="w3-bar-item w3-button">Choose Your Hairstyle</a>
  <a href="hot_now" class="w3-bar-item w3-button">Hot right now</a>
  <a href="best_selling" class="w3-bar-item w3-button">Best Selling Hair</a>
  <a href="#" class="w3-bar-item w3-button">Hair Secret</a>
  <a href="https://docs.google.com/forms/d/e/1FAIpQLSfCiPq_bhN4KHW0NxMyhWxZ0PqH2fLsRipGNmzvWZF9G7KbTg/viewform" class="w3-bar-item w3-button" target="_blank">I want to buy in bulk</a>
</div>
