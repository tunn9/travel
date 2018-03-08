<style>
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }
</style>
<section class="blog-header">
    <div class="container">
        <h1>Blogs</h1>
    </div>
</section>
<div class="container sections-wrapper">
  <div class="row">
    <div class="primary col-md-8 col-sm-7 col-xs-12" style="position: static">
      <div class="panel panel-default">
        <div class="panel-body">
           <div class="panel-body go-right RTL">
               <div class="img-responsive-wrapper">
                   <img src="<?php echo $thumbnail;?>" class="img-responsive" />
               </div>
               <div class="clearfix"></div>
               <h3 style="margin-top:0px" class="wow fadeInUp animated title go-right ttu bold"><?php echo $title;?>
                   <small class="go-left pull-right"><?php echo $date;?></small>
               </h3>
               <div class="row">
                <!--//desc-->
                 <div class="clearfix"></div>
                 <div class="col-md-12">
                    <div class="sharethis-inline-share-buttons"></div>
                    <?php echo $desc; ?>
                 </div>
                </div>
                 <!--//desc-->
          </div>
          <!--//item-->
        </div>
      </div>
    </div>
    <div class="secondary custom-sidebar col-md-4 col-sm-5 add_bottom_30 go-left">
    <?php include('sidebar.php'); ?>
  </div>
  <div class="clearfix"></div>
  <div class="container you-might-like">
   <?php if(!empty($related_posts)){ ?>
      <h3 class="go-right ttu bold"><?php echo trans('0289');?></h3>
      <div class="clearfix"></div>
      <div class="row">
        <?php
          foreach($related_posts as $post):
           $bloglib->set_id($post->post_id);
           $bloglib->post_short_details(); ?>
        <div class="col-md-3">
          <a href="<?php echo base_url().'blog/'.$post->post_slug;?>" class="thumbnail">
          <img src="<?php echo pt_post_thumbnail($post->post_id); ?>" class="img responsive img-fade" style="max-height: 130px;" />
          <button style="padding-left:5px" class="btn btn-primary btn-block btn-lg"><?php echo character_limiter(strip_tags($bloglib->title), 20);?></button>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
      <?php  } ?>
  </div>
  </div>
  <!--//row-->
</div>