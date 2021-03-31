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
        <div class="col-12">
          <div class="box">
            <div class="heading_container heading_center bg-light pt-3 pb-3">
              <h3>
               Registration
             </h3>
          </div>
          <hr>
            <form name="signupForm" id="signupForm"  method="post" onsubmit="return signupFormValidation()">
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
                    <input  type="tel" onkeypress="onlyNumberKey(event)" maxlength="10" id="mobile" value="" name="mobile" class="form-control">
                    <span id="mobileError" class="text-danger"></span>
                    <span id="mobileExistError" class="text-danger"></span>
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
                    <input type="number" maxlength="6" name="pin" class="form-control">
                    <span id="pinError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>State</label>
                    <select id="listBox" name="state" onchange='selct_district(this.value)' class="form-control"></select>
                    <!-- <input type="text" name="state" class="form-control"> -->
                    <span id="stateError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City</label>
                    <select id='secondlist' name="city" class="form-control">
                      <option value="">Select City</option>
                    </select>
                    <!-- <input type="text" name="city" class="form-control"> -->
                    <span id="cityError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                    <span id="addressError" class="text-danger"></span>
                  </div>
                </div>
                <!-- to store otp -->
                <input type="hidden" name="verifiedOtp" id="verifiedOtp">
              </div>
              <div class="form-group text-center">
                <button type="submit" class="signup-btn">Signup</button>
                <button type="reset" class="reset-btn">Reset</button>
                <br>
                <a href="<?php echo site_url('CCustomers/index'); ?>" class="login-link">Already register?<br> login here..</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end signup section -->

  <!-- The Modal for otp confirmation -->
<div class="modal" id="otpConfirmationModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="tel" maxlength="6" id="otpNumber" class="form-control">
        <span id="otpNumberError" class="text-danger"></span>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnVerifyOtp">Verify otp</button>
      </div>
    </div>
  </div>
</div>

  <!-- While ajax process request -->
  <div id="loader" class="lds-dual-ring hidden overlay"></div>


<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>

<script type="text/javascript">
// to check at the validation time 
var mobileExist=0;

//sent  otp
var otp;

//Change the type of input to password or text 
function showPassword() { 
  var pass = document.getElementById("password"); 
  if (pass.type === "password") { 
    pass.type = "text"; 
  } else { 
      pass.type = "password"; 
  } 
} 


// Enter number only for mobile field    
function onlyNumberKey(evt) { 
  // Only ASCII charactar in that range allowed 
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode; 

  if (ASCIICode < 48 || ASCIICode > 57){ 
    document.getElementById('mobileError').innerHTML = "Enter number only";
    return false;
  }else{
    document.getElementById('mobileError').innerHTML = "";
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

  if(city == ""){
    document.getElementById("cityError").innerHTML="Plz select city";
    count++;
  }

  if(state == ""){
    document.getElementById("stateError").innerHTML="Plz select state";
    count++;
  }

  if(address == ""){
    document.getElementById("addressError").innerHTML="Plz enter valid address";
    count++;
  }

  // to check validation error and to check mobileExist count 
  if(count > 0 || mobileExist > 0){
    return false;
  }
 else{
   otp = generateOtp();
   $.ajax({
     url: "<?php echo base_url();?>CCustomers/sendOtp",
     type: 'POST',
     data: {"mobile":mobile, "otp":otp},
     dataType: 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
     success: function(response){
      if(response['return'] == true){
        $('#otpConfirmationModal').modal('show');
        $('.modal-title').html('Otp is sent to your mobile number');
      }else{
        alert('Something went wrong. Please try later!');
      }
     },
     error: function(reponse){
       alert('Something went wrong! Please try later');
     },
     complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
       $('#loader').addClass('hidden')
     }
   });
 return false;

//Due to fast2sms server down without otp verify storing data 
  // $.ajax({
  //     url : "<?php echo base_url();?>CCustomers/saveCustomer",
  //     type : 'POST',
  //     data :  $("#signupForm").serializeArray(),
  //     dataType : 'json',
  //     success : function(response){
  //         if(response['status'] == 1){
  //           // redirect to welcome page
  //           location.href = "<?php echo base_url().'CCustomers/index'; ?>";
  //         }else{
  //           alert("Something went wrong! Please try later!");
  //         }
  //       }
  //   });
 }
 
}



// to check mobile already exists or not
$('#mobile').change(function(){
  var mobile = document.forms["signupForm"]["mobile"].value;
    $.ajax({
      url : "<?php echo base_url();?>CCustomers/mobileAlreadyExistOrNot",
      type : 'POST',
      data : {"mobile" : mobile},
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status'] == 1){
            document.getElementById("mobileExistError").innerHTML="Mobile already exist. Plz enter another mobile number";
            document.getElementById("mobileError").innerHTML="";
            mobileExist=1;
            }else{
            mobileExist=0;
            document.getElementById("mobileExistError").innerHTML="";
          }
      },
      complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
        $('#loader').addClass('hidden')
      }
    });
});

// Function to generate OTP 
function generateOtp() { 
  // Declare a digits variable  
  // which stores all digits 
  var digits = '0123456789'; 
  let OTP = ''; 
  for (let i = 0; i < 6; i++ ) { 
  OTP += digits[Math.floor(Math.random() * 10)]; 
  } 
  return OTP; 
} 

// onclick button verify the otp
$("#btnVerifyOtp").click(function(){
  var userOtp = $("#otpNumber").val();
  
  if(userOtp == otp){
    $("#otpNumberError").html("");
    $("#verifiedOtp").val(otp);
    $.ajax({
      url : "<?php echo base_url();?>CCustomers/saveCustomer",
      type : 'POST',
      data :  $("#signupForm").serializeArray(),
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status'] == 1){
            // redirect to welcome page
            location.href = "<?php echo base_url().'CCustomers/index'; ?>";
          }else{
            alert("Something went wrong! Please try later!");
          }
      },
      complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
        $('#loader').addClass('hidden')
      }
    });
  }else{
    $("#otpNumberError").html("Invalid otp");
  }
});
</script>
</body>

</html>