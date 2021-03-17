<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>kisanzone-admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Site Metas -->
  <link rel="icon" href="<?php echo base_url().'assets/images/kisanzone.png';?>" type="image/png" />
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/adminStyle.css'; ?>">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <!-- jQuery CDN - Slim version (=without AJAX) -->
   <!-- <script  type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

   <style>
   button, h3{
    background: #313958;
    color: #ffffff;
   }
   </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 mt-5 p-3 border">
                <form name="createAdminUserForm" id="createAdminUserForm" onsubmit="createAdminUserFormValidation()">
                    <h3 class="text-center text-light p-2">Create Admin User</h3>
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
                        <label for="">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                        <span id="emailError" class="text-danger"></span>
                        <span id="emailExistError" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <span id="passwordError" class="text-danger"></span>
                        <br>
                        <input type="checkbox" onclick="showPassword()"> 
                        &nbsp;Show Password
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option selected value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- While ajax process request -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

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
function createAdminUserFormValidation(){
// regular expression for username and email
  var usernameRegularE = /^[A-Z a-z]{2,20}$/;
  var emailRegularE = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

  var username = document.forms["createAdminUserForm"]["username"].value;
  var email = document.forms["createAdminUserForm"]["email"].value;
  var password = document.forms["createAdminUserForm"]["password"].value;
  
  //error count
  var count = 0;

  if(username != "")
  {
    document.getElementById('usernameError').innerHTML="";
  }

  if(email != "")
  {
    document.getElementById('emailError').innerHTML="";
  }

  if(password != "")
  {
    document.getElementById('passwordError').innerHTML="";
  }

  if(!username.match(usernameRegularE))
  {
    document.getElementById('usernameError').innerHTML="Username should be characters and  between 2 and 20 characters ";
    count++;
  }

  if(!email.match(emailRegularE))
  {
    document.getElementById('emailError').innerHTML="Please enter valid email";
    count++;
  }

  if(password == "")
  {
    document.getElementById('passwordError').innerHTML="Password is required";
    count++;
  }

// to check validation error and emailExist count
  if(count > 0 || emailExist > 0){
    event.preventDefault();
  }else{
    event.preventDefault();
    $.ajax({
      url : "<?php echo base_url();?>CAdminUser/saveAdminUser",
      type : 'POST',
      data : $("#createAdminUserForm").serializeArray(),
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status']==1){
            createAdminUserForm.reset();
            $('#alert').show();
            $('#alert-msg').html("Record added successfully and "+response['msg']);
            $("#alert").addClass("alert-success");
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

// to check email already exists or not
$('#email').change(function(){
  var email = document.forms["createAdminUserForm"]["email"].value;
    $.ajax({
      url : "<?php echo base_url();?>CAdminUser/emailAlreadyExistOrNot",
      type : 'POST',
      data : {"email" : email},
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status'] == 1){
            document.getElementById("emailExistError").innerHTML="Email already exist. Plz enter another email address";
            document.getElementById("emailError").innerHTML="";
            emailExist=1;
            }else{
            emailExist=0;
            document.getElementById("emailExistError").innerHTML="";
          }
      },
      complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
        $('#loader').addClass('hidden')
      },
    });
});

    </script>

   
    <!-- Popper.JS -->
    <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script  type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- jQuery Datatables -->
			<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.0/b-colvis-1.6.0/b-flash-1.6.0/b-html5-1.6.0/b-print-1.6.0/cr-1.5.2/kt-2.5.1/r-2.2.3/datatables.min.js"></script>

</body>

</html>