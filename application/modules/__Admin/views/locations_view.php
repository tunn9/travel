<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>

   <div class="panel-body">
    <?php if(@$addpermission && !empty($add_link)){ ?>
   <a href="<?php echo $add_link; ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
   <?php } ?>
     <?php echo $content; ?>
   </div>
 </div>