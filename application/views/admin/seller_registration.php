<style type="text/css">
.progress-bar,.next_button
{
	background-color: #1caf9a !important;
	border-color: #1caf9a !important;
}
.previous disabled
{
	background: #eee;
    color: #999;
    border-color: #ccc;
}
.basic-wizard .pager li a
{
	border-color: #1caf9a;
    background-color: #1caf9a;
    color: #fff;
}
.basic-wizard .pager li a:hover {
    background-color: #1caf9a;
    border-color: #1caf9a;
}
.basic-wizard .pager li.disabled a {
    background: #eee;
    color: #999;
    border-color: #ccc;
}
.submit_button
{
	display: none;
	float: right;
}
</style>
<div class="pageheader">
	<div class="row">
		<div class="col-md-8">
			<h2 class="pull-left">
				<i class="fa fa-user"></i><?php echo $sel; ?>
				<span>List</span>
			</h2>
		</div>
	</div>
</div>

<div class="contentpanel">
	<div class="row">
		
		<div class="col-md-12">
      	<div class="panel panel-success">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="#" class="panel-close">&times;</a>
                <a href="#" class="minimize">&minus;</a>
              </div>
              <h4 class="panel-title">Seller Registration</h4>
            </div>
            <div class="panel-body panel-body-nopadding">
              
              <!-- BASIC WIZARD -->
              <div id="progressWizard" class="basic-wizard">
                
                <ul class="nav nav-pills nav-justified seller_register">
                  <li main="1"><a href="#ptab1" data-toggle="tab"><span>Step 1:</span> Basic Info</a></li>
                  <li main="2"><a href="#ptab2" data-toggle="tab"><span>Step 2:</span> Shop Info</a></li>
                  <li main="3"><a href="#ptab3" data-toggle="tab"><span>Step 3:</span> Location</a></li>
                  <li main="4"><a href="#ptab4" data-toggle="tab"><span>Step 4:</span> Characterstic</a></li>
                  <li main="5"><a href="#ptab5" data-toggle="tab"><span>Step 5:</span> Timing Info</a></li>
                  <li main="6"><a href="#ptab6" data-toggle="tab"><span>Step 6:</span> Contact Info</a></li>
                </ul>
            <form method="post" id="seller_register_form">
                <div class="tab-content">
                  
                  <div class="progress progress-striped active">
                    <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="tab-pane" id="ptab1">
                    <div class="row">
                      
                      <div class="col-sm-4">
                           <div class="form-group no_margin">
                           <label class="control-label">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name">
                        </div>
                      </div>
                      <div class="col-sm-4">
                           <div class="form-group no_margin">
                           <label class="control-label">Last name</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name">
                        </div>
                      </div>
                      <div class="col-sm-4">
                           <div class="form-group no_margin">
                           <label class="control-label">Email Id</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email Id">
                        </div>
                      </div>
                      <div class="col-sm-4">
                           <div class="form-group no_margin ">
                           <label class="control-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number">
                        </div>
                      </div>
                      <div class="col-sm-4">
                           <div class="form-group no_margin">
                           <label class="control-label">State</label>
                           <select name="state" class="form-control" id="state">
                              <option value="">Select State</option> 
                           </select>
                        </div>
                      </div>
                      
                      <div class="col-sm-4">
                           <div class="form-group no_margin">
                           <label class="control-label">City</label>
                           <select name="city" class="form-control" id="city">
                              <option value="">Select City</option> 
                           </select>
                           </div>
                      </div>
                      <div class="col-sm-4">
                      <div class="form-group no_margin">
                           <label class="control-label">Profile Image</label>
                           <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                  <div class="uneditable-input">
                                    <i class="glyphicon glyphicon-file fileupload-exists"></i>
                                    <span class="fileupload-preview"></span>
                                  </div>
                                  <span class="btn btn-default btn-file">
                                    <span class="fileupload-new">Select file</span>
                                    <span class="fileupload-exists">Change</span>
                                    <input type="file" name="image"/>
                                  </span>
                                  <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                              </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                         <div class="form-group no_margin">
                         <label class="control-label">Biography</label>
                         <textarea name="biography" placeholder="Enter Biography" class="form-control">
                         </textarea>
                      </div>
                    </div>
                </div>
              </div>
              <!--tab  pane-2-->

                  <div class="tab-pane" id="ptab2">
                      <div class="form-group">
                        <label class="col-sm-4">Product ID</label>
                        <div class="col-sm-5">
                          <input type="text" name="product_id" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-4">Product Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="product_name" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-4">Category</label>
                        <div class="col-sm-4">
                          <select class="form-control">
                            <option value="">Choose One</option>
                            <option value="">3D Animation</option>
                            <option value="">Web Design</option>
                            <option value="">Software Engineering</option>
                          </select>
                        </div>
                      </div>
                 </div>
                  <div class="tab-pane" id="ptab3">
                    <div class="form-group">
                        <label class="col-sm-4">Card No</label>
                        <div class="col-sm-8">
                          <input type="text" name="cardno" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-4">Expiration</label>
                        <div class="col-sm-4">
                          <select class="form-control">
                            <option value="">Month</option>
                            <option value="">January</option>
                            <option value="">February</option>
                            <option value="">March</option>
                            <option value="">...</option>
                          </select>
                        </div>
                        
                        <div class="col-sm-4">
                          <select class="form-control">
                            <option value="">Year</option>
                            <option value="">2013</option>
                            <option value="">2014</option>
                            <option value="">2015</option>
                            <option value="">...</option>
                          </select>
                        </div>
                        
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-4">CSV</label>
                        <div class="col-sm-4">
                          <input type="text" name="csv" class="form-control" />
                        </div>
                      </div>
                      
                    
                  </div>
                  
                  
                </div><!-- tab-content -->
            </form>
                <ul class="pager wizard">
                    <li class="previous">
                    	<a href="javascript:void(0)" class="prev_button">Previous</a>
                	</li>
                    <li class="next">
                    	<a href="javascript:void(0)" class="next_button">Next</a>
                    </li>
                    <li class="d_n">
                    	<button class="submit_button btn btn-success" type="submit">Submit</button>
                    </li>
                </ul>
                
              </div><!-- #basicWizard -->
              
            </div><!-- panel-body -->
          </div><!-- panel -->
      	</div>

	</div><!--row-->
</div><!-- contentpanel -->
<script>
jQuery(document).ready(function(){

$("#seller_register_form .form-control").prop('required',true);

// Progress Wizard
  $('#progressWizard').bootstrapWizard({
    'nextSelector': '.next',
    'previousSelector': '.previous',
    onNext: function(tab, navigation, index) {

      var $valid = jQuery('#seller_register_form').valid();
      if(!$valid) {
        
        $validator.focusInvalid();
        return false;
      }
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
    },
    onPrevious: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
    },
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
    }
  });

  $(".next_button,.prev_button").click(function(){
  	var check_submit = $("ul.seller_register li.active").attr('main');
  	if(check_submit==5)
	{
		$(".next_button").hide();
		$(".submit_button").show();
	}
	else
	{
		$(".next_button").show();
		$(".submit_button").hide();
	}
  });

// With Form Validation Wizard
  var $validator = jQuery("#seller_register_form").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
});
  </script>