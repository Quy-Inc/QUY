<?php
$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addidentitas"):''; ?>

        <section class="panel">
            <header class="panel-heading">
                <h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
                <label class="color"><?php echo $content->module_name; ?></label>
            </header>

            <div class="panel-body">
                <?php echo e(Form::open(array('url' => '/ajax/identitas/addidentitasd','class'=>'form-horizontal parsley-validated','id'=>'fidentitas'))); ?>


                <div class="form-group">
                    <?php echo e(Form::label('Kabupaten / Kota','',['class'=>'control-label col-md-2'])); ?>

                    <div class="row col-md-9">
                        <div class="col-md-6">
                            <?
							 $wilayah = Modules\identitas\models\Wilkab::pluck('nama','kode_wilayah')->all();
						?>
                            <?php echo e(Form::select('kabupaten',array('' => 'Pilih Kabupaten / Kota') +$wilayah,'',['class'=>"selectpicker form-control",'parsley-required'=>"true",'data-live-search'=>'true','parsley-required-message'=>"Kabupaten / Kota Harus dipilih",'id'=>'kabupaten','parsley-error-container'=>'#ekabupaten'])); ?>

                        </div>
                        <span class="col-md-12" id="ekabupaten"></span>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('Kecamatan','',['class'=>'control-label col-md-2'])); ?>

                    <div class="row col-md-9">
                        <div class="col-md-6">
                            <?php echo e(Form::select('kecamatan',array('' => 'Pilih Kecamatan'),'',['class'=>"selectpicker form-control",'parsley-required'=>"true",'data-live-search'=>'true','parsley-required-message'=>"Kecamatan Harus dipilih",'id'=>'kecamatan','parsley-error-container'=>'#ekecamatan'])); ?>

                        </div>
                        <span class="col-md-12" id="ekecamatan"></span>
                    </div>
                </div>
                <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                        <?php echo e(Form::submit('Add Identitas',['class'=>'btn btn-theme','id'=>'bidentitas'])); ?>


                        <button type="reset" class="btn" id="reset"
                            onclick="$( '.identitas' ).trigger( 'click')">Back</button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

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
$('.selectpicker').selectpicker();
$(document).on('change', '#kabupaten', function() {
    let dataWilayah = $('#kabupaten').val();
    let uri = "<?php echo e(url('ajax/identitas/getkecamatand')); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': dataWilayah
        },
        type: "GET",
        // async:false,
        success: function(result) {
            let hasil = JSON.parse(result);

            $('#kecamatan').empty();
            $("#kecamatan").append($.map(hasil.data, function(o) {
                return $('<option/>', {
                    value: o.kode_wilayah,
                    text: o.nama
                });
            }));
            $('#kecamatan').selectpicker('refresh');

        }
    });
});

$(function() {
    $("#fidentitas").submit(function(event) {
        event.preventDefault();
        if ($(this).parsley('validate')) {
            var uri = $(this).attr('action');
            $.ajax({
                url: uri,
                data: $(this).serialize(),
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
                        $(".identitas").trigger('click');
                    }

                }
            });
        } else {
            $.notific8('', {
                life: 5000,
                horizontalEdge: "bottom",
                theme: "danger",
                heading: " ERROR ;( "
            });
            return false;
        }
    });
});
</script>