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
					        	<h3>View Brand List</h3> 
					        </div>
				        </div>
				        <hr>

				        <table id="example" class="table table-responsive table-hover">
					        <thead>
					            <tr class="bg-dark text-light">
						            <th width="10%">ID</th>
						            <th width="20%">Brand Name</th>
						            <th width="20%">Created Date</th>
						            <th width="20%">Modified Date</th>
						            <th width="10%">Status</th>
						            <th width="10%">Edit</th>
						            <th width="10%">Delete</th>
					            </tr>
					        </thead>
					        <tbody>
					        <?php if(!empty($rows)){
					            foreach($rows as $row){
			                ?>
					            <tr id="row-<?php echo $row['brand_id'] ?>">
					        	    <td class="modelId"  width="10%"><?php echo $row['brand_id']; ?></td>
						            <td class="modelName" width="20%"><?php echo $row['brand_name']; ?></td>
						            <td class="modelCreated" width="20%"><?php echo date("d/m/Y h:i:sa", strtotime($row['created_date'])); ?></td>
						            <td  class="modelModified" width="20%"><?php echo (empty($row['modified_date'])) ? 'Not modified' : date("d/m/Y h:i:sa", strtotime($row['modified_date'])); ?></td>
						            <td  class="modelStatus" width="10%"><?php echo ($row['status'])==1 ? 'Active' : 'Inactive';?></td>
						            <td  width="10%"><a href="javascript:void(0)" onclick="showEditForm(<?php echo $row['brand_id']; ?>)" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  						            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  						            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						            </svg> Edit</a></td>
						            <td  width="10%"><a href="#" onclick="confirmDeleteModel(<?php echo $row['brand_id']; ?>)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
						            <th width="10%">ID</th>
						            <th width="20%">Brand Name</th>
						            <th width="20%">Created Date</th>
						            <th width="20%">Modified Date</th>
						            <th width="10%">Status</th>
						            <th width="10%">Edit</th>
						            <th width="10%">Delete</th>
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
  <div class="modal-dialog">
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
   <!-- jquery and script -->
 <?php
    $this->load->view('admin/adminFooter');
 ?>
 
<script>
$(document).ready(function() {
    $("#brand").addClass("active");

		//data table with many features
		$('#example').DataTable({
			dom: 'Bflrtip',
			buttons: [
				{
					extend: 'colvis',
					text: 'Columns',
				},
				{
				extend: 'print',
				title: '',
				messageTop: function () {
				var d = new Date();
				var dd = d.getDate();
				var mm = d.getMonth();
				var yy = d.getFullYear();
				var text = 'Test | '+d;
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
						var text = 'Test | '+d;
						return text;
				},
				filename: function(){
					var d = new Date();
					var dd = d.getDate();
					var mm = d.getMonth();
					var yy = d.getFullYear();
					var text = 'Test '+dd+'-'+mm+'-'+yy;
					return text;
				},
				exportOptions: {
					columns: ':visible'
				}
			    }
			    ]
		});

  });

//show  edit form after cllicking on Edit Button
    function showEditForm(id){
        $.ajax({
        url : "<?php echo base_url();?>CManageKzBrand/getBrand/"+id,
        type : 'POST',
        dataType : 'json',
        success : function(response){
            $('#editModal #response').html(response['html']);
            $('#editModal').modal('show');
        }
      });
    }
// brand form validation using javascript and edit
function brandFormValidation(){
 var brand_id=document.getElementById('brand_id').value;
  var brand = document.forms["brandForm"]["brand_name"].value;
  //error count
  var count=0;

  if(brand == "")
  {
    document.getElementById('brandError').innerHTML="Brand is required";
    count++;
  }

  if(brand != "")
  {
    document.getElementById('brandError').innerHTML="";
  }

  if(count > 0){
    return false;
  }else{
    event.preventDefault();
    $('#brandForm').show();
    $.ajax({
        url : "<?php echo base_url();?>CManageKzBrand/updateBrand",
        type : 'POST',
        data: $('#brandForm').serializeArray(),
        dataType : 'json',
        success : function(response){
            if(response['status']==1){
            $('#alert').show();
            $('#alert-msg').html(response['msg']);
            $("#alert").addClass("alert-success");

            var brand_id=response['row']['brand_id'];
            $("#row-"+brand_id+" .modelName").html(response['row']['brand_name']);
            $("#row-"+brand_id+" .modelCreated").html(response['row']['created_date']);
            $("#row-"+brand_id+" .modelModified").html(response['row']['modified_date']);
            $("#row-"+brand_id+" .modelStatus").html((response['row']['status'])==1? 'Active' : 'Inactive');

          }else{
            $('#alert').show();
            $('#alert-msg').html(response['msg']);
            $("#alert").addClass("alert-danger");
          }
        },
        error: function(xhr, status, error){
            alert(error);
        }
    });
  }
}

// confirm modal
function confirmDeleteModel(id){
    $('#deleteModal').modal('show');
    $('#deleteModal .modal-body').html('Are you sure you want to delete #'+id+'?');
    $('#deleteModal').data("id",id);
}

// delete record
function deleteNow(){
    var id =  $('#deleteModal').data('id');
    $.ajax({
        url : "<?php echo base_url();?>CManageKzBrand/deleteBrand/"+id,
        type : 'POST',
        data : '',
        dataType : 'json',
        success : function(response){
            $('#deleteModal').modal('hide');

            if(response['status'] == 1){
                var brand_id=response['brand_id'];  
                $('#ajaxDeleteResponseModal').modal('show');
                $('#ajaxDeleteResponseModal .modal-body').html(response['msg']);
                $("#row-"+brand_id).remove();   
            }
        }
    });
}
</script>
</body>

</html>