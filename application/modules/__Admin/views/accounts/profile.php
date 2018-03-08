<form action="" method="POST">
<?php echo @$msg; ?>
<div class="panel panel-default">
  <div class="panel-heading"><?php echo trans('0116');?></div>
  <div class="panel-body">
    <div class="panel-body">
      <div class="col-md-12">
        <div class="form-group ">
          <label class="required">Account Type</label>
          <input class="form-control" type="text" disabled="disabled" placeholder="Account Type" name="" value="<?php echo $accType;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0122');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0122');?>" name="fname" value="<?php echo $profile[0]->ai_first_name;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0123');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0123');?>" name="lname" value="<?php echo $profile[0]->ai_last_name;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Email</label>
          <input class="form-control" type="email" placeholder="Địa chỉ Email" name="email" value="<?php echo $profile[0]->accounts_email;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('097');?></label>
          <input class="form-control" type="password" placeholder="<?php echo trans('097');?>" name="password">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0124');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0124');?>" name="mobile" value="<?php echo $profile[0]->ai_mobile;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('068');?></label>
          <select class="chosen-select" name="country" id="">
          <option value="">Select</option>
            <?php foreach($countries as $c){ ?>
            <option value="<?php echo $c->iso2;?>" <?php if($profile[0]->ai_country == $c->iso2){ echo "selected"; }?> ><?php echo $c->short_name;?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0126');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0128');?>" name="address1" value="<?php echo $profile[0]->ai_address_1;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0127');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0128');?>" name="address2" value="<?php echo $profile[0]->ai_address_2;?>">
        </div>
      </div>
      <?php if(empty($isSuperAdmin)){ ?>
      <div class="col-md-6">
        <div class="col-md-12">
        <div class="row">
        <label>
              <input class="checkbox" type="checkbox" name="newssub" value="1" <?php if($isSubscribed){ echo "checked"; }?> > <strong>Email Newsletter Subscriber</strong>
        </label>
        </div>
        </div>
      </div>
      <?php } ?>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="panel-footer">
  <input type="hidden" name="update" value="1" />
  <input type="hidden" name="type" value="<?php echo $profile[0]->accounts_type;?>" />
  <input type="hidden" name="status" value="<?php echo $profile[0]->accounts_status;?>" />
  <input type="hidden" name="oldemail" value="<?php echo $profile[0]->accounts_email;?>" />
    <button class="btn btn-primary"><?php echo trans('0142');?></button>
  </div>
</div>
</form>



