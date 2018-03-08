<script type="text/javascript">
$(function(){
   var airlineid = $("#airlineid").val();
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
     url = "<?php echo base_url();?>admin/airlines/add" ;

     }else{
     url = "<?php echo base_url();?>admin/airlines/manage/"+airlineid;

     }

     $.post(url,$(".offer-form").serialize() , function(response){
        if($.trim(response) != "done"){
        $(".output").html(response);
        }else{
          window.location.href = "<?php echo base_url() . "admin/airlines/"?>";
        }

        });

   })



})
</script>
<div class="output"></div>
<form action="" method="POST" class="offer-form" onsubmit="return false;" >
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $headingText; ?></div>
        <div class="panel-body">

            <br>
            <div class="tab-content form-horizontal">
                <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Hãng hàng không</label>
                        <div class="col-md-4">
                            <input name="airname" type="text" placeholder="Hãng hàng không" class="form-control" value="<?php echo @$gdata[0]->air_name;?>" />
                        </div>
                        <label class="col-md-2 control-label text-left">Liên minh</label>
                        <div class="col-md-4">
                          <select  class="chosen-select" name="groupid">
                            <option value="">Chọn</option>
                            <?php if(!empty($groupairs)){
                              foreach($groupairs as $group){ ?>
                            <option value="<?php echo $group->g_airline_id;?>" <?php if($gdata[0]->air_id ==  $group->g_airline_id ){echo "selected";} ?> ><?php echo $group->g_airline_name;?></option>
                            <?php  } } ?>
                          </select>
                        </div>
                    </div>

                    <div class="row form-group">
                      <label class="col-md-2 control-label text-left">Thành phố</label>
                      <div class="col-md-4">
                          <input name="country" type="numbers" placeholder="Thành phố" class="form-control" value="<?php echo @$gdata[0]->air_country;?>" />
                      </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Mã IATA</label>
                        <div class="col-md-4">
                            <input name="iacode" type="numbers" placeholder="Mã IATA" class="form-control" value="<?php echo @$gdata[0]->air_iata_code;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Mã TD</label>
                        <div class="col-md-4">
                            <input name="tdcode" type="numbers" placeholder="Mã IATA" class="form-control" value="<?php echo @$gdata[0]->air_td_code;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Mã ICAO</label>
                        <div class="col-md-4">
                            <input name="iccode" type="numbers" placeholder="Mã ICAO" class="form-control" value="<?php echo @$gdata[0]->air_icao_code;?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
        <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
        <input type="hidden" name="airlineid" name="airlineid" value="<?php echo @$airlineid;?>" />
        <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>"><?php echo trans('0134');?></button>
        </div>
    </div>
</form>