	</div><!-- mainpanel -->
</section>

<script>
    jQuery(document).ready(function() {
          // Chosen Select
    jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});

      // Date Picker
    jQuery('.datepicker').datepicker
    ({
        dateFormat: "yy-mm-dd"
    });
     jQuery('#datepicker1').datepicker();

    $(".select2-2").select2({
      placeholder: "Select a state"
     });

    $( ".spinner" ).spinner({
      spin: function( event, ui ) { //console.log(ui.value);
        if ( ui.value < 1 ) {
          $( this ).spinner( "value", 1 );
          return false;
        }
        $( this ).spinner( "value", 1 );
      }
    });

});
</script>

<script src="<?php echo base_url(); ?>js/admin/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/toggles.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/retina.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery.cookies.js"></script>
<?php /*<script src="<?php //echo base_url(); ?>js/admin/flot/flot.min.js"></script>*/?>
<script src="<?php echo base_url(); ?>js/admin/flot/flot.resize.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/morris.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery.datatables.js"></script>
<script src="<?php echo base_url(); ?>js/admin/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/custom.js"></script>
<script src="<?php echo base_url(); ?>js/admin/dashboard.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url(); ?>js/carousle/carousle.js"></script>
<script src="<?php echo base_url(); ?>js/admin/bootstrap-fileupload.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/jquery.growl.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/admin/bootstrap-wizard.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/bootstrap-wysihtml5.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js" type="text/javascript"></script>

<div class="loading" style="display:none">
   <div class="loading_icon" style="display:none"><span class="fa fa-spin fa-spinner"></span>
   </div>
</div>

  <!-- Modal -->
<form id="basicForm" action="" class="form-horizontal" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="changePasswordModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><label id="popuptitle"></label> Change Password</h4>
        </div>
        <div class="modal-body">
        	<!--alert messages-->
        		<div class="alert alert-danger pswd_msg" style="display:none">
                	<strong>Please!</strong> Enter New Password.
              	</div>
        		
        		<div class="alert alert-danger cpswd_msg" style="display:none">
                	<strong>Please!</strong> Enter Confirm Password.
              	</div>

	       		<div class="alert alert-danger cnfm_pswd_msg" style="display:none">
                	<strong>Please!</strong> Enter New Password And Confirm Password.
              	</div>

	       		<div class="alert alert-danger pswd_not_match_msg" style="display:none">
                	<strong>O snap!</strong> Password And Confirm Password does Not Match.
              	</div>

	       		<div class="alert alert-success success_msg" style="display:none">
                	<strong>Well done! </strong>You successfully Change Password.
              	</div>
        	<!--alert messages-->
          	<div class="form-group">
              <div class="">
                <input class="form-control" type="password" name="password" id="pswd" required="" placeholder="New Password">
               </div>
          	</div>
          	<div class="form-group">
              <div class="">
                <input class="form-control" type="password" name="password" id="cnfm_pswd" required="" placeholder="Confirm Password">
               </div>
          	</div>
        </div>
        <div class="modal-footer">
          <button type="button" id="submit-btn" class="btn btn-success">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- Modal -->
</body>
</html>

<script type="text/javascript">
  jQuery(document).ready(function(){
    <?php if($this->session->flashdata('fail')) { ?>
      jQuery.growl.error({ title: "<i class='fa fa-times'> Error ! </i>",message: "<?php echo $this->session->flashdata('fail'); ?>" });
    <?php } ?>
    <?php if($this->session->flashdata('success')) { ?>
      jQuery.growl.notice({ title: "<i class='fa fa-check'> Success </i>",message: "<?php echo $this->session->flashdata('success'); ?>" });
    <?php } ?>

      jQuery('#wysiwyg').wysihtml5({color: true,html:true});
    });
</script>
<style type="text/css">
  .error
  {
    color: red;
  }
  .no_margin{
    margin-left: 0px !important;
    margin-right: 0px !important;
    margin-bottom: 7px !important;
}
</style>