
            <form name="brandForm" id="brandForm" onsubmit="return brandFormValidation()">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-lg"><u>Edit Brand</u></h5>
                                <hr>
                                <div id="alert" class="alert alert-dismissible">
                                  <div id="alert-msg"></div>
                                    <button type="button" class="close">&times;</button>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                         <div class="form-group text-left">
                                            <label>Brand Name</label>
                                            <input type="hidden" name="brand_id" id="brand_id" value="<?php echo $row['brand_id']; ?>">
                                            <input type="text" name="brand_name" id="brand_name" value="<?php echo $row['brand_name']; ?>" class="form-control">
                                            <span class="text-danger" id="brandError"></span>
                                          </div>
                                    </div>
                                </div>
                                    <button type="submit" class="card-link btn btn-info pr-4 pl-4">Edit</button>
                             </div>
                        </div>
                    </div>
                </div>
            </form>