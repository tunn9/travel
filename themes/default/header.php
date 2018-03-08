<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo @$metadescription; ?>">
<meta name="keywords" content="<?php echo @$metakeywords; ?>">
<meta name="author" content="PHPTRAVELS">
<title><?php echo @$pageTitle; ?></title>
<link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER.'favicon.png';?>">
<link href="<?php echo $theme_url; ?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo $theme_url; ?>style.css" rel="stylesheet">
<link href="<?php echo $theme_url; ?>assets/css/navigation.css" rel="stylesheet">
<!--<link href="<?php echo $theme_url; ?>eder.css" rel="stylesheet"> -->
<link href="<?php echo $theme_url; ?>assets/css/mobile.css" rel="stylesheet" media="screen">
<link href="<?php echo $theme_url; ?>assets/css/custom-style.css" rel="stylesheet" media="screen">
<!-- facebook --> <meta property="og:title" content="<?php echo @$pageTitle; ?>"/> <meta property="og:site_name" content="<?php echo $app_settings[0]->site_title;?>"/> <meta property="og:description" content="<?php if($app_settings[0]->seo_status == "1"){echo $metadescription;}?>"/> <meta property="og:image" content="<?php echo base_url(); ?>uploads/global/favicon.png"/>  <meta property="og:url" content="<?php echo $app_settings[0]->site_url;?>/"/> <meta property="og:publisher" content="https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>"/> <script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>/","logo":"<?php echo base_url(); ?>uploads/global/favicon.png","sameAs":"https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://twitter.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://www.pinterest.com/<?php echo $app_settings[0]->site_title;?>/","sameAs":"https://plus.google.com/u/0/<?php echo $app_settings[0]->site_title;?>/posts","contactPoint":{"@type":"ContactPoint","telephone":"<?php echo $phone; ?>","contactType":"Customer Service"}}{"@context":"http://schema.org","@type":"WebSite","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>"}  </script>
<!-- Child Theme --> <style> @import "<?php echo $theme_url; ?>assets/css/childstyle.css"; </style>
<!-- Google Maps --> <?php if (pt_main_module_available('ean') || $loadMap) { ?> <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?php echo $app_settings[0]->mapApi; ?>&libraries=places"></script> <script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script><?php } ?>
<!-- jQuery --> <script src="<?php echo $theme_url; ?>assets/js/jquery-1.11.2.min.js"></script>
<!-- RTL CSS --> <?php if($isRTL == "RTL"){ ?> <link href="<?php echo $theme_url; ?>RTL.css" rel="stylesheet"> <?php } ?>
<!-- Mobile Redirect --> <?php if($mSettings->mobileRedirectStatus == "Yes"){ if($ishome != "invoice"){ ?> <script>if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){ window.location ="<?php echo $mSettings->mobileRedirectUrl; ?>";}</script> <?php } } ?>
<!--[if lt IE 7] > <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>assets/css/font-awesome-ie7.css" media="screen" /> <![endif]-->
<!-- Autocomplete CSS files-->
<link href="<?php echo $theme_url; ?>assets/js/autocomplete/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
<!-- Autocomplete CSS files-->
<!-- Autocomplete JS files-->
<script src="<?php echo $theme_url; ?>assets/js/autocomplete/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>
<!-- Autocomplete JS files-->
<script>var base_url = '<?php echo base_url(); ?>';</script>
<?php echo $app_settings[0]->google; ?>
</head>
<body>
<div id="preloader" class="loader-wrapper">
    <img src="<?php echo $theme_url; ?>assets/img/loader.gif" style="width:450px" class="center-block" alt="loading" />
    <div style="margin-top:-120px">
    <h4 class="text-center"><?php echo trans('0555');?> <strong><?php echo $app_settings[0]->site_title;?></strong></h4>
    <h5 class="text-center"><?php echo trans('0556');?></h5>
    </div>
</div>
<div class="modal <?php if($isRTL == "RTL"){ ?> right <?php } else { ?> left <?php } ?> fade" id="sidebar_left" tabindex="1" role="dialog" aria-labelledby="sidebar_left">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close go-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="close icon-angle-<?php if($isRTL == "RTL"){ ?>right<?php } else { ?>left<?php } ?>"></i></span></button>
        <div class="header-responsive-top">
<!--            <a href="--><?php //echo base_url(); ?><!--" class="navbar-brand go-right loader"><img src="--><?php //echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?><!--" alt="--><?php //echo $app_settings[0]->site_title;?><!--" class="logo"/></a>-->
            <a href="<?php echo base_url(); ?>" class="navbar-brand go-right loader"><img src="http://localhost/Source/uploads/global/logo_footer.png" class="logo"/></a>
            <?php if(!empty($customerloggedin)){ ?>
            <div class="header-show-user">
                <img src="http://cdn.savoy.nordicmade.com/wp-content/uploads/2015/08/team-member-2.jpg" alt="user">
                <h4> <?php echo $firstname; ?></h4>
            </div>
            <?php } ?>
        </div>
      </div>
      <?php include 'settings.php'; ?>
        <?php if(!empty($customerloggedin)){ ?>
          <div class="menu-footer-reponsive">
              <a class="go-text-right" href="<?php echo base_url()?>account/logout/">  <?php echo trans('03');?></a>
          </div>
        <?php } ?>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="tbar-top hidden-sm hidden-xs">
  <div class="container">
      <p class="pull-left">
          <a href="#">ubuk.com</a> is a product of company Esperantorour
      </p>
      <ul class="header-top-right pull-right">
          <li>
              <a class="header-lang">google traslate</a>
          </li>
          <li class="header-social">
<!--              --><?php //foreach($footersocials as $fs){ ?>
<!--                  <a href="--><?php //echo $fs->social_link;?><!--"  target="_blank"><img src="--><?php //echo PT_SOCIAL_IMAGES; ?><!----><?php //echo $fs->social_icon;?><!--" /></a>-->
<!--              --><?php //} ?>
              <a href="#" class="fa fa-facebook"></a>
              <a href="#" class="fa fa-google-plus"></a>
              <a href="#" class="fa fa-instagram"></a>
          </li>
      </ul>
  </div>
</div>
<div class="navbar navbar-static-top navbar-default <?php echo @$hidden; ?> hidden-lg hidden-md">
  <div class="container">
    <div class="navbar">
      <!-- Navigation-->
      <div class="navbar-header">
        <button data-toggle="modal" data-target="#sidebar_left" class="navbar-toggle go-left" type="button" style="margin-top: 30px;">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a href="<?php echo base_url(); ?>" class="navbar-brand go-right loader"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" alt="<?php echo $app_settings[0]->site_title;?>" class="logo"/></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right currency_btn"  style="padding-top: 20px;">
          <?php include 'settings.php'; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="tbar-bottom hidden-xs hidden-sm">
  <div class="container">
    <div class="flex-center">
      <div class="header-logo">
        <a href="<?php echo base_url(); ?>" class="navbar-brand go-right loader"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" alt="<?php echo $app_settings[0]->site_title;?>" class="logo"/></a>
      </div>
      <div class="flex-space-between header-nav">
        <nav id="offcanvas-menu">
          <ul class="main-menu go-left RTL">
              <li class="main-lnk">
                  <a class="loader" href="<?php echo base_url(); ?>blog/" title="">
                      <img src="<?php echo $theme_url; ?>assets/img/icons/promotions.png" class="icon-promotion">
                      <span>promotions</span>
                  </a>
              </li>
            <?php  if(pt_main_module_available('blog')){ ?>
            <li class="main-lnk">
              <a class="loader" href="<?php echo base_url(); ?>blog/" title="">
                  <img src="<?php echo $theme_url; ?>assets/img/icons/blog.png">
                  <span><?php echo trans('Blog');?></span>
              </a>
            </li>
            <?php } ?>

              <li class="main-lnk">
                  <a class="loader" href="<?php echo base_url(); ?>blog/" title="">
                      <img src="<?php echo $theme_url; ?>assets/img/icons/support.png">
                      <span>Support</span>
                  </a>
              </li>
          </ul>
        </nav>
          <div class="header-account">
              <?php include 'settings.php'; ?>
          </div>
      </div>
    </div>
  </div>
</div>
<div id="body-section">