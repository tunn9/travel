<?php if(isset($travelportBookings) && ! empty($travelportBookings)): ?>
<?php foreach($travelportBookings as $travelport): ?>
<div class="row">
  <div class="col-md-5 offset-0">
    <img alt="" class="left mr20 img-responsive" style="width: 100%;max-width:96px;border:solid 1px #ccc;" src="<?php echo $travelport->carrier->image_path; ?>">
    <a class="dark" href="#"><b><?php echo sprintf('%s (%s)', $travelport->destination->fullname, $travelport->destination->code); ?></b></a> <br>
    <span class="dark size12"><?php echo sprintf('%s (%s)', $travelport->carrier->fullname, $travelport->carrier->code); ?> 
    <!-- / <i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i> -->
    </span><br>
    <span class="opensans green bold size14"><strong><small><?php echo $travelport->access_token; ?> </small><?php echo $travelport->total_price; ?></strong></span> - <small><span class="grey"><?php echo $travelport->createdAt; ?></span></small><br>
  </div>
  <div class="col-md-3">
    <span class="grey">
    <strong>Booking Code </strong> <?php echo $travelport->access_token; ?> <br>
    <strong>Due Date </strong> <?php echo $travelport->createdAt; ?> <br>
    </span>
  </div>
  <div class="col-md-2">
    <h5 class="mt0"><strong>
            <span class="alert alert-success btn-block text-center">Paid</span>
      </strong>
    </h5>
  </div>
  <div class="col-md-2 offset-0">
    <a style="margin-bottom:5px" href="<?php echo site_url('flight/invoice?token='.$travelport->access_token); ?>" target="_blank" class="btn btn-action btn-block">Invoice</a>
   <div class="clearfix"></div>   </div>
  <div class="clearfix"></div>
  <div class="line2"></div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?php 
  if(!empty($bookings) || !empty($eanbookings)){ if(!empty($bookings))
  { 
    foreach($bookings as $b){ 
?>

<div class="row">
  <div class="col-md-5 offset-0">
    <img alt="" class="left mr20 img-responsive" style="max-width:96px" src="<?php echo $b->thumbnail;?>">
    <a class="dark" href="#"><b><?php echo $b->title; ?></b></a> <br>
    <span class="dark size12"><?php echo $b->location;?> / <?php echo $b->stars;?></span><br>
    <span class="opensans green bold size14"><strong><small><?php echo $b->currCode;?> <?php echo $b->currSymbol;?></small><?php echo $b->checkoutTotal;?></strong></span> - <small><span class="grey"><?php echo $b->date;?></span></small><br>
  </div>
  <div class="col-md-3">
    <span class="grey">
    <strong><?php echo trans('0145');?> <?php echo trans('021');?></strong> <?php echo $b->id;?><br>
    <strong><?php echo trans('0398');?> </strong> <?php echo $b->code;?> <br>
    <strong><?php echo trans('079');?> </strong> <?php echo $b->expiry;?> <br>
    </span>
  </div>
  <div class="col-md-2">
    <h5 class="mt0"><strong>
      <?php if($b->status == "paid"){ ?>
      <span class="alert alert-success btn-block text-center"><?php echo trans('081');?></span>
      <?php }elseif($b->status == "cancelled"){ ?>
      <span class="alert alert-warning btn-block text-center"><?php echo trans('0347'); ?></span>
      <?php }elseif($b->status == "reserved"){ ?>
      <span class="alert alert-warning btn-block text-center"><?php echo trans('0445');?></span>
      <?php }else{ ?>
      <span class="alert alert-danger btn-block text-center"><?php echo trans('082');?></span>
      <?php } ?></strong>
    </h5>
  </div>
  <div class="col-md-2 offset-0">
    <a style="margin-bottom:5px" href="<?php echo base_url();?>invoice?id=<?php echo $b->id;?>&sessid=<?php echo $b->code;?>" target="_blank" class="btn btn-action btn-block"><?php echo trans('076');?></a>
   <div class="clearfix"></div> <?php if($b->status == "paid"){ ?> <span class="btn btn-primary btn-block write_review" data-toggle="modal" href="#AddReview<?php echo $b->id;?>" class="btn_3"><?php if($b->reviewsData['reviewGiven'] == "yes"){ echo trans("0391"); }else{ echo trans('083');  } ?> </span> <?php } ?>
  </div>
  <div class="clearfix"></div>
  <div class="line2"></div>
</div>
<br>
<!--Comments modal -->
<div class="modal fade" id="AddReview<?php echo $b->id;?>" tabindex="" role="dialog" aria-labelledby="AddReview" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-smile-o"></i> <?php echo trans('084');?> <?php echo $b->title;?> </h4>
      </div>
      <div class="modal-body">
        <?php if($b->reviewsData['reviewGiven'] == "yes"){ ?>
        <?php echo trans('08');?>: <?php echo pt_show_date_php($b->reviewsData['reviewDate']); ?><br>
        <?php echo trans('0389');?>: <?php echo $b->reviewsData['overall']; ?><br>
        <?php echo trans('043');?>: <?php echo $b->reviewsData['reviewComment']; ?><br>
        <?php }else{ ?>
        <form class="form-horizontal" method="POST" id="reviews-form-<?php echo $b->id;?>" action="" onsubmit="return false;">
          <div class="">
            <div id="review_result<?php echo $b->id?>" >
            </div>
            <div class="">
              <div class="panel-body">
                <div class="spacer20px">
                  <div class="col-lg-4">
                    <div class="panel panel-body">
                      <div class="form-group">
                        <label class="col-md-5 control-label"><?php echo trans('0389');?></label>
                        <div class="col-md-5">
                          <label class="col-md-4 control-label"> <span class="badge badge-warning"><span id="avgall_<?php echo $b->id;?>">1</span> / 10 </span> </label>
                          <input type="hidden" name="overall" id="overall_<?php echo $b->id;?>" value="1" />
                          <input type="hidden" name="bookingid" value="<?php echo $b->id;?>" />
                          <input type="hidden" name="userid" value="<?php echo $profile[0]->accounts_id;?>" />
                          <input type="hidden" name="fullname" value="<?php echo $profile[0]->ai_first_name.' '.$profile[0]->ai_last_name;?>" />
                          <input type="hidden" name="reviewmodule" value="<?php echo $b->module;?>" />
                          <input type="hidden" name="reviewfor" value="<?php echo $b->itemid;?>" />
                        </div>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="col-md-5 control-label"><?php echo trans('030');?></label>
                        <div class="col-md-5">
                          <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_clean">
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                            <option value="9"> 9 </option>
                            <option value="10"> 10 </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label"><?php echo trans('031');?></label>
                        <div class="col-md-5">
                          <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_comfort">
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                            <option value="9"> 9 </option>
                            <option value="10"> 10 </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label"><?php echo trans('032');?></label>
                        <div class="col-md-5">
                          <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_location">
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                            <option value="9"> 9 </option>
                            <option value="10"> 10 </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label"><?php echo trans('033');?></label>
                        <div class="col-md-5">
                          <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_facilities">
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                            <option value="9"> 9 </option>
                            <option value="10"> 10 </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label"><?php echo trans('034');?></label>
                        <div class="col-md-5">
                          <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_staff">
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                            <option value="9"> 9 </option>
                            <option value="10"> 10 </option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="col-lg-12 panel panel-body">
                      <label class="control-label"> <?php echo trans('042');?> </label>
                      <textarea class="form-control" placeholder="Add review here..." rows="12" name="reviews_comments"></textarea>
                    </div>
                    <p class="text text-danger"><?php echo trans('Note');?>  <?php echo trans('085');?>.</p>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="email" value="<?php echo $profile[0]->accounts_email; ?>" />
            <input type="hidden" name="addreview" value="1" />
          </div>
        </form>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <?php if($b->reviewsData['reviewGiven'] != "yes"){ ?> <button type="button" class="btn btn-primary addreview" id="<?php echo $b->id;?>" ><i class="fa fa-save"></i> <?php echo trans('086');?></button><?php } ?>
      </div>
    </div>
  </div>
</div>
<!---Comments Modal-->
<?php } }  ?>
<?php if(!empty($eanbookings)){ // print_r($eanbookings);
  foreach($eanbookings->bookings as $eanbook){ ?>


  <div class="row">
  <div class="col-md-5 offset-0">
    <img alt="" class="left mr20 img-responsive" style="max-width:96px" src="<?php echo $eanbook->thumbnail;?>">
    <a class="dark" href="#"><b><?php echo character_limiter($eanbook->title,18); ?></b></a> <br>
    <span class="dark size12"><?php echo $eanbook->location;?> / <?php echo $eanbook->stars;?></span><br>
    <span class="opensans green bold size14"><strong><small><?php echo $eanbook->currency;?></small> <?php echo $eanbook->total;?> </strong></span> - <small><span class="grey"><?php echo $eanbook->checkin;?></span></small><br>
  </div>
  <div class="col-md-3">
    <span class="grey">
      <strong><?php echo trans('0145');?> <?php echo trans('021');?></strong> <?php echo $eanbook->id;?><br>
      <strong>Itinerary ID </strong> <?php echo $eanbook->code;?> <br>
      <strong><?php echo trans('079');?> </strong> <?php echo $eanbook->checkout;?> <br>

    </span>
  </div>
  <div class="col-md-2">
    <h5><strong>
      <?php if(!empty($eanbook->cancelNumber)){ ?>
      <span class="alert alert-warning"><?php echo trans('0347'); ?></span>
      <?php } ?></strong>
    </h5>
  </div>
  <div class="col-md-2 offset-0">
    <a style="margin-bottom:5px" href="<?php echo base_url();?>invoice?eid=<?php echo $eanbook->id;?>&sessid=<?php echo $eanbook->code;?>" target="_blank" class="btn btn-action btn-block"><?php echo trans('076');?></a>
  <?php if(empty($eanbook->cancelNumber)){ ?> <span class="btn btn-danger btn-block cancelEanBooking" id="<?php echo $eanbook->id;?>"><?php echo trans('0346'); ?></span> <?php } ?>
  </div>
  <div class="clearfix"></div>
  <div class="line2"></div>
</div>
<br>


<?php } } ?>
<!-- End expedia bookings -->
<?php }else{ ?>
<table class="table table-hover table-border table-responsive table-striped">
  <tbody>
    <h4><strong> <?php echo trans('087');?> </strong></h4>
  </tbody>
</table>
<?php } ?>
<script type="text/javascript">
  $(function(){
    $(".cancelEanBooking").on("click",function(){
      var bookid = $(this).prop("id");
      $.post("<?php echo base_url();?>ean/cancel",{id: bookid},function(resp){
        if(resp == "success"){
          location.reload();
          return true;
        }else{
          alert(resp);
          return false;
        }

      })
    })
  })
</script>
