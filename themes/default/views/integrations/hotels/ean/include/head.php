<div class="container">
<div class="row">
  <div class="col-md-7 go-right">
    <h2 class="go-right"><strong><?php echo character_limiter($HotelSummary['name'], 28);?></strong></h2>
    <div class="clearfix"></div>
    <h4 class="go-right RTL"><i class="icon-location-6"></i> <?php echo character_limiter($HotelSummary['city'],35);?> <?php if($HotelSummary['hotelRating'] < 1){ $hrating = 1; }else{ $hrating = $HotelSummary['hotelRating']; } echo pt_create_stars(intval($hrating)); ?></h4>
  </div>
  <div class="col-md-5">
    <div class="row">
      <div class="visible-lg visible-md col-md-6 go-right" style="margin-top:10px">
      </div>
      <div class="col-md-6 go-left" style="margin-top:20px">
        <a class="btn btn-primary pull-right btn-block" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>
      </div>
    </div>
  </div>
</div>
</div>