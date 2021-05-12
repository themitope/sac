<?php 
  session_start();
  include("includes/header.php");
  if(isset($_SESSION['admin'])){
    header("Location: index");
  }
?>

<body class="" style="background-color: #1C174C;">

  <div class="container mt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-8 col-md-8">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <img src="../assets/images/sac_logo.png" class="img-fluid w-25">
             <!--  <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-10">
                <div class="pb-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                  </div>
                  <form class="user" id="login_admin_form" method="post">
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <button type="button" class="btn btn-user btn-block" style="background-color: #1C174C;" id="login_admin">
                      Login
                    </button>
                    <hr>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php include("includes/scripts.php");?>

</body>

</html>
