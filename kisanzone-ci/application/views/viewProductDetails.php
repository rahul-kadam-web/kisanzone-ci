<!DOCTYPE html>
<html>
<!-- Head -->
<?php
  $this->load->view('head');
?>
<body>

  <div class="hero_area">
    <!-- header section strats -->
   <?php
    $this->load->view('headerSection');
   ?>
    <!-- end header section -->


  <!-- viewProductDetails section -->

  <section class="viewProductDetails_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5 justify-content-center card ">
                    <img class="img-fluid " src="<?php echo base_url().'productImages/'.$products['image']; ?>" data-zoo-image="<?php echo base_url().'productImages/'.$products['image']; ?>" alt="product">
                </div>

                <div class="col-12 col-md-7">
                    <div class="container pt-3">
                        <h4><b><?php echo $products['name']; ?></b></h4>
                        <p><?php echo $products['category_name']; ?> - <?php echo $products['brand_name']; ?></p>
                        <h2><i class="fa fa-inr"> <?php echo $products['price']; ?> /- </i> </h2>
                        <hr>
                        <?php if($products['quantity'] != 0){ ?>
                        <button class="">
                            <a href="<?php echo base_url().'index.php/CCart/addToCart/'.$products['pro_id']; ?>" >
                                <span>
                                Add To Cart
                                </span>
                            </a>
                        </button>
                        <?php }else{?>
                            <h1 class="font-weight-bold">Sold out</h1>
                            <h3>This item is currently out of stock</h3>
                        <?php } ?>
                        <hr>
                        <div class="card p-3">
                            <h4>Product description</h4>
                            <hr>
                            <p><?php echo $products['description']; ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
  </section>
  <!-- end viewProductDetails section -->

<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>

<script>
    $(document).ready(function(){
    
});  
</script>

<!-- store recently viewed product which are here -->
<?php
    $intCustomerId = $this->session->userdata('cus_id');

    if(!empty($intCustomerId)){
    ?>
    <script>
    $.ajax({
        url: "<?php echo base_url().'CCustomers/recentlyViewedProducts'; ?>",
        type: "POST",
        data: {
            "cus_id":<?php echo $intCustomerId; ?>,
            "pro_id":<?php echo $products['pro_id']; ?>
        },
        dataType: 'json',
        success: function(response){

        }
    });
    
    </script>
    <?php
    }
?>
</body>

</html>