<!DOCTYPE html>
<html>
<!-- head -->
<?php $this->load->view('head'); ?>
<body>

  <div class="hero_area">
    <!-- header section starts -->
    <?php
        $this->load->view('headerSection');
    ?>
    <!-- end header section -->


  <!-- contactus section -->
  <section class="contactus_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-10 col-12 col-lg-10 offset-lg-1">
          <div class="box">
            <div class="heading_container bg-light heading_center pt-2 pb-2">
              <h3>
               Contact Us
             </h3>
            </div>
            <hr>
              <div id="alert" class="alert alert-dismissible">
                <div id="alert-msg"></div>
                  <button type="button" class="close">&times;</button>
              </div>
            <form name="contactForm" id="contactForm" onsubmit="return contactFormValidation()">
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                    <span id="nameError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control">
                    <span id="emailError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="tel" onkeypress="onlyNumberKey(event)" maxlength="10" name="mobile" class="form-control">
                    <span id="mobileError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control">
                    <span id="subjectError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Description</label>
                  <textarea class="form-control" id="" cols="30" rows="4" name="desc"></textarea>
                    <span id="descError" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group col-12 text-center">
                <button type="submit" class="contactus-btn">Submit</button>
                <button type="reset" class="reset-btn">Reset</button>
                <br>
              </div>
                </div>
                
                </div>
              </div>
            
            </form>
          </div>
        </div>
      </div>
  </section>

  <!-- end contactus section -->

  <!-- While ajax process request -->
  <div id="loader" class="lds-dual-ring hidden overlay"></div>

  
<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>
<script type="text/javascript">

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

// contact us form validation using javascript
function contactFormValidation() {
  //regular expressions
  var mobileRegularE = /^[0-9]{10}$/;
  var emailRegularE = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

  //storing value in variables
  var name = document.forms["contactForm"]["name"].value;
  var email = document.forms["contactForm"]["email"].value;
  var mobile = document.forms["contactForm"]["mobile"].value;
  var subject = document.forms["contactForm"]["subject"].value;
  var desc = document.forms["contactForm"]["desc"].value;

  //to count error
  var count=0;

  if(name != "")
  {
    document.getElementById('nameError').innerHTML="";
  }

  if(email != "")
  {
    document.getElementById('emailError').innerHTML="";
  }

  if(mobile != "")
  {
    document.getElementById('mobileError').innerHTML="";
  }

  if(subject != "")
  {
    document.getElementById('subjectError').innerHTML="";
  }

  if(desc != "")
  {
    document.getElementById('descError').innerHTML="";
  }

  if(name == ""){
    document.getElementById("nameError").innerHTML="Name is required";
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

  if(subject == ""){
    document.getElementById("subjectError").innerHTML='Subject is required';
    count++;
  }

  if(desc == ""){
    document.getElementById("descError").innerHTML="Description is required";
    count++;
  }

  if(count > 0){
    return false;
  }else{
    event.preventDefault();

    $.ajax({
      url : "<?php echo base_url();?>CHome/saveContactUs",
      type : 'POST',
      data : $("#contactForm").serializeArray(),
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status']==1){
            contactForm.reset();
            $('#alert').show();
            $('#alert-msg').html(response['msg']);
            $("#alert").addClass("alert-success");
          }else{
            $('#alert').show();
            $('#alert-msg').html("Record not added!!");
            $("#alert").addClass("alert-danger");
          }
      },
      complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
        $('#loader').addClass('hidden')
      }
    });
  }

}


$(document).ready(function(){
  $('#alert').hide();
});
</script>
</body>

</html>