<style>
  .forms { color: #303030; max-width: 350px; padding: 19px 29px 29px; margin: 0 auto; margin-bottom: 15px; }
  .logpanel { min-height: 20px; padding: 8px; background-color: rgb(255, 255, 255); -webkit-border-radius: 0px; border-radius: 1px; -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05); box-shadow: 3px 3px 2px 0 rgba(44, 49, 55, .1); border-radius: 4px; }
  .form-heading { padding: 10px 0; margin: 10px 0; padding-top: 0px; padding-bottom: 5px; font-size: 20px; }
  .form-signin .form-control { position: relative; height: auto; -webkit-box-sizing: border-box; box-sizing: border-box; margin-bottom: 10px!important; }
  .form-signin .forget-password { text-align: center; }
</style>
<div class="">
  <!-- 100% Width & Height container  -->
  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3" style="margin-bottom:400px;margin-top100px">



    <?php  if(!empty($customerloggedin)){ ?>
    <li><a href="<?php echo base_url()?>account/logout"><?php echo trans('03');?></a></li>
    <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ ?>
    <form method="POST" action="" id="loginfrm" accept-charset="UTF-8" onsubmit="return false;">
      <p>
        <img data-wow-duration="0.5s" data-wow-delay="0.5s" src="<?php echo base_url(); ?>/assets/img/admin.png" class="center-block wow fadeIn center-block" style="width: 78px; height: 60px; margin-top: 100px; margin-bottom: 20px;" alt="">
      </p>

       <div class="panel panel-default">
  <div class="panel-heading"><?php echo trans('04');?></div>

        <div class="resultlogin"></div>
        <div id="login-overlay"></div>
      <div class="clearfix"></div>
        <div data-wow-duration="1s" data-wow-delay="1s" class="wow fadeIn">
          <div style="background-color: white;" class="panel-body">
            <div class="form-group">
              <label><?php echo trans('094');?></label>
              <input type="email" class="form-control padding-10"  placeholder="<?php echo trans('094');?>" required="required" name="username">
            </div>
            <div class="form-group">
              <label><?php echo trans('095');?></label>
              <input type="password" class="form-control padding-10"  placeholder="<?php echo trans('095');?>" required="required" name="password">
            </div>
            <?php if(!empty($url)){ ?>
            <input type="hidden" class="url" value="<?php echo base_url().'properties/reservation/'.$url;?>" />
            <?php }else{ ?>
            <input type="hidden" class="url" value="<?php echo base_url();?>account/" />
            <?php } ?>
            <label class="go-right"><input class="go-right" type="checkbox" name="remember" id="remember-me" value="1"> <span style="font-size:13px;color:#000"><span class="go-left"> &nbsp; <?php echo trans('0187');?> &nbsp; </span></span></label>
          </div>
          <button style="margin-top: -16px; border-radius: 0px;height: 70px; font-size: 16px;" type="submit" class="btn btn-action btn-lg btn-block loginbtn"><?php echo trans('04');?></button>
        </div>
        </div>
        <div class="wow zoomInDown animated row">
          <?php if($registerationAllowed == "1"){ ?>
          <div class="col-md-12"><a class="btn btn-default btn-block form-group" href="<?php echo base_url();?>register"><span></span><?php echo trans('0237');?></a></div>
          <?php } ?>
          <div class="clearfix form-group"></div>
          <div class="col-md-12"><a class="btn btn-default btn-block"  data-toggle="modal" href="#ForgetPassword"><?php echo trans('0112');?></a></div>
        </div>
      <!-- End of Login Wrap  -->
    </form>
  </div>
  <div class="clearfix"></div>
</div>
<!-- End of Container  -->
<div class="clearfix"></div>
<?php if($fblogin){ ?>
<div class="form-group">
  <a href="<?php echo $fbloginurl;?>" class="btn btn-facebook btn-block"><i class="fa fa-facebook-square" ></i> <?php echo trans('0266');?></a>
</div>
<?php } ?>
<?php } }  ?>
<!-- PHPTRAVELS forget password starting -->
<div class="modal wow fadeIn animated" id="ForgetPassword" tabindex="" role="dialog" aria-labelledby="ForgetPassword" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-asterisk"></i> <?php echo trans('0112');?></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="passresetfrm" accept-charset="UTF-8" onsubmit="return false;">
          <div class="resultreset"></div>
          <div class="input-group">
            <input type="text" placeholder="your@email.com" class="form-control" id="resetemail" name="email" required>
            <span class="input-group-btn">
            <button type="submit" class="btn btn-primary resetbtn" type="button"><?php echo trans('0114');?></button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- PHPTRAVELS forget password ending -->
<script>
  $(function(){
  var url = $(".url").val();
  // start login functionality
  $(".loginbtn").on('click',function(){
  $.post("<?php echo base_url();?>account/login",$("#loginfrm").serialize(), function(response){ if(response != 'true'){
  $(".resultlogin").html("<div class='alert alert-danger'>"+response+"</div>"); }else{
  $(".resultlogin").html("<div id='rotatingDiv'></div> <div class='alert alert-success'><?php echo trans('0427');?></div>");
  window.location.replace(url); }}); });
  // end login functionality

  // start password reset functionality
  $(".resetbtn").on('click',function(){
   var resetemail = $("#resetemail").val();
     $(".resultreset").html("<div id='rotatingDiv'></div>");
  $.post("<?php echo base_url();?>account/resetpass",$("#passresetfrm").serialize(), function(response){
  if($.trim(response) == '1'){
  $(".resultreset").html("<div class='alert alert-success'>New Password sent to "+resetemail+", <?php echo trans('0426');?></div>");
  }else{
  $(".resultreset").html("<div class='alert alert-danger'><?php echo trans('0425');?></div>");
  } }); });
  // end password reset functionality
  });
</script>