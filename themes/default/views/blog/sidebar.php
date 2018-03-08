 <div class="clearfix"></div>
  <div class="panel panel-default">
<!--    <div class="panel-heading go-text-right">--><?php //echo trans('0284');?><!--</div>-->
    <div class="panel-body">
      <form action="<?php echo base_url().'blog/search'; ?>" method="GET">
        <div class="input-group RTL">
          <input type="text" name="s" required placeholder="<?php echo trans('0284');?>" class="form-control sub_email">
          <span class="input-group-btn">
          <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> <?php echo trans('012');?></button>
          </span>
        </div>
      </form>
    </div>
  </div>
  <?php if(!empty($categories)){ ?>
  <div class="list-group">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><?php echo trans('0288');?></div>
      <?php  foreach($categories as $cat):
        $count = pt_posts_count($cat->id);
        if($count > 0){
        ?>
      <a href="<?php echo base_url().'blog/category?cat='.$cat->slug; ?>" class="list-group-item">
        <strong class="go-right"><?php echo $cat->name;?></strong> <span class="go-left badge badge-primary"><?php echo $count;?></span>
        <div class="clearfix"></div>
      </a>
      <?php  } endforeach; ?>
    </div>
  </div>
  <?php  } ?>
  <?php if(!empty($popular_posts)){ ?>
  <div class="panel panel-default">
    <div class="panel-heading go-text-right"><?php echo trans('0287');?></div>
    <div class="panel-body">
      <div class="content">
        <?php
          foreach($popular_posts as $post):
          $bloglib->set_id($post->post_id);
          $bloglib->post_short_details(); ?>
        <div class="blog-sidebar-item">
            <div class="row">
                <a href="<?php echo base_url().'blog/'.$post->post_slug;?>" class="col-md-5 col-sm-5 col-xs-12 go-right" >
                    <img class="img-responsive post-img img-fade" src="<?php echo pt_post_thumbnail($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" />
                </a>
                <div class="desc col-md-7 col-sm-7 col-xs-12 go-left row">
                    <p class="text-warning weak"><?php echo $bloglib->date;?></p>
                    <h5 style="margin-top: 0px;margin-bottom:5px" class="go-text-right bold"><a href="<?php echo base_url().'blog/'.$post->post_slug;?>" ><?php echo character_limiter(strip_tags($bloglib->title), 20);?></a></h5>
                </div>
                <!--//desc-->
            </div>
        </div>
        <!--//item-->
        <?php endforeach; ?>
      </div>
      <!--//content-->
    </div>
  </div>
  <?php  } ?>
<!--//secondary-->