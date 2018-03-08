<script type="text/javascript">
  $(function(){
     var room = $("#roomid").val();
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
       url = "<?php echo base_url();?>admin/hotels/rooms/add" ;

       }else{
       url = "<?php echo base_url();?>admin/hotels/rooms/manage/"+room;

       }

       $.post(url,$(".room-form").serialize() , function(response){
          if($.trim(response) != "done"){
          $(".output").html(response);
          }else{
             window.location.href = "<?php echo base_url().$adminsegment.'/hotels/rooms/'?>";
          }

          });

     })



  })
</script>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form class="form-horizontal room-form" method="POST" action="" onsubmit="return false;" >
  <div class="panel panel-default">
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="active"><a href="#GENERAL" data-toggle="tab">General</a></li>
      <li class=""><a href="#AMENITIES" data-toggle="tab">Amenities</a></li>
      <li class=""><a href="#TRANSLATE" data-toggle="tab">Translate</a></li>
    </ul>
    <div class="panel-body">
      <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Status</label>
            <div class="col-md-2">
              <select class="form-control" name="roomstatus">
                <option value="Yes" <?php if(@$rdata[0]->room_status == 'Yes'){echo "selected";}?> >Enabled</option>
                <option value="No" <?php if(@$rdata[0]->room_status == 'No'){echo "selected";}?> >Disabled</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Room Type</label>
            <div class="col-md-6">
              <select data-placeholder="Room Type" class="chosen-select" name="roomtype">
                <option value=""></option>
                <?php $rtypes = pt_get_hsettings_data("rtypes");    foreach($rtypes as $rtype){   ?>
                <option value="<?php echo $rtype->sett_id;?>" <?php if(@$rdata[0]->room_type == $rtype->sett_id){echo "selected";}?>  ><?php echo $rtype->sett_name;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Hotel</label>
            <div class="col-md-6">
              <select data-placeholder="Hotel Name" class="chosen-select" name="hotelid" >
                <?php foreach($hotels as $h){ ?>
                <option value="<?php echo $h->hotel_id;?>" <?php if($h->hotel_id == @$rdata[0]->room_hotel){echo "selected";} ?>> <?php echo $h->hotel_title;?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Room Description</label>
            <div class="col-md-10">
              <?php $this->ckeditor->editor('roomdesc', @$rdata[0]->room_desc, $ckconfig,'roomdesc'); ?>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Price</label>
            <div class="col-md-2">
              <input class="form-control" Placeholder="Price" type="number" name="basicprice" value="<?php echo @$rdata[0]->room_basic_price;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Quantity</label>
            <div class="col-md-2">
              <input class="form-control" Placeholder="Quantity" type="number" name="quantity" value="<?php echo @$rdata[0]->room_quantity;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Minimum Stay</label>
            <div class="col-md-2">
              <input class="form-control" Placeholder="Minimum Stay" type="number" min=1 name="minstay" value="<?php echo @$rdata[0]->room_min_stay;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Max Adults</label>
            <div class="col-md-2">
              <input class="form-control" type="number" placeholder="Max Adults" name="adults"  value="<?php echo @$rdata[0]->room_adults;?>">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Max Children</label>
            <div class="col-md-2">
              <input class="form-control" type="number" placeholder="Max Children" name="children"  value="<?php echo @$rdata[0]->room_children;?>">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">No. of Exrta Beds</label>
            <div class="col-md-2">
              <input class="form-control" type="number" placeholder="Extra beds" name="extrabeds"  value="<?php echo @$rdata[0]->extra_bed;?>">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Extra Bed Charges</label>
            <div class="col-md-2">
              <input class="form-control" type="number" placeholder="Beds charges" name="bedcharges"  value="<?php echo @$rdata[0]->extra_bed_charges;?>">
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="AMENITIES">
          <div class="row form-group">
            <div class="col-md-12">
              <div class="col-md-4">
                <label class="pointer"><input class="all" type="checkbox" name="" value="" id="select_all" > Select All</label>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="clearfix"></div>
              <?php $roomamenity = explode(",",@$rdata[0]->room_amenities);
                $ramenities = pt_get_hsettings_data("ramenities");
                foreach($ramenities as $ramenity){ ?>
              <div class="col-md-4">
                <label class="pointer"><input class="checkboxcls" <?php if($submittype == "add"){ if( $ramenity->sett_selected == "1"){echo "checked";} }else{ if(in_array($ramenity->sett_id,$roomamenity)){ echo "checked"; } } ?> type="checkbox" name="roomamenities[]" value="<?php echo $ramenity->sett_id;?>"  > <?php echo $ramenity->sett_name;?></label>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">
          <?php foreach($languages as $lang => $val){ if($lang != "en"){ @$trans = getBackRoomTranslation($lang,@$rdata[0]->room_id); ?>
          <div class="panel panel-default">
            <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val['name']; ?></div>
            <div class="panel-body">
              <!--<div class="row form-group">
                <label class="col-md-2 control-label text-left">Room Name</label>
                <div class="col-md-4">
                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Room Name" class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                </div>
                </div>-->
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Room Description</label>
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
      <input type="hidden" id="roomid" name="roomid" value="<?php echo @$rdata[0]->room_id;?>" />
      <input type="hidden" name="oldquantity" value="<?php echo @$rdata[0]->room_quantity;?>" />
      <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
      <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Submit</button>
    </div>
  </div>
</form>