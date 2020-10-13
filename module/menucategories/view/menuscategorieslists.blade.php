<link href="{!!asset('public/assets/plugins/datable/dataTables.bootstrap.css')!!}" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="{!!asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('public/assets/plugins/datable/dataTables.bootstrap.js')!!}"></script>

<div id="content" style="padding-top: 0px;">
@php
    
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
@endphp
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'menuscategories'):''!!}
				<section class="panel">
						<header class="panel-heading">
								<h2>{!!$content->module_name!!} </h2>
						</header>

						<div class="panel-body">
							<table class="table table-striped" id="tmenuscategories" >
								<thead>
										<tr>
											<th>ID Categories</th>
											<th>Categories Name</th>
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

    var idMerchant = "{{$idMerchant}}";

    var attrmenuscategoriesUrl = "{!!url('menucategories/menuscategorieslists')!!}"+"/"+idMerchant;
    var attrmenuscategoriesUrlAdd = "{!!url('menucategories/addmenucategories')!!}"+"/"+idMerchant;

    $(".menucategories").attr('href',attrmenuscategoriesUrl);
    $(".addmenucategories").attr('href',attrmenuscategoriesUrlAdd);


	$('#tmenuscategories').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
            url:'{!!url("/ajax/menucategories/getmenucategories")!!}',
            data:{id_merchants:'{!!$idMerchant!!}'},
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
				var uri = "{!!url('ajax/menucategories/updatemenucategoriesd')!!}";
				$.ajax({
					url: uri, data:{'data':dataid,'statusid':statusClick,'_token':"{{ csrf_token() }}"}, type: "POST", dataType: 'json',
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
$(document).on('click','.showmodaldelmenuscategories', function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	var valueid = $(this).attr('valueajax');
	$modal.find(".modal-title").html("Delete Categories");
	$modal.find(".modal-body").html("Are you sure want to delete Categories data?");
	$modal.find(".modal-footer").html('<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger  yesdelmenuscategories" valueajax="'+valueid+'" >Setuju</button>');
	$modal.modal('show');
});


var $modaldetail = $('#md-full-width');
$(document).on('click','.showmodaldetailmenucategories', function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	var valueid = $(this).attr('valueajax');


	$.ytLoad();
	$modaldetail.find(".modal-body").html("Loading..");
	var uri = "{!!url('menucategories/detailmenucategories')!!}";
	$.ajax({
		url: uri, data:{'data':valueid,'noheader':'on'}, type: "GET",
		success: function (result) {

			$modaldetail.find(".modal-body").html(result);
		}
	});

	$modaldetail.find(".modal-title").html("Detail Categories");
	$modaldetail.find(".modal-footer").html('<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-warning  editlop" valueajax="'+valueid+'" >Edit LoP</button>');
	$modaldetail.modal('show');
});

//Deleted Data
$(document).on('click','.yesdelmenuscategories', function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	var valueid = $(this).attr('valueajax');
	var $modal = $('#md-normal');

	$.ytLoad();
	var uri = "{!!url('ajax/menucategories/deletemenucategoriesd')!!}";
	$.ajax({
		url: uri, data:{'data':valueid,'_token':"{{ csrf_token() }}"}, type: "POST", dataType: 'json',
		success: function (e) {
		 if (e.status == 0) {
			 $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
		 }else{
			$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
			$(".menucategories").trigger('click');

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
	top: 350px !important;
}
</style>
