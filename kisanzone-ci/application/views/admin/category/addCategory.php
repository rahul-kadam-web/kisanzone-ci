<!DOCTYPE html>
<html>

<!-- head -->
<?php 
    $this->load->view('admin/adminHead'); 
?>
<body>

    <div class="wrapper">
        <!--left Sidebar  -->
      <?php
        $this->load->view('admin/adminLeftSidebar');
      ?>
      <!-- end of left Sidebar -->
        <!-- Page Content  -->
        <div id="content">

           <!-- admin top navbar -->
            <?php
                $this->load->view('admin/adminTopNav');
            ?>
                <form name="categoryForm" id="categoryForm" onsubmit="return categoryFormValidation()">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 offset-lg-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-lg"><u>Add Category</u></h5>
                                <hr>
                                <div id="alert" class="alert alert-dismissible">
                                  <div id="alert-msg"></div>
                                    <button type="button" class="close">&times;</button>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                         <div class="form-group text-left">
                                            <label>Category Name</label>
                                            <input type="text" name="category" id="category" class="form-control">
                                            <span class="text-danger" id="categoryError"></span>
                                          </div>
                                    </div>
                                </div>
                                    <button type="submit" class="card-link btn btn-info pr-4 pl-4">Add</button>
                                    <button type="reset" class="card-link btn btn-danger">Reset</button>
                             </div>
                        </div>
                    </div>
                </div>
              </form>
        </div>
    </div>

<!-- While ajax process request -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>
 

<script type="text/javascript">
// category form validation
function categoryFormValidation(){
  //error count
  var count=0;
  var category = document.forms["categoryForm"]["category"].value;

  if(category == "")
  {
    document.getElementById('categoryError').innerHTML="Category is required";
    count++;
  }

  if(category != "")
  {
    document.getElementById('categoryError').innerHTML="";
  }
  if(count > 0){
    return false;
  }else{
    event.preventDefault();
    $.ajax({
      url : "<?php echo base_url();?>CManageKzCategory/saveCategory",
      type : 'POST',
      data : $("#categoryForm").serializeArray(),
      dataType : 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success : function(response){
          if(response['status']==1){
            categoryForm.reset();
            $('#alert').show();
            $('#alert-msg').html(response['category_name']+" added successfully!");
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
</script>


   <!-- jquery and script -->
 <?php
    $this->load->view('admin/adminFooter');
 ?>

<script>
  $(document).ready(function() {
    $("#category").addClass("active");
    $('#alert').hide();
    
    $('.close').click(function(){
    $('#alert').hide();
    });
  });
</script>
</body>

</html>