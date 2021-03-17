        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Kisanzone</h3>
            </div>

            <ul class="list-unstyled components">
                <li id="home">
                    <a href="<?php echo site_url('CAdminManage/adminDashboard'); ?>">
                    <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>

                <li id="product">
                    <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-sitemap"></i>
                        Product
                    </a>
                    <ul class="collapse list-unstyled" id="productSubmenu">
                        <li>
                            <a href="<?php echo site_url('CManageKzProducts/index'); ?>">List Of Product</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('CManageKzProducts/addProduct'); ?>">Add Product</a>
                        </li>
                    </ul>
                </li>

                  <li id="brand">
                    <a href="#brandSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-briefcase"></i>
                        Brand
                    </a>
                    <ul class="collapse list-unstyled" id="brandSubmenu">
                        <li>
                            <a href="<?php echo site_url('CManageKzBrand/index'); ?>">List of Brand</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('CManageKzBrand/addBrand'); ?>">Add Brand</a>
                        </li>
                    </ul>
                </li>

                 <li id="category">
                    <a href="#categorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-ellipsis-h"></i>
                        Category
                    </a>
                    <ul class="collapse list-unstyled" id="categorySubmenu">
                        <li>
                            <a href="<?php echo site_url('CManageKzCategory/index'); ?>">List of Category</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('CManageKzCategory/addCategory'); ?>">Add Category</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-list"></i>
                        Reports
                    </a>
                    <ul class="collapse list-unstyled" id="reportsSubmenu">
                        <li>
                            <a href="#">Report 1</a>
                        </li>
                        <li>
                            <a href="#">Report 2</a>
                        </li>
                        <li>
                            <a href="#">Report 3</a>
                        </li>
                        <li>
                            <a href="#">Report 4</a>
                        </li>
                    </ul>
                </li>
                <!-- icons -->
                <!-- <i class="fas fa-paper-plane"></i>
                <i class="fas fa-image"></i>
                <i class="fas fa-copy"></i>
                <i class="fas fa-question"></i>
            <i class="fas fa-list"></i> -->
            </ul>
            <div class="text-center">
                <?php echo anchor('CAdminManage/logout', 'Logout', 'class="btn btn-danger"'); ?>
            </div>
            <br>
        </nav>
