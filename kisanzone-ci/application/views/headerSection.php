    <!-- header section starts -->
    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
          <div class="top_nav_container">
            <div class="contact_nav">
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call : +91 7756925667
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  Email : rahulpkadam98@gmail.com
                </span>
              </a>
            </div>
          </div>

        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="<?php echo site_url('CHome/index'); ?>">
              <span>
                Kisanzone
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CHome/login'); ?>"> 
                    <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                  Login
                </span>
              </a>
                </li>
                <!-- cart basket -->
                 <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('CCart'); ?>" title="View Cart">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>
                  Cart (<?php echo ($this->cart->total_items() > 0)?$this->cart->total_items():'0'; ?>)
                </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CHome/about'); ?>">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CHome/whyUs'); ?>">Why Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CHome/contactUs'); ?>">Contact Us</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->