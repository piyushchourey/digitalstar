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
        <div class="col-md-4">

      <!-- MAIN CONTENT -->
      <!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width">
</head>
<body>
   <?php $totalAmount = 0; foreach ($this->cart->contents() as $items) { $totalAmount+= $items['subtotal'];} ?>
   <form action="<?php echo base_url('order/confirm');?>" method="POST">
      <!-- Note that the amount is in paise = 50 INR -->
      <script
          src="https://checkout.razorpay.com/v1/checkout.js"
          data-key="rzp_test_HvbQw9eIZbeGLn"
          data-amount="<?php echo $totalAmount*100; ?>"
          data-buttontext="Pay Now"
          data-name="Holla Food Restaurant"
          data-description="Stay hungry..stay foodist."
          data-image="<?php echo base_url('images/themeparrot/logo/my_logo.png'); ?>"
          data-prefill.name="Harshil Mathur"
          data-prefill.email="support@razorpay.com"
          data-theme.color="#cb212a"
      ></script>
      <input type="hidden" value="<?php echo $getData['name'];?>" name="name">
      <input type="hidden" value="<?php echo $getData['email'];?>" name="email">
      <input type="hidden" value="<?php echo $getData['alternate_mobile'];?>" name="alternate_mobile">
      <input type="hidden" value="<?php echo $getData['address'];?>" name="address">
      <input type="hidden" value="online" name="payment_type">
   </form>
</body>
</html>
</div>
    <div class="col-md-6">
        <div class="pd_20 "> 
            <img src="<?php echo base_url('images/payment.png'); ?>" class="img-responsive">
        </div>
    </div>
      <!-- //MAIN CONTENT -->
   </div>
</div>

</div>

<style type="text/css">
    .razorpay-payment-button
    {
        overflow: hidden;
        transition-delay: 0s, 0s;
        transition-duration: 0.3s, 0.3s;
        transition-property: border-color, color;
        transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
        -webkit-transition-delay: 0s, 0s;
        -webkit-transition-duration: 0.3s, 0.3s;
        -webkit-transition-property: border-color, color;
        -webkit-transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
        -moz-transition-delay: 0s, 0s;
        -moz-transition-duration: 0.3s, 0.3s;
        -moz-transition-property: border-color, color;
        -moz-transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
        -o-transition-delay: 0s, 0s;
        -o-transition-duration: 0.3s, 0.3s;
        -o-transition-property: border-color, color;
        -o-transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
        padding: 10px 18px 8px;
        border: 2px solid #ff4c65;
        position: relative;
        z-index: 1;
        vertical-align: middle;
        background: transparent;
        color: #ff4c65;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 0;
        text-shadow: none !important;
    }
    .razorpay-payment-button:hover
    {
        background-color: #20c0a9;
        border-color: #20c0a9;
        color: #ffffff;
        outline: none;
    }
</style>

