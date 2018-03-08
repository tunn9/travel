<?php if (!empty ($tripadvisorinfo->rating)) { ?>
<a href="<?php echo $tripadvisorinfo->web_url;?>" target="_blank">
<img class="img-responsive center-block" src="<?php echo PT_GLOBAL_IMAGES_FOLDER . 'tripadvisor.png';?>" alt="tripadvisor" /></a>
<p class="text-center"><a href="//tripadvisor.com/pages/terms.html" target="_blank"> &copy TripAdvisor 2016</a></p>
<p class="text-center"><?php echo trans('0303');?> <?php echo $tripadvisorinfo->ranking_data->ranking_string;?></p>
<center>
  <hr>
  <h4 class="text-center"><strong><a href="<?php echo $tripadvisorinfo->web_url;?>" target="_blank"> <?php echo $tripadvisorinfo->num_reviews;?> <?php echo trans('042');?></a></strong></h4>
  <hr>
  <div class="c100 p<?php echo $tripadvisorinfo->rating * 20;?>" style="margin-top:10px;margin-left: 20%;">
    <span><strong><?php echo $tripadvisorinfo->rating;?> </strong>/<small>5</small></span>
    <div class="slice">
      <div class="bar"></div>
      <div class="fill"></div>
    </div>
  </div>
  <div class="clearfix"></div>
  <strong><?php echo trans('0230');?></strong>
  <img src="<?php echo $tripadvisorinfo->rating_image_url;?>" alt="" />
  <div class="clearfix"></div>
  <hr>
  <a class="btn btn-success btn-lg btn-block" href="<?php echo $tripadvisorinfo->write_review;?>" target="_blank"><i class="icon_set_1_icon-68"></i> <?php echo trans('0337');?></a>
  <a target="_blank" href="<?php echo $tripadvisorinfo->web_url;?>" class="btn btn-primary btn-lg btn-block btn-lgs"><i class="icon_set_1_icon-93"></i> <?php echo trans('0394');?></a>
</center>
<?php }?>