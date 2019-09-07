<div class="pageheader">
	<div class="row">
		<div class="col-md-8">
			<h2 class="pull-left">
				<i class="fa fa-tag"></i><?php echo $sel; ?>
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

							<th>Category Name</th>

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

								<td>

									<a class="btn btn-primary btn-xs edit"  data-toggle="modal" data-target="#editModal"  main="<?php echo $r['id']; ?>" title="Edit Category"><i class="fa fa-pencil"></i></a>

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
  <div class="modal-dialog modal-md">
	<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Category</h4>
      </div>
      <form id="categoryForm" action="" class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        	<div class="form-group">
				<div class="">
				  	<label>Category Type Name</label>
					<select name="category_type_name" class="form-control" id="category_type_name">
						<option value="">Select Type</option>
						<?php if(!empty($cat_type_info))
						{
							foreach ($cat_type_info as $cat) { ?>
								<option value="<?php echo $cat['type_name']; ?>"><?php echo ucfirst($cat['type_name']); ?></option>
							<?php }
						}
						?>
					</select>
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
		$("#myModalLabel").html("Add Category");
		$("#category-submit-btn").html("Submit");
	});

	

   $('#table2 tbody').on( 'click', '.edit', function(){

		var id = $(this).attr('main');

		$("#myModalLabel").html("Edit Category");

		$("#category-submit-btn").html("Update");

		$.ajax({

          url:"<?php echo base_url('category/getEditdata'); ?>",

          type:"post",

          data:"catId="+id,                    

          success: function(data){

            var obj = jQuery.parseJSON(data);
        	console.log(obj);
			if(obj.type!="fail")
			{
				var name = obj['html'][0]['name']; var id = obj['html'][0]['id'];
				
				jQuery("#categoryName").val(name);
				
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
		bootbox.confirm("Are You Sure You Want to Delete this category?", function(result) {
		if(result == true)
		{
			$.ajax({

				url:"<?php echo base_url(); ?>category/delete",

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



//searching category

        $(".search").change(function(){

		var categoryId = $(this).val();

		if(categoryId)

		{

			var baseUrl = "<?php echo base_url('category/searching'); ?>";

			$.ajax({

				url: baseUrl,

				type:"post",

				data:"categoryId="+categoryId,                    

				success: function(data){

					if(data!="")

					{

						//console.log(data);

						var append = "";

						var abc = jQuery.parseJSON(data)

						if(abc!="childNotavailable")

						{

							if(abc.length >0)

							{

								for(i=0,j=1;i<abc.length;i++,j++)

								{
									append+="<tr id=row_"+abc[i]['id']+"><td>"+j+"</td><td>"+abc[i]['name']+"</td><td>"+abc[i]['parentName']+"</td><td><a class='btn btn-primary btn-xs edit'  data-toggle='modal' data-target='#editModal'  main="+abc[i]['id']+"><i class='fa fa-pencil'></i></a>&nbsp;<a class='btn btn-danger btn-xs delete' main="+abc[i]['id']+" title='Delete Student'><i class='fa fa-trash-o'></i></a></td>";

								}

							}

							else

							{

								append+="<td valign='top' colspan='7' class='dataTables_empty' style='padding:10px'>No matching records found</td>";

							}

						}

						else

						{

							append+="<td valign='top' colspan='7' class='dataTables_empty' style='padding:10px'>No Child Available of this Category.</td>";

						}

						$("#mutisearchingTbody").html(append);

					}

				}

		  });

		}



	}); 

	
//---------------Update Category Submit
var form_object = jQuery("#categoryForm"); 

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

      var form_data = new FormData($('#categoryForm')[0]);

	  console.log(form_data);

      if(form_data != "")  
		{

          $.ajax({

            type: "POST",

            url: "<?php echo base_url('category/add');?>",

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
					setTimeout(window.location.reload.bind(window.location), 500);
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
