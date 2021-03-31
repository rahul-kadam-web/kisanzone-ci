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
             <div class="container">
		        <div class="row">
			        <div class="col-12">
			        	<div class="row pt-3">
					        <div class="col-6">
					        	<h3>View Prooduct List</h3> 
					        </div>
				        </div>
				        <hr>

				        <table id="example" class="table table-responsive table-hover">
					        <thead>
					            <tr class="bg-dark text-light">
						            <th width="">ID</th>
                        <th width="">Name</th>
						            <th width="">Image</th>
						            <th width="">Price</th>
						            <th width="">Quantity</th>
                        <th width="">Description</th>
						            <th width="">Category</th>
						            <th width="">Brand</th>
						            <th width="">Created Date</th>
						            <th width="">Modified Date</th>
                        <th width="">Status</th>
						            <th width="">Edit</th>
						            <th width="">Delete</th>
					            </tr>
					        </thead>
					        <tbody>
					        <?php if(!empty($rows)){
					            foreach($rows as $row){
			                ?>
					            <tr id="row-<?php echo $row['pro_id'] ?>">
					        	    <td class="modelId"  width=""><?php echo $row['pro_id']; ?></td>
						            <td class="modelName" width=""><?php echo $row['name']; ?></td>
                        <td class="modelImage" width=""><img src="<?php echo base_url().'productImages/'.$row['image']; ?>" width="70px" height="70px" alt="product image"/></td>
                        <td class="modelPrice" width=""><?php echo $row['price']; ?></td>
                        <td class="modelQuantity" width=""><?php echo $row['quantity']; ?></td>
                        <td class="modelDescription"><div style="width:300px; height:100px; overflow: auto;"><?php echo $row['description']; ?></div></td>
                        <td class="modelCategory" width=""><?php echo $row['category_name']; ?></td>
                        <td class="modelBrand" width=""><?php echo $row['brand_name']; ?></td>
						            <td class="modelAdded" width=""><?php echo date("d/m/Y h:i:sa", strtotime($row['added_date'])); ?></td>
						            <td  class="modelModified" width=""><?php echo (empty($row['modified_date'])) ? 'Not modified' : date("d/m/Y h:i:sa", strtotime($row['modified_date'])); ?></td>
						            <td  class="modelStatus" width=""><?php echo ($row['status'])==1 ? 'Active' : 'Inactive';?></td>
						            <td  width=""><a href="javascript:void(0)" onclick="showEditForm(<?php echo $row['pro_id']; ?>)" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  						            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  						            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						            </svg> Edit</a></td>
						            <td  width=""><a href="#" onclick="confirmDeleteModel(<?php echo $row['pro_id']; ?>)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  						            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  						            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						            </svg> Delete</a></td>
					            </tr>  

					            <?php }} else{ 
					            ?>
					            <tr><td colspan="7" class="text-center">Records not found!</td></tr>
					            <?php } ?>
					            </tbody>
					        <tfoot>
                      <tr class="bg-dark text-light">
						            <th width="">ID</th>
                        <th width="">Name</th>
						            <th width="">Image</th>
						            <th width="">Price</th>
						            <th width="">Quantity</th>
                        <th width="">Description</th>
						            <th width="">Category</th>
						            <th width="">Brand</th>
						            <th width="">Created Date</th>
						            <th width="">Modified Date</th>
                        <th width="">Status</th>
						            <th width="">Edit</th>
						            <th width="">Delete</th>
					            </tr>
					        </tfoot>

				        </table>
                    </div>
	        	</div>
        	</div>
        </div>
    </div>

<!-- The Modal for edit -->
<div class="modal" id="editModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
    <div class="text-right">
    <button type="button" class="close pr-3 pt-2" data-dismiss="modal">&times;</button>
    </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div id="response"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Modal for delete confirmation -->
<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="deleteNow();">Yes</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal for delete response -->
<div class="modal" id="ajaxDeleteResponseModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Alert</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

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
$(document).ready(function() {
  $("#product").addClass("active");
  $('#alert').hide();
  $('.close').click(function(){
  $('#alert').hide();
});

		//data table with many features
		$('#example').DataTable({
			dom: 'Bflrtip',
			buttons: [
				{
					extend: 'colvis',
					text: 'Sort by columns',
				},
				{
				extend: 'print',
				title: '',
				messageTop: function () {
				var d = new Date();
				var dd = d.getDate();
				var mm = d.getMonth();
				var yy = d.getFullYear();
				var text = 'Products | '+d;
				return text;
				},
				exportOptions: {
					columns: ':visible'
				}
				},
				{
					extend: 'excelHtml5',
						title: '',
						messageTop: function () {
						var d = new Date();
						var text = 'Products | '+d;
						return text;
				},
				filename: function(){
					var d = new Date();
					var dd = d.getDate();
					var mm = d.getMonth();
					var yy = d.getFullYear();
					var text = 'Products '+dd+'-'+mm+'-'+yy;
					return text;
				},
				exportOptions: {
					columns: ':visible'
				}
			    }
        ]// ,
        
        // scrollX:        true,
        // columnDefs: [
        //     { width: 300, targets: 5 }
        // ]
		});


    $('#alert').hide();
    $('.close').click(function(){
    $('#alert').hide();
    });


// edit form validation of productForm
$( '#editModal').on( 'submit', '#productForm', function () { 
  //regular expressions
  var nameRegularE = /^[A-Z 0-9 a-z]{2,20}$/;
  var amtRegularE = /^[0-9]{1,20}$/;

  //storing value in variables
  var brand = document.forms["productForm"]["brand"].value;
  var category = document.forms["productForm"]["category"].value;
  var product = document.forms["productForm"]["product"].value;
  var price = document.forms["productForm"]["price"].value;
  var quantity = document.forms["productForm"]["quantity"].value;
  var image = document.forms["productForm"]["file"].value;
  var desc = document.forms["productForm"]["desc"].value;

  //to count error
  var count=0;

  if(brand != "")
  {
    document.getElementById('brandError').innerHTML="";
  }

  if(category != "")
  {
    document.getElementById('categoryError').innerHTML="";
  }

  if(product != "")
  {
    document.getElementById('productError').innerHTML="";
  }

  if(price != "")
  {
    document.getElementById('priceError').innerHTML="";
  }

  if(quantity != "")
  {
    document.getElementById('quantityError').innerHTML="";
  }

  if(desc != "")
  {
    document.getElementById('descError').innerHTML="";
  }

  if(brand == ""){
    document.getElementById("brandError").innerHTML="Plz select brand";
    count++;
  }

  if(category == ""){
    document.getElementById("categoryError").innerHTML="Plz select category";
    count++;
  }

  if(product == ""){
    document.getElementById("productError").innerHTML="Plz enter a product name";
    count++;
  }

  if(price == ""){
    document.getElementById("priceError").innerHTML="Plz enter price";
    count++;
  }

  if(!quantity.match(amtRegularE)){
    document.getElementById("quantityError").innerHTML="Plz enter amount";
    count++;
  }


  if(desc == ""){
    document.getElementById("descError").innerHTML="Please enter description";
    count++;
  }

  if(count > 0){
    return false;
  }else{
    event.preventDefault();
    if(image != ""){
    $.ajax({
      url : "<?php echo base_url();?>CManageKzProducts/updateProduct",
      type : 'POST',
      data : new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      dataType: 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success: function(response){
          if(response['status']==1){
            $('#alert').show();
            $('#alert-msg').html(response['msg']);
            $("#alert").addClass("alert-success");
            $('#oldImage').attr('src', response['newImage']);

            var pro_id=response['row']['pro_id'];
            $("#row-"+pro_id+" .modelName").html(response['row']['name']);
            $("#row-"+pro_id+" .modelPrice").html(response['row']['price']);
            $("#row-"+pro_id+" .modelImage img").attr('src', response['newImage']);
            $("#row-"+pro_id+" .modelQuantity").html(response['row']['quantity']);
            $("#row-"+pro_id+" .modelDescription").html(response['row']['description']);
            $("#row-"+pro_id+" .modelBrand").html(response['row']['brand_name']);
            $("#row-"+pro_id+" .modelCategory").html(response['row']['category_name']);
            $("#row-"+pro_id+" .modelAdded").html(response['row']['added_date']);
            $("#row-"+pro_id+" .modelModified").html(response['row']['modified_date']);
            $("#row-"+pro_id+" .modelStatus").html((response['row']['status'])==1? 'Active' : 'Inactive');

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
    }else{
        $.ajax({
      url : "<?php echo base_url();?>CManageKzProducts/updateProductWithoutImage",
      type : 'POST',
      data : new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      dataType: 'json',
      beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
        $('#loader').removeClass('hidden')
      },
      success: function(response){
          if(response['status']==1){
            $('#alert').show();
            $('#alert-msg').html(response['msg']);
            $("#alert").addClass("alert-success");
            
            var pro_id=response['row']['pro_id'];
            $("#row-"+pro_id+" .modelName").html(response['row']['name']);
            $("#row-"+pro_id+" .modelPrice").html(response['row']['price']);
            $("#row-"+pro_id+" .modelQuantity").html(response['row']['quantity']);
            $("#row-"+pro_id+" .modelDescription").html(response['row']['description']);
            $("#row-"+pro_id+" .modelBrand").html(response['row']['brand_name']);
            $("#row-"+pro_id+" .modelCategory").html(response['row']['category_name']);
            $("#row-"+pro_id+" .modelAdded").html(response['row']['added_date']);
            $("#row-"+pro_id+" .modelModified").html(response['row']['modified_date']);
            $("#row-"+pro_id+" .modelStatus").html((response['row']['status'])==1? 'Active' : 'Inactive');
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
});

});


//show  edit form after cllicking on Edit Button
    function showEditForm(id){
      $.ajax({
        url : "<?php echo base_url();?>CManageKzProducts/getProduct/"+id,
        type : 'POST',
        dataType : 'json',
        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
          $('#loader').removeClass('hidden')
        },
        success : function(response){
            $('#editModal #response').html(response['html']);
            $('#editModal').modal('show');
        },
        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
          $('#loader').addClass('hidden')
        }
      });
    }

//file validation
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpeg|\.png|\.jpg)$/i;

    // Check if any file is selected.
    if (fileInput.files.length > 0) {
            for (var i = 0; i <= fileInput.files.length - 1; i++) {
 
                const fsize = fileInput.files.item(i).size;
                const file = Math.round((fsize / 1024));

                document.getElementById("imageError").innerHTML="";
                // The size of the file.
                if (file >= 1024) {
                  document.getElementById("imageError").innerHTML="Please upload file having size less than 1 mb";
                  fileInput.value = '';
                  return false;
                }
            }
    }

    if(!allowedExtensions.exec(filePath)){
        document.getElementById("imageError").innerHTML="Please upload file having extensions .jpeg/.png/.jpg only.";
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              document.getElementById('imagePreview').setAttribute('width', '30px');
              document.getElementById('imagePreview').setAttribute('height', '30px');
              document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

function confirmDeleteModel(id){
    $('#deleteModal').modal('show');
    $('#deleteModal .modal-body').html('Are you sure you want to delete #'+id+'?');
    $('#deleteModal').data("id",id);
}

function deleteNow(){
    var id =  $('#deleteModal').data('id');
    $.ajax({
        url : "<?php echo base_url();?>CManageKzProducts/deleteProduct/"+id,
        type : 'POST',
        data : '',
        dataType : 'json',
        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
          $('#loader').removeClass('hidden')
        },
        success : function(response){
            $('#deleteModal').modal('hide');

            if(response['status'] == 1){
                var pro_id=response['pro_id'];  
                $('#ajaxDeleteResponseModal').modal('show');
                $('#ajaxDeleteResponseModal .modal-body').html(response['msg']);
                $("#row-"+pro_id).remove();   
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