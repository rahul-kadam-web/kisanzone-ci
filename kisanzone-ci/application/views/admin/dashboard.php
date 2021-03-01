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
           <!-- end admin top navabr -->

           <h3>Dashbaord</h3>
           <p>Currently no contents</p>
        </div>
    </div>

 <!-- jquery and script -->
 <?php
    $this->load->view('admin/adminFooter');
 ?>

<script>
  $(document).ready(function() {
    $("#home").addClass("active");
  });
</script>
</body>

</html>