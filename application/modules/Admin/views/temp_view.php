<style>
  td span {width: 100%;font-weight: bold;}
</style>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <?php if(@$addpermission && !empty($add_link)){ ?>
   <form class="add_button" action="<?php echo $add_link; ?>" method="post"><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Thêm</button></form>
  <?php } ?>
   <div class="panel-body">
     <?php echo $content; ?>
   </div>
 </div>