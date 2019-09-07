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
.checkout_form input[type=text], input[type=number],input[type=email]
{
   width: 300px;
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
               <a itemprop="item" href="<?php echo base_url('cart'); ?>" class="pathway"><span itemprop="name">Cart</span></a>
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
         </ul> 

      </div>
   </div>
<div id="t3-mainbody" class="container t3-mainbody">
   <div class="row">
      <!-- MAIN CONTENT -->
      <form class="form-validate" id="checkout_form_id" method="post" action="<?php echo base_url('order/pay'); ?>">
      <div id="t3-content" class="t3-content col-xs-12">
         <div class="col-md-8">
            <div class="checkout_form">
               <div class="form-group">
                   <label for="fname">Name</label>
                   <input type="text" class="form-control" name="name" id="fname" placeholder="First Name" required="" value="<?php if(!empty($user_info) && !empty($user_info[0])) echo $user_info[0]['name']; ?>">
               </div>
               
              <div class="form-group">
                <label for="fname">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required value="<?php if(!empty($user_info) && !empty($user_info[0])) echo $user_info[0]['email']; ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
               <div class="form-group">
                   <label for="mobile">Mobile Number</label>
                   <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="<?php echo $this->session->userdata('mobile_num'); ?>" required>
               </div>
               <div class="form-group">
                   <label for="alternate_mobile">Alternate Mobile Number</label>
                   <input type="text" class="form-control" name="alternate_mobile" id="alternate_mobile" placeholder="Enter Alternate Mobile Number" required value="<?php if(!empty($user_info) && !empty($user_info[0])) echo $user_info[0]['alternate_mobile']; ?>">
               </div>
               <div class="form-group">
                   <label for="address">Addresss</label>
                   <textarea class="form-control" id="address" name="address" placeholder="Enter Addresss.." rows="10" cols="20" required><?php if(!empty($user_info) && !empty($user_info[0])) echo $user_info[0]['address']; ?></textarea>
               </div>
               <div class="form-group">
                  <input type="checkbox" id="agree" required>
                   <label for="">I agree terms & condition</label>
                   
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </div>
         </div>
      </div>
     </form>
      <!-- //MAIN CONTENT -->
   </div>
</div>

</div>

<script type="text/javascript">
   jQuery(document).ready(function(){
      jQuery("#checkout_form_id").submit(function(){
         console.log('wert');
         if(jQuery("#fname").val()=="")
         {
            jQuery("#fname").focus();
            return false;
         }
         else if(jQuery("#email").val()=="")
         {
            jQuery("#email").focus();
            return false;
         }
         else if(jQuery("#mobile").val()=="")
         {
            jQuery("#mobile").focus();
            return false;
         }
         else if(jQuery("#alternate_mobile").val()=="")
         {
            jQuery("#alternate_mobile").focus();
            return false;
         }
         else if(jQuery("#address").val()=="")
         {
            jQuery("#address").focus();
            return false;
         }
         else
         {
            return true;
         }
      });
   });
</script>