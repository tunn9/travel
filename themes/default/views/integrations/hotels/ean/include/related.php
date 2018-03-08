<div id="RELATED" class="lastminute4">
  <div class="container cstyle04">
    <div class="row anim3">
      <div class="col-md-3 visible-lg visible-md go-right">
        <h2 class="go-right"><?php echo trans('0290');?></h2>
        <div class="clearfix"></div>
        <hr style="border-top: 1px solid #DADADA;">
        <a href="<?php echo base_url(); ?>hotels" class="btn iosbtn go-right"><?php echo trans('0466');?> <?php echo trans('Hotels');?></a>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-9 col-sm-12 go-left">
        <!-- Carousel -->
        <div class="wrapper">
          <div class="list_carousel">
            <ul id="foo2">
              <?php  foreach($relatedHotels->hotels as $related) {  ?>
              <li>
                <a href="<?php echo $related->slug;?>"><img style="max-height:200px" class="img-responsive" src="<?php echo $related->thumbnail; ?>" alt="<?php echo character_limiter($related->title, 10); ?>"/></a>
                <div class="m1">
                  <h6 class="lh1 dark go-right">
                    <b>
                      <?php echo character_limiter($related->title, 10); ?>
                      <span class="pull-right">
                        <?php  if($related->price > 0){ ?>
                        <?php echo $related->currCode; ?> <?php echo $related->price; ?>
                        <?php } ?>
                        &nbsp;&nbsp;
                        <h6 class="lh1 green go-right">
                          <?php if($item->avgReviews->overall > 0){ ?>
                          <div id="score"><span><i class="icon_set_1_icon-18"></i> <?php echo $item->avgReviews->overall;?></span></div>
                          <?php } ?>
                        </h6>
                      </span>
                      <br><br>
                      <?php echo $related->location;?>
                      <?php echo $item->location;?> <?php echo $related->stars; ?> &nbsp;&nbsp;
                    </b>
                  </h6>
                </div>
              </li>
              <?php }  ?>
            </ul>
            <div class="clearfix"></div>
            <a id="prev_btn2" class="prev offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a>
            <a id="next_btn2" class="next offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>