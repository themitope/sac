<?php include('includes/header.php');?>
<body>

<?php include('includes/navbar1.php');
  $get_categories = $object->get_rows_from_one_table('category');
?>
<?php include('includes/navbar2.php')?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-8">
      <div class="card" style="background-color: #1C174C; border-radius: 10px;">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/images/Woman_with_dreadlocks_-.png" class="d-block float-end w-75" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h1>Hair for <br>Every Woman</h1>
                <button type="button" class="mt-4 btn explore_btn">Explore</button>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/images/attractive-young-.png" class="d-block float-end w-75" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h1>Hair for <br>Every Woman</h1>
                <button type="button" class="mt-4 btn explore_btn">Explore</button>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/images/good-looking-.png" class="d-block float-end w-75" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h1>Hair for <br>Every Woman</h1>
                <button type="button" class="mt-4 btn explore_btn">Explore</button>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/images/indoor-portrait-.png" class="d-block float-end w-75" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h1>Hair for <br>Every Woman</h1>
                <button type="button" class="mt-4 btn explore_btn">Explore</button>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/images/inspired-african-.png" class="d-block float-end w-75" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h1>Hair for <br>Every Woman</h1>
                <button type="button" class="mt-4 btn explore_btn">Explore</button>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/images/joyful-attractive-.png" class="d-block float-end w-75" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h1>Hair for <br>Every Woman</h1>
                <button type="button" class="mt-4 btn explore_btn">Explore</button>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card my_discount_card">
        <img src="assets/images/glad-african2--removebg-preview.png" class="d-block w-100" alt="...">
        <h5 class="text-white">Get 10% discount <br> on bulk orders paced</h5>
      </div>
    </div>
  </div>
  <div class="row mt-5 mb-5">
    <h5 style="color: #1C174C">Choose your Hairstyle</h5>
    <div class="col-md-3">
      <div class="card" style="border-radius: 10px">
        <div class="container">
          <p class="mt-4 fw" style="color: #1C174C">Sort By</p>
          <form>
            <div class="form-group">
              <select class="form-control">
                <option value="recent">Recent</option>
              </select>
            </div>
            <div class="form-group">
              <p class="mt-4" style="color: #1C174C">Size</p>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Small</label>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked="">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Medium</label>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked="">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Large</label>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked="">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Extra Large</label>
              </div>
            </div>
            <div class="form-group">
              <p class="mt-4" style="color: #1C174C">Price</p>
              <input type="text" name="min_price" class="form-control form-control-sm" id="min_price" placeholder="Minimum Price...">
              <input type="text" name="max_price" class="mt-2 mb-5 form-control-sm form-control" id="max_price" placeholder="Maximum Price...">
            </div> 
            <!-- <div class="form-group">
              <p class="mt-4" style="color: #1C174C">Brand Name</p>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Lorem</label>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked="">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Lorem</label>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked="">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Lorem</label>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Lorem</label>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Lorem</label>
              </div>
            </div>  -->
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <?php
          if($get_categories != null){
          foreach ($get_categories as $category) {
            $get_products = $object->get_rows_from_one_table_by_one_param_with_limit('products','category',$category['unique_id'], 3);
            ?>
            <div class="col-md-12 mb-3">
              <div class="card" style="border-radius: 10px">
                <div class="container">
                  <div class="d-flex">
                    <p class="mt-4" style="color: #1C174C"><?= $category['name']?></p>
                    <a href="product_category?category_id=<?php echo $category['unique_id'];?>" class="mt-4 ms-auto" style="color: #F9D30B">See All</a>
                  </div>
                  <div class="row">
                    <?php
                    if($get_products != null){
                      foreach ($get_products as $products) {
                        if(str_word_count($products['name']) > 3){
                          $explode_string = explode(' ', $products['name']);
                          $product_name = $explode_string[0].' '.$explode_string[1].' '.$explode_string[2].' '.'...';
                        }
                        else{
                          $product_name = $products['name'];
                        }
                    ?>
                      <div class="col-md-4">
                        <a href="product?product_id=<?= $products['unique_id'];?>">
                          <div class="card" style="border-radius: 10px">
                            <img src="admin/<?= $products['product_image'];?>" style="border-radius: 10px">
                          </div>
                        </a>
                        <center>
                          <small style="color: #707070"><?= $product_name;?></small>
                          <p class="fw-bold">&#8358;<?= number_format($products['price']);?></p>
                        </center>
                      </div>
                    <?php } }?>
                  </div>
                </div>
              </div>
            </div>
          <?php  
          } }
        ?>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card" style="border-radius: 10px;">
        <div class="card_top" style="border-radius: 10px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
          <img src="assets/images/women-hairstyle-back-.png" class="img-fluid">
        </div>
        <div class="card_down" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
          <h3 class="ms-4 mt-4 mb-5" style="line-height: 50px;">Explore our new collection of <br>wigs</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="mb-5">
  <div class="explore">
    <h3 class="text-center">Explore from our collection of exquisite wigs</h3>
  </div>
</section>

<section>
  <div class="container">
    <h5 style="color: #1C174C">Recently Viewed Items</h5>
    <div class="card" style="border-radius: 10px;">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet1.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet2.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet3.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet4.jpg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet5.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/bella_crochet.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-5" style="border-radius: 10px;">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet1.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet2.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet3.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet4.jpg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/crochet5.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
          <div class="col-md-2">
            <div class="card" style="border-radius: 10px">
              <img src="assets/images/bella_crochet.jpeg" style="border-radius: 10px">
            </div>
            <center>
              <small style="color: #707070">Bella Crochet</small>
              <p class="fw-bold">&#8358;2500</p>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section_hairstyle mt-5 mb-5">
  <div class="own_hairstyle mt-5">
    <div class="container">
      <img src="assets/images/glad-black-woman-removebg-preview.png" class="w-70 float-end d-none d-md-block">
      <h1 class="text-white"><span style="color: #26889E; background-color: #fff">Own</span> that Hairstyle</h1>
    </div>
  </div>
</section>

<section class="mt-5 mb-5">
  <div class="container">
    <div class="card mt-3" style="border-radius: 10px;">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mt-4 mb-4">
            <div class="delivery1">
              <img src="assets/images/beautiful-young-.png" class="w-75 float-end">
            </div>
          </div>
          <div class="col-md-6 mt-4 mb-4">
            <div class="delivery2">
              <div class="container">
                <div class="row">
                  <div class="col-md-6" style="margin-top: 15%; margin-bottom: 10%;">
                    <h3 style="color: #1C174C">Fast Deliveries</h3>
                    <div class="delivery_round mt-3">
                      <h3 class="text-white" style="padding: 23px 15px;">24/7</h3>
                    </div>
                  </div>
                  <div class="col-md-6 float-end">
                    <img src="assets/images/delivery-truck-.png" class="w-100">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>

<script>
  $(document).ready(function(){
    
  });
</script>
<script type="text/javascript">
const btn = document.querySelector(".btn-toggle");
const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");

const currentTheme = localStorage.getItem("theme");
if (currentTheme == "dark") {
  document.body.classList.toggle("dark-theme");
} else if (currentTheme == "light") {
  document.body.classList.toggle("light-theme");
}

btn.addEventListener("click", function () {
  if (prefersDarkScheme.matches) {
    document.body.classList.toggle("light-theme");
    var theme = document.body.classList.contains("light-theme")
      ? "light"
      : "dark";
  } else {
    document.body.classList.toggle("dark-theme");
    var theme = document.body.classList.contains("dark-theme")
      ? "dark"
      : "light";
  }
  localStorage.setItem("theme", theme);
});
</script>
</body>
</html>