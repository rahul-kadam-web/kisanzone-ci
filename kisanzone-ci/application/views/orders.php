<!DOCTYPE html>
<html>
<!-- Head -->
<?php
  $this->load->view('head');
?>
<body>

    <!-- header section strats -->
   <?php
    $this->load->view('headerSection');
   ?>
    <!-- end header section -->

  <!-- orders section -->

    <section class="bg-light orders_section layout_padding">
    <div class="container">
    <?php
        if(!empty($this->session->flashdata('success_msg'))){ 
        ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
        <?php
        }
        if(!empty($this->session->flashdata('error_msg'))){ 
        ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('error_msg'); ?>
        </div>
        <?php 
        }
        ?>
        </div>
        <!-- Display orders -->
      
        <?php  
        if(!empty($orderRows)){
           foreach($orderRows as $orderRow){
            ?> <div class="container card mb-3">
                    <div class="row m-3">
                        <div class="col-4 col-md-2">
                            <img width="100" src="<?php echo base_url().'productImages/'.$orderRow['image'] ?>" alt="product">
                        </div>
                        <div class="col-8 col-md-4">
                            <p>
                                <b><?php echo $orderRow['name']; ?></b><br>
                                <?php echo $orderRow['category_name']; ?><br>
                                <?php echo $orderRow['brand_name']; ?><br><br>
                                <strong>Quantity : </strong><?php echo $orderRow['quantity']; ?>
                            </p>
                        </div>
                        <div class="col-4 col-md-2">
                            <p><i class="fa fa-inr"></i><?php echo $orderRow['sub_total']; ?></p>
                        </div>
                        <div class="col-8 col-md-4">
                            <p>
                            <b>Delivery address</b><br>
                            <?php echo $orderRow['address']; ?>, <?php echo $orderRow['city']; ?>, <?php echo $orderRow['state']; ?>, <?php echo $orderRow['pin']; ?><br>
                            <?php echo date("d-m-Y h:i:sa", strtotime($orderRow['created_date'])); ?>
                            </p>
                        </div>
                     </div>
                </div>            
        <?php }  
        }else{ 
          echo '<div class="text-center"><p>You did not ordered anything!</p></div>'; 
          } ?>
    </section>
  <!-- end orders section -->


<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>


</body>

</html>