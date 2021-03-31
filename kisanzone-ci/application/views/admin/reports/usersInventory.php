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
					        <div class="col-12">
					        	<h3>Users Inventory</h3> 
					        </div>
				        </div>
				        <hr>

				        <table id="example" class="table table-responsive table-hover">
					        <thead>
					            <tr class="bg-dark text-light">
						            <th width="">Cus Id</th>
                        			<th width="">Name</th>
						            <th width="">Email</th>
						            <th width="">Mobile</th>
						            <th width="">City</th>
						            <th width="">State</th>
									<th width="">Address</th>
						            <th width="">Added Date</th>
					            </tr>
					        </thead>
					        <tbody>
					        <?php if(!empty($rows)){
								// loading configuration file of mobile for encryption and decryption
								$this->load->config('mobile');
								
					            foreach($rows as $row){
			                ?>
					            <tr>
					        	    <td><?php echo $row['cus_id']; ?></td>
						            <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                        			<td><?php echo $row['email']; ?></td>
                        			<td><?php echo openssl_decrypt($row['mobile'],  $this->config->item('ciphering'),$this->config->item('encryption_key'),$this->config->item('options'), $this->config->item('encryption_iv')); ?></td>
                        			<td><?php echo $row['city']; ?></td>
                        			<td><?php echo $row['state']; ?></td>
									<td><?php echo $row['address']; ?></td>
						            <td><?php echo date("d/m/Y h:i:sa", strtotime($row['created_date'])); ?></td>
					            </tr>  

					            <?php }} else{ 
					            ?>
					            <tr><td colspan="7" class="text-center">Records not found!</td></tr>
					            <?php } ?>
					            </tbody>
					        <tfoot>
								<tr class="bg-dark text-light">
						            <th width="">Cus Id</th>
                        			<th width="">Name</th>
						            <th width="">Email</th>
						            <th width="">Mobile</th>
						            <th width="">City</th>
						            <th width="">State</th>
									<th width="">Address</th>
						            <th width="">Added Date</th>
					            </tr>
					        </tfoot>

				        </table>
                    </div>
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
  $("#reports").addClass("active");
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
				var text = 'Users feedback | '+d;
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
						var text = 'Users feedback | '+d;
						return text;
				},
				filename: function(){
					var d = new Date();
					var dd = d.getDate();
					var mm = d.getMonth();
					var yy = d.getFullYear();
					var text = 'Users feedback '+dd+'-'+mm+'-'+yy;
					return text;
				},
				exportOptions: {
					columns: ':visible'
				}
			    }
        ]
		});

</script>
</body>

</html>