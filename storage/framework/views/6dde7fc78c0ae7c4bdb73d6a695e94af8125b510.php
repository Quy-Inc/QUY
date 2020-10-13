<link href="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.js'); ?>"></script>

<div id="content" style="padding-top: 0px;">
<?php
    
    //$Users = new Modules\users\models\Users;
    //$getIDMerchantByUsers = $Users::where("id_profile","!=",'1')->get();
    $Auth = new Auth;
    $idProfile = $Auth::user()->id_profile;
    if($idProfile >= "100")
    {
        $idMerchant = $data;
    }else{
        $idMerchant = $data;
    }
?>
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'kitchens'):''; ?>

				<section class="panel">
						<header class="panel-heading">
								<h2><?php echo $content->module_name; ?> </h2>
								<label class="color"><?php echo $content->tag; ?></label>

						</header>

						<div class="panel-body">
							<table class="table table-striped" id="tkitchens" >
								<thead>
										<tr>
											<th>ID Kitchen</th>
											<th>Kitchen Code</th>
											<th>Kitchen Name</th>
											<th>Caption</th>
											<th>Actions</th>
										</tr>
								</thead>
								<tbody align="center">
									<tr>
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

    $("#md-full-width").modal('hide');

    var idMerchant = "<?php echo e($idMerchant); ?>";

    var attrKitchensUrl = "<?php echo url('kitchens/merchants'); ?>"+"/"+idMerchant;
    var attrKitchensUrlAdd = "<?php echo url('kitchens/addvenues'); ?>"+"/"+idMerchant;

    $(".kitchens").attr('href',attrKitchensUrl);
    $(".addkitchens").attr('href',attrKitchensUrlAdd);


	$('#tkitchens').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
            url:'<?php echo url("/ajax/kitchens/getkitchens"); ?>',
            data:{id_merchants:'<?php echo $idMerchant; ?>'},
        },
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
				var uri = "<?php echo url('ajax/kitchens/updatekitchensd'); ?>";
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
		"columns": [
			{ "width": "10%","className": "dt-left"},
			{ "width": "25%","className": "dt-left" },
			{ "width": "25%","className": "dt-left" },
			{ "width": "25%","className": "dt-left" },
			{ "width": "20%","className": "dt-center", "sortable": false }
		  ]
	});

});



$.ajaxSetup ({
	// Disable caching of AJAX responses
	cache: false
});

//Delete Confirm
var $modal = $('#md-normal');
$(document).on('click','.showmodaldelkitchens', function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	var valueid = $(this).attr('valueajax');
	$modal.find(".modal-title").html("Delete Kitchen");
	$modal.find(".modal-body").html("Are you sure want to delete kitchen data?");
	$modal.find(".modal-footer").html('<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger  yesdelvenues" valueajax="'+valueid+'" >Setuju</button>');
	$modal.modal('show');
});


var $modaldetail = $('#md-full-width');
$(document).on('click','.showmodaldetailkitchens', function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	var valueid = $(this).attr('valueajax');


	$.ytLoad();
	$modaldetail.find(".modal-body").html("Loading..");
	var uri = "<?php echo url('kitchens/detailkitchens'); ?>";
	$.ajax({
		url: uri, data:{'data':valueid,'noheader':'on'}, type: "GET",
		success: function (result) {

			$modaldetail.find(".modal-body").html(result);
		}
	});

	$modaldetail.find(".modal-title").html("Detail Kitchens");
	$modaldetail.find(".modal-footer").html('<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-warning  editlop" valueajax="'+valueid+'" >Edit LoP</button>');
	$modaldetail.modal('show');
});

//Deleted Data
$(document).on('click','.yesdelkitchens', function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	var valueid = $(this).attr('valueajax');
	var $modal = $('#md-normal');

	$.ytLoad();
	var uri = "<?php echo url('ajax/venues/deletekitchensd'); ?>";
	$.ajax({
		url: uri, data:{'data':valueid,'_token':"<?php echo e(csrf_token()); ?>"}, type: "POST", dataType: 'json',
		success: function (e) {
		 if (e.status == 0) {
			 $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
		 }else{
			$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
			$(".venues").trigger('click');

		 }
			$modal.modal('hide');
		}
	});
});

</script>

<style>
th.dt-center, td.dt-center { text-align: center; }
th.dt-left, td.dt-left { text-align: left; }
#md-full-width{
	margin-top: -350px !important;
}
</style>
