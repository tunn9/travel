<script type="text/javascript">
    $(function () {
        var cheapflight_id = $("#cheapflight_id").val();
        $(".submitfrm").click(function () {
            var submitType = $(this).prop('id');
            for (instance in CKEDITOR.instances) {

                CKEDITOR.instances[instance].updateElement();

            }
            $(".output").html("");
            $('html, body').animate({

                scrollTop: $('body').offset().top

            }, 'slow');
            if (submitType == "add") {
                url = "<?php echo base_url();?>admin/cheapflight/add";

            } else {
                url = "<?php echo base_url();?>admin/cheapflight/edit/" + cheapflight_id;

            }

            $.post(url, $(".offer-form").serialize(), function (response) {
                if ($.trim(response) != "done") {
                    $(".output").html(response);
                } else {
                    window.location.href = "<?php echo base_url() . "admin/cheapflight/"?>";
                }

            });

        })


    })
</script>

<div class="output"></div>
<form action="" method="POST" class="offer-form" onsubmit="return false;">
    <div class="panel panel-default">

        <div class="panel-heading"><?php echo $headingText; ?></div>

        <!--        <ul class="nav nav-tabs nav-justified" role="tablist">-->
        <!--            <li class="active"><a href="#GENERAL" data-toggle="tab">-->
        <?php //echo trans('0169'); ?><!--</a></li>-->
        <!--        </ul>-->
        <div class="panel-body">
            <div class="panel-body">

                <br>
                <div class="tab-content form-horizontal">
                    <div class="tab-pane wow fadeIn animated active in" id="GENERAL">

                        <div class="clearfix"></div>

                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left"><?php echo trans('0181'); ?></label>
                            <div class="col-md-4">
                                <input name="title" type="text" placeholder="<?php echo trans('0181'); ?>"
                                       class="form-control" value="<?php echo @$cheapflightdata[0]->title; ?>"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left"><?php echo trans('0182'); ?></label>
                            <div class="col-md-2">
                                <input name="startpoint" type="text" placeholder="<?php echo trans('0182'); ?>"
                                       class="form-control" value="<?php echo @$cheapflightdata[0]->startpoint; ?>"/>
                            </div>
                            <label class="col-md-2 control-label text-left"><?php echo trans('0183'); ?></label>
                            <div class="col-md-2">
                                <input name="endpoint" type="text" placeholder="<?php echo trans('0183'); ?>"
                                       class="form-control" value="<?php echo @$cheapflightdata[0]->endpoint; ?>"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left"><?php echo trans('0184'); ?></label>
                            <div class="col-md-2">
                                <input name="godate" type="text" placeholder="<?php echo trans('0184'); ?>"
                                       class="form-control dpd1" value="<?php echo $godate; ?>"/>
                            </div>
                            <label class="col-md-2 control-label text-left"><?php echo trans('0185'); ?></label>
                            <div class="col-md-2">
                                <input name="comebackdate" type="text" placeholder="<?php echo trans('0185'); ?>"
                                       class="form-control dpd1" value="<?php echo $comebackdate; ?>"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left"><?php echo trans('0186'); ?></label>
                            <div class="col-md-2">
                                <input name="adt" type="numbers" placeholder="<?php echo trans('0186'); ?>"
                                       class="form-control" value="<?php echo @$cheapflightdata[0]->adt; ?>"/>
                            </div>
                            <label class="col-md-2 control-label text-left"><?php echo trans('0187'); ?></label>
                            <div class="col-md-2">
                                <input name="chd" type="numbers" placeholder="<?php echo trans('0187'); ?>"
                                       class="form-control" value="<?php echo @$cheapflightdata[0]->chd; ?>"/>
                            </div>
                            <label class="col-md-2 control-label text-left"><?php echo trans('0188'); ?></label>
                            <div class="col-md-2">
                                <input name="inf" type="numbers" placeholder="<?php echo trans('0188'); ?>"
                                       class="form-control" value="<?php echo @$cheapflightdata[0]->inf; ?>"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left"><?php echo trans('0189'); ?></label>
                            <div class="col-md-2">
                                <select data-placeholder="Select" class="form-control" name="type">
                                    <option value="<?php echo $cheapflight_type[0]; ?>" <?php if (@$cheapflightdata[0]->type == $cheapflight_type[0]) {
                                        echo "selected";
                                    } ?> ><?php echo $cheapflight_type[0]; ?></option>
                                    <option value="<?php echo $cheapflight_type[1]; ?>" <?php if (@$cheapflightdata[0]->type == $cheapflight_type[1]) {
                                        echo "selected";
                                    } ?> ><?php echo $cheapflight_type[1]; ?></option>
                                </select>
                            </div>
                            <label class="col-md-2 control-label text-left"><?php echo trans('0190'); ?></label>
                            <div class="col-md-2">
                                <input name="price" type="numbers" placeholder="<?php echo trans('0190'); ?>"
                                       class="form-control" value="<?php echo @$cheapflightdata[0]->price; ?>"/>
                            </div>
                            <label class="col-md-2 control-label text-left"><?php echo trans('0191'); ?></label>
                            <div class="col-md-2">
                                <select data-placeholder="Select" class="form-control" name="carrier">
                                    <option value="<?php echo $cheapflight_carrier[0]; ?>" <?php if (@$cheapflightdata[0]->carrier == $cheapflight_carrier[0]) {
                                        echo "selected";
                                    } ?> ><?php echo $cheapflight_carrier[0]; ?></option>
                                    <option value="<?php echo $cheapflight_carrier[1]; ?>" <?php if (@$cheapflightdata[0]->carrier == $cheapflight_carrier[1]) {
                                        echo "selected";
                                    } ?> ><?php echo $cheapflight_carrier[1]; ?></option>
                                    <option value="<?php echo $cheapflight_carrier[2]; ?>" <?php if (@$cheapflightdata[0]->carrier == $cheapflight_carrier[2]) {
                                        echo "selected";
                                    } ?> ><?php echo $cheapflight_carrier[2]; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left"><?php echo trans('0192'); ?></label>
                            <div class="col-md-2">
                                <select data-placeholder="Select" class="form-control" name="status">
                                    <option value="<?php echo $cheapflight_status[1]; ?>" <?php if (@$cheapflightdata[0]->status == $cheapflight_status[1]) {
                                        echo "selected";
                                    } ?> ><?php echo $cheapflight_status[1]; ?></option>
                                    <option value="<?php echo $cheapflight_status[0]; ?>" <?php if (@$cheapflightdata[0]->status == $cheapflight_status[0]) {
                                        echo "selected";
                                    } ?> ><?php echo $cheapflight_status[0]; ?></option>
                                </select>
                            </div>
                            <label class="col-md-2 control-label text-left"><?php echo trans('0193'); ?></label>
                            <div class="col-md-2">
                                <input name="cheapflight_index" type="numbers"
                                       placeholder="<?php echo trans('0193'); ?>"
                                       class="form-control"
                                       value="<?php echo @$cheapflightdata[0]->cheapflight_index; ?>"/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="hidden" name="submittype" value="<?php echo $submittype; ?>"/>
                <input type="hidden" id="cheapflight_id" name="cheapflight_id" value="<?php echo @$cheapflight_id; ?>"/>
                <button class="btn btn-primary submitfrm"
                        id="<?php echo $submittype; ?>"><?php echo trans('0134'); ?></button>
            </div>
        </div>
</form>