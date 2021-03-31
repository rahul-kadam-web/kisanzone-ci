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
					        	<h3>Orders List</h3> 
					        </div>
				        </div>
				        <hr>

				        <table id="example" class="table table-responsive table-hover">
					        <thead>
					            <tr class="bg-dark text-light">
						            <th width="120">Order Id</th>
                        			<th width="120">Order Item Id</th>
						            <th width="120">Customer Id</th>
						            <th width="120">Product Id</th>
						            <th width="120">Quantity</th>
						            <th width="200">Price</th>
									<th width="200">Order Date</th>
					            </tr>
					        </thead>
					        <tbody>
					        <?php if(!empty($rows)){
								// loading configuration file of mobile for encryption and decryption
								$this->load->config('mobile');
								
					            foreach($rows as $row){
			                ?>
					            <tr>
					        	    <td><?php echo $row['order_id']; ?></td>
						            <td><?php echo $row['order_item_id']; ?></td>
                        			<td><?php echo $row['cus_id']; ?></td>
                        			<td><?php echo $row['pro_id']; ?></td>
                        			<td><?php echo $row['quantity']; ?></td>
                        			<td><?php echo $row['sub_total']; ?></td>
						            <td><?php echo date("d/m/Y", strtotime($row['created_date'])); ?></td>
					            </tr>  

					            <?php }} else{ 
					            ?>
					            <tr><td colspan="7" class="text-center">Records not found!</td></tr>
					            <?php } ?>
					            </tbody>
					        <tfoot>
								<tr class="bg-dark text-light">
						            <th width="">Order Id</th>
                        			<th width="">Order Item Id</th>
						            <th width="">Customer Id</th>
						            <th width="">Product Id</th>
						            <th width="">Quantity</th>
						            <th width="">Price</th>
									<th width="">Order Date</th>
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
				var text = 'Orders list | '+d;
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
						var text = 'Orders list | '+d;
						return text;
				},
				filename: function(){
					var d = new Date();
					var dd = d.getDate();
					var mm = d.getMonth();
					var yy = d.getFullYear();
					var text = 'Orders list '+dd+'-'+mm+'-'+yy;
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