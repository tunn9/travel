<br><br><section id="hero" class="login">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

      <div class="panel panel-default">
        <div class="panel-heading"><?php echo trans('0115');?></div>
        <div class="panel-body">

        <div id="login">

        <?php  if(!empty($customerloggedin)){ ?>
      <li><a href="<?php echo base_url()?>account/logout"><?php echo trans('03');?></a></li>
      <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ ?>
        <form action="" method="POST" id="headersignupform" onsubmit="return false;">

            <div class="clearfix"></div>
                        <div class="resultsignup"></div>

            <div class="form-group">
              <label><?php echo trans('090');?></label>
                      <input class="form-control" type="text" placeholder="<?php echo trans('090');?>" name="firstname" value="">
            </div>
            <div class="form-group">
              <label><?php echo trans('091');?></label>
                      <input class="form-control" type="text" placeholder="<?php echo trans('091');?>" name="lastname"  value="">
            </div>

            <div class="form-group">
              <label><?php echo trans('0173');?></label>
                      <input class="form-control" type="text" placeholder="<?php echo trans('0173');?>" name="phone"  value="">
            </div>

            <div class="form-group">
              <label><?php echo trans('094');?></label>
                        <input class="form-control" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="">
            </div>

            <div class="form-group">
              <label><?php echo trans('095');?></label>
                        <input class="form-control" type="password" placeholder="<?php echo trans('095');?>" name="password"  value="">
            </div>

            <div class="form-group">
              <label><?php echo trans('096');?></label>
                        <input class="form-control" type="password" placeholder="<?php echo trans('096');?>" name="confirmpassword"  value="">
            </div>

            <div class="form-group">
              <button type="submit" class="signupbtn btn_full btn btn-action btn-block btn-lg"><i class="fa fa-check-square-o"></i> <?php echo trans('0115');?></button>
            </div>
          <?php if(!empty($url)){ ?>
          <input type="hidden" class="url" value="<?php echo base_url().'properties/reservation/?'.$url;?>" />
          <?php }else{ ?>
          <input type="hidden" class="url" value="<?php echo base_url();?>account/" />
          <?php } ?>

        </form>
        <?php } }  ?>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script type="text/javascript">
  $(function(){
      var url = $(".url").val();
  // start sign up functionality
      $(".signupbtn").on('click',function(){
      $.post("<?php echo base_url();?>account/signup",$("#headersignupform").serialize(), function(response){
      if($.trim(response) == 'true'){
      $(".resultsignup").html("<div id='rotatingDiv'></div>");
      window.location.replace(url);
      }else{
      $(".resultsignup").html(response); } }); });
  // end signup functionality
  })

</script>