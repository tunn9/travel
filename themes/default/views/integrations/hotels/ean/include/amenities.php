      <div id="AMENITIES">
      <div class="col-md-12">
        <h4 class="main-title go-right"><?php echo trans('048');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line go-right"></i>
        <div class="clearfix"></div>
        <div class="go-text-right">
          <?php
    if(!empty($Facilities)){  ?>
  <div class="row">
    <div class="col-md-4">
      <ul class="list_ok go-right RTL">
        <?php $amcount = 0; foreach($Facilities as $ham){ $amcount++; ?>
        <li><?php echo ucwords($ham['amenity']);?></li>
        <?php if($amcount % 7 == 0){ ?>
      </ul>
    </div>
    <div class="col-md-4">
      <ul class="list_ok go-right RTL">
        <?php } } ?>
      </ul>
    </div>
  </div>
  <div class="clearfix"></div>
  <?php } ?>
        </div>
      </div>
      <div class="clearfix"></div>
      </div>