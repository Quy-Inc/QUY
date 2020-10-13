<link href="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.js'); ?>"></script>

<table class="table table-striped" id="role-table" >
	<thead>
			<tr>
					<th>Name</th>
					<th>View</th>
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

<script>
$(function() {
	
	var createiCheck = (function() {
		  $('.iCheck.role').each(function(i) {
				var  data=$(this).data() , 
				 input=$(this).find("input") , 
				 li=$(this).find("li") ,
				 index="cp"+i , 
				 insert_text,
				 iCheckColor = [ "black", "red","green","blue","aero","grey","orange","yellow","pink","purple"],
				 callCheck=data.style || "flat";
			 if(data.color && data.style !=="polaris" && data.style !=="futurico" ){
					hasColor= jQuery.inArray(data.color, iCheckColor);
					if(hasColor !=-1 && hasColor < iCheckColor.length){
						callCheck=callCheck+"-"+data.color;
					}
			}
			input.each(function(i) {
				var self = $(this), label=$(this).next(), label_text=label.html();
				self.attr("id","iCheck-"+index+"-"+i);
				if(data.style=="line"){
					insert_text='<div class="icheck_line-icon"></div><span>'+label_text+'</span>';
					label.remove();
					self.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck, insert:insert_text  });
				}else{
					label.attr("for","iCheck-"+index+"-"+i);
				}
			});
			if(data.style!=="line"){
				input.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck });
			}else{
				li.addClass("line");
			}
		  });
		});
		
		
		
	function sendrole(role,idprofile,slugaction,statusrole){
		var hrefattr = '<?php echo url("/ajax/modules/sendrole"); ?>';
		$.ytLoad();
		$.post(hrefattr,({"idprofile":idprofile,"module":role,"slugaction":slugaction,"statusrole":statusrole,"_token":"<?php echo csrf_token(); ?>"}), function( response, status, xhr ) {
		  if ( status == "error" ) {
			var msg = JSON.parse(response);
			$.notific8(msg.error,{ life:3000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR "+xhr.status+" :( "});
			$.ytLoad("destroy");
			window.location.reload();
			
		  }else{
				var msg = JSON.parse(response);
				if(msg.status == 1){
					$.notific8(msg.resp,{ life:2000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS  :) "});
				}else{
					$.notific8(msg.resp,{ life:2000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR  :( "});
				}
				$.ytLoad("destroy");
		  }
		});
	}	
		
	
	$('#role-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url:'<?php echo url("/ajax/modules/getprofilesdata"); ?>',
			data: function (d) {
				d.slug = '<?php echo $slug; ?>';
			}
		},
		"initComplete": function( settings, json ) {
			createiCheck();
			$('input[type="checkbox"]').on("ifChecked", function(){
				var name = $(this).attr('name');
				var nsplit = name.split("-");
				sendrole(nsplit[0],nsplit[1],nsplit[2],1);
				$.ytLoad("destroy");
			});
			
			$('input[type="checkbox"]').on("ifUnchecked", function(){
				var name = $(this).attr('name');
				var nsplit = name.split("-");
				sendrole(nsplit[0],nsplit[1],nsplit[2],0);
				$.ytLoad("destroy");				
			});
			
			
		  },
		"fnDrawCallback": function (oSettings) {
			createiCheck();
			$('input[type="checkbox"]').on("ifChecked", function(){
				var name = $(this).attr('name');
				var nsplit = name.split("-");
				sendrole(nsplit[0],nsplit[1],nsplit[2],1);
				$.ytLoad("destroy");
			});
			
			$('input[type="checkbox"]').on("ifUnchecked", function(){
				var name = $(this).attr('name');
				var nsplit = name.split("-");
				sendrole(nsplit[0],nsplit[1],nsplit[2],0);	
				$.ytLoad("destroy");				
			});
		},
	  "columns": [
		{ "width": "20%","className": "dt-left", "sortable": false },
		{ "width": "25%","className": "dt-center", "sortable": false },
		{ "width": "25%","className": "dt-center", "sortable": false }
	  ],
	  "_iDisplayStart":10
	});	
});
	
</script>

<style>
th.dt-center, td.dt-center { text-align: center; vertical-align: top !important; }
th.dt-left, td.dt-left { text-align: left; vertical-align: top !important;}
</style>