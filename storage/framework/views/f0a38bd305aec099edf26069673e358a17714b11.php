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
                <?php echo e(Form::open(array('url' => '/ajax/psbta/importpsbtad','class'=>'form-horizontal parsley-validated','id'=>'fpsbta'))); ?>



<div class="form-group">
    <?php echo e(Form::label('Import Data','',['class'=>'control-label col-md-3'])); ?>

    <div class="row col-md-9">
        <div class="col-md-10">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <span class="btn btn-default btn-file">
                <span class="fileinput-new">Pilih File</span><span class="fileinput-exists">Ganti</span>
                    <input type="file" name="file_import" id="file_import" class="parsley-validated"  parsley-filetype-message="Data yang Diupload harus xls atau xlsx" parsley-filetype="xlsx|xls" parsley-error-container="#file_import">
                </span>
                <span class="fileinput-filename">
                </span>
                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
            </div>
            <span id="file_import"></span>
        </div>
    </div>
</div>



                <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                        <?php echo e(Form::submit('Import Data',['class'=>'btn btn-theme','id'=>'bpsbta'])); ?>


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
if ($.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent
        .toLowerCase()))) {
    $('body').removeClass('nav-collapse-in');
} else {
    $('body').addClass('nav-collapse-in');
}

$(function(){
    $('form').parsley({
        validators: {
            filemaxsize: function() {
                return {
                    validate: function (val, max_megabytes, parsleyField) {
                        if (!Modernizr.fileapi) { return true; }
                        var file_input = $(parsleyField.element);
                        if (file_input.is(':not(input[type="file"])')) {
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

    $("#fpsbta").submit(function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
        if($(this).parsley( 'validate' )){
            var uri = $(this).attr('action');
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
                        $(".psbta").trigger('click');
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
