<?php
$subslugs = $subslug;
$id = Ozn::hashID_decode($data);
$modul = new \Modules\psbMarketing\models\PsbMarketing;
$datamodul = $modul::where("_id",$id)->get()->first();
?>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <!-- <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"edituser"):''; ?> -->
        <section class="panel">
            <header class="panel-heading">
                <h2>DATA PSB MARKETING</h2>
                <!-- <h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2> -->
                <!-- <label class="color"><?php echo $content->module_name; ?></label> -->
            </header>

            <div class="panel-body">
                <?php echo e(Form::open(array('url' => '/ajax/psbMarketing/editpsbMarketingd','class'=>'form-horizontal','id'=>'feditpsbMarketing'))); ?>

                <?php echo e(Form::hidden("idpsbMarketing",$id)); ?>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">No INET</label>
                        <label class="progress-label col-md-6">NDEM</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::text('no_inet','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::text('ndem','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                            <span class="col-md-12" id="ewitel"></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Biaya per Meter</label>
                        <label class="progress-label col-md-6">Biaya</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::number('biaya_per_m','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::number('biaya','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                            <span class="col-md-12" id="ewitel"></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Keterangan</label>
                        <label class="progress-label col-md-6">Tindak Lanjut</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::textarea('keterangan','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus Diisi'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::submit('Approved',['class'=>'btn btn-success','id'=>'beditpsbMarketing'])); ?>



                            <!-- <?php echo e(Form::submit('Not Approved',['class'=>'btn btn-danger','id'=>'bpsbMarketing'])); ?> -->
                        </div>
                    </div>
                </div>


                <!-- <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                        <?php echo e(Form::submit('Update PsbMarketing',['class'=>'btn btn-theme','id'=>'beditpsbMarketing'])); ?>


                        <button type="reset" class="btn" id="reset"
                            onclick="$( '.psbMarketing' ).trigger( 'click')">Back</button>
                    </div>
                </div> -->


                <?php echo e(Form::close()); ?>

            </div>
        </section>
    </div>
</div>
<script>
$(function() {
    $("#feditpsbMarketing").submit(function(event) {
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
                        $(".psbMarketing").trigger('click');
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