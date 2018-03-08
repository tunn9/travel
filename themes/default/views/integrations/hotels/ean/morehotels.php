<div class="clearfix"></div>
<input type="hidden" name="moreResultsAvailable" id="moreResultsAvailable" value="<?php echo $moreResultsAvailable; ?>" />
<input type="hidden" name="cacheKey" id="cacheKey" value="<?php echo $cacheKey; ?>" />
<input type="hidden" name="cacheLocation" id="cacheLocation" value="<?php echo $cacheLocation; ?>" />
<input type="hidden" name="" id="agesappendurl" value="<?php echo $agesApendUrl; ?>" />

<table class="bgwhite table table-striped">
<?php if(!empty($module)){ foreach($module as $item){ ?>



<tr>
<td class="wow fadeIn p-10-0 animated">
            <div class="col-md-4 col-xs-5 go-right rtl_pic">

              <div class="img_list">
                <a href="<?php echo $item->slug;?>">
                  <img <?php echo lazy(); ?> class="" data-lazy="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
                  <div class="short_info"></div>
                </a>
              </div>
            </div>
            <div class="col-md-8 col-xs-7 g0-left">
              <div class="row">
                <h4 class="RTL go-text-right mt0 list_title">
                  <a href="<?php echo $item->slug;?>"><b><?php echo character_limiter($item->title,20);?></b></a>
                </h4>
                 <a class="go-right" href="javascript:void(0);" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/<?php echo $appModule; ?>/<?php echo $item->id;?>','modal');" title="<?php echo $item->location;?>"><i style="margin-left: -3px;" class="icon-location-6 go-right"></i><?php echo character_limiter($item->location,10);?></a> <span class="go-right"><?php echo $item->stars;?></span>
                  <p style="margin: 7px 0px 7px 0px;" class="grey RTL fs12 hidden-xs"><?php echo character_limiter($item->desc,200);?></p>
                  <div class="hidden-xs">
                  <div class="mt15"></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-xs-6 col-sm-4 go-right">
                    <?php  if($item->price > 0){ ?>
                  <div class="row">
                                        <div class="text-success fs18 text-left go-text-right go-right review ">
                      <b>
                      <small><?php echo $item->currCode;?></small><?php echo $item->currSymbol; ?><?php echo $item->price;?> </b>
                    </div>
                                      </div>
                                      <?php } ?>
                </div>
                <div class="col-md-4 col-xs-4 col-sm-4 hidden-xs go-right">


                <?php if($appModule == "ean"){ if($item->tripAdvisorRating > 0){ ?>
              <div class="review text-center size18"><i class="icon-thumbs-up-4"></i><?php echo $item->tripAdvisorRating;?> </div>
              <div class="clearfix"></div>

              <?php } } ?>
                  <div class="clearfix"></div>
                                  </div>
                <div class="col-md-4 col-xs-6 col-sm-4 go-left">
                  <a href="<?php echo $item->slug;?>">
                  <button class="mt15 btn btn-action btn-block"><?php echo trans('0177');?></button>
                 </a>
                </div>
              </div>
            </div>
          </td>
         </tr>
  <?php } } ?>
</table>