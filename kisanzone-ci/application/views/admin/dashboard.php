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

           <h3>Dashboard</h3>
           <div class="container">
              <div class="row">
                <div class="col-md-3">
                  <div class="card-counter primary">
                    <i class="fas fa-sitemap"></i>
                    <span class="count-numbers">
                      <?php 
                        if(!empty($products)){
                          echo $products; 
                        } 
                      ?>
                    </span>
                    <span class="count-name">Products</span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card-counter danger">
                    <i class="fas fa-briefcase"></i>
                    <span class="count-numbers">
                      <?php 
                        if(!empty($brand)){
                          echo $brand; 
                        } 
                      ?>
                    </span>
                    <span class="count-name">Brands</span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card-counter success">
                    <i class="fas fa-ellipsis-h"></i>
                    <span class="count-numbers">
                      <?php 
                        if(!empty($category)){
                          echo $category; 
                        } 
                      ?>
                    </span>
                    <span class="count-name">Categories</span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card-counter info">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers">
                      <?php 
                        if(!empty($customers)){
                          echo $customers; 
                        } 
                      ?>
                    </span>
                    <span class="count-name">Users</span>
                  </div>
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
    $("#home").addClass("active");
  });
</script>
</body>

</html>