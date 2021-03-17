<!DOCTYPE html>
<html>
<!-- head -->
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
    <!-- slider section -->
    <section class="slider_section ">
         <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
            </ul>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="<?php echo base_url().'assets/images/Slider-1.jpg'; ?>" alt="Slider-1">
                <div class="carousel-caption font-weight-bold">
                  <h1 class="text-warning"> Welcome to our kisanzone shop</h1>
                  <h4>We are selling agricutural products online with information to the our indean farmers.</h4>
                </div>   
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="<?php echo base_url().'assets/images/Slider-2.jpg'; ?>" alt="Slider-2">
                <div class="carousel-caption font-weight-bold">
                  <h1 class="text-warning">Looking for great and trusted deal</h1>
                  <h4>So we are here to provide you assured products. You can shop here without any fear</h4>
                </div>   
              </div>
           </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
          </div>
    </section>
    <!-- end slider section -->
  
  </div>
  


  <!-- product section -->

  <section class="product_section layout_padding">
    <div class="container">
    <hr>
      <div class="heading_container heading_center">
        <h2>
          Our Products
        </h2>
      </div>
      <hr>
      <!-- Showing product categorywise -->
      <div class="row">
      <!-- Products -->
      <?php 
        $strCategory = ''; 
        if(!empty($products)){
           foreach($products as $row){
              if($strCategory != $row['category_name']){
              //if((strcmp($strCategory , $row['category_name']))){
              $strCategory = $row['category_name'];
            
      ?>
        <div class="col-12 text-left mt-3">
          <h3> <?php echo $strCategory; ?></h3>
        </div>
        <?php } ?>
        <div class="col-sm-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <img src="<?php echo base_url().'productImages/'.$row["image"]; ?>" alt="product image" class="img img-responsive">
              <a href="<?php echo base_url().'CHome/viewProductDetails/'.$row['pro_id']; ?>" class="view_details_btn">
                <span>
                  View Details
                </span>
              </a>
            </div>
            <div class="detail-box">
              <h5>
              <?php echo $row["name"]; ?>
              </h5>
              <div class="product_info">
                <h5>
                  <span>Rs: </span><?php echo $row["price"]; ?>
                </h5>
                <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php }  
        }else{ 
          echo '<p>Currently Products are not available!</p>'; 
          } ?>
      </div>

      <!-- <div class="btn_box">
        <a href="#" class="view_more-link">
          View More
        </a>
      </div> -->
    </div>

  <?php 
    if(!empty($recently_viewed_products)){
  ?>
    <div class="container pt-5 mt-5">
    <hr>
      <div class="heading_container heading_center">
        <h2>
          Recently Viewed Products
        </h2>
      </div>
      <hr>
      <div class="row">
      <!-- Products -->
      <?php
        foreach($recently_viewed_products as $row){ 
      ?>
        <div class="col-sm-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <img src="<?php echo base_url().'productImages/'.$row["image"]; ?>" alt="product image" class="img img-responsive">
              <a href="<?php echo base_url().'CHome/viewProductDetails/'.$row['pro_id']; ?>" class="view_details_btn">
                <span>
                  View Details
                </span>
              </a>
            </div>
            <div class="detail-box">
              <h5>
              <?php echo $row["name"]; ?>
              </h5>
              <div class="product_info">
                <h5>
                  <span>Rs: </span><?php echo $row["price"]; ?>
                </h5>
                <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
  </section>
  <!-- end product section -->

  <!-- why us section -->
  <section class="why_us_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Why Choose Us
        </h2>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
              <img src="<?php echo base_url('assets/images/w1.png');?>" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Fast Delivery
              </h5>
              <p>
              We are providing fast delivery of products to your address
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
              <img src="<?php echo base_url('assets/images/w2.png');?>" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Free Shiping
              </h5>
              <p>
              We are providing a free shipping facility on products
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
              <img src="<?php echo base_url('assets/images/w3.png');?>" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Best Quality
              </h5>
              <p>
              We check all the products before the sale.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end why us section -->
  
<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>
<script type="text/javascript">
$(document).ready(function(){
  $('.carousel').carousel({
  interval: 2000
});
});
</script>
</body>

</html>