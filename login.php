<title>BROD RIDERS MS | Login</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-info">
    
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row d-flex justify-content-center">

  <?php 
    if(isset($_POST['changepassword'])) {
    $user_Id = $_POST['user_Id'];
    $cpassword = md5($_POST['cpassword']);
    $update = mysqli_query($conn, "UPDATE users SET password='$cpassword' WHERE user_Id='$user_Id'");
      if($update) {
        $_SESSION['message'] = "Password has been changed. Please login to your account.";
        $_SESSION['text'] = "Successfully changed";
        $_SESSION['status'] = "success";
        include 'sweetalert_messages.php';
        echo '<script>window.history.go(+1); </script>';
  ?>

          <div class="col-lg-10 col-md-10 col-12 card m-5">
            <div class="row"  style="min-height: 500px;max-height: 500px;">
              <div class="col-lg-8 col-md-12 col-sm-12 col-12 position-relative justify-content-center d-flex bg-navy p-0">
                  <?php 
                    $fetchpic = mysqli_query($conn, "SELECT * FROM customization WHERE status='Active'");
                    if(mysqli_num_rows($fetchpic) > 0) {
                      while ($pic = mysqli_fetch_array($fetchpic)) {
                        echo '<img src="images-customization/'.$pic['picture'].'" alt="" class="img-fluid">';
                      }
                    } else {
                      echo '<img src="images/logo.png" alt="" class="img-fluid">';
                    }
                  ?>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12 col-12 bg-light">
                  <div class="card-header text-center justify-content-center d-flex">
                    <div class="col-6 p-3">
                      <!-- <a href="login.php" class="h1"><b>Login</b></a> -->
                      <a href="login.php" class="h1">
                        <img src="dist/img/logo.png" alt="logo" class="img-fluid">
                      </a>
                    </div>
                  </div>
                <div class="card-body  bg-white">
                  <p class="login-box-msg">Sign in to start your session</p>
                  <form action="processes.php" method="post" id="quickForm">
                    <div class="input-group">
                      <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" >
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>
                    <!-- FOR INVALID EMAIL -->
                    <div class="input-group mt-1 mb-3">
                      <small id="text" style="font-style: italic;"></small>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" placeholder="Password" id="password" name="password" minlength="8" required>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-8">
                        <div class="icheck-primary">
                          <input type="checkbox" id="remember" id="remember" onclick="myFunction()">
                          <label for="remember">
                            Show password
                          </label>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary btn-block" name="login" id="login">Sign In</button>
                      </div>
                    </div>
                  </form>
                  <p>
                    <a href="forgot-password.php">I forgot my password</a>
                    <br>
                    <a href="register.php" class="text-center">Register a new membership</a>
                  </p>
                </div>
              </div>
            </div>
              
          </div>


  <?php } else { ?>

          <div class="col-lg-4 col-md-4 col-sm-6 col-12 mt-5">
             <section class="content">
              <div class="error-page">
                <h2 class="headline text-warning"> 404</h2>
                <div class="error-content">
                  <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
                  <p>
                    We could not find the page you were looking for.
                    Meanwhile, you may return to <a href="login.php">login</a> page.
                  </p>
                  <form class="search-form">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </section>
          </div>

  <?php } } else { ?>

          <div class="col-lg-10 col-md-10 col-12 card m-5" style="max-height: 300px; min-height: 300px;">

            <div class="row" >
              <div class="col-lg-8 col-md-12 col-sm-12 col-12 justify-content-center d-flex bg-navy p-0">
                  <?php 
                    $fetchpic = mysqli_query($conn, "SELECT * FROM customization WHERE status='Active'");
                    if(mysqli_num_rows($fetchpic) > 0) {
                      while ($pic = mysqli_fetch_array($fetchpic)) {
                        echo '<img src="images-customization/'.$pic['picture'].'" alt="" class="img-fluid">';
                      }
                    } else {
                      echo '<img src="images/logo.png" alt="" class="img-fluid"  style="height: 100%;width: 70%">';
                    }
                  ?>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12 col-12 bg-light">
                  <div class="card-header text-center justify-content-center d-flex">
                    <div class="col-5 p-3">
                      <!-- <a href="login.php" class="h1"><b>Login</b></a> -->
                      <a href="login.php" class="h1">
                        <img src="dist/img/logo.png" alt="logo" class="img-fluid">
                      </a>
                    </div>
                  </div>
                <div class="card-body  bg-white">
                  <p class="login-box-msg">Sign in to start your session</p>
                  <form action="processes.php" method="post" id="quickForm">
                    <div class="input-group">
                      <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" >
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>
                    <!-- FOR INVALID EMAIL -->
                    <div class="input-group mt-1 mb-3">
                      <small id="text" style="font-style: italic;"></small>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" placeholder="Password" id="password" name="password" minlength="8" required>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-8">
                        <div class="icheck-primary">
                          <input type="checkbox" id="remember" id="remember" onclick="myFunction()">
                          <label for="remember">
                            Show password
                          </label>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary btn-block" name="login" id="login">Sign In</button>
                      </div>
                    </div>
                  </form>
                  <p>
                    <a href="forgot-password.php">I forgot my password</a>
                    <br>
                    <a href="register.php" class="text-center">Register a new membership</a>
                  </p>
                </div>
              </div>
            </div>
              
          </div>

  <?php } ?>

        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php'; ?>

<script>

  function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


  function validation() {
    var email = document.getElementById("email").value;
    var pattern =/.+@(gmail)\.com$/;
    // var pattern =/.+@(gmail|yahoo)\.com$/;
    if(email.match(pattern)) {
        document.getElementById('text').style.color = 'green';
        document.getElementById('text').innerHTML = '';
        document.getElementById('login').disabled = false;
        document.getElementById('login').style.opacity = (1);
    } 
    else {
        document.getElementById('text').style.color = 'red';
        document.getElementById('text').innerHTML = 'Domain must be @gmail.com';
        document.getElementById('login').disabled = true;
        document.getElementById('login').style.opacity = (0.4);
        
    }
  }
</script>