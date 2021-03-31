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
					        	<h3>Most viewed products list</h3> 
					        </div>
				        </div>
				        <hr>

				        <table id="example" class="table table-responsive table-hover">
					        <thead>
					            <tr class="bg-dark text-light">
						            <th width="200">Product Id</th>
                        			<th width="500">Name</th>
						            <th width="250">Number of time seen</th>
					            </tr>
					        </thead>
					        <tbody>
					        <?php if(!empty($rows)){
								// loading configuration file of mobile for encryption and decryption
								$this->load->config('mobile');
								
					            foreach($rows as $row){
			                ?>
					            <tr>
					        	    <td><?php echo $row['pro_id']; ?></td>
						            <td><?php echo $row['name']; ?></td>
                        			<td><?php echo $row['count']; ?></td>
					            </tr>  

					            <?php }} else{ 
					            ?>
					            <tr><td colspan="7" class="text-center">Records not found!</td></tr>
					            <?php } ?>
					            </tbody>
					        <tfoot>
								<tr class="bg-dark text-light">
						            <th width="200">Product Id</th>
                        			<th width="500">Name</th>
						            <th width="250">Number of  seen</th>
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
				var text = 'Most viewed products | '+d;
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
						var text = 'Most viewed products | '+d;
						return text;
				},
				filename: function(){
					var d = new Date();
					var dd = d.getDate();
					var mm = d.getMonth();
					var yy = d.getFullYear();
					var text = 'Most viewed products '+dd+'-'+mm+'-'+yy;
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