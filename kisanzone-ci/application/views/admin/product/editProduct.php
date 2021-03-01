<form name="productForm" id="productForm" enctype="multipart/form-data" >
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-lg-center"><u>Edit Product</u></h5>
                                <hr>
                                <div id="alert" class="alert alert-dismissible">
                                  <div id="alert-msg"></div></div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                    <input type="hidden" name="pro_id" value="<?php echo $row['pro_id']; ?>">
                                         <div class="form-group">
                                            <label>Product Brand</label>
                                            <select name="brand" class="form-control">
                                                <?php if(!empty($rows_brand)){
					                                      foreach($rows_brand as $row_brand){
			                                    ?>
                                                <option <?php echo ($row['brand_id'] == $row_brand['brand_id']) ? 'selected' : ''; ?> value="<?php echo $row_brand['brand_id']; ?>"><?php echo $row_brand['brand_name']; ?></option>
                                                <?php } } ?>
                                            </select>
                                            <span class="text-danger" id="brandError"></span>
                                          </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                         <div class="form-group">
                                            <label>Product Category</label>
                                              <select name="category" class="form-control">
                                                <?php if(!empty($rows_category)){
					                                      foreach($rows_category as $row_category){
			                                          ?>
                                                <option <?php echo ($row['cat_id'] == $row_category['cat_id']) ? 'selected' : ''; ?> value="<?php echo $row_category['cat_id']; ?>"><?php echo $row_category['category_name']; ?></option>
                                                <?php } } ?>
                                            </select>
                                            <span class="text-danger" id="categoryError"></span>
                                          </div>
                                    </div>
                                     <div class="col-12 col-md-6 col-lg-6">
                                         <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" value="<?php echo $row['name']; ?>" name="product" class="form-control">
                                            <span class="text-danger" id="productError"></span>
                                          </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                         <div class="form-group">
                                            <label>Product Price</label>
                                            <input type="number" value="<?php echo $row['price']; ?>" name="price" class="form-control">
                                            <span class="text-danger" id="priceError"></span>
                                          </div>
                                    </div>
                                     <div class="col-12 col-md-6 col-lg-6">
                                         <div class="form-group">
                                            <label>Product Quantity</label>
                                            <input type="number" value="<?php echo $row['quantity']; ?>" name="quantity" class="form-control">
                                            <span class="text-danger" id="quantityError"></span>
                                          </div>
                                    </div>
                                     <div class="col-12 col-md-6 col-lg-6">
                                         <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="hidden" name="oldImage" value="<?php echo $row['image']; ?>">
                                            <div> <img id="oldImage" width="100" height="100" src="<?php echo base_url().'productImages/'.$row['image']; ?>" alt=""></div>
                                            <div class="row">
                                              <div class="col-10">
                                            <input type="file"  id="file" onchange="fileValidation()" name="file" class="form-control">
                                            <span class="text-danger" id="imageError"></span>
                                              </div>
                                              <div class="col-2 pt-2">
                                              <i class="fa fa-eye" data-toggle="modal" data-target="#imagePreviewModal" aria-hidden="true"></i>
                                              </div>
                                            </div>

                                            <!-- Image Preview Modal -->
                                            <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg" role="document">
                                               <div class="modal-content">
                                                 <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                     <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                 <div class="modal-body">
                                                   <!-- Image preview -->
                                                   <div id="imagePreview"></div>
                                                </div>
                                             </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-12">
                                         <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" rows="4" name="desc"><?php echo $row['description']; ?></textarea>
                                            <span class="text-danger" id="descError"></span>
                                          </div>
                                    </div>
                                </div>
                                    <button type="submit" class="card-link btn btn-info">Edit</button>
                             </div>
                        </div>
                      
                    </div>
                </div>
          </form>