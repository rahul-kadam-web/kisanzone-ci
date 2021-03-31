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
					        	<h3>Products Inventory</h3> 
					        </div>
				        </div>
				        <hr>

				        <table id="example" class="table table-responsive table-hover">
					        <thead>
					            <tr class="bg-dark text-light">
						            <th width="">Product Id</th>
                        			<th width="">Name</th>
						            <th width="">Quantity</th>
						            <th width="">Price</th>
						            <th width="">Category</th>
						            <th width="">Brand</th>
						            <th width="">Added Date</th>
					            </tr>
					        </thead>
					        <tbody>
					        <?php if(!empty($rows)){
					            foreach($rows as $row){
			                ?>
					            <tr>
					        	    <td><?php echo $row['pro_id']; ?></td>
						            <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td><?php echo $row['brand_name']; ?></td>
						            <td><?php echo date("d/m/Y h:i:sa", strtotime($row['added_date'])); ?></td>
					            </tr>  

					            <?php }} else{ 
					            ?>
					            <tr><td colspan="7" class="text-center">Records not found!</td></tr>
					            <?php } ?>
					            </tbody>
					        <tfoot>
                      <tr class="bg-dark text-light">
						            <th width="">Product Id</th>
                        <th width="">Name</th>
						            <th width="">Quantity</th>
						            <th width="">Price</th>
						            <th width="">Category</th>
						            <th width="">Brand</th>
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
				var text = 'Products inventory | '+d;
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
						var text = 'Products inventory | '+d;
						return text;
				},
				filename: function(){
					var d = new Date();
					var dd = d.getDate();
					var mm = d.getMonth();
					var yy = d.getFullYear();
					var text = 'Products inventory '+dd+'-'+mm+'-'+yy;
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