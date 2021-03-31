<!DOCTYPE html>
<html>
<!-- Head -->
<?php
  $this->load->view('head');
?>
<body>
    <div id="forgotPassword" class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mx-auto">
                <!-- view to enter mobile number -->
               <div id="forMobileNumberEnterView" class="border text-center p-4 bg-white">
                    <div class="header">   
                        <h5 class="pt-3 font-weight-bold">Kisanzone</h5>
                        <h4>Account Recovery</h4>
                   </div>
                   <hr>
                   <form action="" name="forgotPasswordMobileNumber" onsubmit="return forgotPasswordMobileNumberValidation()">
                       <div class="form-group text-left">
                           <label for="">Enter Mobile Number</label>
                           <input type="tel" name="mobile" onkeypress="onlyNumberKey(event)" maxlength="10" class="form-control">
                           <span class="text-danger" id="mobileError"></span>
                       </div>
                       <div class="form-group">
                           <button>Next</button>
                       </div>
                   </form>
               </div>
               
               <!-- view to enter otp -->
               <div id="forOtpEnterView" class="border text-center p-4 bg-white">
                   <h5 class="pt-3 font-weight-bold">Kisanzone</h5>
                   <h4>Account Recovery</h4>
                   <hr>
                   <div>
                       <div class="form-group text-left">
                            <label for="" class="otpForm-title">Otp already sent to your mobile enter</label>
                            <input type="tel" id="otpNumber" maxlength="6" class="form-control">
                            <span id="otpNumberError" class="text-danger"></span>
                       </div>
                       <div class="form-group">
                            <button type="button" id="btnVerifyOtp">Verify otp</button>
                       </div>
                    </div>
               </div>

               <!-- view to enter new password -->
               <div id="forPasswordEnterView" class="border text-center p-4 bg-white">
                   <h5 class="pt-3 font-weight-bold">Kisanzone</h5>
                   <h4>Account Recovery</h4>
                   <hr>
                   <div>
                       <div class="form-group text-left">
                           <label for="">Enter New Password</label>
                           <input type="password" id="password" name="password" class="form-control">
                            <span id="passwordError" class="text-danger"></span>
                            <br>
                            <input type="checkbox" onclick="showPassword()"> 
                            <span>Show Password</span>
                       </div>
                       <div class="form-group">
                           <button id="btnChangePassword" >Change Password</button>
                       </div>
                    </div>
               </div>

            </div>
        </div>
    </div>

  <!-- While ajax process request -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script language=javascript>
    $(document).ready(function(){
        $("#forOtpEnterView").hide();
        $("#forPasswordEnterView").hide();
    });

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

    //sent  otp
    var otp;

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

      function forgotPasswordMobileNumberValidation(){
        // to count error
        var count = 0;

        //regular expressions
        var mobileRegularE = /^[0-9]{10}$/;

        // store value in varible
        var mobile = document.forms["forgotPasswordMobileNumber"]["mobile"].value;

        if(!mobile.match(mobileRegularE))
        {   
            count++;
            document.getElementById('mobileError').innerHTML="Enter 10 digit mobile number";
        }else{
            document.getElementById('mobileError').innerHTML="";
        }    
  
        // to check error count for login form validation
        if(count > 0){
            return false;
        }else{
            event.preventDefault();
            $.ajax({
            url : "<?php echo base_url();?>CCustomers/mobileAlreadyExistOrNot",
            type : 'POST',
            data :  {
                "mobile":mobile
            },
            dataType : 'json',
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
            },
            success: function(response){
                if(response['status'] == 0){
                    document.getElementById('mobileError').innerHTML="Account is not exist on entered number";
                }else{
                    sendOtp(mobile);
                }
            },
            error: function(reponse){
                alert('Something went wrong! Please try later');
            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                $('#loader').addClass('hidden')
            }
            });
        }
      }

    //   Send otp to mobile number
      function sendOtp(mobile){
        otp = generateOtp();
        $.ajax({
            url : "<?php echo base_url();?>CCustomers/sendOtp",
            type : 'POST',
            data :  {"mobile":mobile, "otp":otp},
            dataType : 'json',
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
            },
            success: function(response){
                if(response['return'] == true){
                    $('#forMobileNumberEnterView').hide();
                    $('#forOtpEnterView').show();
                    $('.otpForm-title').html('Otp is sent to your mobile number');
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
      }

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
    $('#forOtpEnterView').hide();
    $('#forPasswordEnterView').show();
  }else{
    $("#otpNumberError").html("Invalid otp");
  }
});

// onclick button chnage the password
$("#btnChangePassword").click(function(){
    // Regular expression for password
    var passwordRegularE = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    var password = $("#password").val();

    if(!password.match(passwordRegularE)){
        document.getElementById("passwordError").innerHTML='Must contain at least <ul><li>one number</li><li>one uppercase letter</li><li>one lowercase letter</li><li>8 or more characters</li></ul>';
        return false;
    }else{
        var mobile = document.forms["forgotPasswordMobileNumber"]["mobile"].value;
        if(mobile  && otp && password){
        $.ajax({
            url : "<?php echo base_url();?>CCustomers/changePassword",
            type : 'POST',
            data :  {
                "mobile":mobile, 
                "otp":otp, 
                "password":password
            },
            dataType : 'json',
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
            },
            success: function(response){
                if(response['status'] == 1){
                    // redirect to welcome page
                    location.href = "<?php echo base_url().'CCustomers/index'; ?>";;
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
        }else{
            alert('Something went wrong, please try later!');
        }
    }
});
 </script>
</body>

</html>