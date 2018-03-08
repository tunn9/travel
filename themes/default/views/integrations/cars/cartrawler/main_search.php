<?php  if(pt_main_module_available('cartrawler')){ ?>
<form class="row rental" action="<?php echo base_url();?>car/" method="GET" target="_self">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label class="go-right"><?php echo trans('0210'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-21"></i>
            <input class='car-startlocation' name="startlocation" type='text' placeholder='select item' />
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
        <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('0472');?></label>
            <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpcd1" name="pickupdate" value="" placeholder="<?php echo trans('08');?>" required />
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
        <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0259');?></label>
            <select class="form-control" name="timeDepart">
                <?php foreach($timing as $time){ ?>
                <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label class="go-right"><?php echo trans('0211'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-21"></i>
            <input class='car-endlocation' name="endlocation" type='text' placeholder='select item' />
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
        <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('0473');?></label>
            <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpcd2" name="dropoffdate" value="" placeholder="<?php echo trans('08');?>" required />
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 go-right">
        <div class="form-group" >
            <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0259');?></label>
            <select class="form-control" name="timeReturn">
                <?php foreach($timing as $time){ ?>
                <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="clearfix"></div>
        <input type="hidden" id="pickuplocation" name="pickupLocationId" value="">
        <input type="hidden" id="returnlocation" name="returnLocationId" value="">
        <input type="hidden" name="clientId" value="<?php echo $cartrawlerid;?>">
        <input type="hidden" name="residencyId" value="PK">
        <input type="submit" value="<?php echo trans('012');?>" style="color:#fff" class="btn btn-lg btn-danger green btn-block loader">
    </div>
</form>
<div class="clearfix"></div>
<?php } ?>