<style>
    .tabs{
    margin-top: 120px
    }
    .tour_margin{
    margin-left: 20px;
    margin-right: 20px;
    }
    @media (max-width: 480px){.tabs{margin-top: 35px !important;}}
    @media (max-width: 624px){.tour_margin{margin-left: 0px !important; margin-right: 0px !important}}
    .form {
    padding-left: 12px !important;
    }
</style>
<div class="" style="margin-top:-25px">
    <div id="Carousel" class="carousel slide carousel-fade">
        <div class="carousel-inner fadeIn animated">
            <div class="item home-slider hero hidden-xs hidden-sm active" style="background-image:url(<?php echo $theme_url; ?>assets/img/page.jpg) ">
                <div class="clearfix"></div>
                <div class="container hidden-xs hidden-sm">
                    <div class="carousel-caption text-center">
                        <h1 style="text-shadow: 0 7px 11px rgba(0,0,0,.5);padding: 0px"><?php echo trans('0192');?></h1>
                        <div class="clearfix"></div>
                        <h4 style="text-shadow: 0 2px 6px rgba(0,0,0,2.5);color:#fff;"><?php echo trans('0193');?></h4>
                        <div class="clearfix"></div>
                        <div class="form-group tabs">
                            <?php  if(pt_main_module_available('hotels')){ ?><button id="hotels" class="btnz btn btn-default btn-lg showform"><i class="icon-building"></i> <?php echo trans('0405');?></button><?php } ?>
                            <?php  if(pt_main_module_available('tours')){ ?><button id="tours" class="btnz btn btn-default btn-lg showform tour_margin"><i class="icon-slideshare"></i> <?php echo trans('0271');?></button><?php } ?>
                            <?php  if(pt_main_module_available('cars')){ ?><button  id="cars" class="btnz btn btn-default btn-lg showform"><i class="fa fa-cab"></i> <?php echo trans('0198');?></button><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="panel-body" id="apply">
        <div class="well">
            <div class="col-xs-14 col-sm-14 col-md-14 col-lg-14">
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
                    <div class="panel-body">
                        <div class="col-md-10">
                            <fieldset>
                                <div class="form-group">
                                    <label style="font-size: 22px; margin-top: 14px;" class="col-md-3 control-label">
                                    <span class="modulelabel" id="hotelslabel"><?php echo trans('0405');?></span><span class="modulelabel" id="tourslabel"> <?php echo trans('0271'); ?> </span> <span class="modulelabel" id="carslabel"><?php echo trans('0198'); ?></span>
                                    <?php echo trans('0350');?></label>
                                    <div class="col-md-8">
                                        <input style="height: 60px;font-size: 18px;" data-original-title="<?php echo trans('0350');?>" data-toggle="tooltip" data-placement="top" class="form-control input-lg" type="text" placeholder="<?php echo trans('0350');?>" name="itemname"  value="<?php echo set_value('itemname'); ?>" required >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('090');?> </label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('090');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="text" placeholder="<?php echo trans('090');?>" name="fname"  value="<?php echo set_value('fname'); ?>" required >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('091');?></label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('091');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="text" placeholder="<?php echo trans('091');?>" name="lname" value="<?php echo set_value('lname'); ?>" required >
                                    </div>
                                </div>
                                <hr class="soften">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('094');?> </label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('094');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="email" placeholder="<?php echo trans('094');?>" name="email" value="<?php echo set_value('email'); ?>" required >
                                    </div>
                                </div>
                                <hr class="soften">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('092');?></label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('092');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="text" placeholder="<?php echo trans('092');?>" name="mobile" value="<?php echo set_value('mobile'); ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('0105');?></label>
                                    <div class="col-md-8">
                                        <select data-original-title="<?php echo trans('0105');?>" data-toggle="tooltip" data-placement="top" data-placeholder="Select" name="country" class="form-control form"  required>
                                            <option value=""> <?php echo trans('0484');?> </option>
                                            <?php foreach($allcountries as $c){ ?>
                                            <option value="<?php echo $c->iso2;?>"><?php echo $c->short_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('0101');?></label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('0101');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="text" placeholder="<?php echo trans('0101');?>" name="state" value="<?php echo set_value('state'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('0100');?></label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('0100');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="text" placeholder="<?php echo trans('0100');?>" name="city" value="<?php echo set_value('city'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('098');?></label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('098');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="text" placeholder="<?php echo trans('098');?>" name="address1" value="<?php echo set_value('address1'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo trans('099');?></label>
                                    <div class="col-md-8">
                                        <input data-original-title="<?php echo trans('099');?>" data-toggle="tooltip" data-placement="top" class="form-control form" type="text" placeholder="<?php echo trans('099');?>" name="address2" value="<?php echo set_value('address2'); ?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <input type="hidden" name="addaccount" value="1" />
                    <input type="hidden" name="type" value="supplier" />
                    <div class="panel-footer">
                        <input type="hidden" id="applyfor" name="applyfor" value="">
                        <div class="clearfix"></div>
                        <br>
                        <button  type="submit" class="btn-block btn btn-lg btn-action center-block"><?php echo trans('05');?></button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php if(!empty($success)){   ?>
    <div class="alert alert-success">
        <i class="fa fa-check"></i>
        <?php  echo trans('0244');  ?>
    </div>
    <?php   }else{
        if(!empty($error)){  ?>
    <div class="alert alert-danger">
        <?php  echo @$error;  ?>
    </div>
    <?php } } ?>
    <h2 class="text-center h1-title"><?php echo $app_settings[0]->site_title;?> <?php echo trans('0494');?></h2>
    <hr class="hrs">
    <br><br>
    <div class="col-md-6 wow fadeInRight animated">
        <div class="col-md-2 icons_right"><i class="pull-left icon_set_2_icon-105 icons"></i></div>
        <div class="col-md-7">
            <h3 class="text-right"> <?php echo trans('0495');?></h3>
        </div>
    </div>
    <div class="col-md-6 wow fadeInLeft animated">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-2"><i class="pull-right icon_set_1_icon-12 icons"></i></div>
        <div class="col-md-7">
            <h3 class="text-left"> <?php echo trans('0496');?></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    <div class="col-md-6 wow fadeInRight animated">
        <div class="col-md-2 icons_right"><i class="pull-left icon_set_1_icon-18 icons"></i></div>
        <div class="col-md-7">
            <h3 class="text-right"> <?php echo trans('0497');?></h3>
        </div>
    </div>
    <div class="col-md-6 wow fadeInLeft animated">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-2"><i class="pull-right icon_set_1_icon-30 icons"></i></div>
        <div class="col-md-7">
            <h3 class="text-left"> <?php echo trans('0498');?></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    <div class="col-md-6 wow fadeInRight animated">
        <div class="col-md-2 icons_right"><i class="pull-left icon_set_1_icon-35 icons"></i></div>
        <div class="col-md-7">
            <h3 class="text-right"> <?php echo trans('0499');?></h3>
        </div>
    </div>
    <div class="col-md-6 wow fadeInLeft animated">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-2"><i class="pull-right icon_set_1_icon-63 icons"></i></div>
        <div class="col-md-7">
            <h3 class="text-left"> <?php echo trans('0500');?></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <style>
        /*  .btn-default:hover, .btn-default:focus, .btn-default.focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
        background-color: #FFFFFF;
        } */
        .icons {
        font-size: 60px !important;
        color: #0066FF !important;
        }
        .icons_right{
        float: right;
        margin-right: 126px;
        }
        body {
        background-color:#fff;
        }
        .btnz {
        min-width: 190px;
        border: 1px solid #fff;
        /* margin-right: 30px;*/
        height: 70px;
        background-color: rgba(0,0,0,.3);
        color: #fff;
        text-align: left;
        cursor: pointer;
        transition-duration: .5s;
        font-size:30px;
        }
        .btnz:hover {
        background-color: rgba(255, 255, 255, 0.3);
        border: 1px solid #fff;
        }
        .c-form--banner-bottom {
        position: absolute;
        bottom: 0;
        width: 100%;
        }
        .started {
        background-color: #f3f3f3;
        }
        .list {
        padding:15px 30px 15px 30px;border-radius:5px; box-shadow: 2px 2px 2px 0 rgba(44,49,55,.1)
        }
        .lapcon {
        position: absolute;
        font-size: 65px;
        margin-top: 25px;
        margin-left: 106px;
        color: #0066FF;
        }
        .hrs {
        margin-top: 14px;
        margin-bottom: 19px;
        border: 0;
        border-top: 4px solid #0066FF;
        margin-left: 35%;
        margin-right: 35%;
        }
        @media (max-width: 585px){.btnz{margin-bottom: 5px !important; width:100%;}}
        @media (max-width: 991px){.list{margin-bottom: 5px !important;}}
        @media (max-width: 1200px){.icons_right{margin-right: 110px !important;}}
        @media (max-width: 991px){.icons_right{margin-right:0px !important; float:none;}}
    </style>
</div>
<br><br>
<section class="started">
    <div class="container">
        <h2 class="text-center"><?php echo trans('0502');?></h2>
        <hr class="hrs">
        <div class="col-md-12">
            <div class="wow fadeInDown animated">
                <div class="step">
                    <div class="row-fluid img-thumbnail list">
                        <div class="col-md-4">
                            <img class="img-responsive" src="<?php echo $theme_url; ?>assets/img/supplier/signup.png">
                        </div>
                        <div class="col-md-8">
                            <h3><strong><?php echo trans('0115');?></strong></h3>
                            <p><?php echo trans('0504');?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wow fadeInDown animated">
                <div class="step">
                    <div class="row-fluid img-thumbnail list">
                        <div class="col-md-4">
                            <img class="img-responsive" src="<?php echo $theme_url; ?>assets/img/supplier/verify.png">
                        </div>
                        <div class="col-md-8">
                            <h3><strong><?php echo trans('0505');?></strong></h3>
                            <p><?php echo trans('0507');?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wow fadeInDown animated">
                <div class="step">
                    <div class="row-fluid img-thumbnail list">
                        <div class="col-md-4">
                            <img class="img-responsive" src="<?php echo $theme_url; ?>assets/img/supplier/access.png">
                        </div>
                        <div class="col-md-8">
                            <h3><strong><?php echo trans('0508');?></strong></h3>
                            <p><?php echo trans('0510');?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="form-group">
        <div class="col-md-12">
            <br>
            <h3 class="text-center"><a class="btn btn-action btn-block btn-lg" href="#top"> <?php echo trans('0511');?> </a></h3>
            <br><br>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#apply").hide();
        $("#hotelslabel").hide();
        $("#tourslabel").hide();
        $("#carslabel").hide();
        $(".showform").on("click",function(){
        var module = $(this).prop('id');
        $("#applyfor").val(module);
        $(".modulelabel").hide();
        $("#"+module+"label").show();
        $("#apply").slideDown();
        })
        })
</script>