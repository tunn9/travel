<script type="text/javascript">
$(function(){
   var slug = $("#slug").val();
   $(".submitfrm").click(function(){
     var submitType = $(this).prop('id');
          for ( instance in CKEDITOR.instances )

    {

        CKEDITOR.instances[instance].updateElement();

    }
             $(".output").html("");
              $('html, body').animate({

              scrollTop: $('body').offset().top

              }, 'slow');
     if(submitType == "add"){
     url = "<?php echo base_url();?>admin/offers/add" ;

     }else{
     url = "<?php echo base_url();?>admin/offers/manage/"+slug;

     }

     $.post(url,$(".offer-form").serialize() , function(response){
        if($.trim(response) != "done"){
        $(".output").html(response);
        }else{
           window.location.href = "<?php echo base_url().$adminsegment."/offers/"?>";
        }

        });

   })



})
</script>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>

    <div class="output"></div>
<form action="" method="POST" class="offer-form" onsubmit="return false;" >
    <div class="panel panel-default">

        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active"><a href="#GENERAL" data-toggle="tab"><?php echo trans('0169');?></a></li>
            <li class=""><a href="#TRANSLATE" data-toggle="tab"><?php echo trans('0170');?></a></li>
        </ul>

        <div class="panel-body">

            <br>
            <div class="tab-content form-horizontal">
                <div class="tab-pane wow fadeIn animated active in" id="GENERAL">


                    <div class="clearfix"></div>
                     <div class="row form-group">
                        <label class="col-md-2 control-label text-left"><?php echo trans('099');?></label>
                        <div class="col-md-2">
                            <select data-placeholder="Select" class="form-control" name="offerstatus">
                                <option value="Yes" <?php if(@$offerdata[0]->offer_status == "Yes"){ echo "selected"; }?> ><?php echo trans('053');?></option>
                                <option value="No" <?php if(@$offerdata[0]->offer_status == "No"){ echo "selected"; }?> ><?php echo trans('054');?></option>

                            </select>
                        </div>
                     </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left"><?php echo trans('0113');?></label>
                        <div class="col-md-4">
                            <input name="offertitle" type="text" placeholder="<?php echo trans('0113');?>" class="form-control" value="<?php echo @$offerdata[0]->offer_title;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left"><?php echo trans('0124');?></label>
                        <div class="col-md-4">
                            <input name="offerphone" type="numbers" placeholder="<?php echo trans('0124');?>" class="form-control" value="<?php echo @$offerdata[0]->offer_phone;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Email</label>
                        <div class="col-md-4">
                            <input name="offeremail" type="numbers" placeholder="Email" class="form-control" value="<?php echo @$offerdata[0]->offer_email;?>" />
                        </div>
                    </div>

                        <div class="row form-group">
                        <label class="col-md-2 control-label text-left"><?php echo trans('0171');?></label>
                        <div class="col-md-2">
                            <input name="offerprice" type="text" placeholder="<?php echo trans('0171');?>" class="form-control" value="<?php echo @$offerdata[0]->offer_price;?>" />
                        </div>
                    </div>

                                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left"><?php echo trans('0173');?></label>
                        <div class="col-md-2">
                            <input name="ofrom" type="text" placeholder="<?php echo trans('0173');?>" class="form-control dpd1" value="<?php echo @$ofrom; ?>" />
                        </div>

                        <div class="col-md-2">
                            <input name="oto" type="text" placeholder="<?php echo trans('0174');?>" class="form-control dpd2" value="<?php echo @$oto; ?>" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left"><?php echo trans('0115');?></label>
                        <div class="col-md-10">
                         <?php $this->ckeditor->editor('offerdesc', @$offerdata[0]->offer_desc, $ckconfig,'offerdesc'); ?>
                         </div>
                    </div>

                </div>


                <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">

                    <?php foreach($languages as $lang => $val){ if($lang != "en"){ @$trans = getBackOffersTranslation($lang,$offerid); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val['name']; ?></div>
                        <div class="panel-body">
                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left"><?php echo trans('0113');?></label>
                                <div class="col-md-4">
                                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="<?php echo trans('0113');?>" class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left"><?php echo trans('0115');?></label>
                                <div class="col-md-10">
                                 <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig,"translated[$lang][desc]"); ?>
                               </div>
                            </div>

                        </div>
                    </div>
                    <?php } } ?>

                </div>
            </div>
        </div>
        <div class="panel-footer">
        <input type="hidden" id="slug" value="<?php echo @$offerdata[0]->offer_slug;?>" />
        <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
        <input type="hidden" name="offerid" value="<?php echo @$offerid;?>" />
            <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>"><?php echo trans('0134');?></button>
        </div>
    </div>
</form>