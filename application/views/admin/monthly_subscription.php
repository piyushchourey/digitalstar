<style type="text/css">
	.prdct_img
	{
		height:100px;
		width:100px;
	}
</style>
<div class="pageheader">
	<div class="row">
		<div class="col-md-8">
			<h2 class="pull-left">
				<i class="fa fa-calendar"></i><?php echo $sel; ?>
				<span>List</span>
			</h2>
		</div>
		<div class="col-md-4">
			<a class="btn btn-success pull-right" href="<?php echo base_url('product/addMonthly'); ?>">Add</a>
		</div>
	</div>
</div>

<div class="contentpanel">
	<div class="row">

        <div class="table-responsive">

			<table class="table table2excel table-striped" id="table2">
					<thead>
						<tr>

							<th>S.No.</th>
							<th>Pack Image</th>
							<th>Pack Name</th>
							<th>Timing</th>
							<th>Price</th>
							<th>Discount</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody id="mutisearchingTbody">

					<?php if(!empty($all_subscription))

					{

						$i=1;
						foreach($all_subscription as $r)
						{ ?>

							<tr id="row_<?php echo $r['id']; ?>">

								<td> <?php echo $i++; ?></td>
								<td> 
									<img class="img-responsive img-thumbnail prdct_img" src="<?php echo base_url('images/products') ?>/<?php echo $r['image']; ?>" alt="<?php echo $r['pack_nm']; ?>">
								</td>
								<td> <?php echo ucfirst($r['pack_nm']); ?></td>
								<td> <?php echo ucfirst($r['pack_timing']); ?></td>
								<td> <i class="fa fa-inr"></i><?php echo $r['price']; ?></td>
								<td> <?php echo $r['discount']; ?></td>
								<td>
									<?php if($r['status'])
									{ ?>
										<a class="btn btn-warning btn-xs status_change" main="<?php echo $r['id']; ?>" title="Disapprove Product" current_status="<?php echo $r['status']; ?>">
										<i class="fa fa-thumbs-down"></i>
									</a>
									<?php } else { ?>
										<a class="btn btn-info btn-xs status_change" main="<?php echo $r['id']; ?>" title="Approve Product" current_status="<?php echo $r['status']; ?>">
										<i class="fa fa-thumbs-up"></i>
									</a>
									<?php }
									?>
									<a class="btn btn-primary btn-xs edit" href="<?php echo base_url('product/edit')?>/<?php echo $r['id']; ?>" title="Edit Product">
										<i class="fa fa-pencil"></i>
									</a>

									<a class="btn btn-danger btn-xs delete" main="<?php echo $r['id']; ?>" title="Delete Product">
										<i class="fa fa-trash-o"></i>
									</a>
								</td>
							</tr>

						<?php }

					} ?>

					</tbody>

			</table>

          </div><!-- table-responsive -->



		</div><!--row-->

	</div><!-- contentpanel -->


<script type="text/javascript">

//data table
$(document).ready(function(){

	var t = jQuery('#table2').dataTable({
		"sPaginationType": "full_numbers"
	});

	// Chosen Select
 	jQuery("#table2_length select").chosen({
		'min-width': '100px',
	 	'white-space': 'nowrap',
		disable_search_threshold: 10
	});

  	$(".addItemButton").click(function(){
		$("#hidden_id").val("");
		$("#myModalLabel").html("Add Category");
		$("#category-submit-btn").html("Submit");
	});

//delete 

	$(".table").on('click','.delete',function(){
		var id = $(this).attr('main');
		bootbox.confirm("Are You Sure You Want to Delete this Product?", function(result) {
		if(result == true)
		{
			$.ajax({

				url:"<?php echo base_url(); ?>product/delete",

				type:"post",

				data:"id="+id,                    

				success: function(data){  
					var abc = jQuery.parseJSON(data);
					if(abc.type!="fail")
					{
						$.growl.notice({title: "<i class='fa fa-check'> Success!!! </i>", message: abc.msg });
						t.fnDeleteRow(jQuery("#row_" + id)[0]);
					}
					else
					{
						$.growl.notice({title: "<i class='fa fa-times'> Sorry!!! </i>", message: abc.msg});			
					}
				}
			  });
		}
        else if(result == false)
		{
		}
	});
});


//Approve - disapprove status..
	$(".table").on('click','.status_change',function(){
		var id = $(this).attr('main');
		var current_status = $(this).attr('current_status');
		if(current_status > 0)
			var msg = "Are You Sure You Want to Disapprove this Product?";
		else
			var msg = "Are You Sure You Want to Approve this Product?";

		bootbox.confirm(msg, function(result) {
		if(result == true)
		{
			$.ajax({

				url:"<?php echo base_url(); ?>product/status_change",

				type:"post",

				data:"id="+id,                    

				success: function(data){  
					var abc = jQuery.parseJSON(data);
					if(abc.type!="fail")
					{
						$.growl.notice({title: "<i class='fa fa-check'> Success!!! </i>", message: abc.msg });
						window.location.reload();
					}
					else
					{
						$.growl.notice({title: "<i class='fa fa-times'> Sorry!!! </i>", message: abc.msg});			
					}
				}
			  });
		}
        else if(result == false)
		{
		}
	});
});



});
</script>
