<form action="" class="form-horizontal" method="POST">
  <div class="panel panel-default">
    <div class="panel-heading"> <?php echo trans('0175');?></div>
    <div class="panel-body">
      <?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } ?>
      <!--<div class="row form-group">
        <label class="col-md-2 control-label text-left">Icon Class</label>
        <div class="col-md-4">
          <input type="text" name="page_icon" class="form-control" value="<?php echo $settings[0]->front_icon;?>" >
        </div>
      </div>-->
      <div class="row form-group">
        <label class="col-md-2 control-label text-left"><?php echo trans('0176');?></label>
        <div class="col-md-4">
          <select  class="form-control" name="target">
            <option  value="_self" <?php if($settings[0]->linktarget == "_self"){ echo "selected";} ?>   ><?php echo trans('0177');?></option>
            <option  value="_blank"  <?php if($settings[0]->linktarget == "_blank"){ echo "selected";} ?>  ><?php echo trans('0178');?></option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-2 control-label text-left"><?php echo trans('0113');?></label>
        <div class="col-md-4">
          <input type="text" name="headertitle" class="form-control" placeholder="<?php echo trans('0113');?>" value="<?php echo $settings[0]->header_title;?>" />
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-2 control-label text-left"><?php echo trans('0179');?></label>
        <div class="col-md-4">
          <input class="form-control" type="text" placeholder="" name="listings"  value="<?php echo $settings[0]->front_listings;?>">
        </div>
      </div>
      <!--<div class="row form-group">
        <label class="col-md-2 control-label text-left">Homepage</label>
        <div class="col-md-4">
          <input class="form-control" type="text" placeholder="" name="home"  value="<?php echo $settings[0]->front_homepage;?>">
        </div>
      </div>-->
    </div>
    <div class="panel-footer">
      <input type="hidden" name="updatesettings" value="1" />
      <input type="hidden" name="updatefor" value="offers" />
      <button class="btn btn-primary"><?php echo trans('0134');?></button>
    </div>
  </div>
</form>