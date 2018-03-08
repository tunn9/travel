<script type="text/javascript">
$(function(){
  $(".pagetitle").blur(function(){
    var title = $(this).val();
    var pageid = $("#pageid").val();
    $.post("<?php echo base_url();?>admin/ajaxcalls/createCMSPermalink",{pagetitle: title, pageid: pageid},function(response){
        $(".permalink").val(response);
    });
  })
})
</script>
<div class="container">
  <form action="" method="POST">
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
            <li class="active"><a href="#GENERAL" data-toggle="tab"><?php $actionName = 'Thêm'; if($action =='update'){ $actionName = 'Cập nhật'; } echo ucfirst($actionName);?> <?php echo trans('015');?></a></li>
            <li class=""><a href="#TRANSLATE" data-toggle="tab"><?php echo trans('0170');?></a></li>
        </ul>

      <div class="panel-body">
    <br>
            <div class="tab-content">
          <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group ">
                <label class="required"><?php echo trans('0201');?></label>
                <input class="form-control pagetitle" type="text" placeholder="Page Title" name="pagetitle" value="<?php echo  @$pagedata[0]->content_page_title;?>">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group ">
              <?php if($pagedata[0]->page_slug == "contact-us"){ ?><input type="hidden" name="pageslug" value="contact-us"> <?php }else{ ?>
                <label class="required"><?php echo trans('0202');?> : <?php echo base_url();?></label>
                <input class="form-control pull-right permalink" type="text" placeholder="Permalink" name="pageslug" value="<?php echo  @$pagedata[0]->page_slug;?>">
                <?php } ?>
              </div>
            </div>
            <?php if($pagedata[0]->page_slug == "contact-us"){ ?><input type="hidden" name="pagebody" value="<?php echo @$pagedata[0]->content_body; ?>"> <?php }else{ ?>
            <div class="col-md-12">
            <?php $this->ckeditor->editor('pagebody', @$pagedata[0]->content_body, $ckconfig,'pagebody'); ?>
            </div>
            <?php } ?>
          </div>
          <div class="clearfix"></div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading"><?php echo trans('0225');?></div>
                <div class="panel-body form-horizontal">
                  <div class="form-group">
                    <label for="form-input" class="col-sm-1 control-label"><?php echo trans('099');?></label>
                    <div class="col-sm-2">
                      <select data-placeholder="Select" name="status" class="form-control" tabindex="2">
                        <option value="Yes" <?php if($pagedata[0]->page_status == "Yes"){ echo "selected";} ?> ><?php echo trans('0143');?></option>
                        <option value="No" <?php if($pagedata[0]->page_status == "No"){ echo "selected";} ?>><?php echo trans('0144');?></option>
                      </select>
                    </div>
                    <label for="form-input" class="col-sm-1 control-label"><?php echo trans('0226');?></label>
                    <div class="col-sm-2">
                      <select data-placeholder="Select" name="pagetarget" class="form-control" tabindex="2">
                        <option value="self" <?php if($pagedata[0]->page_target == "self"){ echo "selected";} ?>><?php echo trans('0176');?></option>
                        <option value="blank" <?php if($pagedata[0]->page_target == "blank"){ echo "selected";} ?>><?php echo trans('0177');?></option>
                      </select>
                    </div>
                    <label for="form-input" class="col-sm-1 control-label"><?php echo trans('0202');?></label>
                    <div class="col-sm-5">
                      <input class="form-control" type="text" name="externalink" value="<?php echo $pagedata[0]->page_external_link; ?>" placeholder="External URL">
                    </div>
                    </div>
                     <div class="form-group">
                    <label for="form-input" class="col-sm-1 control-label"><?php echo trans('0227');?></label>
                    <div class="col-sm-4">
                <input class="form-control" type="text" placeholder="<?php echo trans('0227');?>" name="page_icon" value="<?php echo  @$pagedata[0]->page_icon;?>">

                    </div>
                    </div>



                </div>
              </div>
            </div>
            .
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">SEO</div>
                <div class="panel-body form-horizontal">
                  <div class="form-group">
                    <label for="form-input" class="col-sm-1 control-label"><?php echo trans('0114');?></label>
                    <div class="col-sm-11">
                      <input class="form-control" type="text" name="keywords" value="<?php echo @$pagedata[0]->content_meta_keywords; ?>" placeholder="<?php echo trans('0114');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="form-input" class="col-sm-1 control-label"><?php echo trans('0115');?></label>
                    <div class="col-sm-11">
                      <input class="form-control" type="text" name="pagedesc" value="<?php echo @$pagedata[0]->content_meta_desc; ?>" placeholder="<?php echo trans('0115');?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>

          <!----Translation Tab---->

           <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">

                    <?php foreach($languages as $lang => $val){ if($lang != "vi"){ @$trans = getBackCMSTranslation($lang,$pageid);  ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val['name']; ?></div>
                        <div class="panel-body">
                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left"><?php echo trans('0202');?></label>
                                <div class="col-md-4">
                                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Page Title" class="form-control" value="<?php echo @$trans[0]->content_page_title;?>" />
                                </div>
                            </div>

 <?php if($pagedata[0]->page_slug == "contact-us"){ ?><input type="hidden" name='<?php echo "translated[$lang][desc]";?>' value="{contact_us}"> <?php }else{ ?>
                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left"><?php echo trans('013');?></label>
                                <div class="col-md-10">
                                 <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->content_body, $ckconfig,"translated[$lang][desc]"); ?>

                                </div>
                            </div>                          
                            <hr>

                             <?php } ?>


                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left"><?php echo trans('0204');?></label>
                                <div class="col-md-6">
                                    <textarea name='<?php echo "translated[$lang][keywords]"; ?>' placeholder="<?php echo trans('0204');?>" class="form-control" id="" cols="30" rows="2"><?php echo @$trans[0]->content_meta_keywords;?></textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left"><?php echo trans('013');?></label>
                                <div class="col-md-6">
                                    <textarea name='<?php echo "translated[$lang][metadesc]"; ?>' placeholder="<?php echo trans('013');?>" class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->content_meta_desc;?></textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    <?php } } ?>

                </div>

        </div>
      </div>
      <div class="panel-footer">
      <input type="hidden" name="action" value="<?php echo $action;?>" />
      <input type="hidden" id="pageid" name="pageid" value="<?php echo $pageid;?>" />
      <input type="hidden" id="" name="contentid" value="<?php echo @$pagedata[0]->content_id; ?>" />
        <button class="btn btn-primary"><?php echo trans('0142');?></button>
      </div>
    </div>
  </form>
</div>