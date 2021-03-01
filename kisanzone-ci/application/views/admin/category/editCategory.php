            <form name="categoryForm" id="categoryForm" onsubmit="return categoryFormValidation()">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-lg"><u>Edit Category</u></h5>
                                <hr>
                                <div id="alert" class="alert alert-dismissible">
                                  <div id="alert-msg"></div>
                                    <button type="button" class="close">&times;</button>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                         <div class="form-group text-left">
                                            <label>Category Name</label>
                                            <input type="hidden" name="cat_id" value="<?php echo $row['cat_id']; ?>" id="cat_id">
                                            <input type="text" name="category_name" value="<?php echo $row['category_name']; ?>" id="category" class="form-control">
                                            <span class="text-danger" id="categoryError"></span>
                                          </div>
                                    </div>
                                </div>
                                    <button type="submit" class="card-link btn btn-info pr-4 pl-4">Edit</button>
                             </div>
                        </div>
                      
                    </div>
                </div>
            </form>