<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo "$page_title"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="UBUK">
    <base href="<?php echo base_url(); ?>"/>
    <script>var base_url = '<?php echo base_url(); ?>'; </script>
    <!-- Pace -->
    <script src="<?php echo base_url(); ?>assets/include/pace/pace.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/include/pace/dataurl.css" rel="stylesheet"/>
    <!-- Pace -->

    <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/global/favicon.png">
    <link href="<?php echo base_url(); ?>assets/include/loading/loading.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/fa.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
    <?php if (empty($dontload)) { ?>
        <script src="<?php echo base_url(); ?>assets/include/ckeditor/ckeditor.js"></script><?php } ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.js"></script>
    <link href="<?php echo base_url(); ?>assets/include/alert/css/alert.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/include/alert/themes/default/theme.css" rel="stylesheet"/>
    <script src="<?php echo base_url(); ?>assets/include/alert/js/alert.js"></script>

    <!---Jquery Form--->
    <script src="<?php echo base_url(); ?>assets/include/jquery-form/jquery.form.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--[if lte IE 8]>
    <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/excanvas.min.js"></script>
    <![endif]-->

    <!-- select2 -->
    <link href="<?php echo base_url(); ?>assets/include/select2/select2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/include/select2/select2-default.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/include/select2/select2.min.js"></script>
    <!-- end select2 -->

    <style>
        .wrapper .main {
            margin-top: 55px;
        }

        @media screen and (max-width: 480px) {
            .wrapper .main {
                margin-top: 100px;
            }
        }
    </style>

</head>
<body>
<div class="wrapper">
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Dashboard -->
                <!-- <a class="navbar-brand" href="<?php echo base_url(); ?>admin/"><?php echo trans('01'); ?></a> -->
                <a class="navbar-brand" href="<?php echo base_url(); ?>admin/"><img id="admin-logo"
                                                                                    src="<?php echo base_url(); ?>assets/img/logo.png"
                    /img></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <!--                     --><?php //if($isadmin){ ?>
                    <!--                    <li class="active">-->
                    <!--                        <a href="--><?php //echo base_url();?><!--" target="_blank">-->
                    <!--                            <i class="fa fa-laptop"></i>-->
                    <!--                            <span>--><?php //echo trans('02');?><!--</span>-->
                    <!--                        </a>-->
                    <!--                    </li> -->
                    <?php if ($isSuperAdmin) { ?>
                        <ul class="nav navbar-nav">
                            <!-- Configuration -->
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false"><i
                                            class="fa fa-cogs"></i> <?php echo trans('0119'); ?> <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url(); ?>admin/settings/"><?php echo trans('04'); ?></a>
                                    </li>
                                    <!-- <li>
                                    <a href="<?php echo base_url(); ?>admin/settings/api/"><?php echo trans('036'); ?></a>
                                    </li> -->
                                    <!-- BEGIN ELEMENT MENU-->
                                    <!-- <?php $chkupdates = checkUpdatesCount();
                                    if ($chkupdates->showUpdates) {
                                        if ($isSuperAdmin) { ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/updates/">
                                    <span>Updates</span><span class="pull-right label label-danger" id="updatescount"><?php if ($chkupdates->count > 0) {
                                            echo $chkupdates->count;
                                        }; ?></span>
                                    </a>
                                </li>
                                <?php }
                                    } ?> -->
                                    <!-- <li>
                                    <a href="<?php echo base_url(); ?>admin/settings/modules/"><?php echo trans('08'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/settings/currencies/">Currencies</a>
                                </li> -->
                                    <!-- <li>
                                    <a href="<?php echo base_url(); ?>admin/settings/paymentgateways/"><?php echo trans('05'); ?></a>
                                </li> -->
                                    <!-- <li>
                                    <a href="<?php echo base_url(); ?>admin/settings/social/"><?php echo trans('07'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/settings/widgets/"><?php echo trans('010'); ?></a>
                                </li> -->
                                <li>
                                    <a href="<?php echo base_url();?>admin/settings/sliders/"><?php echo trans('011');?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>admin/templates/email/"><?php echo trans('012');?></a>
                                </li>
                                <!-- <li>
                                    <a href="<?php echo base_url();?>admin/templates/sms_settings/">SMS API Settings</a>
                                </li>
                                <?php if (pt_permissions('locations', @$userloggedin)) { ?>
                                <li>
                                    <a href="<?php echo base_url() . $this->uri->segment(1); ?>/locations">
                                    <span>Locations</span><span class="pull-right label label-danger" id=""></span>
                                    </a>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/backup/">BackUp</a>
                                </li> -->
                                </ul>
                            </li>
                        </ul>
                    <?php } ?>
                    <!-- END ELEMENT MENU-->
                    <!-- Account -->
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false"><i
                                    class="glyphicon glyphicon-user"></i> <?php echo trans('017'); ?> <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if ($role === "webadmin" || pt_permissions('account', @$userloggedin)) { ?>
                                <!--                            --><?php //if($role != "admin"){ ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/accounts/admins/"><?php echo trans('021'); ?></a>
                                </li>
                            <?php } ?>
                            <!--                            <li><a href="-->
                            <?php //echo base_url();?><!--admin/accounts/suppliers/">-->
                            <?php //echo trans('023');?><!--</a></li>-->
                            <li>
                                <a href="<?php echo base_url(); ?>admin/accounts/customers/"><?php echo trans('025'); ?></a>
                            </li>
                            <!-- <li><a href="<?php echo base_url(); ?>admin/accounts/guest/"><?php echo trans('027'); ?><?php echo trans('025'); ?></a></li> -->
                        </ul>
                    </li>
                    <!-- CMS -->
                    <?php if ($role === "webadmin" || pt_permissions('content', @$userloggedin)) { ?>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-list-alt"></i> <?php echo trans('0225'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>admin/cms"><?php echo trans('015'); ?></a></li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/cms/menus/manage"><?php echo trans('016'); ?></a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <!-- Modules -->
                    <?php if ($role === "webadmin" || pt_permissions('content', @$userloggedin)) { ?>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-list-alt"></i> <?php echo trans('0163'); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url(); ?>admin/blog/"><?php echo trans('0156'); ?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>admin/blog/category/"><?php echo trans('0157'); ?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>admin/blog/settings/"><?php echo trans('0158'); ?></a>
                                    </li>
                                </ul>
                                <!-- <li>
                                    <a href="<?php echo base_url();?>admin/flights/">
                                    <span>Đối tác</span>
                                    </a>
                                </li> -->
                                <!-- <a href="javascript:void(0)">
                                <?php echo $modl['Icon']; ?>
                                <span><?php echo $modl['DisplayName']; ?></span>
                                <i class="fa arrow"></i>
                                </a>
                                <ul id="<?php echo $modl['DisplayName']; ?>" class="dropdown-menu">
                                    <?php echo str_replace("%baseurl%","$baseurl",$submenu); ?>

                                </ul> -->
                            </li>
                            <li class="dropdown-submenu">

                                <!-- <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false"><i
                                            class="fa fa-list-alt"></i> <?php echo trans('030'); ?> </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url(); ?>admin/offers/"><?php echo trans('029'); ?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>admin/offers/settings/"><?php echo trans('04'); ?></a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="<?php echo base_url(); ?>admin/coupons/"><i class="fa fa-asterisk"></i>
                                    <span><?php echo trans('032'); ?></span> -->

                              <!--<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt"></i> <?php echo trans('030');?> </a>-->
                              <!--<ul class="dropdown-menu">
                                <li><a href="<?php echo base_url();?>admin/offers/"><?php echo trans('0167');?></a></li>
                                <li><a href="<?php echo base_url();?>admin/offers/settings/"><?php echo trans('0168');?></a></li>
                            </ul>-->
                           </li>
                           <li>
                                <a href="<?php echo base_url();?>admin/paymentmethods/">
                                <span><?php echo trans('0194');?></span>
                                </a>
                            </li>
                           <li>
                                <a href="<?php echo base_url();?>admin/ticketlevels"><!--<i class="fa fa-asterisk"></i>-->
                                <span><?php echo trans('0166');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>admin/baggages/">
                                <span><?php echo trans('0195');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>admin/coupons/"><!--<i class="fa fa-asterisk"></i>-->
                                <span><?php echo trans('032');?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url();?>admin/newsletter/"><!--<i class="fa fa-envelope"></i>-->
                                <span><?php echo trans('031');?></span><span class="pull-right label label-danger" id=""></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>admin/cheapflight/"><!--<i class="fa fa-asterisk"></i>-->
                                    <span><?php echo trans('0180');?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <!-- Bookings -->
                    <?php if ($role === "webadmin" || pt_permissions('booking', @$userloggedin)) { ?>
                        <li>
                            <a href="<?php echo base_url() . $this->uri->segment(1); ?>/bookings/"><i
                                        class="fa fa-list"></i>
                                <span><?php echo trans('034'); ?></span><span class="pull-right label label-danger" id=""></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo base_url() . $this->uri->segment(1); ?>/profile/"><?php echo trans('0116'); ?></a>
                    </li>
                    <li class="active">
                        <a href="<?php echo base_url() . $this->uri->segment(1); ?>/logout"><?php echo trans('0120'); ?></a>
                    </li>
                    <!-- <li><a href="//phptravels.org/submitticket.php?step=2&deptid=1" target="_blank"> Help</a></li> -->
                </ul>
            </div>
        </div>
    </nav>
    <div style="margin-top:75px">
        <div class="container" id="content">