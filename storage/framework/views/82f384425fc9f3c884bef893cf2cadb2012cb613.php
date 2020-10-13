<link href="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.js'); ?>"></script>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'users'):''; ?>

				<section class="panel">
						<header class="panel-heading">
								<h2><?php echo $content->module_name; ?> </h2>
								<label class="color"><?php echo $content->tag; ?></label>
								
						</header>
					
						<div class="panel-body">
							<table class="table table-striped" id="users-table" >
								<thead>
										<tr>
												
												<th>Name</th>
												<th>Email</th>
												<th>Action</th>
										</tr>
								</thead>
								<tbody align="center">
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>												
							</table>
						</div>
				</section>
</div>
</div>
<script>
$(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo url("/ajax/users/getuserdata"); ?>',
			"preInit":function(settings,json){
			$('.switch').bootstrapSwitch('destroy');
			},
			"fnDrawCallback": function (oSettings) {
				$('.switch').bootstrapSwitch();
				$('.switch').change(function (event) {
					//alert('xx');
					var changethis = $(this);
					var status = $(this).bootstrapSwitch('status');
					var dataid = $(this).find('input[type="checkbox"]').attr('valueajax');
					var statusClick = (status)?1:0;
					
					//var valueid = $(this).attr('valueajax');
					$.ytLoad();
					var uri = "<?php echo url('ajax/users/updatestatususersdata'); ?>";
					$.ajax({
						url: uri, data:{'data':dataid,'statusid':statusClick,'_token':"<?php echo e(csrf_token()); ?>"}, type: "POST", dataType: 'json',
						success: function (e) {
						 if (e.status == 0) {
							 //var statusstate = (statusClick == 1)?false:true;
							//changethis.bootstrapSwitch('setState',statusstate);
							 $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
						 }else{
							$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
						 }
						
						}
					});
					
					event.preventDefault();
					
				});
			},
			columns:[
			{"className": "dt-left", "width":"25%"},
			{"className": "dt-center", "width":"25%"},
			{"className": "dt-center", "width":"15%","sortered":"false","orderable":"false"}
			]
        });
    });
	$.ajaxSetup ({
	// Disable caching of AJAX responses
	cache: false
});	

//KONFIRMASI HAPUS
var $modal = $('#md-normal');
$(document).on('click','.showmodaldel', function(){
	var valueid = $(this).attr('valueajax');
	$modal.find(".modal-title").html("Hapus Data");
	$modal.find(".modal-body").html("Anda Setuju Akan Menghapus Data?");
	$modal.find(".modal-footer").html('<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger  yesdel" onclick="deletedata(\''+valueid+'\')" >Setuju</button>');
	$modal.modal('show');
});


//EKSEKUSI HAPUS

function deletedata(valueid){

	var $modal = $('#md-normal');
	
	$.ytLoad();
	var uri = "<?php echo url('ajax/users/deleteusersdata'); ?>";
	$.ajax({
		url: uri, data:{'data':valueid,'_token':"<?php echo e(csrf_token()); ?>"}, type: "POST", dataType: 'json',
		success: function (e) {
		 if (e.status == 0) { 
			 $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
		 }else{
			$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
			$(".profiles").trigger('click');
			
		 }
			$modal.modal('hide');
		}
	});	
}
</script>

<style>
th.dt-center, td.dt-center { text-align: center; }
th.dt-left, td.dt-left { text-align: left; }
th.dt-capitalize,td.dt-capitalize{ text-transform: capitalize; }
</style>