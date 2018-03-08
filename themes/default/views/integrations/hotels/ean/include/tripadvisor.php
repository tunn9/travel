 <a style="cursor:pointer" data-toggle="modal" data-target="#myModal"><img src="https://www.tripadvisor.com/img/cdsi/img2/ratings/traveler/4.0-23961-5.png" alt="" /></a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">

                                  <div class="">

                                  <!---------------TripAdvisor Starting---------------->
<?php if (!empty ($tripadvisorinfo->rating)) {?>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo $tripadvisorinfo->web_url;?>" target="_blank"><img class="img-responsive" style="height:30px" src="<?php echo PT_GLOBAL_IMAGES_FOLDER . 'tripadvisor.png';?>" alt="" /></a>
        </div>
      </div>
    </nav>
    <div class="well whitewell" style="margin-bottom: 0px;">
      <p><?php echo trans('0303');?> <?php echo $tripadvisorinfo->ranking_data->ranking_string;?></p>
      <div class="clearfix"></div>
      <div class="line3"></div>
      <div class="panel-body">
        <h4><strong><?php echo trans('0230');?></strong> <?php echo $tripadvisorinfo->rating;?>/<strong>5</strong></h4>
        <h4><img src="<?php echo $tripadvisorinfo->rating_image_url;?>" alt="" /></h4>
        <a href="<?php echo $tripadvisorinfo->web_url;?>" target="_blank"> <?php echo $tripadvisorinfo->num_reviews;?> <?php echo trans('042');?></a>
        <br>
        <a href="<?php echo $tripadvisorinfo->write_review;?>" target="_blank"><?php echo trans('0337');?></a>
        <br>
        <a href="//tripadvisor.com/pages/terms.html" target="_blank"> &copy TripAdvisor 2014</a>
      </div>
      <div class="clearfix"></div>
    </div>
    <?php }?>
    <!---------------TripAdvisor Ending------------------------>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo trans('0234');?></button>
                                  </div>
                                </div>
                              </div>
                            </div>





