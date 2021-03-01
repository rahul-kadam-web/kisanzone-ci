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
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Welcome to our kisanzone shop
                    </h1>
                    <p>
                    We are selling agricutural products online with information to the our indean farmers.
                    </p>
                    <!-- <a href="">
                      Read More
                    </a> -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="<?php echo base_url().'assets/images/slider-1.png'; ?>" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Looking for great and trusted deal
                    </h1>
                    <p>
                       So we are here to provide you assured products.
                    </p>
                    <p>You can shop here without any fear</p>
                    <!-- <a href="">
                      Read More
                    </a> -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="<?php echo base_url().'assets/images/slider-2.png'; ?>" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn_box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>


  <!-- product section -->

  <section class="product_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Products
        </h2>
      </div>
      <div class="row">
        <!-- Products -->
        <?php if(!empty($products)){ foreach($products as $row){ ?>
        <div class="col-sm-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <img src="<?php echo base_url().'productImages/'.$row["image"]; ?>" alt="product image" class="img img-responsive">
              <a href="<?php echo base_url().'index.php/CHome/addToCart/'.$row['pro_id']; ?>" class="add_cart_btn">
                <span>
                  Add To Cart
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
      <div class="btn_box">
        <a href="#" class="view_more-link">
          View More
        </a>
      </div>
    </div>
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
                We are providing fast delivery of products to the your address
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
               We are providing free shiping facility
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
                We check all the product before sale
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
</body>

</html>