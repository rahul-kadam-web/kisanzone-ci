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
                    <h6 class="text-center text-light bg-dark p-2"><?php echo date("d-m-Y h:i:s a", strtotime($orderRow['created_date'])); ?></h6>
                    <div class="row m-3">
                        <div class="col-4 col-md-2">
                            <img width="100" src="<?php echo base_url().'productImages/'.$orderRow['image'] ?>" alt="product">
                        </div>
                        <div class="col-8 col-md-4">
                            <p>
                                <b><?php echo $orderRow['name']; ?></b><br>
                                <?php echo $orderRow['category_name']; ?> - <?php echo $orderRow['brand_name']; ?><br>
                                <strong>Quantity : </strong><?php echo $orderRow['quantity']; ?>
                            </p>
                        </div>
                        <div class="col-4 col-md-2">
                            <p><i class="fa fa-inr"></i><?php echo $orderRow['sub_total']; ?></p>
                        </div>
                        <?php if($orderRow['status'] == 1){ ?>
                        <div class="col-8 col-md-4">
                            <p class=>
                            <b>Delivery address</b><br>
                            <?php echo $orderRow['address']; ?>, <?php echo $orderRow['city']; ?>, <?php echo $orderRow['state']; ?>, <?php echo $orderRow['pin']; ?>
                            </p>
                            <p class="text-right">
                                <a href="<?php echo site_url("CCustomers/cancelOrder?pro_id=".$orderRow["pro_id"]."&order_id=".$orderRow["order_id"]."&quantity=".$orderRow['quantity']."&price=".($orderRow['grand_total']-$orderRow['sub_total']));?>" class="text-light badge badge-primary">
                                    <i class="fa fa-close font-weight-bold"> Cancel item</i>
                                </a>
                            </p>
                        </div>
                        <?php }else{ ?>
                        <div class="col-8 col-md-4">
                            <p>
                            <span class="badge badge-pill badge-danger">&nbsp;</span><b> Cancelled</b><br>
                            <span class="text-muted"> You requested a cancellation because you changed your mind about this product</span>
                            </p>
                        </div>
                        <?php } ?>
                     </div>
                </div>            
        <?php }  
        }else{ 
          echo '<div class="container card text-center pt-4 pb-4"><h5>You did not order anything!</h5></div>'; 
          } ?>
    </section>
  <!-- end orders section -->


<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>


</body>

</html>                                                             