<style type="text/css">
.t3-content
{
   padding-top: 20px !important;
   padding-bottom: 20px !important;
   margin-left: 30px !important;
}
.pd_15 { padding: 15px; }
.mb-20 { margin-bottom: 20px; }
</style>
<div class="">
  <div class="wrap t3-bg-banner ">
   <div class="">
      <div class="custom">
         <div class="image-background"><img src="<?php echo base_url(); ?>images/themeparrot/food/layout-bg.jpg" alt="layout bg"></div>
      </div>
   </div>
</div>
<div class="wrap t3-breadcrumbs ">
      <div class="container">
        <ul itemscope="" itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
            <li>
               &nbsp; <i class="fa fa-home"></i>
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">Home</span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">             
               </span>
               <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">Product</span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">             
               </span>
               <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">
               Monthly Subscription           </span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">           
               </span>
               <meta itemprop="position" content="3">
            </li>
         </ul> 

      </div>
   </div>
   <div class="container t3-sl t3-sl-2">
   <!-- SPOTLIGHT -->
   <div class="t3-spotlight t3-spotlight-2  row">
      <?php if(!empty($category_type_info) && !empty($category_type_info[0])) { 
               $pack = explode(",",($category_type_info[0]['pack_type']));
               if(!empty($pack))
               {
                  foreach ($pack as $p) { ?>
      <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <div class="t3-module module box-style " id="Mod135">
            <div class="module-inner">
               <h3 class="module-title "><span><?php echo ucfirst($p); ?> -Subscription</span></h3>
               <div class="module-ct">
                  <div class="j2store-product-module j2store-product-module-list row-fluid col-sm-12 col-xs-12">
                     <!-- single product -->
                     <?php if(!empty($my_prdct)) { 

                        if(!empty($my_prdct[$p])) {

                        foreach ($my_prdct[$p] as $mp) { ?>
                        
                        <div class="j2store product-14 j2store-module-product col-sm-12 col-xs-12 mb-20">
                        <!-- product image if postion is top -->
                        <div class="j2store-product-image col-xs-3 col-sm-3 col-md-3  ">
                           <a href="simple-layout/stuffed-shells.html" title="Stuffed Shells">
                           <img itemprop="image" alt="Stuffed Shells" class="j2store-img-responsive j2store-product-image-14" src="<?php echo base_url('images/products'); ?>/<?php echo $mp['image'];?>" width="80" height="80">
                           </a>
                        </div>
                        <div class="j2strore-content col-xs-9 col-sm-9">
                           <div class="head-title col-md-12 col-xs-12 col-xs-12">
                              <!-- product title -->
                              <h4 itemprop="name" class="product-title">
                                 <a itemprop="url" href="../../features/shop-pages/shop/stuffed-shells.html" title="Stuffed Shells">
                                 <?php echo ucfirst($mp['name']); ?>               </a>
                              </h4>
                              <!-- end product title -->
                              <div class="product-cart-section">
                                 <!-- product image if postion is left -->
                                 <div class="product-cart-left-block  span12 ">
                                    <!-- Product price block-->
                                    <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="product-price-container">
                                       <div class="base-price ">
                                          <i class="fa fa-inr">
                                             <?php if($mp['discount_price'] > 0)
                                                 echo "<span class='price_sec'><del>".$mp['price']."</del>&nbsp;&nbsp;". $mp['discount_price']; 
                                                else
                                                   echo $mp['price']; ?>
                                          </i>      
                                       </div>
                                    </div>
                                    <!-- end Product price block-->
                                    <div class="product_cart_block">
                                    
                                    </div>
                                    <!-- Quick view -->
                                 </div>
                              </div>
                              <!-- product image if postion is right -->
                           </div>
                           <!-- end of product_cart_block -->
                           <!-- intro text -->
                           <div class="product-short-description col-md-12 col-xs-12 col-xs-12">
                              <p><?php echo $mp['description']; ?></p>
                           </div>
                           
                           <!-- end intro text -->
                        </div>
                        <div class="pd_15 col-md-12 col-xs-12 col-xs-12">
                              <div class="col-md-6 col-xs-6">
                                 <label>Timing</label>
                                 <select name="pack_timing" class="form-control" id="pack_timing">
                                    <option value="">Select pack Timing</option>
                                    <?php if(!empty($category_type_info) && !empty($category_type_info[0]))
                                    {
                                        $pack = explode(",",($category_type_info[0]['pack_timing']));
                                        if(!empty($pack))
                                        {
                                          foreach ($pack as $p) { ?>  
                                            <option value="<?php  echo $p; ?>"><?php  echo ucfirst($p); ?></option>                                
                                        <?php }
                                        }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                 <label>Quantity</label>
                                 <input type="text" name="qty" value=1 id="qty"> 
                              </div>
                        </div>
                        <span class="text-danger dn" id="errorSec" style="text-align: center;">Timing &amp; qty required!!!</span>
                        <div class="pd_15 col-md-12 col-xs-12 col-xs-12">
                           <div class="col-md-8 col-xs-8 col-md-offese-2 col-xs-offset-2">
                              <button class="btn btn-block add_cart" main="<?php echo $mp['id']; ?>">Add to cart</button>
                           </div>
                        </div>
                     </div>
                     
                  <div class="mb-10"></div>
                     <?php  } } } ?>

                     <!-- end single product -->

                   </div>
               </div>
            </div>
         </div>
      </div>
      <?php } } }?>
   </div>
   <!-- SPOTLIGHT -->
</div>
</div>


<script type="text/javascript">
   jQuery( document ).ready(function() { 
      jQuery(".add_cart").on('click',function(){ 
         var pr_id = jQuery(this).attr('main'); 
         var qty = jQuery(this).parent().parent().parent().find("#qty").val(); 
         var pack_timing = jQuery(this).parent().parent().parent().find("#pack_timing").val(); 
         console.log(pack_timing);
         if(pr_id && pack_timing!="" && qty!="")
         {
             jQuery.ajax({
               type: "POST",
               url: "<?php echo base_url('cart/additem');?>",
               data: "prdct_id="+pr_id+"&pack_timing="+pack_timing+"&qty="+qty,                    
               beforeSend: function()
               {
                  jQuery('.loading').show();
                  jQuery('.loading_icon').show();
               },
               success: function(result)
               {
                  setTimeout(
                    function() 
                    {
                        jQuery('.loading').hide();
                        jQuery('.loading_icon').hide();
                    }, 2000);
                  
                  if(result != "")
                  {
                     var res = jQuery.parseJSON(result); 
                     if(res.type=="success")
                     {
                        jQuery("span.cart-item-count").html(res.msg);
                     }
                     else
                     {
                          
                     }
                  }
               }
             });
         }
         else
         {
            jQuery(this).parent().parent().parent().find("span#errorSec").show().delay(4000).fadeOut();
         }
      });


      //pack type change..
      jQuery("#pack_timing").on('change',function(){
         var Timing = jQuery(this).val();
         var obj = jQuery(this).parent().parent().parent().find(".base-price span");
         if(Timing!="")
         {
            var prdct_id = jQuery(this).parent().parent().parent().find(".add_cart").attr('main');
            if(prdct_id)
            {
               jQuery.ajax({
                  type: "POST",
                  url: "<?php echo base_url('cart/getProductData');?>",
                  data: "prdct_id="+prdct_id+"&Timing="+Timing,                    
                  beforeSend: function()
                  {
                     jQuery('.loading').show();
                     jQuery('.loading_icon').show();
                  },
                  success: function(result)
                  {
                     setTimeout(
                       function() 
                       {
                           jQuery('.loading').hide();
                           jQuery('.loading_icon').hide();
                       }, 2000);
                     if(result != "")
                     {
                        var res = jQuery.parseJSON(result); 
                        if(res!="")
                        {
                           if(res.discountPrice > 0)
                              var data = "<del>"+res.price+"</del>&nbsp;&nbsp;"+res.discountPrice;
                           else
                              var data = res.price;


                           console.log( obj.html(data));
                          
                        }
                        else
                        {
                             
                        }
                     }
                  }
                });
            }
         }
      });
   });
</script>