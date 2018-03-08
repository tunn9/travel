<style>
  .item { max-height: 55px !important; }
</style>
<!-- End section -->
<?php //print_r($allposts); ?>
<section class="blog-header">
    <div class="container">
        <h1>Blog</h1>
    </div>
</section>
<div class="container">
  <div class="row">
    <div class="col-md-8 go-right">
      <div class="panel panel-default">
<!--        <div class="panel-heading title_rtl">--><?php // if($ptype == "search"){
//          echo trans('0291');
//          }elseif($ptype == "category"){
//          echo trans('0292')." - ".$categoryname;
//          }else{
//           echo trans('0285');
//          }  ?><!--</div>-->
        <div class="panel-body">
          <?php if(!empty($allposts['all'])){
            foreach($allposts['all'] as $post):
             $bloglib->set_id($post->post_id);
            $bloglib->post_short_details();
             ?>
          <div class="col-md-4 go-right">
            <div class="row">
              <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="<?php echo pt_post_thumbnail($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-md-8">
            <a href="<?php echo base_url().'blog/'.$post->post_slug;?>">
              <h4 class="go-right RTL mtb0 upper"><?php echo $bloglib->title;?></h4>
            </a>
            <div class="clearfix"></div>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo $bloglib->date; ?></span></li>
                </ul>
              </div>
            </div>
            <p class="RTL"> <?php echo character_limiter(strip_tags($bloglib->desc), 110);?></p>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$post->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <?php endforeach; }else{ echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
        </div>
      </div>
      <ul class="nav nav-pills nav-justified custom-navigation" role="tablist">
        <?php echo createPagination($info);?>
      </ul>
      <br /><br /><br />
    </div>
    <!-- End col-md-8-->
    <div class="secondary custom-sidebar col-md-4 add_bottom_30 go-left">
    <?php include('sidebar.php'); ?>
  </div>
  </div>
  <!-- End row-->
</div>
<!-- End container -->
