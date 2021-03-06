		<link href="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
		<script type="text/javascript"
		    src="<?php echo asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.js'); ?>"></script>

		<div id="content" style="padding-top: 0px;">
		    <div class="row">
		        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'psbmarketing'):''; ?>

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
		                <table class="table table-striped" id="tpsbmarketing">
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
		                            <th>Keterangan</th>
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
		$('#tpsbmarketing').DataTable().ajax.reload();
	});

$(function() {
	$(".selectpicker").selectpicker();
	$('#tpsbmarketing').DataTable({
		processing: true,
		serverSide: true,
		searching: false,
		lengthChange:false,
		pageLength: 12,
		ajax: {
			url:'<?php echo url("/ajax/psbmarketing/getpsbmarketing"); ?>',
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
                "width": "18%",
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
$(document).on('click', '.showmodaldelpsbmarketing', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    $modal.find(".modal-title").html("Delete Psbmarketing");
    $modal.find(".modal-body").html("Are you sure want to delete psbmarketing data?");
    $modal.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger  yesdelpsbmarketing" valueajax="' +
        valueid + '" >Setuju</button>');
    $modal.modal('show');
});


//Deleted Data
$(document).on('click', '.yesdelpsbmarketing', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    var $modal = $('#md-normal');

    $.ytLoad();
    var uri = "<?php echo url('ajax/psbmarketing/deletepsbmarketingd'); ?>";
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
                $(".psbmarketing").trigger('click');

            }
            $modal.modal('hide');
        }
    });
});

// ---------------------------------------------------------------------- //


//detail Approve Confirm
var $modal = $('#md-normal');
$(document).on('click', '.showmodalapprove', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    $modal.find(".modal-title").html("Data PSB");
    $modal.find(".modal-body").html(
        "<textarea id='approve' class='form-control' rows='3' placeholder='Isi Keterangan'></textarea>");

    $modal.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-success approve" valueajax="' +
        valueid + '">Approve</button>');
    $modal.modal('show');
});

$(document).on('click', '.approve', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    var keterangan = $('#approve').val();
    var $modal = $('#md-normal');

    $.ytLoad();
    var uri = "<?php echo url('ajax/psbmarketing/detailpsbmarketingd'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': valueid,
            'keterangan': keterangan,
            'noheader': 'on',
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
                $(".psbmarketing").trigger('click');

            }
            $modal.modal('hide');
        }
    });
});

// -------------------------------------------------------------------------- //
//detail NotApprove Confirm
var $modal = $('#md-normal');
$(document).on('click', '.showmodalnotapprove', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    $modal.find(".modal-title").html("Data PSB");
    $modal.find(".modal-body").html(
        "<textarea id='idapprove' class='form-control' rows='3' placeholder='Isi Keterangan'></textarea>");

    $modal.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger ntapprove" valueajax="' +
        valueid + '">Not Approve</button>');
    $modal.modal('show');
});

//action
$(document).on('click', '.ntapprove', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    var keterangan = $('#idapprove').val();
    var $modal = $('#md-normal');

    $.ytLoad();
    var uri = "<?php echo url('ajax/psbmarketing/notapproved'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': valueid,
            'keterangan': keterangan,
            'noheader': 'on',
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
                $(".psbmarketing").trigger('click');

            }
            $modal.modal('hide');
        }
    });
});
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