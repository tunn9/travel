<?php require $themeurl. 'views/home/slider.php';?>



<?php if(pt_main_module_available( 'promotions')) { ?>

    <div class="home-selction-promotions">
        <div class="container">
            <h2 class="destination-title destination-title-home tr ttu">
                <?php echo trans('0600');?>
            </h2>
            <div class="row">
            <div class="main_slider">
                <div class="promotions-slider promotions-slider-latest">
                    <?php foreach($promotions_home as $p){ ?>
                        <div class="promotions-item-inner">
                            <div class="imgLodBg">
                                <div class="load"></div>
                                <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="http://localhost/Source/uploads/images/blog/120331_3.jpg">
                            </div>
                            <div class="promotions-item-desc">
                                <h4><?php echo character_limiter($p->title,25);?></h4>
                                <span class="promotions-stop"><?php echo $p->type; ?></span>
                                <div class="desc">
                                    <p><?php echo $p->startpoint .' '. trans( '0601') .' '.$p->endpoint;  ?></p>
                                    <p><?php echo pt_show_date_php($p->godate) .' - '.pt_show_date_php($p->comebackdate);  ?></p>
                                </div>
                                <div class="promotions-footer">
                                    <span class="promotions-price"><?php echo $p->price; ?></span>
                                    <a class="btn btn-primary more-detail"> <?php echo trans( '0602');?></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php } ?>



<!-- flights slider -->
<?php //include $themeurl. 'views/includes/flights_slider.php';?>


<?php if($offersCount> 0){ ?>
<div class="offers-wapper hidden-xs hidden-sm">
    <div class="container position-relative">
        <div class="offers-image" style="background-image: url(<?php echo $specialoffers[0]->thumbnail;?>)">
            <span id="offers-icon-play"></span>
            <video id="offers-video"><source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"></video>
        </div>
        <div class="row">
            <?php if($offersCount> 0){ ?>
            <?php //foreach($specialoffers as $offer){ ?>
            <div class="col-md-5 col-sm-12 pull-right">
                <div class="offers-content">
                    <h3><?php echo character_limiter($specialoffers[0]->title,30);?></h3>
                    <p class="big-save">
                        <?php if($specialoffers[0]->price > 0){ ?> <span class="big-save-price"><?php echo trans('0536');?> <?php echo  trans('0388');?></span>
                            <strong> <?php echo $specialoffers[0]->price;?><?php echo $specialoffers[0]->currSymbol; ?></strong>
                        <?php } ?>
                    </p>
                    <div class="desc">
                        <p>
                            <?php echo character_limiter($specialoffers[0]->desc,240);?>
                        </p>
                    </div>
                    <a href="<?php echo base_url(); ?>offers" class="loader btn-offers">
                        <?php echo trans( '0297');?>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<?php if(pt_main_module_available( 'blog')){ if($showOnHomePage !="No" ){ ?>
<div class="home-selction">
    <div class="container">
            <h2 class="destination-title destination-title-home tr ttu">
                <?php echo trans('0402');?>
            </h2>
        <div class="row">
            <div class="main_slider">
                <div class="blog-slider">
                    <?php foreach($posts as $p){ ?>
                        <div class="blog-item-inner">
                            <div class="imgLodBg">
                                <div class="load"></div>
                                <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $p->thumbnail;?>">
                            </div>
                            <div class="blog-item-desc">
                                <h4 class="blog-slide-title"><?php echo character_limiter($p->title,70);?></h4>
                                <span class="blog-date"><?php echo pt_show_date_php($p->date); ?></span>
                                <p class="tr">
                                    <?php echo $p->shortDesc;?> &nbsp;
                                </p>
                                <p class="text-right">
                                    <a class="btn btn-primary loader" href="<?php echo $p->slug;?>">
                                        <?php echo trans( '0286');?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>

<!-- flights slider -->
<?php include $themeurl. 'views/includes/flights_slider.php';?>

<!-- Why choose us -->

<div class="why-choose-us">
    <div class="container">
        <h2 class="choose-us-title">
            <?php echo trans('0604');?>
        </h2>
       <div class="why-choose-us-slide ">
           <div class="why-choose-slide-item">
               <img class="" src="<?php echo $theme_url ?>assets/img/why_icon5.png">
               <p>The Esperantotour
                   experience</p>
           </div>
           <div class="why-choose-slide-item">
               <img class="" src="<?php echo $theme_url ?>assets/img/why_icon6.png">
               <p>Great prices and
                   transparency</p>
           </div>
           <div class="why-choose-slide-item">
               <img class="" src="<?php echo $theme_url ?>assets/img/why_icon7.png">
               <p>We cherish our Customers:
                   collect points and acquire discounts</p>
           </div>
           <div class="why-choose-slide-item">
               <img class="" src="<?php echo $theme_url ?>assets/img/why_icon8.png">
              <p>We cherish our Customers:
                   collect points and acquire discounts</p>
           </div>
       </div>
    </div>
</div>




