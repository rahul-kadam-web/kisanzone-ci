
<!DOCTYPE html>
<html>
<!-- head -->
<?php $this->load->view('head'); ?>
<body>

  <div class="hero_area">
    <!-- header section strats -->
    <?php
        $this->load->view('headerSection');
    ?>
    <!-- end header section -->

    <!-- cart section -->
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-12">
             <h3>Shopping cart</h3>
                <table class="table table-responsive">
                    <thead class="text-info">
                        <tr>
                            <th width="10%"></th>
                            <th width="30%">Product</th>
                            <th width="15%">Price</th>
                            <th width="13%">Quantity</th>
                            <th width="20%" class="text-right">Subtotal</th>
                            <th width="12%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){    ?>
                        <tr>
                            <td>
                            <img src="<?php echo base_url().'productImages/'.$item["image"]; ?>" width="100"/>
                            </td>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo '$'.$item["price"].' Rs'; ?></td>
                            <td><input type="number" min="1" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item['rowid']; ?>')"></td>
                            <td class="text-right"><?php echo '$'.$item["subtotal"].' Rs'; ?></td>
                            <td class="text-right"><button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete item?')?window.location.href='<?php echo base_url('CCart/removeItem/'.$item['rowid']); ?>':false;"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                    <?php } }else{ ?>
                     <tr><td colspan="6"><p>Your cart is empty.....</p></td>
                    <?php } ?>
                    <?php if($this->cart->total_items() > 0){ ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Cart Total</strong></td>
                            <td class="text-right"><strong><?php echo '$'.$this->cart->total().' Rs'; ?></strong></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-right">
            <a href="<?php echo  base_url().'CHome'; ?>" class="btn btn-primary">Continue shopping</a>
            </div>
            </div>
        </div>
    </div>
    <!-- end of cart section -->
  
<!-- info section, footer section and Jquery links -->
<?php
$this->load->view('footerInfoSection')
?>
<script>
// Update item quantity
function updateCartItem(obj, rowid){
$.get("<?php echo base_url('CCart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
    if(resp == 'ok'){
        location.reload();
    }else{
        alert('Cart update failed, please try again.');
    }
});
// $.ajax({
// 				url:'<?php echo base_url('CCart/updateItemQty/'); ?>',
// 				type: "GET",
// 				dataType: 'json',
//                 data : {rowid:rowid, qty:obj.value},
// 				success: function(data){
// 					console.log(data);

// 				},
//                 error: function(data){
//                     alert('Cart update failed, please try again.');
//                 }
// 			});
}
</script>   

</body>

</html>