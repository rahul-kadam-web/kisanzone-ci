<!DOCTYPE html>
<html>
<!-- head -->
<?php $this->load->view('head'); ?>
<body>

  <div class="hero_area">
    <!-- header section start -->
    <?php
        $this->load->view('headerSection');
    ?>
    <!-- end header section -->


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