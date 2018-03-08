<div class="clearfix"></div>
<?php if(!empty($things) && pt_is_module_enabled('thingstodo')){ ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="offset-0-tb"><strong><?php echo trans('045');?></strong></h4>
  </div>
    <section >
      <div id="">
        <div class="" style="margin: 0px 0px -45px 0px;">
          <div class="containter">
            <?php if(!empty($things) && pt_is_module_enabled('thingstodo')){ ?>
            <?php foreach($things as $thing){ $thingtodo = $hotelslib->things_translation($thing->things_id); ?>
            <a data-toggle="modal" data-target="#thingstodo-id<?php echo $thingg->things_id;?>">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 featured-hotels modal-body">
                <?php if(!empty($thing->things_image)){ ?>
                <img class="img-responsive" src="<?php echo PT_THINGS_IMAGES.$thing->things_image; ?>" class="img-reponsive" />
                <?php }else{ ?>
                <img class="img-responsive" src="<?php echo PT_BLANK;?>" class="img-responsive" />
                <?php } ?>
                <div class="body bs">
                  <p class="strong fs12"><span class="pull-left"><?php echo $thingtodo['title'];?></span></p>
                  <div class="clearfix"></div>
                  <p class="small"><span class="pull-left"><?php echo pt_show_date_php($thing->things_added_on);?></span></p>
                  <div class="clearfix"></div>
                </div>
                <button type="button" class="btn btn-primary btn-block offset-0" data-toggle="modal" data-target="#thingstodo-id<?php echo $thing->things_id;?>">
                <?php echo trans('0286');?>
                </button>
              </div>
            </a>
            <?php } ?>
          </div>
          <div class="clearfix"></div>
          <br><br>
        </div>
      </div>
      <?php } ?>
    </section>
</div>
<?php foreach($things as $thingg){ $thingtodo = $hotelslib->things_translation($thingg->things_id); ?>
<div class="modal fade" id="thingstodo-id<?php echo $thingg->things_id;?>" tabindex="" role="dialog" aria-labelledby="Name" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><span class="fa fa-dot-circle-o"></span> <?php echo $thingtodo['title'];?></h4>
      </div>
      <div class="modal-body">
        <img class="img-responsive col-md-6" src="<?php echo PT_THINGS_IMAGES.$thingg->things_image; ?>" alt=""/>
        <p  class="strong"><?php echo pt_show_date_php($thingg->things_added_on);?></p>
        <p><?php echo $thingtodo['desc'];?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php } ?>