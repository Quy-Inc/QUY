<?php
$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <!-- <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addsiswa"):''; ?> -->
        <section class="panel">
            <header class="panel-heading">
                <h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
                <label class="color"><?php echo $content->module_name; ?></label>
            </header>

            <div class="panel-body">
                <?php echo e(Form::open(array('url' => '/ajax/siswa/addsiswad','class'=>'form-horizontal parsley-validated','id'=>'fsiswa'))); ?>



                <div class="form-group">
                    <?php echo e(Form::label('Nama Siswa','',['class'=>'control-label col-md-3'])); ?>

                    <div class="row col-md-9">
                        <div class="col-md-6">
                            <?php echo e(Form::text('nama','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Nama siswa harus diisi'])); ?>

                        </div>
                    </div>
                </div>





                <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                        <?php echo e(Form::submit('Add Siswa',['class'=>'btn btn-theme','id'=>'bsiswa'])); ?>


                        <button type="reset" class="btn" id="reset"
                            onclick="$( '.siswa' ).trigger( 'click')">Back</button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </section>
    </div>
</div>