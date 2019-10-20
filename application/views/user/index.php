<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>css/admin/images/favicon.png" type="image/png">

  <title>Digital Star | User Panel</title>

  <link href="<?php echo base_url(); ?>css/admin/style.default.css" rel="stylesheet">
  <style>
  #my_signin_form h4 , p, a#forgot_link, #my_forgot_form h4, #my_forgot_form a#signin_link
  {
	  color:#fff;
  }
  .signinpanel form
  {
	  background:none;
  }
  .signup-footer
  {
	  border-top:none;
  }
  label.error{
    color:#fff;
  }
  </style>
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-4">
                
                <div class="signin-info">
                    
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5" id="signin_div">
              <?php if($this->session->flashdata('login')=='false') { ?>
                <div id="msg_div1" class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong> </strong><?php echo $this->session->flashdata('msg');  ?>
                </div>
                <?php $this->session->sess_destroy(); } ?>
                <div id="msg_div" class="alert alert-danger" style="display:none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong> </strong>Please Enter Username Or Password
                </div>
                <form method="post" id="my_signin_form">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account via OTP.</p>

                    <input  id="mobile" type="text" class="form-control uname" name="mobile" placeholder="Enter Mobile Number" />
                    <input  id="otp" type="password" class="form-control pword d_n" name="otp" placeholder="Enter OTP"/>
                    <input type="hidden" name="loginType" id="loginType" value="user">
                    <a id="forgot_link" href="javascript:void(0);"><small>Resend OTP</small></a>
                    <button id="get_otp_btn" type="button" class="btn btn-warning btn-block">GET OTP</button>
                    <button id="submit_btn" class="btn btn-warning btn-block d_n">Submit</button>
					    </form>
            </div><!-- col-sm-5 -->

            <div class="col-md-5" style="display:none;" id="forgot_div">
               <div style="display:none" class="alert alert-danger" id="fu_msg_div">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong> </strong>Please Enter Username
                </div>
                <div style="display:none" class="alert alert-danger" id="notfound_msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong> </strong>User Doesn`t Exist
                </div>
                <div style="display:none" class="alert alert-success" id="found_msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong> </strong>Password Has Been Reset </br> Please Check Your Mail.
                </div>
                <form method="post" id="my_forgot_form">
                    <h4 class="nomargin">Forgot Password</h4>
                    <p class="mt5 mb20">Forgot Your Password?</p>
                
                    <input type="text" placeholder="Username" name="fu_username" class="form-control uname" id="fu_username"> 
                    <a id="signin_link" href="javascript:void(0);"><small>Sign In</small></a>
                    <input type="button" class="btn btn-warning btn-block" id="fu_submit_btn" value="Submit" />
                    
                </form>
            </div>
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
             
            </div>
            <div class="pull-right">
               
            </div>
        </div>
         
    </div><!-- signin -->
   
</section>


<script src="<?php echo base_url(); ?>js/admin/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/retina.min.js"></script>

<script src="<?php echo base_url(); ?>js/admin/custom.js"></script>

</body>
</html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery.validate.min.js"></script>
<!-- For Login Panel Validation -->
<script>
$(document).ready(function(){
	$('#submit_btn').click(function(){
		$('#msg_div1').hide();
		var username = $('#username').val();
		var password = $('#password').val();
		if(username == "" || password == "")
			{
				$('#msg_div').show();
				return false;
			}
  });

//************Get One time password authentication*****************
$('#get_otp_btn').click(function(){
  let mobile =  $("#mobile").val();
  if(mobile && (/^\d{10}$/.test(mobile))){
      let ajaxURL = "<?php echo base_url('login/getOTP');?>";
      let postData = {"mobile":mobile};
      commonAjaxService(ajaxURL,postData, function(result){
        if(result != "")
        { 
          var res = jQuery.parseJSON(result);
          console.log(res);
          if(res.type=="success")
          {
            $("#otp").val("").removeClass('d_n');
          }
          else
          {
              $("#otp").hide();
              $.growl.error({title: "<i class='fa fa-times'> Sorry.. </i>", message: res.msg });
          }
        }
        else
        {
          $.growl.notice({title: "<i class='fa fa-times'> Sorry.. </i>", message: "Please Try Again!!!" });
        }
    });
  }else{
    alert("Invalid number; must be ten digits")
    $("#mobile").focus()
    return false
  }
});
/** Forgot password link event functionality...  */
  $('#forgot_link').click(function(){
      $('#signin_div').hide();
      $('#forgot_div').show();
      $('#fu_msg_div').hide();
  });
  /** Do registration submit event handling..   */
  $('#signin_link').click(function(){
      $('#signin_div').show();
      $('#forgot_div').hide();
      $('#msg_div').hide();
  });
  /** Forgot password submit functionality.. */
  $('#fu_submit_btn').click(function(){
    var username = $('#fu_username').val();
    if(username == "")
      {
        $('#notfound_msg').hide();
        $('#found_msg').hide();
        $('#fu_msg_div').show();  
        return false;
      }
    else
      {
        $.ajax({
                url:"<?php echo base_url(); ?>login/forgotPassword",
                type:"post",
                data:"username="+username,                    
                success: function(data){ alert(data);
                  $('#fu_msg_div').hide();
                  if(data =="Not Found")
                    {
                      $('#found_msg').hide();
                      $('#notfound_msg').show();
                    }
                  else if(data =="Found")
                    {
                      $('#fu_username').val("");
                      $('#notfound_msg').hide();
                      $('#found_msg').show();
                    }
                }
            });
      }
  });

});

function commonAjaxService(URL,postData,callback){
  $.ajax({
            type: "POST",
            url: URL,
            data: postData,                    
            cache: false,
            beforeSend: function()
            {
              $('.loading').show();
              $('.loading_icon').show();
            },
            success: function(result)
            {
            	$('.loading').hide();
             	$('.loading_icon').hide();
              if(result != "")
              {
                callback(result);
              }
              else
              {
                $.growl.notice({title: "<i class='fa fa-times'> Sorry.. </i>", message: "Please Try Again!!!" });
              }
            }
          });
}
</script>

<!-- Login Validation End -->
<div class="loading" style="display:none">
   <div class="loading_icon" style="display:none"><span class="fa fa-spin fa-spinner"></span>
   </div>
</div>


