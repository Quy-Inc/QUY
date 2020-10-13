<?php
$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addpsbta"):''; ?>

        <section class="panel">
            <header class="panel-heading">
                <h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
                <label class="color"><?php echo $content->module_name; ?></label>
            </header>

            <div class="panel-body">
                <?php echo e(Form::open(array('url' => '/ajax/psbta/addpsbtad','class'=>'form-horizontal parsley-validated','id'=>'fpsbta'))); ?>



                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">No INET</label>
                        <label class="progress-label col-md-6">Witel</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::number('no_inet','',['class'=>'form-control parsley-validated','id'=>'no_inet','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?
                                $witel = Modules\witel\models\Witel::pluck("nama_witel","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_witel',array('' => 'Pilih Witel') +$witel,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"witel Harus dipilih",'id'=>'witel','parsley-error-container'=>'#ewitel'])); ?>

                            <span class="col-md-12" id="ewitel"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">STO</label>
                        <label class="progress-label col-md-6">Pek</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?
                                $sto = Modules\sto\models\Sto::pluck("nama_sto","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_sto',array('' => 'Pilih STO') +$sto,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"sto Harus dipilih",'id'=>'sto','parsley-error-container'=>'#esto'])); ?>

                            <span class="col-md-12" id="esto"></span>
                        </div>

                        <div class="col-md-6">
                            <?
                                $pek = Modules\pek\models\Pek::pluck("nama_pek","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_pek',array('' => 'Pilih Pek') +$pek,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"pek Harus dipilih",'id'=>'pek','parsley-error-container'=>'#epek'])); ?>

                            <span class="col-md-12" id="epek"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Tipe</label>
                        <label class="progress-label col-md-6">NoSC NoTID</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php
                            $tipe = ["1"=>'1P',"2"=>'2P',"3"=>'3P'];
                            ?>
                            <?php echo e(Form::select('tipe',array('' => 'Pilih Tipe') +$tipe,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Status tipe Harus dipilih",'id'=>'module','parsley-error-container'=>'#etipe'])); ?>

                            <span class="col-md-12" id="etipe"></span>
                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::text('nosc_notid','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Tanggal WO</label>
                        <label class="progress-label col-md-6">Tanggal PS</label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::date('tgl_wo','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::date('tgl_ps','',['class'=>'form-control parsley-validated','id'=>'tgl_ps','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">TA Telkom</label>
                        <label class="progress-label col-md-6">Mitra TA</label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?
                                $tatelkom = Modules\tatelkom\models\Tatelkom::pluck("name","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_tatelkom',array('' => 'Pilih Data') +$tatelkom,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Data Harus dipilih",'id'=>'tatelkom','parsley-error-container'=>'#etatelkom'])); ?>

                            <span class="col-md-12" id="etatelkom"></span>
                        </div>

                        <div class="col-md-6">
                            <?
                                $mitraTa = Modules\mitraTa\models\MitraTa::pluck("nama_mitra","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_mitraTa',array('' => 'Pilih Mitra') +$mitraTa,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"mitraTa Harus dipilih",'id'=>'mitraTa','parsley-error-container'=>'#emitraTa'])); ?>

                            <span class="col-md-12" id="emitraTa"></span>

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Nama ODP</label>
                        <label class="progress-label col-md-6">SP(mtr)</label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::text('nama_odp','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::number('sp_mtr','',['class'=>'form-control parsley-validated','id'=>'sp_mtr','min=151','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">NDEM</label>
                        <label class="progress-label col-md-6">Biaya Per Meter</label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::text('ndem','',['class'=>'form-control parsley-validated','readonly','id'=>'ndem','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?
                                $biayaperm = Modules\biaya\models\Biaya::pluck('biaya',"_id")->toArray();
                            ?>
                            <?php echo e(Form::select('id_biaya',array('' => 'Pilih Biaya') +$biayaperm,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Biaya Harus dipilih",'id'=>'biayaperm','parsley-error-container'=>'#ebiayaperm'])); ?>

                            <span class="col-md-12" id="ebiayaperm"></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Kelebihan SP(mtr)</label>
                        <label class="progress-label col-md-6">Biaya Akhir</label>
                    </div>
                </div>


                <div class="form-group">
                     <div class="row col-md-12">
                        <div class="col-md-6">
                        <?php echo e(Form::text('sp_mtr_150','',['class'=>'form-control parsley-validated','id'=>'lebih_spmtr','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi','readonly'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::text('biaya_akhir','',['class'=>'form-control parsley-validated','id'=>'biaya_akhir','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi','readonly'])); ?>

                        </div>
                    </div>
                </div>
 <!-- --------------------------------------------------------------------------------------------------- -->
                <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                <?php echo e(Form::submit('Tambah Data PSB',['class'=>'btn btn-theme enableOnInput','id'=>'bpsbta','disabled'=>'disabled'])); ?>


                        <button type="reset" class="btn" id="reset"
                            onclick="$( '.psbta' ).trigger( 'click')">Back</button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </section>
    </div>
</div>
<script>

$(document).on('keyup','#no_inet',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    var uri = "<?php echo e(url('ajax/psbta/checkpsbtelkomd')); ?>";
        if(this.value.length == 12){
            var data = $('#no_inet').val();
            $.ajax({
                url:uri,
                data:{"data":data},
                type:"GET",
                success:function(result){
                    $('#ndem').val(result.ndem);
                    if(result.status === 0){
                        $('.enableOnInput').prop('disabled', true);
                    }
                }
            });
          $('.enableOnInput').prop('disabled', false);
    }else if(this.value.length != 12){
       $('#ndem').val('Data salah');
       $('.enableOnInput').prop('disabled', true);
    }
});

$(document).add('#sp_mtr').bind('keyup change','#biayaperm',function(e){
    var biaya_per_m = $('#biayaperm').val();
    var biayaperm = parseInt($('#biayaperm option[value="'+biaya_per_m+'"]').text());
    var sp_meter = parseInt($('#sp_mtr').val()) - 150;
    var biaya_akhir = sp_meter * biayaperm;
    $('#biaya_akhir').val(biaya_akhir);
});

$(document).add('#sp_mtr').bind('keyup change','#lebih_spmtr',function(e){
    var sp_meter = parseInt($('#sp_mtr').val());
    var lebih_spmtr = sp_meter -150;
    $('#lebih_spmtr').val(lebih_spmtr);
});


if ($.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent
        .toLowerCase()))) {
    $('body').removeClass('nav-collapse-in');
} else {
    $('body').addClass('nav-collapse-in');
}
$(function() {
    $("#fpsbta").submit(function(event) {
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
                        $(".psbta").trigger('click');
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
