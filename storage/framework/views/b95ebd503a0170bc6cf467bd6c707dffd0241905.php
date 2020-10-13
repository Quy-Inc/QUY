<link href="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>">
</script>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datable/dataTables.bootstrap.js'); ?>"></script>
<div id="content" style="padding-top: 0px;">
    <div class="row">
        <?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,'lop'):''; ?>

        <section class="panel">
            <header class="panel-heading">
                <h2><?php echo $content->module_name; ?> </h2>
            </header>

            <div class="panel-body" style="padding-top: 0px;">
                <?
								switch (Auth::user()->id_profile) {
								case '1':
									$witel = Modules\witel\models\Witel::pluck("nama_witel","_id")->toArray();
								break;
								case '8':
									$witel = Modules\witel\models\Witel::pluck("nama_witel","_id")->toArray();
									break;
								case '6':
									$witel = Modules\witel\models\Witel::pluck("nama_witel","_id")->toArray();
									break;
								default:
									$witel = Modules\witel\models\Witel::where("_id",Auth::user()->id_witel)->pluck("nama_witel","_id")->toArray();
									break;
							}
								
							?>
                <form class="form-horizontal filterLop" id="filterLop">
                    <div class="row" style="margin-top: 35px;">


                        <?php switch(Auth::user()->id_profile):
                        case ("1"): ?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_witel',array(""=>"All Witel")+$witel,(request('id_witel'))?request('id_witel'):'',['class'=>'form-control selectpicker','data-live-search'=>'true','data-limit'=>'10','id'=>'id_witel',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <?php break; ?>
                        <?php case ("8"): ?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_witel',array(""=>"All Witel")+$witel,(request('id_witel'))?request('id_witel'):'',['class'=>'form-control selectpicker','data-live-search'=>'true','data-limit'=>'10','id'=>'id_witel',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <?php break; ?>

                        <?php case ("6"): ?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_witel',array(""=>"All Witel")+$witel,(request('id_witel'))?request('id_witel'):'',['class'=>'form-control selectpicker','data-live-search'=>'true','data-limit'=>'10','id'=>'id_witel',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <?php break; ?>

                        <?php default: ?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_witel',$witel,(request('id_witel'))?request('id_witel'):'',['class'=>'form-control selectpicker','data-live-search'=>'true','data-limit'=>'10','id'=>'id_witel',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <?php break; ?>
                        <?php endswitch; ?>


                        <?
										$segmen = Modules\segmen\models\Segmen::pluck("nama_segmen","_id")->toArray();
									?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_segmen',array(""=>"All Segmen")+$segmen,(request('id_segmen'))?request('id_segmen'):'',['class'=>'form-control selectpicker','data-live-search'=>'true','data-limit'=>'10','id'=>'id_segmen',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_subsegmen',array(""=>"All Subsegmen"),(request('id_segmen'))?request('id_segmen'):'',['class'=>'form-control selectpicker','data-show-subtext'=>'true','data-live-search'=>'true','data-limit'=>'10','id'=>'id_subsegmen',"style"=>"margin-right:15px;"])); ?>

                        </div>

                        <?
										$id_status_ticares = Modules\statustcares\models\Statustcares::orderBy('sort','asc')->pluck("status_tcares","_id")->toArray();
									?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_status_ticares[]',$id_status_ticares,'',['class'=>'form-control','data-live-search'=>'false','data-limit'=>'10','id'=>'id_status_ticares',"style"=>"margin-right:15px;","multiple"=>'multiple'])); ?>

                        </div>


                        <button class="btn btn-sm btn-success filter" type="submit">Filter</button>
                        <button class="btn btn-sm btn-primary saf">Show Advance Filter</button>
                        <button class="btn btn-sm btn-inverse safh clearf hide" type="button">Clear Filter</button>
                        <button class="btn btn-sm btn-theme-inverse exportexcel">Excel &nbsp;<i
                                class="fa fa-download"></i></button>
                    </div>
                    <div class="row" style="margin-top: 10px;" class="safh hide"></div>
                    <div class="row" class="safh hide">

                        <?php if(Auth::user()->id_profile == 4 || Auth::user()->id_profile == 5 || Auth::user()->id_profile
                        == 7 ): ?>
                        <?

										$accman = Modules\lop\models\AccountManager::where("id_witel",Auth::user()->id_witel)->where("id_profile","4")->pluck("name","_id")->toArray();

										
										?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_am',array(""=>"All Account Mananger")+$accman,'',['class'=>'form-control safh hide selectpicker','data-live-search'=>'true','data-limit'=>'10','id'=>'id_am',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <?php else: ?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_am',array(""=>"All Account Mananger"),'',['class'=>'form-control safh hide selectpicker','data-live-search'=>'true','data-limit'=>'10','id'=>'id_am',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <?php endif; ?>
                        <div class="col-lg-2">
                            <?
										$tgl_req="";
										if(request('start_date') && request('end_date')){
											$tgl_req = request('start_date')." - ".request('end_date');
										}else if(request('daterange'))
										{
											//$tgl_req = str_replace("+"," ", request('daterange'));
											$tgl_req = urldecode(request('daterange'));
										}
										?>
                            <input type="text" class="form-control safh hide" name="daterange" id="daterange" readonly
                                placeholder="Tanggal Mulai Tagih" style="margin-right:15px;" value="<?php echo e($tgl_req); ?>" />
                        </div>

                        <div class="col-lg-2">
                            <input type="text" class="form-control safh hide" name="noncxp" id="nonxcp"
                                placeholder="No NCX / Nama Pelanggan" style="margin-right:15px;" />
                        </div>

                        <?
									$tingkatkeyakinan = Modules\tingkatkeyakinan\models\Tingkatkeyakinan::pluck("tingkat_keyakinan","_id")->toArray();
									?>
                        <div class="col-lg-2">
                            <?php echo e(Form::select('id_tingkatkeyakinan',array(""=>"All Tingkat Keyakinan")+$tingkatkeyakinan,(request('id_tingkatkeyakinan'))?request('id_tingkatkeyakinan'):'',['class'=>'form-control tingkatkeyakinan safh hide selectpicker', 'data-live-search'=>'true','data-limit'=>'10',"style"=>"margin-right:15px;"])); ?>

                        </div>
                        <?
									$mitra = Modules\mitra\models\Mitra::pluck("nama_mitra","_id")->toArray();
									?>

                        <div class="col-lg-2" style="padding-left: 0px; !important;">
                            <?php echo e(Form::select('id_mitra',array(""=>"All Mitra")+$mitra,(request('id_mitra'))?request('id_mitra'):'',['class'=>'form-control mitra safh hide selectpicker', 'data-live-search'=>'true','data-limit'=>'10',"style"=>"margin-right:15px;"])); ?>

                        </div>

                    </div>
                    <div class="row safh hide" style="margin-top: 10px;"></div>
                    <div class="row safh hide">
                        <div class="col-lg-9">
                            <ul class="iCheck safh hide" data-color="green">
                                <li>
                                    <input type="checkbox" name="topp" id="topp" value="topp"
                                        <?php echo e((request('topp')=="on")?'checked':''); ?>>
                                    <label>Top 10 LOP</label>
                                </li>

                                <li>
                                    <input type="checkbox" name="bigp_" id="bigp" value="bigp_"
                                        <?php echo e((request('big_project')=="on")?'checked':''); ?>>
                                    <label>Big Project</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="kom_" id="kom_" value="kom_"
                                        <?php echo e((request('komitmen')=="on")?'checked':''); ?>>
                                    <label>Komitmen</label>
                                </li>

                                <li>
                                    <input type="checkbox" name="winpro" id="winpro" value="winpro"
                                        <?php echo e((request('winpro')=="on")?'checked':''); ?>>
                                    <label>Win Project</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="locked" id="locked" value="locked"
                                        <?php echo e((request('locked')=="on")?'checked':''); ?>>
                                    <label>Belum Di Verifikasi</label>
                                </li>
                            </ul>

                        </div>
                        <?
										$wtgl_req="";
										if(request('wstart_date') && request('wend_date')){
											$wtgl_req = request('wstart_date')." - ".request('wend_date');
										}else if(request('wdaterange'))
										{
											//$tgl_req = str_replace("+"," ", request('daterange'));
											$wtgl_req = urldecode(request('wdaterange'));
										}
										?>
                        <div class="col-lg-2 wdate <?php echo e(($wtgl_req =="")?"hide":""); ?>">

                            <input type="text" class="form-control safh <?php echo e(($wtgl_req =="")?"hide":""); ?>"
                                name="wdaterange" id="wdaterange" readonly placeholder="Tanggal Kontrak"
                                style="margin-right:15px;" value="<?php echo e($wtgl_req); ?>" />
                        </div>
                    </div>
                </form>
                </table>
                <table class="table table-striped" id="tlop">
                    <thead>
                        <tr>
                            <th>Witel/Segmen/Sub Segmen</th>
                            <th>Account Mananger</th>
                            <th>Pelanggan</th>
                            <th>Nama Kontrak</th>
                            <th>Nilai Kontrak</th>
                            <th>Billcom NET</th>
                            <th>No Order NCX</th>
                            <th>Status Order NCX</th>
                            <th>Nama Mitra</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<script>
$(function() {

    $("body").addClass('nav-collapse-in');
    $('.selectpicker').selectpicker();
    $('#id_status_ticares').selectpicker('selectAll');
    <?php

    if (request('id_statustcares')) {
        $idstatustcaresR = explode(",", request('id_statustcares'));
        /*echo "<pre>"; print_r($idstatustcaresR); echo "</pre>";
        echo "<pre>"; print_r($id_status_ticares); echo "</pre>";*/
        $idstatustcares = [];
        if (count($idstatustcaresR) != 0) {
            echo "$('#id_status_ticares').selectpicker('deselectAll');";
            foreach($idstatustcaresR as $val) {
                $idstatustcares[] = "'".$val.
                "'";
            }

            $selectVal = join(",", $idstatustcares);
            echo "$('#id_status_ticares').selectpicker('val', [$selectVal]);";
        }

        //echo "<pre>"; print_r($idstatustcares); echo "</pre>";
    }

    ?>


    $('#tlop').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        pageLength: 10,
        ajax: {
            url: '<?php echo url("/ajax/lop/getlop"); ?>',

            data: function(d) {

                param = $('#filterLop').serializeArray();
                paramDownload = $('#filterLop').serialize();
                filterClick = $.cookie('filterClick');
                if (filterClick == 1) {
                    //console.log("oc1");
                    $.cookie('cookieFilter', JSON.stringify(param));
                    storedCookieFilter = JSON.parse($.cookie('cookieFilter'));
                    $.cookie('cookieFilterDownload', paramDownload);
                    $.cookie('filterClick', null);
                    d.form = storedCookieFilter;
                } else {
                    $.cookie('cookieFilterDownload', paramDownload);
                    storedCookieFilter = JSON.parse($.cookie('cookieFilter'));
                    from = "<?php echo e((request('from')=='report')?1:0); ?>";
                    if (storedCookieFilter != null && from == 0) {
                        d.form = storedCookieFilter;
                    } else {
                        if (from == 1) {
                            //$(".saf").trigger("click");
                            var fileterSaf = $(".saf");
                            $(".safh").removeClass("hide");
                            fileterSaf.removeClass("saf");
                            fileterSaf.addClass("haf");
                            fileterSaf.html("Hide Advance Filter");

                        }
                        $.cookie('cookieFilter', JSON.stringify(param));
                        d.form = param;
                    }

                }
            }

        },
        "columns": [{
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "*",
                "className": "dt-left",
                "sortable": false
            },
            {
                "width": "17%",
                "className": "dt-center",
                "sortable": false
            }
        ]
    });



    function getSubSegmen(id_segmen, selected = "", callback = false) {
        //var id_segmen = $(this).val();
        $.ajax({
            url: "<?php echo e(url('ajax/lop/getSubSegmen')); ?>",
            data: {
                "id_segmen": id_segmen
            },
            type: "GET",
            dataType: 'json',
            success: function(e) {
                var option = "<option value=''>All Subsegmen</option>";
                $("#subsegmen").attr('disabled', 'disabled');
                $.each(e, function(index, value) {
                    subtext = value.keterangan;
                    subtext = subtext.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    selected_ = (selected == value._id) ? "selected" : "";
                    option = option + "<option value='" + value._id + "' data-subtext='" +
                        subtext + "' " + selected_ + ">" + value.nama_subsegmen +
                        "</option>";
                });

                $("#id_subsegmen").html(option);
                $("#id_subsegmen").removeAttr("disabled");
                $("#id_subsegmen").selectpicker('refresh');
                if (callback == true) {
                    $('#tlop').DataTable().ajax.reload();
                }
            }
        });
    }


    $("#id_segmen").on("change", function() {
        var id_segmen = $(this).val();
        getSubSegmen(id_segmen);
    });


    $("#id_witel").on("change", function() {
        var id_witel = $(this).val();
        var option = "<option value=''>All Account Mananger</option>";
        $("#id_am").attr('disabled', 'disabled');
        $.ajax({
            url: "<?php echo e(url('ajax/lop/getAccman')); ?>",
            data: {
                "id_witel": id_witel
            },
            type: "GET",
            dataType: 'json',
            success: function(e) {
                $.each(e, function(index, value) {
                    option = option + "<option value='" + index + "'>" + value +
                        "</option>";
                });

                $("#id_am").html(option);
                $("#id_am").removeAttr("disabled");
                $("#id_am").selectpicker('refresh');

            }
        });
    });

    $('#daterange').daterangepicker();
    $('#wdaterange').daterangepicker();

    $(".filterLop").on('submit', function(e) {
        e.preventDefault();
        $.cookie('filterClick', 1);
        console.log("submit log");
        //$.cookie('cookieFilterDownload', null);
        $('#tlop').DataTable().ajax.reload();
        //console.log($(".filterLop").serialize());
    });

    $(document).on("click", ".saf", function(e) {

        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        $(".safh").removeClass("hide");
        $(this).removeClass("saf");
        $(this).addClass("haf");
        $(this).html("Hide Advance Filter");

        return false;
    });

    /*	
    var daterange = $("#daterange");
    var instance = daterange.data('daterangepicker');
    var container = instance.container;
    container.remove();
    */

    $("#winpro").on('ifChecked', function(e) {
        e.preventDefault()
        e.stopPropagation();
        e.stopImmediatePropagation();
        //console.log('checkbox');
        $(".wdate").removeClass('hide');
        $("#daterange").val('');
        //$("#daterange").addClass('hide');


    });

    $("#winpro").on('ifUnchecked', function(e) {
        e.preventDefault()
        e.stopPropagation();
        e.stopImmediatePropagation();
        //console.log('uncheckbox');
        $(".wdate").addClass('hide');
        $("#daterange").val('');
        //$("#daterange").removeClass('hide');
        //$('daterange').daterangepicker('refresh');
        $("#wdaterange").val('');
    });

    $(document).on("click", ".clearf", function(e) {
        e.preventDefault();
        $('#filterLop').find('input:text, input:password, select, textarea').val('');
        $('#filterLop').find('input:radio, input:checkbox').prop('checked', false);
        $('.iCheck input').iCheck('destroy');
        createiCheck();
        $('#filterLop').trigger("submit");
    });

    $(document).on("click", ".haf", function(e) {
        e.preventDefault();
        $(".safh").addClass("hide");
        $(this).addClass("saf");
        $(this).removeClass("haf");
        $(this).html("Show Advance Filter");
    });

    function getVal(id) {
        return $('#' + id).val();
    }

    $(document).on("click", ".exportexcel", function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        dataExport = ($.cookie('cookieFilterDownload') == null) ? $("#filterLop").serialize() : $
            .cookie('cookieFilterDownload');
        uri = "<?php echo e(url('download/lop')); ?>?" + dataExport;
        //console.log(uri);
        window.open(uri);
        return false;

    });

    <?php
    if (request('id_segmen') != null && request('id_subsegmen') != null) {
        echo "
        getSubSegmen('".request('
            id_segmen ')."', '".request('
            id_subsegmen ')."', true);
        ";


    }
    elseif(request('id_segmen') != null && request('id_subsegmen') == null) {
        echo "
        getSubSegmen('".request('
            id_segmen ')."', '', true);
        ";
    }
    ?>

});






$.ajaxSetup({
    // Disable caching of AJAX responses
    cache: false
});

//Delete Confirm
var $modal = $('#md-normal');
$(document).on('click', '.showmodaldel', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    $modal.find(".modal-title").html("Hapus List Of Project");
    $modal.find(".modal-body").html("Anda yakin akan menghapus List Of Project ini?");
    $modal.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-danger  yesdellop" valueajax="' +
        valueid + '" >Setuju</button>');
    $modal.modal('show');
});

var $modaldetail = $('#md-full-width');
$(document).on('click', '.showmodaldetail', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');


    $.ytLoad();
    $modaldetail.find(".modal-body").html("Loading..");
    var uri = "<?php echo url('lop/detaillop'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': valueid,
            'noheader': 'on'
        },
        type: "GET",
        success: function(result) {

            $modaldetail.find(".modal-body").html(result);
        }
    });

    $modaldetail.find(".modal-title").html("Detail LoP");
    $modaldetail.find(".modal-footer").html(
        '<button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Tutup</button><button type="button" class="btn btn-warning  editlop" valueajax="' +
        valueid + '" >Edit LoP</button>');
    $modaldetail.modal('show');
});



//Deleted Data
$(document).on('click', '.yesdellop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var valueid = $(this).attr('valueajax');
    var $modal = $('#md-normal');

    $.ytLoad();
    var uri = "<?php echo url('ajax/lop/deletelopd'); ?>";
    $.ajax({
        url: uri,
        data: {
            'data': valueid,
            '_token': "<?php echo e(csrf_token()); ?>"
        },
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
                $(".lop").trigger('click');

            }
            $modal.modal('hide');
        }
    });
});

var createiCheck = (function() {
    $('.iCheck').each(function(i) {
        var data = $(this).data(),
            input = $(this).find("input"),
            li = $(this).find("li"),
            index = "cp" + i,
            insert_text,
            iCheckColor = ["black", "red", "green", "blue", "aero", "grey", "orange", "yellow", "pink",
                "purple"
            ],
            callCheck = data.style || "flat";
        if (data.color && data.style !== "polaris" && data.style !== "futurico") {
            hasColor = jQuery.inArray(data.color, iCheckColor);
            if (hasColor != -1 && hasColor < iCheckColor.length) {
                callCheck = callCheck + "-" + data.color;
            }
        }
        input.each(function(i) {
            var self = $(this),
                label = $(this).next(),
                label_text = label.html();
            self.attr("id", "iCheck-" + index + "-" + i);
            if (data.style == "line") {
                insert_text = '<div class="icheck_line-icon"></div><span>' + label_text +
                    '</span>';
                label.remove();
                self.iCheck({
                    checkboxClass: 'icheckbox_' + callCheck,
                    radioClass: 'iradio_' + callCheck,
                    insert: insert_text
                });
            } else {
                label.attr("for", "iCheck-" + index + "-" + i);
            }
        });
        if (data.style !== "line") {
            input.iCheck({
                checkboxClass: 'icheckbox_' + callCheck,
                radioClass: 'iradio_' + callCheck
            });
        } else {
            li.addClass("line");
        }
    });
});
createiCheck();

$('.iCheckColor li').click(function() {
    var self = $(this);
    if (!self.hasClass('active')) {
        self.siblings().removeClass('active');
        var color = self.attr('class');
        $('.iCheck').each(function(i) {
            $(this).data("color", color)
        });
        $('.iCheck input').iCheck('destroy');
        createiCheck();
        self.addClass('active');
    };
});

$('.ios-switch .switch').each(function(i) {
    $(this).addClass("ios");
});
$('.ios').bootstrapSwitch('setOnLabel', '');
$('.ios').bootstrapSwitch('setOffLabel', '');


//////////     ICHECK     //////////
$(".ios-switch input:checkbox").change(function() {
    var targetLabel = $(this).parents('li').find("label span");
    if ($(this).is(':checked')) {
        targetLabel.text("ON");
    } else {
        targetLabel.text("OFF");
    }
});
</script>

<style>
small.muted.text-muted {
    font-style: italic !important;
    font-weight: 800 !important;
}

th.dt-center,
td.dt-center {
    text-align: center;
}

th.dt-left,
td.dt-left {
    text-align: left;
}

ul.iCheck {
    display: inline-block;
}

ul.iCheck li {
    display: inline-block;
    width: auto;
    margin-right: 52px;
}

.dt-button {
    position: absolute;
    top: 0px;
    z-index: 99999;
    right: 80px;
    margin-top: 15px;
}
</style>