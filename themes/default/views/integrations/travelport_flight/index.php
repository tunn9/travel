<div class="visible-xs">
  <div class="mt25"></div>
</div>
<div class="header-mob">
  <div class="container">
    <div class="row">
      <div class="col-xs-2 text-leftt">
        <a data-toggle="tooltip" data-placement="right" title="<?php echo trans('0533');?>" class="icon-angle-left pull-left mob-back" onclick="goBack()"></a>
      </div>
      <div class="col-xs-7 p5">
        <div class="mob-trip-info-head ttu">
         <span><?php echo $flying_from; ?></span> &#x2794; <span><?php echo $flying_to; ?></span>
          <div> <?php echo $departure_time; ?> <?php echo $arrival_time; ?> </div>
        </div>
      </div>
      <div class="col-xs-2 text-center pull-right visible-xs">
        <a class="ttu" data-toggle="modal" data-target="#sidebar_filter">
        <i class="icon-filter mob-filter"></i>
        <span class="cw"><?php echo trans('0217');?></span>
        </a>
      </div>
      <!--<div class="col-xs-1 text-center pull-right hidden-xs ttu opl20pdr20">
        <div class="row">
          <a class="btn btn-warning btn-xs btn-block" data-toggle="modal" data-target="#sidebar_filter">
          <i class="icon-filter mob-filter"></i>
          <span><?php echo trans('0217');?></span>
          </a>
        </div>
      </div>-->
      <!--<div class="col-xs-1 text-center pull-right hidden-xs ttu opl20pdr20">
        <div class="row">
          <a class="btn btn-success btn-xs btn-block" data-toggle="collapse" data-target="#modify" aria-expanded="false" aria-controls="modify">
          <i class="icon-filter mob-filter"></i>
          <span><?php echo trans('0106');?></span>
          </a>
        </div>
      </div>-->
    </div>
  </div>
</div>



  <div class="mob-alert-msg go-text-right">
  <div class="container">
    <div class="row">
    <div class="col-md-6 fs12">
    <i class="icon-info-circled-alt go-right"></i>
    <span><?php echo trans('0534');?></span>
  </div>

  <div class="col-md-6 text-right hidden-xs">
   <strong class="go-text-right"><?php echo $dataAdapter['totalListingFound']; ?></strong>
    <span class="go-text-left"><?php echo trans('0535');?></span>
  </div>

  </div>
  </div>
  </div>


  <div class="collapse listing-search-BG modify-flights" id="modify">
    <div class="container">
    <div class="panel-body">
     <?php echo searchForm($appModule, $travelportSearchFormData); ?>
    </div>
    </div>
     <div class="clearfix"></div>
  </div>


  <section class="flights-home hidden-sm hidden-xs">
  <div class="container">
    <?php echo $error; ?>

    <?php if($flightsListSliderflag): // This flag is set in controller ?>
    <div class="row">
      <h2 class="destination-title go-text-right">
        <?php echo trans('0252');?> <?php echo trans('0551');?>
      </h2>
    </div>

    <div class="main_slider">
      <div class="set2 fa-left">
        <i class="glyphicon-chevron-right icon-angle-left owl prev"></i>
      </div>
      <div id="owl-flights" class="get">
      <?php foreach($dataAdapter as $aircraftCarrerBlock):  ?>
        <?php foreach($aircraftCarrerBlock as $aircraftFareBlock): ?>
          <?php
            $priceObj = $aircraftFareBlock['price'];
            $departureTrips = $aircraftFareBlock[0];
          ?>
          <div class="owl-item">
            <div class="item">
              <div class="flight-box-styling">
                <img src="<?php echo $departureTrips['aircraft']['image_path']; ?>">
                <div class="airline-name">
                  <?php echo $departureTrips['aircraft']['carrier']['fullname']; ?>
                </div>
                <div class="flight-price">
                  <?php echo $priceObj['totalprice_unit']; ?>
                  <strong><?php echo $priceObj['totalprice_value']; ?></strong>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endforeach; ?>
      </div>
      <div class="set2 fa-right">
        <i class="glyphicon-chevron-right icon-angle-right"></i>
      </div>
    </div> <!--/ .main_slider -->
    <?php endif; ?>

  </div>
</section>

<div class="container flight-result-container">
<div class="hidden-xs"><br></div>
<!--<nav class="navbar navbar-static-top navbar-orange hidden-xs">
        <div class="container">
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#"><strong><?php echo trans('0284');?></strong></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">by Fares <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">by location <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">by Airline <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>
      </nav>-->

  <table class="bgwhite table table-striped">
    <tbody>
    <?php foreach($dataAdapter as $outerIndex => $aircraftCarrerBlockArray): ?>
      <?php if (isset($aircraftCarrerBlockArray) && ! empty($aircraftCarrerBlockArray)): ?>
        <?php foreach($aircraftCarrerBlockArray as $index => $aircraftFareBlock): ?>
          <?php
            $priceObj = $aircraftFareBlock['price'];
            $departureTrip = $aircraftFareBlock[0];

            $departureDate = $departureTrip['origin']['departure']['date'];
            $departure_date = sprintf('%s %s, %s', $departureDate['day'], $month_name[trim($departureDate['month'], 0)], $departureDate['year']);

            $returnTrip = NULL;
            if (isset($aircraftFareBlock[1]))
            {
              $returnTrip = $aircraftFareBlock[1];

              $returnTripDate = $returnTrip['origin']['departure']['date'];
              $return_date = sprintf('%s %s, %s', $returnTripDate['day'], $month_name[trim($returnTripDate['month'], 0)], $returnTripDate['year']);
            }
          ?>
          <tr>
            <td>
              <div class="row bl">

                  <!------------------     START: DEPARTURE Aggregate data box    ------------------------------>

                  <div class="col-sm-10 col-md-10 col-xs-9">

                      <div class="hidden-xs">
                      <div class="trip-title col-md-4 col-xs-12">
                      <div class="row">
                        <span class="destination-grid"><i class="icon-plane"></i> <span><?php echo trans('0472');?></span></span> <small><?php echo $departure_date; ?></small>
                      </div>
                      </div>
                      <div class="visible-xs"><div class="clearfix"></div></div>
                      <div class="departure-gird col-md-4 col-xs-6">
                        <strong><?php echo $departureTrip['origin']['airport']['code']; ?></strong>
                        <small class="hidden-xs"><?php echo $departureTrip['origin']['airport']['fullname']; ?></small>
                      </div>
                      <div class="return-gird col-md-4 col-xs-6">
                        <strong><?php echo $departureTrip['destination']['airport']['code']; ?></strong>
                        <small class="hidden-xs"><?php echo $departureTrip['destination']['airport']['fullname']; ?></small>
                      </div>
                      </div>

                    <div class="flight-result-grid">
                      <div class="bg-color">
                        <div class="available-seat">
                            <?php $refundable = (isset($aircraftFareBlock['refundable'])) ? $aircraftFareBlock['refundable'] : 0; ?>
                            <p class="text-danger hidden-xs mb0"><strong><?php echo ($refundable) ? 'Refundable' : ''; ?></strong></p>
                          <button class="btn btn-default" data-toggle="collapse" data-target="#departure_detail_flight_<?=$index?>" aria-expanded="false" aria-controls="departure_detail_flight_<?=$index?>">
                            <?php echo trans('052');?>
                          </button>
                        </div>
                        <div class="airline-logo">
                          <img src="<?php echo $departureTrip['aircraft']['image_path']; ?>">
                          <div class="airline-name hidden-xs">
                            <span><?php echo $departureTrip['aircraft']['carrier']['fullname']; ?></span>
                            <span class="airline-num"> -
                              <?php echo $departureTrip['aircraft']['equipment']['shortname']; ?>
                            </span>
                          </div>
                        </div>
                        <div class="flight-from hidden-xs">
                          <?php $time = $departureTrip['origin']['departure']['time']; ?>
                          <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                        </div>
                        <div class="flight-to hidden-xs">
                          <?php $time = $departureTrip['destination']['arrival']['time']; ?>
                          <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                          <!-- <span>+2</span> -->
                        </div>
                        <div class="layover">
                          <div class="layover-top">
                            <span class="hidden-sm hidden-md hidden-lg pull-left">
                            <small>
                             <strong><?php echo $departureTrip['origin']['airport']['code']; ?></strong>
                             <div class="clearfix"></div>
                             <?php $time = $departureTrip['origin']['departure']['time']; ?>
                             <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                            </small>
                            </span>
                            <span class="hidden-xs"><?php echo ($departureTrip['flightItinerary']['totalStops'] == 0) ? 'Direct' : $departureTrip['flightItinerary']['totalStops'] . ' Stop, '; ?></span>
                            <span class="hidden-xs"><?php echo $departureTrip['flightItinerary']['totalOptions']; ?> <?php echo trans('0559');?>,</span>
                            <strong><span class="hidden-sm hidden-md hidden-lg"></span></strong>

                            <!-- <span class="hidden-xs">Layover: 21 hrs (AUH)</span></strong> this otpion will be appear in foreach($segments as $segment): loop section -->
                            <span class="hidden-sm hidden-md hidden-lg pull-right pr24">
                            <small>
                            <strong><?php echo $departureTrip['destination']['airport']['code']; ?></strong>
                            <div class="clearfix"></div>
                            <?php $time = $departureTrip['destination']['arrival']['time']; ?>
                          <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                            </small>
                          </span>
                          </div>
                          <div class="layover-bottom">
                            <strong><span class="hidden-xs"><?php echo trans('0560');?></span> <?php echo $departureTrip['totalDuration']['hour']; ?> hrs <?php echo $departureTrip['totalDuration']['minute']; ?> <span class="hidden-xs"><?php echo trans('0561');?></span></strong>
                          </div>
                        </div>
                      </div><!--/ .bg-color -->
                    </div><!--/ .flight-result-grid -->
                    <!------------------     END: DEPARTURE Aggregate data box    ------------------------------>

                    <!------------------     START: Return Aggregate data box    ------------------------------>
                    <?php if(isset($returnTrip) && ! empty($returnTrip)): ?>

                    <div class="hidden-xs">
                      <div class="trip-title col-md-4 col-xs-12">
                      <div class="row">
                        <span class="destination-grid"><i class="icon-plane"></i> <span><?php echo trans('0473');?></span></span> <small><?php echo $return_date; ?></small>
                      </div>
                      </div>
                      <div class="visible-xs"><div class="clearfix"></div></div>
                      <div class="departure-gird col-md-4 col-xs-6">
                        <strong><?php echo $returnTrip['origin']['airport']['code']; ?></strong>
                        <small class="hidden-xs"><?php echo $returnTrip['origin']['airport']['fullname']; ?></small>
                      </div>
                      <div class="return-gird col-md-4 col-xs-6">
                        <strong><?php echo $returnTrip['destination']['airport']['code']; ?></strong>
                        <small class="hidden-xs"><?php echo $returnTrip['destination']['airport']['fullname']; ?></small>
                      </div>
                      </div>
                    <div class="flight-result-grid">
                      <div class="bg-color">
                        <div class="available-seat">
                            <?php $refundable = (isset($aircraftFareBlock['refundable'])) ? $aircraftFareBlock['refundable'] : 0; ?>
                            <p class="text-danger hidden-xs mb0"><strong><?php echo ($refundable) ? 'Refundable' : ''; ?></strong></p>
                          <button class="btn btn-default" data-toggle="collapse" data-target="#return_detail_flight_<?=$index?>" aria-expanded="false" aria-controls="return_detail_flight_<?=$index?>"><?php echo trans('052');?></button>
                        </div>
                        <div class="airline-logo">
                          <img src="<?php echo $returnTrip['aircraft']['image_path']; ?>">
                          <div class="airline-name hidden-xs">
                            <span><?php echo $returnTrip['aircraft']['carrier']['fullname']; ?></span>
                            <span class="airline-num"> -
                              <?php echo $returnTrip['aircraft']['equipment']['shortname']; ?>
                            </span>
                          </div>
                        </div>
                        <div class="flight-from hidden-xs">
                          <?php $time = $returnTrip['origin']['departure']['time']; ?>
                          <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                        </div>
                        <div class="flight-to hidden-xs">
                          <?php $time = $returnTrip['destination']['arrival']['time']; ?>
                          <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                          <!-- <span>+2</span> -->
                        </div>
                        <div class="layover">
                          <div class="layover-top">
                            <span class="hidden-sm hidden-md hidden-lg pull-left">
                            <small>
                              <strong><?php echo $returnTrip['origin']['airport']['code']; ?></strong>
                              <div class="clearfix"></div>
                                <?php $time = $returnTrip['origin']['departure']['time']; ?>
                                <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                            </small>
                            </span>
                            <span class="hidden-xs"><?php echo ($returnTrip['flightItinerary']['totalStops'] == 0) ? 'Direct' : $returnTrip['flightItinerary']['totalStops'] . ' Stop, '; ?></span>
                            <span class="hidden-xs"><?php echo $returnTrip['flightItinerary']['totalOptions']; ?> <?php echo trans('0559');?>,</span>
                            <strong><span class="hidden-sm hidden-md hidden-lg"></span></strong>
                            <!-- <span class="hidden-xs">Layover: 21 hrs (AUH)</span></strong> -->
                            <span class="hidden-sm hidden-md hidden-lg pull-right pr24">
                            <small>
                            <strong><?php echo $returnTrip['destination']['airport']['code']; ?></strong>
                            <div class="clearfix"></div>
                            <?php $time = $returnTrip['destination']['arrival']['time']; ?>
                            <?php echo sprintf('%s:%s', $time['hour'], $time['minute']); ?>
                            </small>
                          </span>
                          </div>
                          <div class="layover-bottom">
                            <strong><span class="hidden-xs"><?php echo trans('0560');?></span> <?php echo $returnTrip['totalDuration']['hour']; ?> hrs <?php echo $returnTrip['totalDuration']['minute']; ?> <span class="hidden-xs"><?php echo trans('0561');?></span></strong>
                          </div>
                        </div>
                      </div><!--/ .bg-color -->
                    </div><!--/ .flight-result-grid -->
                  <?php endif; ?>
                  <!------------------     END: Return Aggregate data box    ------------------------------>
                  </div><!--/ .col-sm-10 col-md-10 -->

                  <!------------------     START: PRICE BOX     ------------------------------>
                  <div class="col-sm-2 col-md-2 col-xs-3 padding-zero">
                    <div class="flight-price-grid">
                      <strong><small><?php echo $priceObj['totalprice_unit']; ?></small> <?php echo $priceObj['totalprice_value']; ?> </strong>
                      <button class="btn-block booknowButton loader" data-index="<?=$index?>"><?php echo trans('0142');?></button>
                    </div>
                  </div>
                  <!------------------     END: PRICE BOX     ------------------------------>

                  <div class="clearfix"></div>

                  <!-- START: DEPARTURE DETAILS BOX -->
                    <div class="collapse" id="departure_detail_flight_<?=$index?>">
                      <div class="alert alert-danger mb0">
                        <ul class="nav nav-tabs">
                          <li class="active mob_w100p">
                            <a class="fs12" data-toggle="tab" href="#ITINERARY_<?=$index?>"><?php echo trans('0580');?></a>
                          </li>
                          <li class="mob_w100p">
                            <a class="fs12" data-toggle="tab" href="#FARE_<?=$index?>"><?php echo trans('0581');?></a>
                          </li>
                          <li class="mob_w100p">
                            <a class="fs12" data-toggle="tab" href="#BADGE_<?=$index?>"><?php echo trans('0582');?></a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="ITINERARY_<?=$index?>">
                            <?php $initialRadioChecked = TRUE; ?>
                            <?php foreach($departureTrip['flightItinerary']['segments'] as $segments): ?>
                            <table class="table table-striped mb0">
                              <thead>
                                <tr>
                                  <td><strong><?php echo trans('0583');?></strong></td>
                                  <td><strong><?php echo trans('0584');?></strong></td>
                                  <td><strong><?php echo trans('0585');?></strong></td>
                                  <td><strong><?php echo trans('0586');?></strong></td>
                                  <td><strong><?php echo trans('0587');?></strong></td>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $rowspan = TRUE; ?>
                                <?php foreach($segments as $segment): ?>
                                <?php $departure_date = $segment['departureTime']['date']; ?>
                                <?php $departure_date = sprintf('%s %s, %s', $departure_date['day'], $month_name[trim($departure_date['month'], 0)], $departure_date['year']); ?>
                                <?php $arrival_date = $segment['arrivalTime']['date']; ?>
                                <?php $arrival_date = sprintf('%s %s, %s', $arrival_date['day'], $month_name[trim($arrival_date['month'], 0)], $arrival_date['year']); ?>
                                <tr>
                                  <td><?php echo $departure_date; ?> - <?php echo $arrival_date; ?></td>
                                  <td><?php echo $segment['origin']['code']; ?> - <?php echo $segment['destination']['code']; ?></td>
                                  <td><?php echo sprintf('%s Hours %s Minute', $segment['totalDuration']['hour'], $segment['totalDuration']['minute']); ?></td>
                                  <td><?php echo $segment['bookingInformation']['CabinClass']; ?></td>
                                  <?php if($rowspan): ?>
                                  <td rowspan="<?=count($segments)?>">
                                    <input type="radio" class="radio" name="outbound_<?=$index?>" <?php echo ($initialRadioChecked) ? "checked": ""; ?> value="<?php echo implode(',', array_column($segments, 'key')); ?>" data-segment="<?php echo implode(',', array_column($segments, 'key')); ?>"/>
                                  </td>
                                  <?php endif; ?>
                                </tr>
                                <?php $rowspan = FALSE; $initialRadioChecked = FALSE; ?>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                            <?php endforeach; ?>
                          </div>
                          <div class="tab-pane fade" id="FARE_<?=$index?>">
                            <br>
                            <strong>Fare</strong> <?php echo $segment['fareDetails']['basePrice']['unit'] .' '. $segment['fareDetails']['basePrice']['value']; ?>
                            <div class="clearfix"></div><strong>Tax & Fees</strong> <?php echo $segment['fareDetails']['taxes']['unit'] .' '. $segment['fareDetails']['taxes']['value']; ?>
                            <div class="clearfix"></div><strong>Total</strong> <?php echo $segment['fareDetails']['totalPrice']['unit'] .' '. $segment['fareDetails']['totalPrice']['value']; ?>
                            <?php $refundable = (isset($segment['fareDetails']['refundable'])) ? $segment['fareDetails']['refundable'] : 0; ?>
                            <div class="clearfix"></div><strong>Refundable</strong> <?php echo ($refundable) ? 'Yes' : 'No'; ?>
                          </div>
                          <div class="tab-pane fade" id="BADGE_<?=$index?>">
                            <br>
                            <table style="width:100%">
                              <tbody>
                                <tr>
                                  <td><?php echo trans('0589');?></td>
                                  <td>
                                      <?php
                                        echo sprintf('%s %s / Person', $segment['fareInformation']->BaggageAllowance->MaxWeight->Value, $segment['fareInformation']->BaggageAllowance->MaxWeight->Unit);
                                      ?>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div><!--/ .tab-content -->
                      </div><!--/ .well mb0 -->
                    </div><!--/ .collapse -->
                    <!-- END: DEPARTURE DETAILS BOX -->

                    <!-- START: Return DETAILS BOX -->
                    <?php if($returnTrip != NULL): ?>
                    <div class="collapse" id="return_detail_flight_<?=$index?>">
                      <div class="alert alert-danger mb0">
                          <ul class="nav nav-tabs">
                              <li class="active"><a class="fs12" data-toggle="tab" href="#RETURN_ITINERARY_<?=$index?>"><?php echo trans('0580');?></a></li>
                              <li><a class="fs12" data-toggle="tab" href="#RETURN_FARE_<?=$index?>"><?php echo trans('0581');?></a></li>
                              <li><a class="fs12" data-toggle="tab" href="#RETURN_BADGE_<?=$index?>"><?php echo trans('0582');?></a></li>
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane fade in active" id="RETURN_ITINERARY_<?=$index?>">
                              <?php $initialRadioChecked = TRUE; ?>
                              <?php foreach($returnTrip['flightItinerary']['segments'] as $segments): ?>
                                <table class="table table-striped mb0">
                                  <thead>
                                    <tr>
                                  <td><strong><?php echo trans('0583');?></strong></td>
                                  <td><strong><?php echo trans('0584');?></strong></td>
                                  <td><strong><?php echo trans('0585');?></strong></td>
                                  <td><strong><?php echo trans('0586');?></strong></td>
                                  <td><strong><?php echo trans('0587');?></strong></td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $rowspan = TRUE; ?>
                                    <?php foreach($segments as $segment): ?>
                                    <?php $departure_date = $segment['departureTime']['date']; ?>
                                    <?php $departure_time = $segment['departureTime']['time']; ?>
                                    <?php $departure_date = sprintf('%s %s, %s', $departure_date['day'], $month_name[trim($departure_date['month'], 0)], ($departure_time['hour'].':'.$departure_time['minute'])); ?>
                                    <?php $arrival_date = $segment['arrivalTime']['date']; ?>
                                    <?php $arrival_time = $segment['arrivalTime']['time']; ?>
                                    <?php $arrival_date = sprintf('%s %s, %s', $arrival_date['day'], $month_name[trim($arrival_date['month'], 0)], ($arrival_time['hour'].':'.$arrival_time['minute'])); ?>
                                    <tr>
                                      <td><?php echo $departure_date; ?> - <?php echo $arrival_date; ?></td>
                                      <td><?php echo $segment['origin']['code']; ?> - <?php echo $segment['destination']['code']; ?></td>
                                      <td><?php echo sprintf('%s Hours %s Minute', $segment['totalDuration']['hour'], $segment['totalDuration']['minute']); ?></td>
                                      <td><?php echo $segment['bookingInformation']['CabinClass']; ?></td>
                                      <?php if($rowspan): ?>
                                      <td rowspan="<?=count($segments)?>">
                                        <input type="radio" class="radio" name="inbound_<?=$index?>" <?php echo ($initialRadioChecked) ? "checked": ""; ?> value="<?php echo implode(',', array_column($segments, 'key')); ?>" data-segment="<?php echo implode(',', array_column($segments, 'key')); ?>"/>
                                      </td>
                                      <?php endif; ?>
                                    </tr>
                                    <?php $rowspan = FALSE; $initialRadioChecked = FALSE; ?>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                                <?php endforeach; ?>
                              </div>
                              <div class="tab-pane fade" id="RETURN_FARE_<?=$index?>">
                                  <br>
                                  <strong>Fare</strong> <?php echo $segment['fareDetails']['basePrice']['unit'] .' '. $segment['fareDetails']['basePrice']['value']; ?>
                                  <div class="clearfix"></div><strong>Tax & Fees</strong> <?php echo $segment['fareDetails']['taxes']['unit'] .' '. $segment['fareDetails']['taxes']['value']; ?>
                                  <div class="clearfix"></div><strong>Total</strong> <?php echo $segment['fareDetails']['totalPrice']['unit'] .' '. $segment['fareDetails']['totalPrice']['value']; ?>
                                  <?php $refundable = (isset($segment['fareDetails']['refundable'])) ? $segment['fareDetails']['refundable'] : 0; ?>
                                  <div class="clearfix"></div><strong>Refundable</strong> <?php echo ($refundable) ? 'Yes' : 'No'; ?>
                              </div>
                              <div class="tab-pane fade" id="RETURN_BADGE_<?=$index?>">
                                  <br>
                                  <table style="width:100%">
                                  <tbody>
                                    <tr>
                                      <td><?php echo trans('0589');?></td>
                                      <td>
                                          <?php
                                            echo sprintf('%s %s / Person', $segment['fareInformation']->BaggageAllowance->MaxWeight->Value, $segment['fareInformation']->BaggageAllowance->MaxWeight->Unit);
                                          ?>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                          </div><!--/ .tab-content -->
                      </div><!--/ .well mb0 -->
                  </div><!--/ .collapse -->
                  <?php endif; ?>
                  <!-- END: Return DETAILS BOX -->
              </div><!--/ .row -->
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>



<!-- fliter search side bar -->
<div class="modal <?php if($isRTL == "RTL"){ ?> right <?php } else { ?> left <?php } ?> fade" id="sidebar_filter" tabindex="1" role="dialog" aria-labelledby="sidebar_filter">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close go-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="close icon-angle-<?php if($isRTL == "RTL"){ ?>right<?php } else { ?>left<?php } ?>"></i></span></button>
        <h4 class="modal-title go-text-right" id="sidebar_filter"><i class="icon_set_1_icon-65 go-right"></i> <?php echo trans('0191');?></h4>
      </div>
      <!-- fliter search side bar -->
      <div class="title">
        <h3>
          <a href="#" class="mob-filter-closebtn btn btn-sm btn-default hidden-md hidden-lg"><i class="icon-cancel"></i></a>
          Filter Search
          <div class="pull-right">
            <input class="mob-filter-cencelbtn hidden-sm hidden-md hidden-lg" type="button" value="Cancel" >
            <input class="mob-filter-applybtn hidden-sm hidden-md hidden-lg" type="button" value="Apply">
          </div>
        </h3>
        <span>to narrow down your search</span>
      </div>
      <div class="panel-heading collapser">
        <h4>
          <button class="bg-none custom_collapse"> <i class="icon-angle-up"></i> </button>
          <span>Price</span>
        </h4>
      </div>
      <div class="collapsing_data" style="margin-bottom: 15px;">
        <div class="slider-vals"> <span>SAR 3267</span> <span class="pull-right">SAR 4658</span> </div>
        <input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/>
        <div class="cleafix"></div>
      </div>
      <div class="panel-heading collapser">
        <h4>
          <button class="bg-none custom_collapse"> <i class="icon-angle-up"></i> </button>
          <span>Stops</span>
          <span class="pull-right grey-txt">From</span>
        </h4>
      </div>
      <div class="collapsing_data box-row">
        <div class="pure-checkbox">
          <input name="" value="1" id="1" type="checkbox">
          <label for="1"><span>Non Stop</span><span class="badge">2</span><span class="pull-right blue-txt">SAR 1863</span>
          </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="2" id="2" type="checkbox">
          <label for="2"> <span>One Stop</span><span class="badge">32</span><span class="pull-right blue-txt">SAR 1863</span>  </label>
        </div>
      </div>
      <div class="panel-heading collapser">
        <h4>
          <button class="bg-none custom_collapse"> <i class="icon-angle-up"></i> </button>
          <span>Timings</span>
        </h4>
      </div>
      <div class="collapsing_data box-row flight-panel">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#onward" class="padding-left" aria-controls="home" role="tab" data-toggle="tab">Onward</a></li>
          <li role="presentation"><a href="#return" aria-controls="profile" role="tab" data-toggle="tab">Return</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active fadein" id="onward">
            <section>
              <h5>Departure Time</h5>
              <ul>
                <li>
                  <label>
                  <i class="icon-moon-inv"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                  <label>
                  <i class="icon-sun"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                  <label>
                  <i class="icon-sun-inv"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                  <label>
                  <i class="icon-moon"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
              </ul>
            </section>
            <section>
              <h5>Arrival Time</h5>
              <ul>
                <li>
                  <label>
                  <i class="icon-moon-inv"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                  <label>
                  <i class="icon-sun"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                  <label>
                  <i class="icon-sun-inv"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                </li>
              </ul>
            </section>
          </div>
          <div class="tab-pane fadein" id="return">
            <section>
              <h5>Arrival Time</h5>
              <ul>
                <li>
                  <label>
                  <i class="icon-moon-inv"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                  <label>
                  <i class="icon-sun"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                  <label>
                  <i class="icon-sun-inv"></i>
                  <span>00:00</span>
                  <span>12:00</span>
                  </label>
                </li>
                <li>
                </li>
              </ul>
            </section>
          </div>
        </div>
      </div>
      <div class="panel-heading collapser">
        <h4>
          <button class="bg-none custom_collapse"> <i class="icon-angle-up"></i> </button>
          <span>Airlines</span>
        </h4>
      </div>
      <div class="collapsing_data box-row">
        <ul class="flight-tabs">
          <li class="">
            <img src="assets/img/skyteam.png">
          </li>
          <li class="">
            <img src="assets/img/skyteam.png">
          </li>
          <li class="">
            <img src="assets/img/skyteam.png">
          </li>
        </ul>
        <div class="pure-checkbox">
          <input name="" value="7" id="7" type="checkbox">
          <label for="7">
          <span class="ar-name">
          <span>
          <img src="assets/img/flight-small-logo.png">
          </span>
          <span>British Airways</span>
          </span>
          <span class="pull-right blue-txt">SAR 1863</span>
          </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="8" id="8" type="checkbox">
          <label for="8">
          <span class="ar-name">
          <span>
          <img src="assets/img/flight-small-logo.png">
          </span>
          <span>British Airways</span>
          </span>
          <span class="pull-right blue-txt">SAR 1863</span>
          </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="9" id="9" type="checkbox">
          <label for="9">
          <span class="ar-name">
          <span>
          <img src="assets/img/flight-small-logo.png">
          </span>
          <span>British Airways</span>
          </span>
          <span class="pull-right blue-txt">SAR 1863</span>
          </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="10" id="10" type="checkbox">
          <label for="10">
          <span class="ar-name">
          <span>
          <img src="assets/img/flight-small-logo.png">
          </span>
          <span>British Airways</span>
          </span>
          <span class="pull-right blue-txt">SAR 1863</span>
          </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="11" id="11" type="checkbox">
          <label for="11">
          <span class="ar-name">
          <span>
          <img src="assets/img/flight-small-logo.png">
          </span>
          <span>British Airways</span>
          </span>
          <span class="pull-right blue-txt">SAR 1863</span>
          </label>
        </div>
      </div>
      <div class="panel-heading collapser">
        <h4>
          <button class="bg-none custom_collapse"> <i class="icon-angle-up"></i></button>
          <span>Stopover Airports</span>
        </h4>
      </div>
      <div class="collapsing_data box-row">
        <div class="pure-checkbox">
          <input name="" value="13" id="13" type="checkbox">
          <label for="13"> <span>Hot Deal</span>   </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="14" id="14" type="checkbox">
          <label for="14"> <span>Hot Deal</span>   </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="15" id="15" type="checkbox">
          <label for="15"> <span>Hot Deal</span>   </label>
        </div>
        <div class="pure-checkbox">
          <input name="" value="16" id="16" type="checkbox">
          <label for="16"> <span>Hot Deal</span>   </label>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Authentication Model -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('0463');?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo trans('0464');?></p>
                <img src="<?php echo $theme_url; ?>assets/img/users.png" class="img-responsive">
                <hr>
                <div class="row">
                    <form name="loginForm" action="#" method="POST">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email"><?php echo trans('094');?>:</label>
                          <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                          <label for="pwd"><?php echo trans('095');?>:</label>
                          <input type="password" name="password" class="form-control" id="pwd">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo trans('04');?></button>
                      </div>
                    </form>
                    <div class="col-md-6">
                      <button type="button" class="btn btn-success btn-block btn-lg" id="userGuest"><?php echo trans('0167');?></button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12"><h4 class="text-center"><span id="message"><hr></span></h4></div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234');?></button>
            </div>
        </div>
    </div>
</div>
<!--/ .Authentication Model -->

<script>
  $(document).ready(function() {
    var userAuthorization = '<?php echo $userAuthorization; ?>';
    var index = undefined;
    $("#userGuest").on('click', function(e) {
        e.preventDefault();
        // process booking
        $("#myModal").modal('hide');
        processBooking(index);
    });
    $("[name='loginForm']").on('submit', function(e) {
        e.preventDefault();
        var message = document.getElementById("message");
        message.innerHTML = "Processing...";
        var payload = $(this).serializeArray();
        $.post( base_url + 'auth/signin', payload, function(response) {
            message.innerHTML = response.message;
            if(response.status == 'success') {
              // Set username in header
              $('.navbar-right.sidebar #li_myaccount').hide();
              $('.navbar-right.sidebar').prepend(response.username_li);
              // process booking
              $("#myModal").modal('hide');
              processBooking(index);
            }
        });
    });
    var processBooking = function(index) {
        window.scrollTo(0, 0);
        var payload = {
            outbound: $("[name='outbound_"+index+"']").val(),
            inbound: $("[name='inbound_"+index+"']").val(),
        };

        $('.loader-wrapper').show();
        $.post(base_url + 'flight/cart/checkout', payload, function(response) {
            $('.loader-wrapper').hide();
            $('#body-section').html(response.body);
        });
    };
    $(".booknowButton").on('click', function(e) {
        e.preventDefault();
        index = $(this).data('index');
        if (userAuthorization == 0) {
            $("#myModal").modal('show');
        } else {
          processBooking(index);
        }
    });
    $(".search-form").hide();

    $(".modifyHotelSearch").click(function(){
           $(".search-form").slideToggle('fast');
           $(this).find("i").toggleClass("icon-angle-up icon-angle-down")
    })
    $("div").removeClass('home-bg-img');
    $(".filter-search-close").click(function(event) {
      $(this).find("i").toggleClass('icon-angle-right icon-angle-left');

      if($(".filter-Sec").hasClass('filter-hidden')){
         $(".filter-Sec").show().removeClass('filter-hidden');
        $(".flight-info-sec").css("width","80%");
      }
      else{
          $(".filter-Sec").hide().addClass('filter-hidden');
          $(".flight-info-sec").css("width","100%");
      }
    });
    $(".custom_collapse").click(function(event) {
      $(this).children('i').toggleClass('icon-angle-up icon-angle-down');

      $(this).parents('.collapser').next('.collapsing_data').slideToggle(600);
    });
    $('#ex2').slider().on('change', function(event2) {
        var a = event2.value.newValue;
        var b = event2.value.oldValue;
        var changed = !($.inArray(a[0], b) !== -1 &&
                        $.inArray(a[1], b) !== -1 &&
                        $.inArray(b[0], a) !== -1 &&
                        $.inArray(b[1], a) !== -1 &&
                        a.length === b.length);
        if(changed) {
            //value change event code here
        }
    });
  });
</script>