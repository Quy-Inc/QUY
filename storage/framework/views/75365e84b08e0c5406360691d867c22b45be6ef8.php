<?
$id = request('data');
$Detail = new \Modules\psbta\models\Psbta;
$getDetail = $Detail::where("_id",$id)
                ->with('witel')
                ->with('stodata')
                ->with('pek')
                ->with('mitra')
                ->with('telkom_')
                ->with('biaya_')
                ->get()->first();
?>
<style>
.panel-heading {
    font-weight: bold;
}

span.text {
    display: inline-block;
    width: 50%;
    font-weight: bold;
}
</style>


<?php echo e(Form::open(array('url' => '/ajax/psbAOM/detailpsbAOMd','class'=>'form-horizontal','id'=>'fdetailpsbAOM'))); ?>

<?php echo e(Form::hidden("idpsbAOM",$id)); ?>


<div class="row">
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Data PSB</div>
            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="text">NO INET</span> :
                    <?php echo e($getDetail->no_inet); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Witel</span> :
                    <?php echo e($getDetail->witel->nama_witel); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">STO</span> :
                    <?php echo e($getDetail->stodata->nama_sto); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Pek</span> :
                    <?php echo e($getDetail->pek->nama_pek); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Mitra TA</span> :
                    <?php echo e($getDetail->mitra->nama_mitra); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">NOsc NoTID</span> :
                    <?php echo e($getDetail->nosc_notid); ?>

                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Data PSB</div>
            <!-- List group -->
            <ul class="list-group">

                <li class="list-group-item">
                    <span class="text">Tanggal WO</span> :
                    <?php echo e($getDetail->tgl_wo->format('d-M-Y')); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Tanggal PS</span> :
                    <?php echo e($getDetail->tgl_ps->format('d-M-Y')); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">TA Telkom</span> :
                    <?php echo e($getDetail->telkom_->name); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Nama ODP</span> :
                    <?php echo e($getDetail->nama_odp); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">SP (mtr)</span> :
                    <?php echo e($getDetail->sp_mtr); ?>

                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Data PSB</div>
            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="text">NDEM</span> :
                    <?php echo e($getDetail->ndem); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Biaya Per Meter</span> :
                    <?php echo e(number_format($getDetail->biaya_->biaya ,0,".",".")); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">SP > 150</span> :
                    <?php echo e($getDetail->sp_mtr-150); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Biaya</span> :
                    <?php echo e(number_format(($getDetail->biaya_->biaya)*($getDetail->sp_mtr-150),0,".",".")); ?>

                </li>

                <li class="list-group-item">
                    <span><b>Document</b></span>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-default btn-file">
                            <span class="fileinput-new">Pilih File</span><span class="fileinput-exists">Ganti</span>
                                <input type="file" name="document" class="parsley-validated"  parsley-filetype-message="Dokumen ini tidak bisa diupload" parsley-filetype="pdf|docx|doc|xlsx|xls|jpg|png" parsley-error-container="#edocument">
                            </span>
                            <span class="fileinput-filename">
                            <?php if($getDetail->document !=null): ?>
                                <a href='<?php echo e(url('/public/files')); ?>/<?php echo e($getDetail->document); ?>'target='_blank'>Document</a>
                            <?php endif; ?>
                            </span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                        </div>
                        <span id="edocument"></span>
                </li>

                <li class="list-group-item">
                    <?php echo e(Form::submit('Upload',['class'=>'btn btn-theme','id'=>'beditpsbAOM'])); ?>

                </li>
            </ul>
        </div>
    </div>
</div>

<?php echo e(Form::close()); ?>


<script>

$(function(){
    $('form').parsley({
        validators: {
            filemaxsize: function() {
                return {
                    validate: function (val, max_megabytes, parsleyField) {
                        if (!Modernizr.fileapi) { return true; }
                        var file_input = $(parsleyField.element);
                    if (file_input.is(':not(input[type=])')) {
                            console.log("Validation on max file size only works on file input types");
                            return true;
                        }
                        var max_bytes = max_megabytes * BYTES_PER_MEGABYTE, files = file_input.get(0).files;
                        if (files.length == 0) {
                            // No file, so valid. (Required check should ensure file is selected)
                            return true;
                        }
                        return files.length == 1  && files[0].size <= max_bytes;
                    },
                    priority: 3
                    };
                    },
                    filetype: function() {
                        return {
                    validate: function (val, requirement) {
                        var fileExtension = val.split('.').pop();
                        var fileExtensionExplode = requirement.split('|');
                        var checkExt = fileExtensionExplode.indexOf(fileExtension);
                        return fileExtension === fileExtensionExplode[checkExt];
                    },
                    priority: 2
                    };
                }
            },
            messages: {
                filetype: "The File Type not Allowed.",
                requiredfile: "File Required"
            },
        excluded: 'input[type=hidden], :disabled'
    });
    $("#fdetailpsbAOM").submit(function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
        if($(this).parsley( 'validate' )){
            var uri = $(this).attr('action');
            var $modaldetail = $('#md-full-width');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: uri,
                type: 'POST',
                    data:formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function (e) {
                    if (e.status == 0) {
                        $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
                    }else{
                        $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
                        $modaldetail.modal('hide');
                        $(".psbAOM").trigger('click');

                    }
                }
            });
        }else{
            $.notific8('',{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
            return false;
        }
    });
});

</script>