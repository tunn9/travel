<div class="herobg">
    <div class="container">
        <div style="background: #282fca; color: white;">
            <div class="col-md-5 col-xs-12 go-right">
                <div class="row">
                    <ul class="nav nav-tabs RTL nav-justified">
                        <!--<li class="dropdown <?php pt_active_link();?> go-right">
                            <a class="dropdown-toggle" href="<?php echo base_url(); ?>"> <?php echo trans('01');?> </a>
                            </li>-->
                        <?php  if(pt_main_module_available('hotels')){ ?>
                        <li role="presentation" class="active" data-title="HOTELS">
                            <a class="text-center" href="#HOTELS" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="fa fa-building-o"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Hotels');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('ean')){ ?>
                        <li role="presentation" class="text-center" data-title="EXPEDIA">
                            <a href="#EXPEDIA" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="fa fa-building-o"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Ean');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(module_status_check('travelpayoutshotels')){ ?>
                        <li role="presentation" class="text-center" data-title="TRAVELPAYOUTSHOTELS">
                            <a href="#TRAVELPAYOUTSHOTELS" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="fa fa-building-o"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Hotels');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('hotelscombined')){ ?>
                        <li role="presentation" class="text-center" data-title="HOTELSC">
                            <a href="#HOTELSC" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="fa fa-building-o"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Hotelscombined');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- Travelport flight list item -->
                        <?php  if(pt_main_module_available('travelport_flight')){ ?>
                        <li role="presentation" class="text-center" data-title="flight">
                            <a href="#flight" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="fa fa-plane outline-icon"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('0564');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('Travelpayouts')){ ?>
                        <li class="text-center">
                            <a href="#TRAVELPAYOUTS" data-toggle="tab" aria-controls="home">
                                <i class="fa fa-plane outline-icon"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Travelpayouts');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('Travelstart')){ ?>
                        <li class="text-center">
                            <a href="<?php echo base_url(); ?>flightst">
                                <i class="fa fa-plane outline-icon"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Travelstart');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('wegoflights')){ ?>
                        <li role="presentation" class="text-center"  data-title="WEGOFLIGHTS">
                            <a href="#WEGOFLIGHTS" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="fa fa-plane outline-icon"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Wegoflights');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('tours')){ ?>
                        <li role="presentation" class="text-center" data-title="TOURS">
                            <a href="#TOURS" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="icon_set_1_icon-30"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Tours');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('cars')){ ?>
                        <li role="presentation" class="text-center" data-title="CARS">
                            <a href="#CARS" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="icon_set_1_icon-21"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Cars');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('cartrawler')){ ?>
                        <li role="presentation" class="text-center" data-title="CARTRAWLER">
                            <a href="#CARTRAWLER" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="icon_set_1_icon-21"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Cars');?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if(pt_main_module_available('ivisa')){ ?>
                        <li role="presentation" class="text-center" data-title="VISA">
                            <a class="text-center" href="#VISA" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <i class="icon_set_1_icon-35"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Ivisa');?></span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content panel-body">
                        <?php  if(pt_main_module_available('hotels')){ ?>
                        <!-- Hotels  -->
                        <div role="tabpanel" class="tab-pane fade active in <?php pt_searchbox('hotels'); ?>" id="HOTELS" aria-labelledby="home-tab">
                            <?php echo searchForm('hotels'); ?>
                        </div>
                        <!-- Hotels  -->
                        <?php } ?>
                        <?php  if(pt_main_module_available('ean')){ ?>
                        <!-- Expedia Hotels  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('ean'); ?>" id="EXPEDIA" aria-labelledby="home-tab">
                            <?php echo searchForm('ean'); ?>
                        </div>
                        <!-- Expedia Hotels  -->
                        <?php } ?>
                         <?php  if(module_status_check('travelpayoutshotels')){ ?>
                        <!-- Travelpayouts Flights  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('Travelpayouts'); ?>" id="TRAVELPAYOUTSHOTELS" aria-labelledby="home-tab">
                        <script charset="utf-8" src="<?php echo $WidgetURL; ?>" async></script>
                        </div>
                        <!-- Travelpayouts Flights  -->
                        <?php } ?>
                        <?php  if(pt_main_module_available('hotelscombined')){ ?>
                        <!-- HotelsCombine -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('hotelscombined'); ?>" id="HOTELSC" aria-labelledby="home-tab">
                            <div style="margin-top:7px;background-color:black">
                                <script src="//sbhc.portalhc.com/<?php echo $aid; ?>/SearchBox/<?php echo $searchBoxID;?>" ></script>
                            </div>
                        </div>
                        <!-- HotelsCombine   -->
                        <?php } ?>
                        <?php  if(pt_main_module_available('Travelpayouts')){ ?>
                        <!-- Travelpayouts Flights  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('Travelpayouts'); ?>" id="TRAVELPAYOUTS" aria-labelledby="home-tab">
                            <script charset="utf-8" src="<?php echo $WidgetURL; ?>" async></script>
                        </div>
                        <!-- Travelpayouts Flights  -->
                        <?php } ?>
                        <?php  if(pt_main_module_available('wegoflights')){ ?>
                        <!-- Wego Flights  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('Wegoflights'); ?>" id="WEGOFLIGHTS" aria-labelledby="home-tab">
                            <?php require $themeurl.'views/integrations/flights/wegoflights/search.php';?>
                        </div>
                        <!-- Wego  Flights  -->
                        <?php } ?>
                        <?php  if(pt_main_module_available('tours')){ ?>
                        <!-- Tours  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('tours'); ?>" id="TOURS" aria-labelledby="home-tab">
                            <?php echo searchForm('tours'); ?>
                        </div>
                        <!-- Tours  -->
                        <?php } ?>
                        <?php  if(pt_main_module_available('cars')){ ?>
                        <!-- Cars  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('cars'); ?>" id="CARS" aria-labelledby="home-tab">
                            <?php echo searchForm('cars'); ?>
                        </div>
                        <!-- Cars  -->
                        <?php } ?>
                        <?php  if(pt_main_module_available('cartrawler')){ ?>
                        <!-- Cartrawler  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('cartrawler'); ?>" id="CARTRAWLER" aria-labelledby="home-tab">
                            <?php require $themeurl.'views/integrations/cars/cartrawler/main_search.php';?>
                        </div>
                        <?php } ?>
                        <!-- Cartrawler  -->
                        <!-- travelport flight form -->
                        <?php  if(pt_main_module_available('travelport_flight')){ ?>
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('flight'); ?>" id="flight" aria-labelledby="home-tab">
                            <!-- travelportSearchFormData pass by home -->
                            <?php echo searchForm('travelport_flight', $travelportSearchFormData); ?>
                        </div>
                        <?php } ?>
                        <!--/ .travelport flight form body -->
                        <!-- ivisa  -->
                        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('visa'); ?>" id="VISA" aria-labelledby="home-tab">
                            <?php echo searchForm('ivisa'); ?>
                        </div>
                        <!-- ivisa  -->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 hidden-xs hidden-sm go-left">
                <div class="row">
                    <div style="background:black" id="Carousel" class="carousel slide carousel-fade">
                        <div class="carousel-inner fadeIn animated">
                            <?php  if($sliderInfo->totalSlides > 0){ foreach($sliderInfo->slides as $ms){ ?>
                            <div class="item <?php echo $ms->sactive; ?> home-slider hero hidden-xs hidden-sm">
                                <img src="<?php echo $ms->thumbnail;?>" alt="">
                                <div class="clearfix"></div>
                                <div class="container hidden-xs hidden-sm">
                                    <div class="carousel-caption">
                                        <h5 data-wow-duration="1s" data-wow-delay="0.1s" class="fadeInUp wow text-left go-right ttu"><?php echo $ms->title;?></h5>
                                        <div class="clearfix"></div>
                                        <p data-wow-duration="2s" data-wow-delay="0.1s" class="flash wow text-left go-text-right"><?php echo $ms->desc;?></p>
                                        <div class="clearfix"></div>
                                        <!--<h5 data-wow-duration="1s" data-wow-delay="0.2s" style="font-size:14px;color:yellow;margin-top:10px" class="slim uppercase fadeInDown wow" style="font-size:26px;color:yellow;margin-top:10px; font-weight: bold">
                                            <?php echo $ms->optionalText;?></h5>
                                            <div class="clearfix"></div>-->
                                    </div>
                                </div>
                            </div>
                            <?php } }else{ ?>
                            <div class="item active hero">
                                <div class="slide">
                                    <img  src="<?php echo $theme_url; ?>assets/img/slider.jpg">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if($sliderInfo->totalSlides > 1){ ?>
                        <a class="left carousel-control visible-lg visible-md" href="#Carousel" data-slide="prev">
                        <span class="glyphicon-chevron-left fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control visible-lg visible-md" href="#Carousel" data-slide="next">
                        <span class="glyphicon-chevron-right fa fa-angle-right"></span>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>