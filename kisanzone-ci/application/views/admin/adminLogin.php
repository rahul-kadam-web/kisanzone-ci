<!DOCTYPE html>
<html>
<!-- head -->
<?php 
    $this->load->view('admin/adminHead'); 
?>
<body class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 mt-5 p-3 border bg-light">
                <form name="adminLoginForm" id="adminLoginForm" onsubmit="adminLoginFormValidation()">
                    <h3 class="text-center p-2">Admin Login </h3>
                    <hr>
                    <div id="alert" class="alert alert-dismissible">
                        <button type="button" class="close">&times;</button>
                        <div id="alert-msg"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control">
                        <span id="usernameError" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <span id="passwordError" class="text-danger"></span>
                        <br>
                        <input type="checkbox" onclick="showPassword()"> 
                        &nbsp;Show Password
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- While ajax process request -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>
   

    <!-- jquery and script -->
 <?php
    $this->load->view('admin/adminFooter');
 ?>

<script>
    $(document).ready(function(){
        $('#alert').hide();
    });

    //Email Exists
    var emailExist = 0;

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


// contact form validation using javascript
function adminLoginFormValidation(){

  var username = document.forms["adminLoginForm"]["username"].value;
  var password = document.forms["adminLoginForm"]["password"].value;
  
  //error count
  var count = 0;

  if(username != "")
  {
    document.getElementById('usernameError').innerHTML="";
  }

  if(password != "")
  {
    document.getElementById('passwordError').innerHTML="";
  }

  if(username == "")
  {
    document.getElementById('usernameError').innerHTML="Username is required";
    count++;
  }

  if(password == "")
  {
    document.getElementById('passwordError').innerHTML="Password is required";
    count++;
  }

// to check validation error and emailExist count
  if(count > 0){
    event.preventDefault();
  }else{
    event.preventDefault();
    $.ajax({
      url : "<?php echo base_url();?>CAdminManage/adminLogin",
      type : 'POST',
      data : $("#adminLoginForm").serializeArray(),
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status']==1){
            location.href = "<?php echo base_url().'CAdminManage/adminDashboard'; ?>";
          }else{
            $('#alert').show();
            $('#alert-msg').html(response['msg']);
            $("#alert").addClass("alert-danger");
          }
        },
        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
          $('#loader').addClass('hidden')
        }
    });
  }
}

</script>

</body>

</html>