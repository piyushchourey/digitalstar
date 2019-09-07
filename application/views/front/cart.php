<style type="text/css">
   .shop .j2store-product-list .j2store-products-row .j2store-single-product {
    border: 1px solid #eee;
    box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin-bottom: 20px;
}
.t3-content
{
   padding-top: 20px !important;
   padding-bottom: 20px !important;
   margin-left: 30px !important;
}
input.width_dec
{
   width: 80px;
}
</style>
<div class="shop">
<div class="wrap t3-breadcrumbs ">
      <div class="container">
        <ul itemscope="" itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
            <li>
               &nbsp; <i class="fa fa-home"></i>
            </li>
            <li itemprop="itemListElement">
               <a itemprop="item" href="<?php echo base_url(); ?>" class="pathway"><span itemprop="name">Home</span></a>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">             
               </span>
               <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">
               Cart Detail           </span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">           
               </span>
               <meta itemprop="position" content="3">
            </li>
         </ul> 

      </div>
   </div>
<div id="t3-mainbody" class="container t3-mainbody">
   <div class="row">
      <!-- MAIN CONTENT -->
      <div id="t3-content" class="t3-content col-xs-12">
         <span class="text-danger dn error"></span>
         <div class="clearfix table-responsive">
            <?php if(count($this->cart->contents()) > 0) { ?>
               <table class="table ct-table">
                  <tbody>
                     <tr class="bg-smoke">
                        <th>ITEM</th>
                        <th>QTY</th>
                        <th>PRICE</th>
                        <th>SUBTOTAL</th>
                        <th>ACTION</th>
                     </tr>
                     <?php $totalAmount = 0; foreach ($this->cart->contents() as $items) { ?>
                     <tr class="tr_<?php $items['rowid'];?>">
                        <td>
                           <div class="row">
                              <aside class="col-sm-3">
                                 <img src="<?php echo base_url('images/products')."/".$items['options']['image']; ?>" class="img-responsive" height="80" width="80"> 
                              </aside>
                              <aside class="col-sm-9">
                                 <a>
                                    <h4><?php echo ucfirst($items['name']) ?></h4>
                                    <?php if(isset($items['options']['pack_type']) && $items['options']['pack_type']!="") {
                                    echo  "Pack type:- <span>".$items['options']['pack_type']."</span>";
                                    } ?>
                                    <br>
                                    <?php if(isset($items['options']['pack_timing']) && $items['options']['pack_timing']!="") {
                                    echo  "Pack Timing:- <span>".$items['options']['pack_timing']."</span>";
                                    } ?>
                                 </a>
                              </aside>
                           </div>
                        </td>
                        <td>
                           <input type="text" class="form-control chage_cart_qty width_dec" main="<?php echo $items['rowid'];?>" title="sku_272" value="<?php echo $items['qty'];?>">
                        </td>
                        <td>
                           <p> <i class="fa fa-inr"></i><?php echo $items['price']; ?></p>
                        </td>
                        <td>
                           <h5><strong><i class="fa fa-inr"></i> <?php echo $items['qty']*$items['price']; ?></strong></h5>
                        </td>
                        <td>
                           <div class="row">
                              <aside class="col-sm-6">
                                 <a class="remove_item" href="javascript:void(0);" main="<?php echo $items['rowid'];?>" title="Remove Product"><i class="fa fa-trash"></i></a>
                              </aside>
                           </div>
                        </td>
                     </tr>
                     <?php $totalAmount+= $items['subtotal']; } ?>
                     <tr class="bg-smoke text-right t-xs-left">
                        <td colspan="6">
                           <h5><strong>Subtotal: <i class="fa fa-inr"></i> <?php echo $totalAmount; ?></strong></h5>
                           <h5><strong>Total Amount: <i class="fa fa-inr"></i> <?php echo $totalAmount; ?></strong></h5>
                        </td>
                     </tr>
                     <tr class="bg-smoke text-right" id="discout_val_html"></tr>
                  </tbody>
               </table>
               <div class="buttons-right">
                  <span class="cart-checkout-button">
                     <a class="btn button" href="<?php echo base_url('cart/checkout'); ?>">Proceed to Checkout </a>
                  </span>
               </div>
            <?php } else { ?>
               <div class="buttons-right">
                  <span class="cart-checkout-button">
                     Sorry!!! No items found in the cart.
                     <a class="btn button" href="<?php echo base_url(); ?>">Continue Shopping</a>
                  </span>
               </div>
            <?php } ?>
</div>
      </div>
      <!-- //MAIN CONTENT -->
   </div>
</div>

</div>

<script type="text/javascript">
   jQuery( document ).ready(function() {
//cahnge qty..
jQuery(".chage_cart_qty").on('keyup',function(){ 
      jQuery("span.error").hide();
      var qty = jQuery(this).val();
      var row_id = jQuery(this).attr("main");  
      console.log(row_id);
      var cartprdct_id = jQuery(this).attr("title");
      if (row_id  && qty!="" && cartprdct_id!="")
      {    
            var prdct_arr = cartprdct_id.split("_");  var prdct_id = prdct_arr[1];
           jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('cart/update'); ?>",
            data: "row_id="+row_id+"&qty="+qty+"&prdct_id="+prdct_id,
            beforeSend: function()
            {
               jQuery('.loading').show();
               jQuery('.loading_icon').show();
            },
            success: function(result)
            {
               hideLoader();
               console.log(result);
               if(result!="")
               {
                  var abc=JSON.parse(result);
                  if(abc.type="success")
                  {
                    location.reload();
                  }
                  else
                  {
                     jQuery("span.error").html(abc.msg);
                     jQuery("span.error").show();
                  }
               }
               else
               {
                  jQuery("span.error").html(abc.msg);
                  jQuery("span.error").show();
               }
               
            }
         });
         }
   });



//delete product
jQuery(".remove_item").on('click',function(){ 
      jQuery("span.error").hide();
      var row_id = jQuery(this).attr("main");  
      if (row_id!="")
      {    
           jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('cart/remove'); ?>",
            data: "row_id="+row_id,
            beforeSend: function()
            {
               jQuery('.loading').show();
               jQuery('.loading_icon').show();
            },
            success: function(result)
            {
               hideLoader();
               console.log(result);
               if(result!="")
               {
                  var abc=JSON.parse(result);
                  if(abc.type="success")
                  {
                    location.reload();
                  }
                  else
                  {
                     jQuery("span.error").html(abc.msg);
                     jQuery("span.error").show();
                  }
               }
               else
               {
                  jQuery("span.error").html(abc.msg);
                  jQuery("span.error").show();
               }
               
            }
         });
         }
   });

   jQuery(function() {
     var regExp = /[a-z]/i;
     jQuery('.chage_cart_qty').on('keydown keyup', function(e) {
       var value = String.fromCharCode(e.which) || e.key;

       // No letters
       if (regExp.test(value)) {
         e.preventDefault();
         return false;
       }
     });
   });


   function hideLoader()
   {
      setTimeout(
           function() 
           {
               jQuery('.loading').hide();
               jQuery('.loading_icon').hide();
           }, 2000);
   }

   });
</script>