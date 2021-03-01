<!DOCTYPE html>
<html>
<!-- Head -->
<?php
  $this->load->view('head');
?>
<body>

  <div class="hero_area">
    <!-- header section strats -->
   <?php
    $this->load->view('headerSection');
   ?>
    <!-- end header section -->


  <!-- login section -->

  <section class="login_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3 col-10 offset-1 col-lg-6 offset-lg-3">
          <div class="box">
            <div class="heading_container heading_center bg-light pt-3 pb-3">
              <h3>
               Login here..
             </h3>
          </div> 
          <hr>
            <form name="loginForm" method="post" onsubmit="return loginFormValidation()">
              <div class="form-group">
                <label>Enter Email / Mobile</label>
                <input type="text" name="emailMobile" class="form-control">
                <span id="emailMobileError" class="text-danger"></span>
              </div>
                <div class="form-group">
                <label>Enter Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <span id="passwordError" class="text-danger"></span>
                <br>
                <input type="checkbox" onclick="showPassword()"> 
                <b>Show Password</b> 
              </div>
              <div class="form-group text-center">
                <button type="submit" class="login-btn">Login</button>
                <button type="reset" class="reset-btn">Reset</button>
                <br>
                <a href="<?php echo site_url('CHome/signup'); ?>" class="text-info">Are you new to kisanzone? <br> signup here..</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
  <!-- end login section -->


<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>

<script type="text/javascript">
//Change the type of input to password or text 
        function showPassword() { 
            var pass = document.getElementById("password"); 
            if (pass.type === "password") { 
                pass.type = "text"; 
            } 
            else { 
                pass.type = "password"; 
            } 
        } 
// login form validation
function loginFormValidation() {
  // store value in varible
  var emailMobile = document.forms["loginForm"]["emailMobile"].value;
  var password = document.forms["loginForm"]["password"].value;

  if(emailMobile != "")
  {
    document.getElementById('emailMobileError').innerHTML="";
  }

  if(password != ""){
    document.getElementById('passwordError').innerHTML="";
  }

  if (emailMobile == "" && password == "") {
    document.getElementById('emailMobileError').innerHTML="Email/Mobile is required!";
    document.getElementById('passwordError').innerHTML="Password is required!";
    return false;
  }

  if (emailMobile == "") {
    document.getElementById('emailMobileError').innerHTML="Email/Mobile is required!";
    return false;
  }

  if(password == ""){
    document.getElementById('passwordError').innerHTML="Password is required!";
    return false;
  }

}
</script>
</body>

</html>