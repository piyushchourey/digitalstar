<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="<?php echo base_url(); ?>js/admin/jquery-1.10.2.min.js"></script>
  <link rel="shortcut icon" href="<?php echo base_url();?>images/admin/favicon.png" type="image/png">
  <title>Holla Food | Admin</title>
   
  <link href="<?php echo base_url(); ?>css/admin/style.default.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/bootstrap-fileupload.min.css" />
  <link href="<?php echo base_url(); ?>css/admin/jquery.datatables.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>css/admin/jquery.growl.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body>
 
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
    
    <div class="logopanel">
        <h1><span>[</span> Holla Food <span>]</span></h1>
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged"> 
                <img alt="" src="<?php echo base_url(); ?>images/admin/admin/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4><?php echo ucwords($this->session->userdata('email')); ?></h4>
                    <span>Media</span>
                </div>
            </div>
          
            <!-- <h5 class="sidebartitle actitle">Account</h5> -->
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <!-- <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li> -->
              <!-- <li><a href="#"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li> -->
              <li><a href="javascript:void(0)"><i class="glyphicon glyphicon-cog"></i> <span>Change Password</span></a></li>
              <li><a href="<?php echo base_url();?>home/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
		<ul class="nav nav-pills nav-stacked nav-bracket">
		  <li <?php if(isset($sel) and $sel=='dashboard') echo 'class="active"'; ?>>
			  <a href="<?php echo base_url('home');?>"><i class="fa fa-home"></i> <span>Dashboard</span></a>
		  </li>
      <!--<li <?php if(isset($sel) and $sel=='Category') echo 'class="active"'; ?>>
          <a href="<?php echo base_url('category');?>"><i class="fa fa-list"></i> <span>Category</span></a>
      </li>-->
		  <li <?php if(isset($sel) and $sel=='Category') echo 'class="active"'; ?>>
				  <a href="<?php echo base_url('category');?>"><i class="fa fa-list"></i> <span>Category</span></a>
		  </li>
		  <li <?php if(isset($sel) and $sel=='Product') echo 'class="active"'; ?>>
			  <a href="<?php echo base_url('product');?>"><i class="fa fa-cube"></i> <span>Products</span></a>
		  </li> 
       <li <?php if(isset($sel) and $sel=='Monthly Subscription') echo 'class="active"'; ?>>
        <a href="<?php echo base_url('product/monthly');?>"><i class="fa fa-calendar"></i> <span>Monthly Subscription</span></a>
      </li>
      <li <?php if(isset($sel) and $sel=='Order') echo 'class="active"'; ?>>
        <a href="<?php echo base_url('order');?>"><i class="fa fa-shopping-cart"></i> <span>Order</span></a>
      </li>
		 </ul>
</div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
    <div class="mainpanel">
		<div class="headerbar">
      
    <a class="menutoggle"><i class="fa fa-bars"></i></a>
    <div class="header-right">
        <ul class="headermenu">
         <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>images/admin/admin/photos/loggeduser.png" alt="" />
                <?php echo ucwords($this->session->userdata('email')); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li>
                  <a href="<?php echo base_url("myprofile"); ?>"><i class="glyphicon glyphicon-user"></i> My Profile</a>
                </li>
                <li><a href="#" data-toggle="modal" data-target="#changePasswordModal" ><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
                <li><a href="<?php echo base_url(); ?>home/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->


<!-- change password script start -->
    <script type="text/javascript">
        $(document).ready(function(){
          $('#submit-btn').click(function(){
            //alert('dgfdg');
            var pswd = $('#pswd').val();
            var cnfm_pswd = $('#cnfm_pswd').val();
            if(pswd == "" && cnfm_pswd == "")
                {
                  $('.cnfm_pswd_msg').show();
                  $('.pswd_msg').hide();
                  $('.pswd_not_match_msg').hide();
                  $('.cpswd_msg').hide();
                  return false;
                }

              if(pswd == "")
                {
                  $('.pswd_msg').show();
                  $('.cnfm_pswd_msg').hide();
                  $('.pswd_not_match_msg').hide();
                  $('.cpswd_msg').hide();
                  return false;
                }

              if(cnfm_pswd == "")
                {
                  $('.cpswd_msg').show();
                  $('.pswd_msg').hide();
                  $('.cnfm_pswd_msg').hide();
                  $('.pswd_not_match_msg').hide();
                  return false;
                }

              if(pswd != cnfm_pswd)
                {
                  $('.pswd_not_match_msg').show();
                  $('.cpswd_msg').hide();
                  $('.pswd_msg').hide();
                  $('.cnfm_pswd_msg').hide();
                  return false;
                }

                $.ajax({
                    url:"<?php echo base_url() ?>home/changePassword",
                    type:"POST",
                    data:"pswd="+pswd,
                    success: function(response){
                     console.log(response);
                     if(response=="hello")
                      {
                          $('.pswd_not_match_msg').hide();
                          $('.cpswd_msg').hide();
                          $('.pswd_msg').hide();
                          $('.cnfm_pswd_msg').hide();
                          $('.success_msg').show();
                          $('#pswd').val("");  
                          $('#cnfm_pswd').val("");
                          setInterval(function(){ $('#changePasswordModal').modal('hide'); window.location.reload(); }, 1000);
                      }
                    },
                    error: function(data)
                      {
                        alert(data);
                      } 
              });
          });
        });
    </script>
    <!-- change password script end -->
	
	