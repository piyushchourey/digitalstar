<?php //print_r($this->session->all_userdata()); die; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('images');?>/favicon.ico">

    <title>Holla Food</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/cover/cover.css" rel="stylesheet">
    <style type="text/css">
      body
      {
        background-image: url('images/bb.jpg');
        color: #cb212a;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .mylogo
      {
        width: 600px;
      }
      
      /* for ajax loading */

    .loading{
     width:100%;
     height:100%;
     position:fixed;
     top:0;
     left:0;
     display:table;
     background-color:rgba(0,0,0,.6);
     vertical-align:middle;
     text-align:center;
     }
    .loading_icon{
     width:100px; 
     height:100px;
     display:table-cell;
     vertical-align:middle;
     margin:0 auto;
     }
    .loading_icon span.fa{
     font-size:100px;
     color:#000;
     }
    /* for ajax loading */
    .dn
    {
      display: none;
    }

    .loading_img
    {
      height: 100px;
    }
    </style>
  </head>

  <body class="text-center">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <main role="main" class="inner cover">
       <img src="<?php echo base_url('images');?>/red1.png" class="img-responsive mylogo">
      </main>
      
      <div class="col-md-6">
        <form>
            <div class="form-group ">
              <label for="email">Mobile Number:</label>
              <input type="Number" class="form-control" name="mobile" id="mobile" placeholder="Enter Your Mobile Number">
              <span class="mob_error"></span>
            </div>

            <div class="otp_btn">
              <button type="button" class="btn btn-danger get_otp">Get OTP</button>
            </div>
              
            <div class="otp_sec dn">
              <div class="form-group">
                <label for="pwd">OTP(One time password):</label>
                <input type="password" class="form-control" id="otp_val" placeholder="Enter 4 digits..">
                 <span class="otp_error"></span>
                 <a href="javascript:void(0)" class="resend_otp"><span>Resend Otp</span></a>
              </div>
              <button type="button" class="btn btn-danger btn-block valiadate_otp">Validate</button>
            </div>
        </form>  
      </div>
    

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Powered By <a href="http://cloud1.me">Cloud1 Web Solutions</a>.</p>
        </div>
      </footer>
    </div>

    <!--loader-->
    <div class="loading" style="display:none">
       <div class="loading_icon" style="display:none">
          <img class="img-responsive loading_img" src="<?php echo base_url('images/loader.gif');?>">
       </div>
    </div>
    <!--loader-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    var filter = /^\d*(?:\.\d{1,2})?$/;
    $(".get_otp").on('click',function(){
      var mobile = $("#mobile").val();
      if(checkMobile(mobile))
      {
        $("span.mob_error").html('');
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('api/setMobile') ?>",
              data: "mobile="+mobile+"&method=default",
              beforeSend: function()
              {
                $('.loading').show();
                $('.loading_icon').show();
              },
              success: function(data){ 
                $('.loading').hide();
                $('.loading_icon').hide();
                var abc = jQuery.parseJSON(data);
                if(abc.type!="fail")
                {
                  $(".otp_btn").hide();
                  $(".otp_sec").show();
                }
                else
                {

                }
              }
            });
      }
    });

    $("#mobile").on('blur',function(){
      var mobile = $("#mobile").val();
      
        if(filter.test(mobile))
        {
          if(mobile.length==10)
          {
            $("span.mob_error").html('');
          }
          else 
          {
            $("span.mob_error").html('Please put 10  digit mobile number..');
            return false;
          }
        }
        else
        {
          $("span.mob_error").html('Not a valid number..');
          return false;
        }
    });

    $(".valiadate_otp").on('click',function(){
        var otp_val = $("#otp_val").val();
        if(filter.test(otp_val))
        {
          if(otp_val.length==4)
          {
            var mobile = $("#mobile").val();
            $.ajax({
              type: 'POST',
              url: "<?php echo base_url('api/checkOtp') ?>",
              data: "otp_val="+otp_val+"&mobile="+mobile,
              beforeSend: function()
              {
                $('.loading').show();
                $('.loading_icon').show();
              },
              success: function(data){ 
                $('.loading').hide();
                $('.loading_icon').hide();
                var abc = jQuery.parseJSON(data);
                if(abc.type!="fail")
                {
                  window.location= "<?php echo base_url('main'); ?>";
                }
                else
                {
                    $("span.otp_error").html('Sorry....Something Went Wrong.');
                }
              }
            });
          }
          else
          {
            $("span.otp_error").html('Sorry....OTP have 4 digits only!!');
            return false;
          }
        }
        else
        {
            $("span.otp_error").html('Please Enter right OTP!!');
            return false;
        }
    });

    //resend..msg
  $(".resend_otp").on('click',function(){
      var mobile = $("#mobile").val();
      if(checkMobile(mobile))
      {
        $("span.mob_error").html('');
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('api/setMobile') ?>",
              data: "mobile="+mobile+"&method=resend",
              beforeSend: function()
              {
                $('.loading').show();
                $('.loading_icon').show();
              },
              success: function(data){ 
                $('.loading').hide();
                $('.loading_icon').hide();
                var abc = jQuery.parseJSON(data);
                if(abc.type!="fail")
                {
                  $(".otp_btn").hide();
                  $(".otp_sec").show();
                }
                else
                {

                }
              }
            });
      }
    });


    function checkMobile(mobile)
    {
      if(filter.test(mobile))
        {
          if(mobile.length==10)
          {
            $("span.mob_error").html('');
            return true;
          }
          else 
          {
            $("span.mob_error").html('Please put 10  digit mobile number..');
            return false;
          }
        }
        else
        {
          $("span.mob_error").html('Not a valid number..');
          return false;
        }
    }
  })
</script>