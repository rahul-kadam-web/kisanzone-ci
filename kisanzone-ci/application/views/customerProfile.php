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

  <section class=" signup_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="heading_container heading_center bg-light pt-2 pb-2">
              <h3>
               Personal information
             </h3>
          </div>
          <hr>
          <div class="text-right">
          <button id="btnEnableEdit" class="btn btn-sm btn-primary">Edit</button>
          <button id="btnCancelEnableEdit" class="btn btn-sm btn-secondary">Cancel</button>
          </div>
            <form name="editRegistrationForm" id="editRegistrationForm"  method="post" onsubmit="return editRegistrationFormValidation()">
            <input type="hidden" name="cus_id" value="<?php echo $row['cus_id']; ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" value="<?php echo $row['fname']; ?>" name="fName" id="fName" class="form-control">
                    <span id="fNameError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lName" id="lName" value="<?php echo $row['lname']; ?>" class="form-control">
                    <span id="lNameError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="<?php echo $row['email']; ?>" name="email" id="email" class="form-control">
                    <span id="emailError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="number" value="<?php echo $row['mobile']; ?>"  name="mobile" id="mobile" value="<?php echo $row['mobile']; ?>" class="form-control">
                    <span id="mobileError" class="text-danger"></span>
                    <span id="mobileExistError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Pin</label>
                    <input type="number" name="pin" id="pin" value="<?php echo $row['pin']; ?>" class="form-control">
                    <span id="pinError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>State</label>
                    <select id="listBox" name="state" onchange='selct_district(this.value)' class="form-control">
                        <option selected value="<?php echo $row['state']; ?>">value="<?php echo $row['state']; ?>"</option>
                    </select>
                    <!-- <input type="text" name="state" class="form-control"> -->
                    <span id="stateError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City</label>
                    <select id='secondlist' name="city" class="form-control">
                    <option selected value="<?php echo $row['city']; ?>"><?php echo $row['city']; ?></option>
                    </select>
                    <!-- <input type="text" name="city" class="form-control"> -->
                    <span id="cityError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" id="address" class="form-control" rows="2"><?php echo $row['address']; ?></textarea>
                    <span id="addressError" class="text-danger"></span>
                  </div>
                </div>
                <!-- to store otp -->
                <input type="hidden" name="verifiedOtp" value="<?php echo $row['verified_otp']; ?>" id="verifiedOtp">
              </div>
              <div class="form-group text-center">
                <button id="btnSubmit" type="submit" class="signup-btn">Edit</button>
                <br>
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
        <input type="number" id="otpNumber" class="form-control">
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

$(document).ready(function(){ 
    $('#fName').prop("disabled", true);
    $('#lName').prop("disabled", true);
    $('#email').prop("disabled", true);
    $('#mobile').prop("disabled", true);
    $('#listBox').prop("disabled", true);
    $('#secondlist').prop("disabled", true);
    $('#pin').prop("disabled", true);
    $('#address').prop("disabled", true);
    $('#btnCancelEnableEdit').hide();
    $('#btnSubmit').hide();

    $('#listBox option[value="<?php echo $row['state'] ?>"]').attr("selected","");

    $("#btnEnableEdit").click(function(){
        $('#fName').prop("disabled", false);
        $('#lName').prop("disabled", false);
        $('#email').prop("disabled", false);
        $('#mobile').prop("disabled", false);
        $('#listBox').prop("disabled", false);
        $('#secondlist').prop("disabled", false);
        $('#pin').prop("disabled", false);
        $('#address').prop("disabled", false);
        $('#btnEnableEdit').hide();
        $('#btnCancelEnableEdit').show();
        $('#btnSubmit').show();
    });

    $("#btnCancelEnableEdit").click(function(){
        $('#fName').prop("disabled", true);
        $('#lName').prop("disabled", true);
        $('#email').prop("disabled", true);
        $('#mobile').prop("disabled", true);
        $('#listBox').prop("disabled", true);
        $('#secondlist').prop("disabled", true);
        $('#pin').prop("disabled", true);
        $('#address').prop("disabled", true);
        $('#btnEnableEdit').show();
        $('#btnCancelEnableEdit').hide();
        $('#btnSubmit').hide();
    });
});

// editRegistrationForm validation
function editRegistrationFormValidation() {
  //regular expressions
  var mobileRegularE = /^[0-9]{10}$/;
  var nameRegularE = /^[A-Z a-z]{2,20}$/;
  var emailRegularE = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  var pinRegularE = /^[123456789][0-9]{5}$/;
  var passwordRegularE = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

  //storing value in variables
  var fName = document.forms["editRegistrationForm"]["fName"].value;
  var lName = document.forms["editRegistrationForm"]["lName"].value;
  var email = document.forms["editRegistrationForm"]["email"].value;
  var mobile = document.forms["editRegistrationForm"]["mobile"].value;
  var pin = document.forms["editRegistrationForm"]["pin"].value;
  var city = document.forms["editRegistrationForm"]["city"].value;
  var state = document.forms["editRegistrationForm"]["state"].value;
  var address = document.forms["editRegistrationForm"]["address"].value;

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

  // to check validation error and to check emailExist count 
  if(count > 0 || mobileExist > 0){
    return false;
  }
 else{
    if(mobile != <?php echo $row['mobile']; ?>){
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
      }
     },
     complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
       $('#loader').addClass('hidden')
     }
   });
   return false;
}else{
    editCustomerDetails();
 }
 }
 
}

// to check mobile already exists or not
$('#mobile').change(function(){
    var mobile = document.forms["editRegistrationForm"]["mobile"].value;

   if(mobile != <?php echo $row['mobile']; ?>){
    $.ajax({
      url : "<?php echo base_url();?>CCustomers/mobileAlreadyExistOrNot",
      type : 'POST',
      data : {"mobile" : mobile},
      dataType : 'json',
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
  }
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
      url : "<?php echo base_url();?>CCustomers/updateCustomer",
      type : 'POST',
      data :  $("#editRegistrationForm").serializeArray(),
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status'] == 1){
            alert("Your details updated succeessfully!");
            location.reload();
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

// edit or update customer details
function editCustomerDetails(){
    $.ajax({
      url : "<?php echo base_url();?>CCustomers/updateCustomer",
      type : 'POST',
      data :  $("#editRegistrationForm").serializeArray(),
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status'] == 1){
            alert("Your details updated succeessfully!");
            location.reload();
          }else{
            alert("Something went wrong! Please try later!");
          }
      },
      complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
        $('#loader').addClass('hidden')
      }
    });
}
</script>
</body>

</html>