<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>css/admin/images/favicon.png" type="image/png">

  <title>Inventory | Admin Panel</title>

  <link href="<?php echo base_url(); ?>css/admin/style.default.css" rel="stylesheet">
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?php //echo base_url(); ?>js/admin/html5shiv.js"></script>
  <script src="<?php //echo base_url(); ?>js/admin/respond.min.js"></script>
  <![endif]-->
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
                <form method="post" action="<?php echo base_url();?>login/signIn" method="post" id="my_signin_form">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                
                    <input  id="username" type="text" class="form-control uname" name="email" placeholder="Email" />
                    <input  id="password" type="password" class="form-control pword" name="password" placeholder="Password" />
                    <a id="forgot_link" href="javascript:void(0);"><small>Forgot Your Password?</small></a>
                    <button id="submit_btn" class="btn btn-warning btn-block">Sign In</button>
					<?php //echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
                    
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
               <!-- &copy; 2014. All Rights Reserved. Bracket Bootstrap 3 Admin Template -->
            </div>
            <div class="pull-right">
               <!-- Created By: <a href="http://themepixels.com/" target="_blank">ThemePixels</a> -->
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>


<script src="<?php echo base_url(); ?>js/admin/admin/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/admin/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/admin/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/admin/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/admin/retina.min.js"></script>

<script src="<?php echo base_url(); ?>js/admin/admin/custom.js"></script>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
});
</script>

<!-- Login Validation End -->

<!-- Forgot Password Start -->   

<script type="text/javascript">
  $(document).ready(function(){
    $('#forgot_link').click(function(){
      $('#signin_div').hide();
      $('#forgot_div').show();
      $('#fu_msg_div').hide();
    });
  });
</script>

<!-- Forgot Password End -->

<!-- Sign In Start -->   

<script type="text/javascript">
  $(document).ready(function(){
    $('#signin_link').click(function(){
      $('#signin_div').show();
      $('#forgot_div').hide();
      $('#msg_div').hide();
    });
  });
</script>

<!-- Sign In Password End -->

<!-- For Forgot Password Validation -->
<script>
$(document).ready(function(){
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
</script>

<!-- Forgot Password End -->


