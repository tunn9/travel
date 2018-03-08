<form style="padding-top:10px" action="" method="GET">
  <div class="row" >
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('07');?></label>
        <input type="text" placeholder="<?php echo trans('07');?>" name="checkin" class="form-control-icon input-lg form-control dpean1 icon-calendar" value="<?php echo $checkin;?>" required>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('09');?></label>
        <input type="text" placeholder="<?php echo trans('09');?>" name="checkout" class="form-control-icon input-lg form-control dpean2 icon-calendar" value="<?php echo $checkout;?>" required>
      </div>
    </div>
  </div>
  <div class="row" >
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('010');?></label>
        <select data-placeholder="<?php echo trans('010');?>" class="form-control-icon icon-guests form-control input-lg RTL" name="adults" required>
          <?php for($adults = 1; $adults < 11;$adults++){ ?>
          <option value="<?php echo $adults;?>" <?php if($adults == $adultsCount){ echo "selected"; } ?> > <?php echo $adults;?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('011');?></label>
        <select data-placeholder="Children" class="form-control-icon icon-guests form-control input-lg RTL childcount" name="child">
          <option value="0" selected>0</option>
          <?php for($child = 1; $child < 6;$child++){ ?>
          <option value="<?php echo $child;?>" <?php if($child == $childCount){ echo "selected"; } ?>> <?php echo $child;?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
   <input type="hidden" name="ages" id="childages" value="<?php echo $childAges; ?>">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
      <button type="submit" class="btn btn-block btn-lg btn-warning"><i class="fa fa-search"></i> <?php echo trans('0106');?></button>
    </div>
  </div>
</form>
<div class="clearfix"></div>
<div class="panel-body">
  <div class="col-lg-7n col-md-6">
    <h2 style="margin-top: 0px;"><i class="fa fa-smile-o text-warning"></i> <?php echo $HotelSummary['tripAdvisorReviewCount']; ?></h2>
    <?php echo trans('0194');?>
  </div>
  <div class="col-lg-5 col-md-6">
    <h2 style="margin-top: 0px;"><i class="fa fa-thumbs-up text-primary"></i> <?php echo  $HotelSummary['hotelRating'];?>/<strong class="rating10">5</strong></h2>
    <?php echo trans('0195');?>
  </div>
  <div class="clearfix"></div>
  <hr style="margin-top: 5px;margin-bottom: 8px;">
  <div class="clearfix"></div>
  <div class="pull-left">
    <img src="<?php echo $HotelSummary['tripAdvisorRatingUrl']; ?>" alt="Trip Advisor Rating" />
  </div>
  <div class="pull-right">
    <span><strong><?php echo trans('0227');?> </strong>  <?php echo $HotelDetails['numberOfRooms'];?></span>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $('.reviewscore').change(function(){
  var sum = 0;
  var avg = 0;
  var id = $(this).attr("id");
  $('.reviewscore_'+id+' :selected').each(function() {
  sum += Number($(this).val());
  });
  avg = sum/5;
  $("#avgall_"+id).html(avg);
  $("#overall_"+id).val(avg);
  });

  //submit review
  $(".addreview").on("click",function(){
  var id = $(this).prop("id");
  $.post("<?php echo base_url();?>admin/ajaxcalls/postreview", $("#reviews-form-"+id).serialize(), function(resp){
    var response = $.parseJSON(resp);
   // alert(response.msg);
    $("#review_result"+id).html("<div class='alert "+response.divclass+"'>"+response.msg+"</div>").fadeIn("slow");
  });

  setTimeout(function(){

  $("#review_result"+id).fadeOut("slow");

  }, 3000);

  });

  })
</script>
<script type="text/javascript">
  $(function(){
  // Add/remove wishlist
  $(".wish").on('click',function(){
  var loggedin = $("#loggedin").val();
  var removelisttxt = $("#removetxt").val();
  var addlisttxt = $("#addtxt").val();
  var title = $("#itemid").val();
  var module = $("#module").val();
  if(loggedin > 0){ if($(this).hasClass('addwishlist')){
   var confirm1 = confirm("<?php echo trans('0437');?>");
   if(confirm1){
     $(".wish").removeClass('addwishlist btn-primary');
  $(".wish").addClass('removewishlist btn-warning');
  $(".wishtext").html(removelisttxt);
  $.post("<?php echo base_url();?>account/wishlist/add", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){ });

   }
   return false;

  }else if($(this).hasClass('removewishlist')){
  var confirm2 = confirm("<?php echo trans('0436');?>");
  if(confirm2){
   $(".wish").addClass('addwishlist btn-primary'); $(".wish").removeClass('removewishlist btn-warning');
  $(".wishtext").html(addlisttxt);
  $.post("<?php echo base_url();?>account/wishlist/remove", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){
  });
  }
  return false;

  } }else{ alert('Please Login to add to wishlist.'); } });
  // End Add/remove wishlist
  })
  // End document ready
</script>
