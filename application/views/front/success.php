<style type="text/css">
.t3-content
{
   padding-top: 20px !important;
   padding-bottom: 20px !important;
   margin-left: 30px !important;
}
.pd_20
{
    padding: 20px 20px 20px;;
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
               <span itemprop="name">Home</span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">             
               </span>
               <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">Cart</span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">             
               </span>
               <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">
               Checkout           </span>
               <span class="divider">
                  <img src="<?php echo base_url(); ?>images/arrow.png" alt="">           
               </span>
               <meta itemprop="position" content="3">
            </li>
            <li itemprop="itemListElement">
               <span itemprop="name">
               Payment  </span>
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
         <div class="item-page" >
            <div class="col-md-10 col-sm-12 col-xs-12">
               <div class="pull-left item-image col-xs-12"> 
               	<img src="<?php echo base_url('images/orderSuccess.png');?>" alt="" itemprop="image"> </div>
               <div class="col-md-12 col-sm-12 col-xs-12 blog-content">
                  <div itemprop="articleBody" class="articlebody">
                     <div class="page-header">
                        <h2 itemprop="name">
                           <?php if($orderRes=="success")
                           	echo "Your Order is success";
                           	else
               				echo "Sorry...Your Order is Failed!!";
                           ?>							
                        </h2>
                     </div>
                    <div class="article-tags col-md-12 col-sm-12 col-xs-12">
                     </div>
                     <div class="description">
                     	 <?php if($orderRes=="success")
                     	 	{
             	 				echo "<p>Your Order Number is ".$success_info['orderId']."</p>";
             	 				echo "<p>Your Payment Id is ".$success_info['paymentId']."</p>";
             	 				echo "<p>Your Total Order Amount is ".$success_info['totalAmount']."</p>";
                     	 	}
                           	
                           	else
               					echo "Sorry...Your Order is Failed!!";
                           ?>							
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- //MAIN CONTENT -->
   </div>
</div>

</div>