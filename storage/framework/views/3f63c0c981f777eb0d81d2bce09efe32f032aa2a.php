<?php
$subslugs = $subslug;


$date = date('dmYHis');
$hsl = $date;
?>

<div id="content" style="padding-top: 0px;">
    <div class="row">
        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addpendaftaran"):''; ?>

        <section class="panel">
            <header class="panel-heading">
                <h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
                <label class="color"><?php echo $content->module_name; ?></label>
            </header>

            <div class="panel-body">
                <?php echo e(Form::open(array('url' => '/ajax/pendaftaran/addpendaftarand','class'=>'form-horizontal parsley-validated','id'=>'fpendaftaran'))); ?>



                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Kode Pendaftaran</label>
                        <label class="progress-label col-md-6">Nama Lengkap</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::text('kode_pendaftaran',$hsl,['class'=>'form-control parsley-validated','readonly','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::text('nama_lengkap','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Jenis Kelamin</label>
                        <label class="progress-label col-md-3">Tempat Lahir</label>
                        <label class="progress-label col-md-3">Tanggal Lahir</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php
                            $jenis_kelamin = ["1"=>'Laki-laki',"2"=>'Perempuan'];
                            ?>
                            <?php echo e(Form::select('jenis_kelamin',array('' => 'Pilih Jenis Kelamin') +$jenis_kelamin,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Status jenis_kelamin Harus dipilih",'id'=>'module','parsley-error-container'=>'#e'])); ?>

                            <span class="col-md-12" id="jenis_kelamin"></span>
                        </div>

                        <div class="col-md-3">
                            <?php echo e(Form::text('tempat_lahir','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>

                        <div class="col-md-3">
                            <?php echo e(Form::date('tgl_lahir','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Agama</label>
                        <label class="progress-label col-md-6">Alamat</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?
                                $agama = Modules\agama\models\Agama::pluck("agama","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_agama',array('0' => 'Pilih Agama') +$agama,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Agama Harus dipilih",'id'=>'agama','parsley-error-container'=>'#eagama'])); ?>

                            <span class="col-md-12" id="eagama"></span>
                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::text('alamat','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Sekolah Asal</label>
                        <label class="progress-label col-md-6">Tahun Ajaran</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <?php echo e(Form::text('asal_sekolah','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?
                                $tahun_ajaran = Modules\tahunajaran\models\Tahunajaran::pluck("tahun_ajaran","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_tahun_ajaran',array('0' => 'Pilih Tahun ajaran') +$tahun_ajaran,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Tahun ajaran Harus dipilih",'id'=>'tahun_ajaran','parsley-error-container'=>'#etahun_ajaran'])); ?>

                            <span class="col-md-12" id="etahun_ajaran"></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">Jurusan</label>
                        <label class="progress-label col-md-6">Nama Orang tua/Wali</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12">

                        <div class="col-md-6">
                            <?
                                $jurusan = Modules\jurusan\models\Jurusan::pluck("jurusan","_id")->toArray();
                             ?>
                            <?php echo e(Form::select('id_jurusan',array('0' => 'Pilih Jurusan') +$jurusan,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Jurusan Harus dipilih",'id'=>'jurusan','parsley-error-container'=>'#ejurusan'])); ?>

                            <span class="col-md-12" id="ejurusan"></span>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::text('nama_ortu','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important;">
                        <label class="progress-label col-md-6">No hp Orang tua/wali</label>
                        <label class="progress-label col-md-6">Alamat Orang tua/Wali</label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12">

                        <div class="col-md-6">
                            <?php echo e(Form::number('no_hp_ortu','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>

                        <div class="col-md-6">
                            <?php echo e(Form::text('alamat_ortu','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Data tidak boleh kosong'])); ?>

                        </div>
                    </div>
                </div>

                <!-- ----------------------------------------------------------------------------------------------- -->

                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12" style="height: 0px !important; margin-top: 25px;">
                        <label class="progress-label col-md-3">Kartu Keluarga</label>
                        <label class="progress-label col-md-3">Pas Photo</label>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">Pilih File</span><span
                                        class="fileinput-exists">Ganti</span>
                                    <input type="file" name="kartu_keluarga" id="kartu_keluarga"
                                        class="parsley-validated" parsley-required="true"
                                        parsley-required-message="Harap Upload Kartu Keluarga "
                                        parsley-filetype-message="Tipe File Yang Diupload Harus .Jpg / .png"
                                        parsley-filetype="jpg|png" parsley-error-container="#kartu_keluarga">
                                </span>
                                <span class="fileinput-filename">
                                    Pilih File
                                </span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                    style="float: none">&times;</a>
                            </div>
                            <span id="kartu_keluarga"></span>
                        </div>

                        <div class="row col-md-6">
                            <div class="col-md-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Pilih File</span><span
                                            class="fileinput-exists">Ganti</span>
                                        <input type="file" name="pasphoto" id="pasphoto" class="parsley-validated"
                                            parsley-required="true" parsley-required-message="Harap Upload Pas Photo"
                                            parsley-filetype-message="Tipe File Yang Diupload Harus .Jpg / .png"
                                            parsley-filetype="jpg|png" parsley-error-container="#pasphoto">
                                    </span>
                                    <span class="fileinput-filename">
                                        Pilih File
                                    </span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                        style="float: none">&times;</a>
                                </div>
                                <span id="pasphoto"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ----------------------------------------------------------------------------------------------- -->

                <div class="form-group offset">
                    <div class="col-md-offset-3 col-md-9">
                        <?php echo e(Form::submit('Tambah Calon Siswa',['class'=>'btn btn-theme','id'=>'bpendaftaran'])); ?>

                        <button type="reset" class="btn" id="reset"
                            onclick="$( '.pendaftaran' ).trigger( 'click')">Back</button>
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

$(function() {
    $('.selectpicker').selectpicker();
    $('form').parsley({
        validators: {
            filemaxsize: function() {
                return {
                    validate: function(val, max_megabytes, parsleyField) {
                        if (!Modernizr.fileapi) {
                            return true;
                        }

                        var $file_input = $(parsleyField.element);
                        if ($file_input.is(':not(input[type="file"])')) {
                            console.log(
                                "Validation on max file size only works on file input types"
                            );
                            return true;
                        }

                        var max_bytes = max_megabytes * BYTES_PER_MEGABYTE,
                            files = $file_input.get(0).files;

                        if (files.length == 0) {
                            // No file, so valid. (Required check should ensure file is selected)
                            return true;
                        }

                        return files.length == 1 && files[0].size <= max_bytes;
                    },
                    priority: 3
                };
            },
            filetype: function() {
                return {
                    validate: function(val, requirement) {
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

    $("#fpendaftaran").submit(function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        if ($(this).parsley('validate')) {
            var uri = $(this).attr('action');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: uri,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
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
                        $(".pendaftaran").trigger('click');
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
// --------------------------------------------------------------------------------------------- //
</script>