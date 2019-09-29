<div class="pageheader">
	<div class="row">
		<div class="col-md-8">
			<h2 class="pull-left">
				<i class="fa fa-gamepad"></i><?php echo $sel; ?>
				<span>List</span>
			</h2>
		</div>
		<div class="col-md-4">
			<button class="btn btn-success pull-right addItemButton" data-toggle="modal" data-target="#categoryModal">Add</button>
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
							<th>Name</th>
							<th>Created By</th>
							<th>Date</th>
							<th>Action</th>
						</tr>

					</thead>

					<tbody id="mutisearchingTbody">

					<?php if(!empty($result))

					{

						$i=1;

						foreach($result as $r)
						{ ?>

							<tr id="row_<?php echo $r['id']; ?>">

								<td> <?php echo $i++; ?></td>
								<td> <?php echo ucfirst($r['name']); ?></td>
								<td> <?php echo ucfirst($r['email']); ?></td>
								<td> <?php echo ucfirst(ymddate($r['dateTime'])); ?></td>

								<td>

									<a class="btn btn-primary btn-xs edit"  data-toggle="modal" data-target="#categoryModal"  main="<?php echo $r['id']; ?>" title="Edit Category"><i class="fa fa-pencil"></i></a>

									<a class="btn btn-danger btn-xs delete" main="<?php echo $r['id']; ?>" title="Delete Category"><i class="fa fa-trash-o"></i></a>

								</td>
 
								

							</tr>

						<?php }

					} ?>

					</tbody>

			</table>

          </div><!-- table-responsive -->



		</div><!--row-->

	</div><!-- contentpanel -->

	<!-- Modal -->
<div id="categoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
	<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Campaign</h4>
      </div>
      <form id="campaignForm" action="" class="" method="post" enctype="multipart/form-data">
      <div class="modal-body">
  			<div class="form-group">
				<div class="">
				  	<label>Campaign Name</label>
					<input class="form-control valid" type="text" name="name" id="name" required="" placeholder="Campaign Name">
					<label for="categoryName" class="error"></label><br>
					<input type="hidden" name="id" id="hidden_id" value="">	
				</div>
			</div>
			<div class="form-group">
				<button type="submit" id="category-submit-btn" class="btn btn-success btn-block btn_category">Add</button>
			</div>
      </div>
      </form>
    </div>

  </div>
</div>



	

<!--cvcv-->



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
		$("#myModalLabel").html("Add Campaign");
		$("#category-submit-btn").html("Submit");
	});

	

   $('#table2 tbody').on( 'click', '.edit', function(){

		var id = $(this).attr('main');

		$("#myModalLabel").html("Edit Campaign");

		$("#category-submit-btn").html("Update");

		$.ajax({

          url:"<?php echo base_url('campaign/getEditdata'); ?>",

          type:"post",

          data:"catId="+id,                    

          success: function(data){

            var obj = jQuery.parseJSON(data);
        	console.log(obj);
			if(obj.type!="fail")
			{
				var name = obj['html'][0]['name']; var id = obj['html'][0]['id'];
				jQuery("#name").val(name);
				
				jQuery("#hidden_id").val(id);  
				
				jQuery('#categoryModal').modal('show');
			}
			else
			{

				$("#myModalLabel").html("Update Item");

				$("#category-submit-btn").html("Update");

				jQuery('#categoryModal').modal('show');

			}

          }

        });

    }); 

	

//delete 

	$(".table").on('click','.delete',function(){
		var id = $(this).attr('main');
		bootbox.confirm("Are You Sure You Want to Delete this campaign?", function(result) {
		if(result == true)
		{
			$.ajax({

				url:"<?php echo base_url(); ?>campaign/delete",

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


//---------------Update Campaign Submit
var form_object = jQuery("#campaignForm"); 

  form_object.validate({

    rules: {
            name: {
                   required: true
				}
	 	},



    highlight: function(element) {

      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');

    },

    success: function(element) {

    jQuery(element).closest('.form-group').removeClass('has-error');

    },

    submitHandler: function() {

      var form_data = new FormData($('#campaignForm')[0]);

	  console.log(form_data);

      if(form_data != "")  
		{

          $.ajax({

            type: "POST",

            url: "<?php echo base_url('campaign/add');?>",

            data: form_data,                    

            cache: false,

            contentType: false,

            processData: false,

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
					var res = jQuery.parseJSON(result);
					if(res.type=="success")
					{
						$.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: res.msg });
					}
					else
					{
							$.growl.error({title: "<i class='fa fa-times'> Sorry.. </i>", message: res.msg });
					}
					
					$('#categoryModal').modal('hide');
					//setTimeout(window.location.reload.bind(window.location), 500);
					//location.reload();
				}
				else
				{
					$.growl.notice({title: "<i class='fa fa-times'> Sorry.. </i>", message: "Please Try Again!!!" });
				}
			}
          }); 
        }
	}

});
});



</script>

















<script>



	//---------------

	$(document).on('click','.deletereq', function(){

	var id= $(this).attr('id');

	//alert(id);

          bootbox.confirm("Are You Sure You Want to Delete this entry?", function(result) {

            if(result == true)

                {

                $.ajax({

                    url:"<?php echo base_url(); ?>supervisor/deletereq",

                    type:"post",

                    data:{

						'arg1':id

					},                    

                    success: function(result){					

						//alert(result); 

						

						if (result=='deleted'){

							window.location.reload();

						}

						else{

							bootbox.alert("Some error occured");

						}

                    }

                  });

                }

          });

});

	

</script>
