
                      <p class="main-title go-right"><?php echo trans('046');?></p>
                      <div class="clearfix"></div>
                      <i class="tiltle-line  go-right"></i>
                      <div class="clearfix"></div>
                      <?php echo $module->desc; ?>

                      <?php if($appModule == "ean" || $appModule == "hotels" || $appModule == "tours" || $appModule == "cars"){ ?>
                      <hr>
                      <?php } ?>

                      <div class="clearfix"></div>
                      <?php if($appModule == "offers"){  }else if($appModule == "cars" || $appModule == "hotels" || $appModule == "ean" || $appModule == "tours"){ ?>
                      <!-- Start checkInInstructions -->
                      <?php if(!empty($checkInInstructions)){ ?>
                      <div class="panel panel-default">
                        <div class="panel-heading go-text-right panel-green">
                          <?php echo trans('0550'); ?>
                        </div>
                        <?php }  if(!empty($checkInInstructions)){ ?>
                        <div class="panel-body">
                          <span class="RTL">
                            <p>
                              <?php echo $checkInInstructions; ?>
                            </p>
                          </span>
                        </div>
                        <?php } ?>
                        <!-- End checkInInstructions -->
                        <!-- Start SpecialcheckInInstructions -->
                        <?php if(!empty($specialCheckInInstructions)){ ?>
                        <div class="panel-heading go-text-right panel-green">
                          <?php echo trans('0551'); ?>
                        </div>
                        <?php }  if(!empty($specialCheckInInstructions)){ ?>
                        <div class="panel-body">
                          <span class="RTL">
                            <p>
                              <?php echo $specialCheckInInstructions; ?>
                            </p>
                          </span>
                        </div>
                      </div>
                      <?php } ?>
                      <!-- End  SpecialcheckInInstructions -->
                      <?php if(!empty($module->policy)){ ?>
                      <p class="main-title go-right"><?php echo trans('0148');?></p>
                      <div class="clearfix"></div>
                      <i class="tiltle-line  go-right"></i>
                      <div class="clearfix"></div>
                      <?php echo $module->policy; } ?>
                      <?php } ?>
                      <?php if($appModule != "cars" && $appModule != "ean"){ ?>
                      <div class="clearfix"></div>
                      <hr>
                      <?php if(!empty($module->paymentOptions)){ ?>
                      <p id="terms" class="main-title  go-right"><?php echo trans('0265');?></p>
                      <div class="clearfix"></div>
                      <i class="tiltle-line  go-right"></i>
                      <div class="clearfix"></div>
                      <span class="RTL">
                      <?php foreach($module->paymentOptions as $pay){ if(!empty($pay->name)){ ?>
                      <?php echo $pay->name;?> -
                      <?php } } ?>
                      </span>
                      <br><br>
                      <?php } ?>
                      <div class="hidden-xs">
                        <?php if($appModule == "hotels"){ ?>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="go-right">
                          <p class="main-title  go-right"><?php echo trans('07');?></p>
                          <div class="clearfix"></div>
                          <i class="tiltle-line go-right"></i>
                          <div class="clearfix"></div>
                          <p class="RTL">
                            <i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('07');?> </strong> :   <?php echo $module->defcheckin;?>
                            <br>
                            <i class="fa fa-clock-o text-warning"></i> <strong> <?php echo trans('09');?> </strong> :  <?php echo $module->defcheckout;?>
                          </p>
                        </div>
                        <?php } ?>
                      </div>
                      <!-- Start Tours Inclusions / Exclusions -->
                      <?php if($appModule == "tours"){ ?>
                      <p class="go-text-left"><i class="fa fa-sun-o text-success"></i> <strong> <?php echo trans('0275');?> </strong> :   <?php echo $module->tourDays;?> | <i class="fa fa-moon-o text-warning"></i>   <strong> <?php echo trans('0276');?> </strong> :  <?php echo $module->tourNights;?> </p>
                      <div class="">
                        <div class="clearfix"></div>
                        <hr>
                        <div id="INCLUSIONS">
                          <h4 class="main-title go-right"><?php echo trans('0280');?></h4>
                          <div class="clearfix"></div>
                          <i class="tiltle-line go-right"></i>
                          <div class="clearfix"></div>
                          <br>
                          <?php foreach($module->inclusions as $inclusion){ if(!empty($inclusion->name)){  ?>
                          <ul class="list_ok col-md-12 RTL" style="margin: 0 0 5px 0;">
                            <li class="go-right"><?php echo $inclusion->name; ?></li>
                          </ul>
                          <?php } } ?>
                          <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                        <hr>

                        <div id="EXCLUSIONS">
                          <h4 class="main-title go-right"><?php echo trans('0281');?></h4>
                          <div class="clearfix"></div>
                          <i class="tiltle-line go-right"></i>
                          <div class="clearfix"></div>
                          <br>
                          <?php foreach($module->exclusions as $exclusion){ if(!empty($exclusion->name)){  ?>
                          <ul class="col-md-12" style="margin: 0 0 5px 0;list-style:none;">
                            <li class="go-right"><i style="font-size: 13px; color: #E25A70; margin-left: -16px;" class="icon-cancel-5 go-right"></i> &nbsp;&nbsp;&nbsp; <?php echo $exclusion->name; ?> &nbsp;&nbsp;&nbsp;</li>
                          </ul>
                          <?php } } ?>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                      <?php } } ?>


