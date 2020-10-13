<?php
$subslugs = $subslug;
?>


<?php echo e(Form::open(array('url' => '/ajax/psbMarketing/detailpsbMarketingd','class'=>'form-horizontal parsley-validated','id'=>'fpsbMarketing'))); ?>

<h1> DATA PSB </h1>
<br>
<div class="row">
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
</div>
<br>
<div class="row">
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
</div>
<br>
<div class="row">
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
                <?php echo e(Form::submit('Approved',['class'=>'btn btn-success','id'=>'bpsbMarketing'])); ?>

                <!-- <?php echo e(Form::submit('Not Approved',['class'=>'btn btn-danger','id'=>'bpsbMarketing'])); ?> -->
            </div>
        </div>
    </div>
</div>
<br>
<?php echo e(Form::close()); ?>

<script>
$(function() {
    $("#fpsbMarketing").submit(function(event) {
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