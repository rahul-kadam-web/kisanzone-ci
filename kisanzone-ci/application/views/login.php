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
        <div class="col-10 offset-1 col-lg-6 offset-lg-3">
          <div class="box">
            <div class="heading_container heading_center bg-light pt-3 pb-3">
              <h3>
               Login
             </h3>
          </div> 
          <hr>
          <?php
			$success=$this->session->flashdata('success');
			if(!empty($success)){
			 ?>
			<div class="col-md-12 pt-1">
				<div id="alert" class="alert alert-success text-center"><?php echo $success; ?></div>
			</div>
			<?php } ?>

        <!-- to display login status -->
				<div id="loginStatus" class="col-md-12 pt-1 text-center"></div>

            <form name="loginForm" id="loginForm" method="post" onsubmit="return loginFormValidation()">
              <div class="form-group">
                <label>Enter Mobile Number</label>
                <input type="text" name="mobile" class="form-control">
                <span id="mobileError" class="text-danger"></span>
              </div>
              <div class="form-group">
                <label>Enter Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <span id="passwordError" class="text-danger"></span>
                <br>
                <input type="checkbox" onclick="showPassword()"> 
                Show Password
              </div>
              <div class="form-group text-center">
                <button type="submit" class="login-btn">Login</button>
                <button type="reset" class="reset-btn">Reset</button>
                <br>
                <a href="<?php echo site_url('CCustomers/signup'); ?>" class="text-info">Are you new to kisanzone? <br> signup here..</a>
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
  // to count error
  var count = 0;
  // store value in varible
  var emailMobile = document.forms["loginForm"]["mobile"].value;
  var password = document.forms["loginForm"]["password"].value;

  if(emailMobile != "")
  {
    document.getElementById('mobileError').innerHTML="";
  }

  if(password != ""){
    document.getElementById('passwordError').innerHTML="";
  }

  if (emailMobile == "") {
    document.getElementById('mobileError').innerHTML="Mobile number is required";
    count++;
  }

  if(password == ""){
    document.getElementById('passwordError').innerHTML="Password is required";
    count++;
  }

  // to check error count for login form validation
  if(count > 0){
    return false;
  }else{
    event.preventDefault();
    $.ajax({
      url : "<?php echo base_url();?>CCustomers/login",
      type : 'POST',
      data :  $("#loginForm").serializeArray(),
      dataType : 'json',
      success : function(response){
          if(response['status'] == 1){
            // redirect to welcome page
            location.href = "<?php echo base_url().'CHome/index'; ?>";
          }else{
            $("#alert").hide();
            $("#loginStatus").addClass('alert alert-danger');
            $("#loginStatus").html(response['msg']);
          }
        }
    });
  }

}
</script>
</body>

</html>