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
               <?php echo ucfirst(getName('category','name',$cat_id)); ?>          
               </span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">           
               </span>
               <meta itemprop="position" content="3">
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">
               Products            </span>
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
         <div id="akeeba-renderjoomla">
            <div class="j2store-product-list bs3">
               <div class="row">
                  <div class="col-sm-9">
			            <div class="j2store-products-row row-0 row">
                        <?php 
                           if(!empty($cat_product) && !empty($cat_product[0])) {
                              foreach($cat_product as $cat_p)
                              { ?>
                        <div class="j2-single-product col-sm-4">
                           <div class="j2store-single-product multiple j2store-single-product-21 product-21 pcolumn-1">
                              <div class="j2store-product-images">
                                 <div class="j2store-mainimage">
                                    <img itemprop="image"
                                       alt="Grilled bass"
                                       class="j2store-img-responsive j2store-product-main-image-21"
                                       src="<?php echo base_url('images/products'); ?>/<?php echo $cat_p['image']; ?>"
                                       width="250"
                                       />
                                 </div>
                              </div>
                              <div class="j2-content">
                                 <h2 itemprop="name" class="product-title">
                                    <a itemprop="url" 
                                       title="<?php if($cat_p['name']!="")
                                    echo ucfirst($cat_p['name']); ?>" >
                                    <?php if($cat_p['name']!="")
                                    echo ucfirst($cat_p['name']); ?>					</a>
                                 </h2>
                                 <div class="product-price-container">
                                   <span class="sale-price">			
                                    <i class="fa fa-inr">
                                       <?php if($cat_p['discount_price'] > 0)
                                           echo "<del>".$cat_p['price']."</del>&nbsp;&nbsp;". $cat_p['discount_price']; 
                                          else
                                             echo $cat_p['price']; ?>
                                    </i>
                                    </span>
                                   
                                 </div>
                                 <div class="j2store-addtocart-form">
                                    <div id="add-to-cart-5" class="j2store-add-to-cart">
                                       <button data-cart-action-always="Adding..." data-cart-action-done="Add to cart" data-cart-action-timeout="1000" type="button" class="j2store-cart-button btn btn-primary add_cart" main="<?php echo $cat_p['id']; ?>">Add to cart</button>
                                    </div>
                                 </div>
                              </div>
                              <!-- QUICK VIEW OPTION -->
                           </div>
                        </div>
                        <?php } } else { ?>
                           <div class="buttons-right">
                              <span class="cart-checkout-button text-center">
                                 Sorry!!! No Product Available.
                              </span>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <!-- end of row-fluid -->
            </div>
            <!-- end of product list -->
         </div>
      </div>
      <!-- //MAIN CONTENT -->
   </div>
</div>

</div>

<script type="text/javascript">
   jQuery( document ).ready(function() {
      jQuery(".add_cart").on('click',function(){
         var pr_id = jQuery(this).attr('main');
         if(pr_id)
         {
             jQuery.ajax({

               type: "POST",
               url: "<?php echo base_url('cart/additem');?>",
               data: "prdct_id="+pr_id+"&qty=1",                    
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
                  else
                  {
                     
                  }
               }
             });
         }
      });
   });
</script>