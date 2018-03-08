<?php if(@$avg_reviews[0]->overall > 0){ ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel"><?php echo trans('042');?></h4>
</div>
<div class="modal-body" style="padding: 0px;">
  <?php if(!empty($reviews) && pt_is_module_enabled('reviews')){ foreach($reviews as $rev){ ?>
  <div class="modal-body" style="padding: 5px;">
    <div class="alert-message alert-message-info" style="margin-top:5px">
      <h4><?php echo $rev->review_name;?> <strong class="badge badge-info pull-right"> <?php echo round($rev->review_overall,1);?> / 10</strong></h4>
      <h6><?php echo pt_show_date_php($rev->review_date);?></h6>
      <p><?php echo $rev->review_comment;?> </p>
    </div>
  </div>
  <?php } } ?>
</div>
<!-- PHPTRAVELS Ending Reviews -->
<?php } ?>
<style>
  .modal .modal-body {
  max-height: 470px;
  overflow-y: auto;  }
</style>