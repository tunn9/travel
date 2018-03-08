<script type="text/javascript">
  $(function(){

  $(".generate").click(function(){ 
    var id = $(this).prop("id");
  $.post("<?php echo base_url();?>admin/coupons/generate_coupon", {}, function(resp){
  $("#code"+id).val(resp);
  });
  });
  //add coupon
  $(".submitcoupon").on("click",function(){

  $.post("<?php echo base_url();?>admin/coupons/addcoupon", $("#addcoupon").serialize(), function(resp){

    var response = $.parseJSON(resp);
      console.log(response);
  //  $("#coupon_result").html(response).fadeIn("slow");
    if(response.status == "success"){

      $("#coupon_result").html("please wait....").fadeIn("slow");
      location.reload();

    }else{

       $("#coupon_result").html(response.msg).fadeIn("slow");

    }



  });

  setTimeout(function(){

  $("#coupon_result").fadeOut("slow");

  }, 5000);

  });

  //update coupon
  $(".editcoupon").on("click",function(){
  var id = $(this).prop('id');
  $.post("<?php echo base_url();?>admin/coupons/updatecoupon", $("#editcoupon"+id).serialize(), function(resp){

var response = $.parseJSON(resp);
      console.log(response);
  //  $("#coupon_result").html(response).fadeIn("slow");
    if(response.status == "success"){

      $("#coupon_result"+id).html("please wait....").fadeIn("slow");
      location.reload();

    }else{

       $("#coupon_result"+id).html(response.msg).fadeIn("slow");

    }


  });

  setTimeout(function(){

  $("#coupon_result"+id).fadeOut("slow");

  }, 3000);

  });

  });



</script>

<style>
.datepicker{z-index:9999 !important;}
</style>


<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div> 


   <div class="panel-body">
   <div class="add_button_modal" > <button type="button" data-toggle="modal" data-target="#ADD_COUPON" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> <?php echo trans('0135');?></button></div>
     <?php echo $content; ?>
   </div>
 </div>


 <!--Add Coupon Modal -->
<div class="modal fade" id="ADD_COUPON" tabindex="" role="dialog" aria-labelledby="CouponModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Thêm mã giảm giá</h4>
      </div>
      <div class="modal-body" style="padding:0px">
        <form style="margin-top:10px" class="form-horizontal" method="POST" id="addcoupon" action="" onsubmit="return false;">

                  <div class="col-lg-5">
                    <div class="well">
                      <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('099');?></label>
                        <div class="col-md-8">
                          <select class="form-control" id="#" name="status">
                            <option value="Yes" selected> <?php echo trans('0143');?> </option>
                            <option value="No"> <?php echo trans('0144');?> </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0141');?></label>
                        <div class="col-md-8">
                          <input type="text" placeholder="<?php echo trans('0141');?>" class="form-control" name="rate" id="rate" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0140');?></label>
                        <div class="col-md-8">
                          <input type="text" placeholder="<?php echo trans('0140');?>" class="form-control" name="max" id="max" />
                        </div>
                      </div>

                         <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0138');?></label>
                        <div class="col-md-8">
                          <input type="text" placeholder="<?php echo trans('0138');?>" class="form-control dpd1" name="startdate" id="stardate" />
                        </div>
                      </div>

                              <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0139');?></label>
                        <div class="col-md-8">
                          <input type="text" placeholder="<?php echo trans('0139');?>" class="form-control dpd2" name="expdate" id="expdate" />
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-7">

                  <!-- <div class="panel panel-default">
                       <div class="panel-heading">Assign Globally</div>
                       <div class="panel-body">

                       <div class="input-group">
                      <?php foreach($modules as $mod => $items): ?>
                <input type="checkbox" name="allmodules[]" value="<?php echo $mod;?>"> All <?php echo ucfirst($mod); ?> &nbsp;
                    <?php endforeach; ?>

                      </div>
                       </div>
                     </div> -->

                    <div class="col-lg-12 well">
                      <div class="input-group">
                        <input type="text" name="code" id="codeadd" placeholder="<?php echo trans('032');?>" class="form-control input-lg code" value="">
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-lg generate" id="add" type="button">Tạo mã</button>
                        </span>
                      </div>
                    </div>




                  </div>

<!-- <?php foreach($modules as $mod => $items): ?>
      <div class="col-md-12">
        <div class="form-group form-horizontal">
         <div class="col-md-2"> <label class="required">Assign to <?php echo ucfirst($mod); ?></label></div>
         <div class="col-md-10">
         <select class="chosen-multi-select" name="items[<?php echo $mod; ?>][]" id="" multiple>
          <?php foreach($items as $item){ ?>
          <option value="<?php echo $item->id; ?>"><?php echo $item->title; ?></option>
          <?php } ?>
          </select>
          </div>
        </div>
      </div>
<?php endforeach; ?> -->

        </form>

      <div id="coupon_result"></div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submitcoupon" id="#" ><i class="fa fa-save"></i> Submit</button>
      </div>
    </div>
  </div>
</div>
</div>
<!---end add coupon modal -->

 <!-- edit coupon Modal -->

 <?php foreach($coupons as $cop){ ?>
<!--PHPTravels Edit coupon modal -->
          <div class="modal fade" id="editCop<?php echo $cop->id;?>" tabindex="" role="dialog" aria-labelledby="CouponModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Cập nhật mã giảm giá "<?php echo $cop->code;?>"</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" method="POST" id="editcoupon<?php echo $cop->id;?>" action="" onsubmit="return false;">
                    <div class="">
                      <div class="">
                        <div class="panel-body">
                          

                           <div class="spacer20px">
                  <div class="col-lg-5">
                    <div class="well">
                      <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('099');?></label>
                        <div class="col-md-8">
                          <select class="form-control" id="#" name="status">
                            <option value="Yes" <?php makeSelected($cop->status, 'Yes'); ?> > <?php echo trans('0143');?> </option>
                            <option value="No" <?php makeSelected($cop->status, 'No'); ?> > <?php echo trans('0144');?> </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0141');?></label>
                        <div class="col-md-4">
                          <input type="text" placeholder="Percentage" class="form-control" name="rate" id="rate" value="<?php echo $cop->value;?>" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0140');?></label>
                        <div class="col-md-6">
                          <input type="text" placeholder="<?php echo trans('0140');?>" class="form-control" name="max" id="max" value="<?php echo $cop->maxuses;?>" />
                        </div>
                      </div>

                         <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0138');?></label>
                        <div class="col-md-8">
                          <input type="text" placeholder="<?php echo trans('0138');?>" class="form-control dpd1" name="startdate" id="stardate" value="<?php echo pt_show_date_php($cop->startdate);?>" />
                        </div>
                      </div>

                              <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo trans('0139');?></label>
                        <div class="col-md-8">
                          <input type="text" placeholder="<?php echo trans('0139');?>" class="form-control dpd2" name="expdate" id="expdate" value="<?php echo pt_show_date_php($cop->expirationdate);?>" />
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="col-lg-12 well">
                      <div class="input-group">
                      <?php echo $cop->code;?>       
                      </div>
                    </div>
                  </div>
<!-- 
                  <div class="col-lg-7">
                    <div class="col-lg-12 well">
                    <h5>Assign Globally</h5>
                      <div class="input-group">
                      <?php foreach($modules as $mod => $items): ?>
                <input type="checkbox" name="allmodules[]" value="<?php echo $mod;?>" <?php if(pt_couponAssignedAllItems($cop->id,$mod)){ echo "checked"; } ?> > All <?php echo ucfirst($mod); ?> &nbsp;
                    <?php endforeach; ?>
       
                      </div>
                    </div>
                  </div> -->

<!-- <?php foreach($modules as $mod => $items): ?>
      <div class="col-md-12">
        <div class="form-group">
          <label class="required">Assign to <?php echo ucfirst($mod); ?></label>
          <select class="chosen-multi-select" name="items[<?php echo $mod; ?>][]" id="" multiple>
          <?php foreach($items as $item){ ?>
          <option value="<?php echo $item->id; ?>" <?php if(pt_couponAssigned($cop->id,$mod, $item->id)){ echo "selected"; } ?> ><?php echo $item->title; ?></option>
          <?php } ?>
       
          </select>
        </div>
      </div>
<?php endforeach; ?> -->

                </div>


                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="couponid" value="<?php echo $cop->id;?>" />
                  </form>
                </div>
                <div id="coupon_result<?php echo $cop->id;?>"></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary editcoupon" id="<?php echo $cop->id;?>" ><i class="fa fa-save"></i> <?php echo trans('0142');?></button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

<!-- edit modal -->