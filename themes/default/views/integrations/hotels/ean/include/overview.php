<section class="bg-white">
  <div class="container">
    <div id="DESCRIPTION" class="row">
      <div class="panel-body">
        <h2 class="main-title go-right"><?php echo trans('046');?></h2>
        <div class="clearfix"></div>
        <i class="tiltle-line go-right"></i>
        <span class="go-right RTL"><?php echo html_entity_decode(str_replace("Property Location","",$HotelDetails['propertyDescription']));?></span>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <h4 id="terms" class="main-title  go-right"><?php echo trans('0148');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line  go-right"></i>
        <div class="clearfix"></div>
        <span class="RTL">
          <p><?php echo html_entity_decode($HotelDetails['hotelPolicy']);?></p>
        </span>
         <p><strong> <?php echo trans('0458');?> </strong> : <?php echo $HotelDetails['checkInInstructions']; ?> </p>
            <p class="go-text-right"><i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('07');?> </strong> :   <?php echo $HotelDetails['checkInTime'];?> - <i class="fa fa-clock-o text-warning"></i>   <strong> <?php echo trans('09');?> </strong> :  <?php echo $HotelDetails['checkOutTime'];?> </p>
            <p><strong> <?php echo trans('0538');?> </strong> : <?php echo $HotelDetails['roomFeesDescription']; ?> </p>
            <h4 id="terms" class="main-title  go-right"><?php echo trans('058');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line go-right"></i>
            <div class="clearfix"></div>
            <p class="go-right RTL"><?php echo trans('0200');?></p>
      </div>
    </div>
  </div>
</section>



