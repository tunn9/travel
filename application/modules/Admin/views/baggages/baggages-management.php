<div class="container">
  <form method="post" action="" enctype="multipart/form-data" >
    <?php $validationerrors = validation_errors();
      if(isset($errormsg) || !empty($validationerrors)){  ?>
    <div class="alert alert-danger">
      <i class="fa fa-times-circle"></i>
      <?php
        echo @$errormsg;
        echo $validationerrors; ?>
    </div>
    <?php  } ?>
    <div class="panel panel-default">
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="active"><a href="#GENERAL" data-toggle="tab">Cập nhật hành lý</a></li>
        <li class=""><a href="#TRANSLATE" data-toggle="tab">Dịch</a></li>
      </ul>
      <div class="panel-body">
        <br>
        <div class="tab-content">
          <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
            <div class="col-md-12">
              <div class="col-md-4">
                <div class="form-group ">
                  <label class="required">Hãng vé</label>
                  <select data-placeholder="Select" name="airline_code" class="form-control" tabindex="2">
                      <option value="VN" <?php if(@$pdata[0]->baggage_airline_code == "VN"){ echo "selected";} ?> >Vietnam Airlines</option>
                      <option value="BL" <?php if(@$pdata[0]->baggage_airline_code == "BL"){ echo "selected";} ?>>Jetstar Pacific</option>
                      <option value="VJ" <?php if(@$pdata[0]->baggage_airline_code == "VJ"){ echo "selected";} ?>>Vietjet Air</option>
                  </select>
                </div>
                <div class="form-group ">
                  <label class="required">Hạng vé</label>
                  <input class="form-control posttitle" type="text" placeholder="Hạng vé" name="class_code" value="<?php echo  @$pdata[0]->baggage_class;?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group ">
                  <label class="required">Trạng thái</label>
                  <select data-placeholder="Select" name="status" class="form-control" tabindex="2">
                      <option value="Yes" <?php if(@$pdata[0]->baggage_status == "Yes"){ echo "selected";} ?> >Hoạt động</option>
                      <option value="No" <?php if(@$pdata[0]->baggage_status == "No"){ echo "selected";} ?>>Không hoạt động</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <?php $this->ckeditor->editor('desc', @$pdata[0]->baggage_desc, $ckconfig,'desc'); ?>
              </div>

            </div>

          </div>
          <!----Translation Tab---->
          <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">
            <?php foreach($languages as $lang => $val){
              if($lang != "vi"){
                @$trans = getBaggageTranslation($lang, $pdata[0]->baggage_id);  ?>
            <div class="panel panel-default">
              <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val['name']; ?></div>
              <div class="panel-body">
                <div class="row form-group">
                  <label class="col-md-2 control-label text-left">Hạng vé</label>
                  <div class="col-md-4">
                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Hạng vé" class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                  </div>
                </div>
                <div class="row form-group">
                  <label class="col-md-2 control-label text-left">Nội dung</label>
                  <div class="col-md-10">
                    <?php  $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig,"translated[$lang][desc]"); ?>
                  </div>
                </div>
                <hr>
              </div>
            </div>
            <?php } } ?>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <input type="hidden" name="action" value="<?php echo $action;?>" />
        <input type="hidden" id="postid" name="postid" value="<?php echo @$pdata[0]->post_id;?>" />
        <button class="btn btn-primary" type="submit"><?php echo trans('0142');?></button>
      </div>
    </div>
  </form>
</div>