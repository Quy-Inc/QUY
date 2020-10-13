		<link href="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
		<script type="text/javascript"
		    src="<?php echo asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.js'); ?>"></script>

		<div id="content" style="padding-top: 0px;">
		    <div class="row">
		        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'psbAOM'):''; ?>

		        <section class="panel">
		            <header class="panel-heading">
		                <h2><?php echo $content->module_name; ?> </h2>
		                <label class="color"><?php echo $content->tag; ?></label>
		            </header>

        <form class="form-horizontal filter" id="filter">
            <div class="row" style="padding:30px 20px 0px;">
                <div class ="col-md-2">
                    <?php echo e(Form::select('bulan',array(""=>"Pilih Bulan","1"=>"Januari","2"=>"Februari","3"=>"Maret","4"=>"April","5"=>"Mei","6"=>"Juni","7"=>"Juli","8"=>"Agustus","9"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember"),'',['class'=>'form-control selectpicker','data-live-search'=>'true'])); ?>

                </div>

                <div class ="col-md-2">
                    <?php echo e(Form::select('tahun',array(""=>"Pilih Tahun","2019"=>"2019","2020"=>"2020"),'',['class'=>'form-control selectpicker','data-live-search'=>'true'])); ?>

                </div>

                <div class ="col-md-2">
                    <button class="btn btn-sm btn-success tfilter" type="submit">Filter</button>
                </div>

            </div> 
        </form>

		            <div class="panel-body">
		                <table class="table table-striped" id="tpsbAOM">
		                    <thead>
		                        <tr>
		                            <th>NO INET</th>
		                            <th>Witel</th>
		                            <th>STO</th>
		                            <th>Pek</th>
		                            <th>Mitra TA</th>
		                            <th>Tipe</th>
		                            <th>NoSC NoTID</th>
		                            <th>Tgl WO</th>
		                            <th>Tgl PS</th>
		                            <th>TA Telkom</th>
		                            <th>Nama ODP</th>
		                            <th>SP(mtr)</th>
		                            <th>NDEM</th>
		                            <th>Biaya Per M</th>
		                            <th>SP>150</th>
		                            <th>Biaya</th>
		                            <th>Action</th>
		                            <th>Status</th>
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
if ($.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent
        .toLowerCase()))) {
    $('body').removeClass('nav-collapse-in');
} else {
    $('body').addClass('nav-collapse-in');
}
$("#filter").on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
		$('#tpsbAOM').DataTable().ajax.reload();
	});

$(function() {
	$(".selectpicker").selectpicker();
	$('#tpsbAOM').DataTable({
		processing: true,
		serverSide: true,
		searching: false,
		lengthChange:false,
		pageLength: 12,
		ajax: {
			url:'<?php echo url("/ajax/psbAOM/getpsbAOM"); ?>',
			data: function(d){

	    		param = $('#filter').serializeArray();
	    		// paramDownload = $('#filterLop').serialize();
					d.form=param;

				}
        },
        "columns": [{
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "*",
                "className": "dt-left"
            },
            {
                "width": "10%",
                "className": "dt-center"
            },
            {
                "width": "10%",
                "className": "dt-center",
                "sortable": false
            }
        ]
    });

});



$.ajaxSetup({
    // Disable caching of AJAX responses
    cache: false
});

//Delete Confirm
var $modal = $('#md-normal');
$(document).on('click', '.showmodaldelpsbAOM', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    $modal.find(".modal-title").html("Delete PsbAOM");
    $modal.find(".modal-body").html("Are you sure want to delete psbAOM data?");
    $modal.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger  yesdelpsbAOM" valueajax="' +
        valueid + '" >Setuju</button>');
    $modal.modal('show');
});


//Deleted Data
$(document).on('click', '.yesdelpsbAOM', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    var $modal = $('#md-normal');

    $.ytLoad();
    var uri = "<?php echo url('ajax/psbAOM/deletepsbAOMd'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': valueid,
            '_token': "<?php echo e(csrf_token()); ?>"
        },
        type: "POST",
        dataType: 'json',
        success: function(e) {
            if (e.status == 0) {
                $.notific8(e.message, {
                    life: 5000,
                    horizontalEdge: "bottom",
                    theme: "danger",
                    heading: " ERROR ;( "
                });
            } else {
                $.notific8(e.message, {
                    life: 5000,
                    horizontalEdge: "bottom",
                    theme: "success",
                    heading: " SUCCESS :) "
                });
                $(".psbAOM").trigger('click');

            }
            $modal.modal('hide');
        }
    });
});

// -------------------------------------------------------------- //

//detail document Confirm
$(document).on('click', '.showmodaldocument', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var iddocument = $(this).attr('valueajax');
    var $modaldetail = $('#md-full-width');
    $modaldetail.find(".modal-body").html("Loading");
    var uri = "<?php echo url('psbAOM/detailpsbAOM'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': iddocument,
            'noheader': 'on'
        },
        type: "GET",
        success: function(result) {

            $modaldetail.find(".modal-body").html(result);
        }
    });

    $modaldetail.find(".modal-title").html("Data PSB AOM");
    $modaldetail.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button>'
    );
    $modaldetail.modal('show');
});

// -------------------------------------------- //


//close Confirm
var $modal = $('#md-normal');
$(document).on('click', '.showmodalclose', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    $modal.find(".modal-title").html("Close Data");
    $modal.find(".modal-body").html("Are you sure want to Close this Data?");
    $modal.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger closepsbAOM" valueajax="' +
        valueid + '" >Close</button>');
    $modal.modal('show');
});


//action
$(document).on('click', '.closepsbAOM', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    var $modal = $('#md-normal');

    $.ytLoad();
    var uri = "<?php echo url('ajax/psbAOM/datapsbAOMd'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': valueid,
            '_token': "<?php echo e(csrf_token()); ?>"
        },
        type: "POST",
        dataType: 'json',
        success: function(e) {
            if (e.status == 0) {
                $.notific8(e.message, {
                    life: 5000,
                    horizontalEdge: "bottom",
                    theme: "danger",
                    heading: " ERROR ;( "
                });
            } else {
                $.notific8(e.message, {
                    life: 5000,
                    horizontalEdge: "bottom",
                    theme: "success",
                    heading: " SUCCESS :) "
                });
                $(".psbAOM").trigger('click');

            }
            $modal.modal('hide');
        }
    });
});










// ----------------------------------------------------------------------//










		</script>

		<style>
th.dt-center,
td.dt-center {
    text-align: center;
}

th.dt-left,
td.dt-left {
    text-align: left;
}
		</style>