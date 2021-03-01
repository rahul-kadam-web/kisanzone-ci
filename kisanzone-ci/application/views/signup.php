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

  <!-- Signup section -->

  <section class="signup_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 col-12 col-lg-8 offset-lg-2">
          <div class="box">
            <div class="heading_container heading_center bg-light pt-3 pb-3">
              <h3>
               Registration
             </h3>
          </div>
          <hr>
            <form name="signupForm" method="post" onsubmit="return signupFormValidation()">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fName" class="form-control">
                    <span id="fNameError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lName" class="form-control">
                    <span id="lNameError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control">
                    <span id="emailError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="number" value="" name="mobile" class="form-control">
                    <span id="mobileError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <span id="passwordError" class="text-danger"></span>
                    <br>
                    <input type="checkbox" onclick="showPassword()"> 
                    <span>Show Password</span> 
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Pin</label>
                    <input type="number" name="pin" class="form-control">
                    <span id="pinError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control">
                    <span id="cityError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>State</label>
                    <input type="text" name="state" class="form-control">
                    <span id="stateError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                    <span id="addressError" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="form-group text-center">
                <button type="submit" class="signup-btn">Signup</button>
                <button type="reset" class="reset-btn">Reset</button>
                <br>
                <a href="<?php echo site_url('CHome/login'); ?>" class="text-info">Already register? login here..</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end signup section -->


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
  } else { 
      pass.type = "password"; 
  } 
} 

// signup form validation
function signupFormValidation() {
  //regular expressions
  var mobileRegularE = /^[0-9]{10}$/;
  var nameRegularE = /^[A-Z a-z]{2,20}$/;
  var emailRegularE = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  var pinRegularE = /^[123456789][0-9]{5}$/;
  var passwordRegularE = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

  //storing value in variables
  var fName = document.forms["signupForm"]["fName"].value;
  var lName = document.forms["signupForm"]["lName"].value;
  var email = document.forms["signupForm"]["email"].value;
  var mobile = document.forms["signupForm"]["mobile"].value;
  var password = document.forms["signupForm"]["password"].value;
  var pin = document.forms["signupForm"]["pin"].value;
  var city = document.forms["signupForm"]["city"].value;
  var state = document.forms["signupForm"]["state"].value;
  var address = document.forms["signupForm"]["address"].value;

  //to count error
  var count=0;

  if(fName != "")
  {
    document.getElementById('fNameError').innerHTML="";
  }

  if(lName != "")
  {
    document.getElementById('lNameError').innerHTML="";
  }

  if(email != "")
  {
    document.getElementById('emailError').innerHTML="";
  }

  if(mobile != "")
  {
    document.getElementById('mobileError').innerHTML="";
  }

  if(password != "")
  {
    document.getElementById('passwordError').innerHTML="";
  }

  if(pin != "")
  {
    document.getElementById('pinError').innerHTML="";
  }

  if(city != "")
  {
    document.getElementById('cityError').innerHTML="";
  }

  if(state != "")
  {
    document.getElementById('stateError').innerHTML="";
  }

  if(address != "")
  {
    document.getElementById('addressError').innerHTML="";
  }

  if(!fName.match(nameRegularE)){
    document.getElementById("fNameError").innerHTML="Plz enter more than one character";
    count++;
  }

  if(!lName.match(nameRegularE)){
    document.getElementById("lNameError").innerHTML="Plz enter more than one character";
    count++;
  }

  if(!email.match(emailRegularE)){
    document.getElementById("emailError").innerHTML="Plz enter valid email";
    count++;
  }

  if(!mobile.match(mobileRegularE)){
    document.getElementById("mobileError").innerHTML="Plz enter 10 digit mobile number";
    count++;
  }

  if(!password.match(passwordRegularE)){
    document.getElementById("passwordError").innerHTML='Must contain at least <ul><li>one number</li><li>one uppercase letter</li><li>one lowercase letter</li><li>8 or more characters</li></ul>';
    count++;
  }

  if(!pin.match(pinRegularE)){
    document.getElementById("pinError").innerHTML="Plz enter valid pin";
    count++;
  }

  if(!city.match(nameRegularE)){
    document.getElementById("cityError").innerHTML="Plz enter more than one character";
    count++;
  }

  if(!state.match(nameRegularE)){
    document.getElementById("stateError").innerHTML="Plz enter more than one character";
    count++;
  }

  if(!address.match(nameRegularE)){
    document.getElementById("addressError").innerHTML="Plz enter valid address";
    count++;
  }

  if(count > 0){
    return false;
  }

}
</script>
</body>

</html>