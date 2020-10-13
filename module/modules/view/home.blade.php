<link href="{!!asset('public/assets/plugins/datable/dataTables.bootstrap.css')!!}" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="{!!asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('public/assets/plugins/datable/dataTables.bootstrap.js')!!}"></script>

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'modules'):''!!}
				<section class="panel">
						<header class="panel-heading">
								<h2>{!!$content->module_name!!} </h2>
								<label class="color">{!!$content->tag!!}</label>
								
						</header>
						<div class="panel-body">
							<table class="table table-striped" id="module-table" >
								<thead>
										<tr>
												
												<th>Id</th>
												<th>Modules</th>
												<th>Actions</th>
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
<div id="md-ajax" class="modal fade container" tabindex="-1" aria-hidden="true">
		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
				<h4	 class="modal-title" style="text-transform:capitalize; font-weight:450;"></h4>
		</div>
		<!-- //modal-header-->
		<div class="modal-body">
			
		</div>
		<!-- //modal-body-->
</div>

<script>
$(function() {
	$('#module-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{!!url("/ajax/modules/getdirectory")!!}',
		 columns: [
			{data: 'id', name: 'id',"className": "dt-center", "width":"10%","sortered":"false"},
			{data: 'module', name: 'module',"className": "dt-left dt-capitalize" },
			{data: 'action', name: 'action',orderable:'false',searchable:'false',"className": "dt-center", "width":"25%","sortered":"false"}
		]
	});		
});


$.ajaxSetup ({
	// Disable caching of AJAX responses
	cache: false
});

var $modal = $('#md-ajax');
$(document).on('click','.md-ajax-load', function(){
	  $.ytLoad();
	  $('body').modalmanager('loading');
	  var $slug = $(this).attr("value");
	  $modal.find(".modal-body").load('{!!url("/ajax/modules/vrole_profile")!!}', {"slug":$slug,"_token":"{{ csrf_token() }}"}, function(){
		  $modal.find(".modal-title").html($slug + " Role Permission");
		  $modal.modal();
	  });
});
</script>


<style>
th.dt-center, td.dt-center { text-align: center; }
th.dt-left, td.dt-left { text-align: left; }
th.dt-capitalize,td.dt-capitalize{ text-transform: capitalize; }
</style>