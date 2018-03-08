
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>

   <div class="panel-body">
   <div class="add_button_modal" > <button type="button" data-toggle="modal" data-target="#ADD_GROUP_AIRLINE" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i><?php echo trans('020');?></button></div>
   <?php echo $content; ?>
   </div>
 </div>


 <!--Add blog category Modal -->
<div class="modal fade" id="ADD_GROUP_AIRLINE" tabindex="-1" role="dialog" aria-labelledby="ADD_GROUP_AIRLINE" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo trans('0232');?></h4>
      </div>
      <div class="modal-body form-horizontal">

      <div class="row form-group">
<label  class="col-md-3 control-label text-left"><?php echo trans('0233');?></label>
<div class="col-md-8">
<input type="text" name="name" class="form-control" placeholder="Name" value="" required >
</div>
</div>

<div class="row form-group">
<label  class="col-md-3 control-label text-left"><?php echo trans('099');?></label>
<div class="col-md-8">
<select name="status" class="form-control" id="">
<option value="Yes"><?php echo trans('053');?></option>
<option value="No"><?php echo trans('054');?></option>
</select></div>
</div>


      </div>
      <div class="modal-footer">
      <input type="hidden" name="addgroup" value="1" />
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('083');?></button>
        <button type="submit" class="btn btn-primary"><?php echo trans('020');?></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-----end add category modal------>
  <!-- edit Modal -->
 <?php foreach($groupairs['all'] as $cat){ ?>
<div class="modal fade" id="group<?php echo $cat->g_airline_id;?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo trans('0234');?></h4>
      </div>
      <div class="modal-body form-horizontal">

      <div class="row form-group">
<label  class="col-md-3 control-label text-left"><?php echo trans('0233');?></label>
<div class="col-md-8">
<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $cat->g_airline_name;?>" required >
</div>
</div>

<div class="row form-group">
<label  class="col-md-3 control-label text-left"><?php echo trans('099');?></label>
<div class="col-md-8">
<select name="status" class="form-control" id="">
<option value="Yes" <?php makeSelected($cat->g_airline_status,"Yes"); ?>><?php echo trans('053');?></option>
<option value="No" <?php makeSelected($cat->g_airline_status,"No"); ?> ><?php echo trans('054');?></option>
</select></div>
</div>


      </div>
      <div class="modal-footer">
      <input type="hidden" name="updategroup" value="1" />
      <input type="hidden" name="groupid" value="<?php echo $cat->g_airline_id;?>" />

          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('083');?></button>
        <button type="submit" class="btn btn-primary"><?php echo trans('0142');?></button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<!----edit modal--->