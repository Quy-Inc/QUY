<?php
$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addpsbTA"):''; ?>

        <section class="panel">
            <header class="panel-heading">
                <h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
                <label class="color"><?php echo $content->module_name; ?></label>
            </header>

            <div class="panel-body">
                <?php echo e(Form::open(array('url' => '/ajax/psbTA/addpsbTAd','class'=>'form-horizontal parsley-validated','id'=>'fpsbTA'))); ?>



                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">No</label>
                        <label class="progress-label col-md-6">Witel</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::text('no','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?
                                $witel = Modules\witel\models\Witel::pluck("nama_witel","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_witel',array('0' => 'Pilih Witel') +$witel,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"witel Harus dipilih",'id'=>'witel','parsley-error-container'=>'#ewitel'])); ?>

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
                            <?php echo e(Form::select('id_sto',array('0' => 'Pilih STO') +$sto,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"sto Harus dipilih",'id'=>'sto','parsley-error-container'=>'#esto'])); ?>

                            <span class="col-md-12" id="esto"></span>
                        </div>

                        <div class="col-md-6">
                            <?
                                $pek = Modules\pek\models\Pek::pluck("nama_pek","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_pek',array('0' => 'Pilih Pek') +$pek,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"pek Harus dipilih",'id'=>'pek','parsley-error-container'=>'#epek'])); ?>

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
                            <?php echo e(Form::select('tipe',array('' => 'Pilih Tipe') +$tipe,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Status tipe Harus dipilih",'id'=>'module','parsley-error-container'=>'#e'])); ?>

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
                            <?php echo e(Form::date('tgl_ps','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

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
                            <?php echo e(Form::text('ta_telkom','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?
                                $mitraTa = Modules\mitraTa\models\MitraTa::pluck("nama_mitra","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_mitraTa',array('0' => 'Pilih Mitra') +$mitraTa,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Mitra Harus dipilih",'id'=>'mitraTa','parsley-error-container'=>'#emitraTa'])); ?>

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
                            <?php echo e(Form::number('sp_mtr','',['class'=>'form-control parsley-validated','min=151','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>
                    </div>
                </div>



                <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                        <?php echo e(Form::submit('Add PSB TA',['class'=>'btn btn-theme','id'=>'bpsbTA'])); ?>


                        <button type="reset" class="btn" id="reset"
                            onclick="$( '.psbTA' ).trigger( 'click')">Back</button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </section>
    </div>
</div>

<script>
$(function() {
    $("#fpsbTA").submit(function(event) {
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
                        $(".psbTA").trigger('click');
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