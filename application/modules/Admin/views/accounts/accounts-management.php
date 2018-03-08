<?php
$validationerrors = validation_errors();
if(isset($errormsg) || !empty($validationerrors)){
?>
<div class="alert alert-danger">
<i class="fa fa-times-circle"></i>
<?php
echo @$errormsg;
echo $validationerrors; ?>
</div>
<?php
}
?>
<form action="" method="POST">
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $headertitle;?></div>
  <div class="panel-body">
    <div class="panel-body">
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0122');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0122');?>" name="fname" value="<?php echo setFrmVal(@$profile[0]->ai_first_name,set_value('fname')); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0123');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0123');?>" name="lname" value="<?php echo setFrmVal(@$profile[0]->ai_last_name,set_value('lname')); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Email</label>
          <input class="form-control" type="email" placeholder="Địa chỉ Email" name="email" value="<?php echo setFrmVal(@$profile[0]->accounts_email,set_value('email')); ?>">
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
          <input class="form-control" type="text" placeholder="<?php echo trans('0124');?>" name="mobile" value="<?php echo setFrmVal(@$profile[0]->ai_mobile,set_value('mobile')); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0125');?></label>
          <select class="chosen-select" name="country" id="">
           <option value=""><?php echo trans('0133');?></option>
            <?php foreach($countries as $c){ ?>
            <option value="<?php echo $c->iso2;?>" <?php if(setFrmVal(@$profile[0]->ai_country,set_value('country')) == $c->iso2){ echo "selected"; }?> ><?php echo $c->short_name;?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0126');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0128');?>" name="address1" value="<?php echo setFrmVal(@$profile[0]->ai_address_1,set_value('address1')); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required"><?php echo trans('0127');?></label>
          <input class="form-control" type="text" placeholder="<?php echo trans('0128');?>" name="address2" value="<?php echo setFrmVal(@$profile[0]->ai_address_2,set_value('address2')); ?>">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6">
        <div class="col-md-4">
        <div class="row">
       <div class="form-group ">
          <label class="required"><?php echo trans('0129');?></label>
          <select name="status" class="form-control">
          <option value="yes" <?php  makeSelected($profile[0]->accounts_status,"yes"); ?>><?php echo trans('0130');?></option>
          <option value="no"  <?php  makeSelected($profile[0]->accounts_status,"no"); ?> ><?php echo trans('0131');?></option>
          </select>
        </div>

        </div>
        </div>



      </div>
     <?php if($profile[0]->accounts_verified == '0'){ ?>
      <div class="col-md-6">
      <div class="col-md-12">
        <div class="row">
         <span id="<?php echo $profile[0]->accounts_id;?>" class="btn btn-primary pull-right verify">Send Verification Details</span>
        </div>
      </div>
      </div>
      <?php } ?>
      <div class="clearfix"></div>
      <?php if($type == "supplier"){ ?>
       <div class="col-md-6">

        <div class="form-group">
          <label>Supplier For </label>
          <select name="applyfor" class="form-control">
          <?php if (!empty($mainmodules)) {
              foreach($mainmodules as $md) { if($md != "smsaddon"){ $isenabled = $this->ptmodules->is_main_module_enabled($md); if($isenabled){ ?>
              <option value="<?php echo $md;?>" <?php makeSelected($md,$appliedFor); ?> > <?php echo $md; ?> </option>
              <?php } } }
          } ?>
          </select>


        </div>
        </div>


        <div class="col-md-6">

         <div class="form-group">
          <label>Name</label>
      <input class="form-control" type="text" placeholder="Name" name="itemname" value="<?php echo @$propertyName;?>">

        </div>
        </div>
        <?php } ?>



      <div class="col-md-6">
        <div class="col-md-12">
        <div class="row">
        <label>
              <input class="checkbox" type="checkbox" name="newssub" value="1" <?php if(setFrmVal(@$isSubscribed,set_value('newssub'))){ echo "checked"; }?> > <strong><?php echo trans('0132');?></strong>
        </label>

        </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="clearfix"></div>
     <?php if($type == "supplier"){  if(@$chkinghotels){ ?>

      <div class="col-md-12">
        <div class="form-group ">
          <label class="required">Assign Hotels</label>
          <select class="chosen-multi-select" name="hotels[]" id="" multiple>
            <?php foreach($hotels as $hotel){ ?>
            <option value="<?php echo $hotel->hotel_id;?>" <?php if(in_array($hotel->hotel_id,@$userhotels)){ echo "selected"; } ?> ><?php echo $hotel->hotel_title;?></option>
            <?php } ?>
          </select>
        </div>
      </div>

     <?php } if(@$chkingtours){ ?>

      <div class="col-md-12">
        <div class="form-group ">
          <label class="required">Assign Tours</label>
          <select class="chosen-multi-select" name="tours[]" id="" multiple>
            <?php foreach($tours as $tour){ ?>
            <option value="<?php echo $tour->tour_id;?>" <?php if(in_array($tour->tour_id,@$usertours)){ echo "selected"; } ?> ><?php echo $tour->tour_title;?></option>
            <?php } ?>
          </select>
        </div>
      </div>

     <?php } if(@$chkingcars){ ?>

      <div class="col-md-12">
        <div class="form-group ">
          <label class="required">Assign Cars</label>
          <select class="chosen-multi-select" name="cars[]" id="" multiple>
            <?php foreach($cars as $car){ ?>
            <option value="<?php echo $car->car_id;?>" <?php if(in_array($car->car_id,@$usercars)){ echo "selected"; } ?> ><?php echo $car->car_title;?></option>
            <?php } ?>
          </select>
        </div>
      </div>

     <?php } ?>

     <?php } ?>
      <div class="clearfix"></div>
      <?php if($type == "admin" || $type == "supplier"){   ?>
      <hr>

      <div class="row">

      <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading"><?php echo trans('0135');?></div>
        <div class="panel-body">
         <ul class="list-unstyled">
             <?php foreach($permissions_const as $index => $md) {  $per_name = $permissions_name[$index] ?>
      <li>
      <label>
          <input class="checkbox" type="checkbox" name="permissions[]" value="<?php echo "add".$md;?>" <?php if(in_array("add".$md,$permitted) || set_value('permissions[]') == "add".$md){ echo "checked"; } ?>   >  <?php echo ucfirst($per_name);?>
      </label>
      </li>
         <?php }?>
         </ul>
        </div>
      </div>
      </div>

      <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading"><?php echo trans('0136');?> </div>
        <div class="panel-body">
        <ul class="list-unstyled">
            <?php foreach($permissions_const as $index => $md) {  $per_name = $permissions_name[$index] ?>
        <li>
        <label><input class="checkbox" type="checkbox" name="permissions[]" value="<?php echo "edit".$md;?>" <?php if(in_array("edit".$md,$permitted) || set_value('permissions[]') == "edit".$md){ echo "checked"; } ?>  >  <?php echo ucfirst($per_name);?></label>
        </li>
        <?php }?>
        </ul>
        </div>
      </div>
      </div>

      <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading"><?php echo trans('0137');?></div>
        <div class="panel-body">
        <ul class="list-unstyled">
            <?php foreach($permissions_const as $index => $md) {  $per_name = $permissions_name[$index] ?>
        <li>
          <label><input class="checkbox" type="checkbox" name="permissions[]" value="<?php echo "delete".$md;?>" <?php if(in_array("delete".$md,$permitted) || set_value('permissions[]') == "delete".$md){ echo "checked"; } ?>  >  <?php echo ucfirst($per_name);?></label>
        </li>
        <?php } ?>
        </ul>
        </div>
      </div>
      </div>
    </div>
   <?php } ?>
  </div>
  </div>
  <div class="panel-footer">
  <input type="hidden" name="<?php echo $viewtype;?>" value="1" />
  <input type="hidden" name="type" value="<?php echo $type;?>" />
  <input type="hidden" name="oldemail" value="<?php echo @$profile[0]->accounts_email;?>" />
    <button class="btn btn-primary"><?php echo trans('0142');?></button>
  </div>
  </div>

</form>
<script type="text/javascript">
  $(function(){
    $(".verify").on("click",function(){
      var id = $(this).prop('id');
      var accType = "<?php echo $type;?>";
      var ask = confirm("Proceed to Verify this user.");
      if(ask){
        $.post("<?php echo base_url();?>admin/ajaxcalls/verifyAccount", {id: id, accType: accType}, function(resp){
          location.reload();
        });

      }else{
        return false;
      }

    })
  })
</script>
