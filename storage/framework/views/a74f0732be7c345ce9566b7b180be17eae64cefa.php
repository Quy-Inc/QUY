<?php
$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <section class="panel">
            <header class="panel-heading">
                <h2>Data</h2>
                <label class="color"> Data 1</label>
            </header>

            <div class="panel-body">
                <?php echo e(Form::open(array('url' => '/ajax/psbmarketing/detailpsbmarketingd','class'=>'form-horizontal parsley-validated','id'=>'fpsbmarketing'))); ?>


                <div class="form-group">
                    <?php echo e(Form::label('Keterangan','',['class'=>'control-label col-md-3'])); ?>

                    <div class="row col-md-9">
                        <div class="col-md-6">
                            <?php echo e(Form::textarea('keterangan','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data harus diisi'])); ?>

                        </div>
                    </div>
                </div>


                <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                        <?php echo e(Form::submit('Approve',['class'=>'btn btn-success','id'=>'bpsbmarketing'])); ?>


                        <button type="reset" class="btn" id="reset"
                            onclick="$( '.psbmarketing' ).trigger( 'click')">Back</button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </section>
    </div>
</div>

<script>
$(function() {
    $("#fpsbmarketing").submit(function(event) {
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
                        $(".psbmarketing").trigger('click');
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