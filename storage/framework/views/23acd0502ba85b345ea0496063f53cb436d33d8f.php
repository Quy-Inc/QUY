<link href="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>">
</script>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.js'); ?>"></script>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'siswa'):''; ?>

        <section class="panel">
            <header class="panel-heading">
                <h2><?php echo $content->module_name; ?> </h2>
                <label class="color"><?php echo $content->tag; ?></label>
            </header>

            <div class="panel-body">
                <table class="table table-striped" id="tsiswa">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Alamat</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Asal Sekolah</th>
                            <th>Action</th>
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
    $('#tsiswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo url("/ajax/siswa/getsiswa"); ?>',
        "preInit": function(settings, json) {
            $('.switch').bootstrapSwitch('destroy');
        },
        "fnDrawCallback": function(oSettings) {
            $('.switch').bootstrapSwitch();
            $('.switch').change(function(event) {
                //alert('xx');
                var changethis = $(this);
                var status = $(this).bootstrapSwitch('status');
                var dataid = $(this).find('input[type="checkbox"]').attr('valueajax');
                var statusClick = (status) ? 1 : 0;

                //var valueid = $(this).attr('valueajax');
                $.ytLoad();
                var uri = "<?php echo url('ajax/siswa/updatesiswad'); ?>";
                $.ajax({
                    url: uri,
                    data: {
                        'data': dataid,
                        'statusid': statusClick,
                        '_token': "<?php echo e(csrf_token()); ?>"
                    },
                    type: "POST",
                    dataType: 'json',
                    success: function(e) {
                        if (e.status == 0) {
                            //var statusstate = (statusClick == 1)?false:true;
                            //changethis.bootstrapSwitch('setState',statusstate);
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
                        }

                    }
                });

                event.preventDefault();

            });
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
                "width": "20%",
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
$(document).on('click', '.showmodaldelsiswa', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    $modal.find(".modal-title").html("Delete Siswa");
    $modal.find(".modal-body").html("Are you sure want to delete siswa data?");
    $modal.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger  yesdelsiswa" valueajax="' +
        valueid + '" >Setuju</button>');
    $modal.modal('show');
});


//Deleted Data
$(document).on('click', '.yesdelsiswa', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    var $modal = $('#md-normal');

    $.ytLoad();
    var uri = "<?php echo url('ajax/siswa/deletesiswad'); ?>";
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
                $(".siswa").trigger('click');

            }
            $modal.modal('hide');
        }
    });
});

// Detail siswa
$(document).on('click', '.showmodaldetailsiswa', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var idsiswa = $(this).attr('valueajax');
    var $modaldetail = $('#md-full-width');
    $modaldetail.find(".modal-body").html("Loading..");
    var uri = "<?php echo url('siswa/detailsiswa'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': idsiswa,
            'noheader': 'on'
        },
        type: "GET",
        success: function(result) {

            $modaldetail.find(".modal-body").html(result);
        }
    });

    $modaldetail.find(".modal-title").html("Data Siswa");
    $modaldetail.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button>'
        );
    $modaldetail.modal('show');
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