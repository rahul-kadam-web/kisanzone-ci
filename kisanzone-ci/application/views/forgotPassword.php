<!DOCTYPE html>
<html>
<!-- Head -->
<?php
  $this->load->view('head');
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3 card align-items-center">
               <div class="text-center">
                   <h5 class="pt-3 text-primary font-weight-bold">Kisanzone</h5>
                   <h4>Account Recovery</h4>
                   <hr>
                   <form action="">
                       <div class="form-group">
                           <label for="" class="">Enter Mobile Number</label>
                           <input type="number" min-length="10" max-length="10" class="form-control">
                       </div>
                       <div class="form-group">
                           <button class="btn btn-primary">Next</button>
                       </div>
                   </form>
               </div>             
            </div>
        </div>
    </div>
    <p class="text-center">It's in working</p>
  <!-- While ajax process request -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

</body>

</html>