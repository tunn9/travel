<!-- WRAP -->
<style>.height44 { height: 44px !important; }</style>
<div >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form_title title_rtl">
                        <h3><?php echo trans('0270');?></h3>
                        <p><?php echo trans('0260');?></p>
                    </div>
                </div>
                <form action="" class="row" method="POST">
                    <div class="bg-white" style="padding:15px">
                        <?php if(isset($successmsg)){ ?>
                        <div style="margin-bottom: 0px;" class="alert alert-success">
                            <i class="fa fa-check-square-o"></i>
                            <?php echo @$successmsg; ?>
                        </div>
                        <?php } if(!empty($validationerrors)){ ?>
                        <div style="margin-bottom: 0px;" class="alert alert-danger">
                            <i class="fa fa-times-circle"></i>
                            <?php echo $validationerrors; ?>
                        </div>
                        <?php } ?>
                        <div id="message-contact"></div>
                        <div class="col-md-4 go-right">
                            <!--<span class="opensans size24 slim go-right"><?php echo trans('0439');?></span>-->
                            <br>
                            <input placeholder="<?php echo trans('0350');?>" class="height44 form-control logpadding margtop10  contact_form" type="text" name="contact_name" value="" required />
                            <input placeholder="<?php echo trans('094');?>"  class="height44 form-control logpadding margtop10 contact_form" type="email" name="contact_email" value="" required />
                            <input placeholder="<?php echo trans('0261');?>" class="height44 form-control logpadding margtop10 contact_form" type="text" name="contact_subject" value="" required />
                        </div>
                        <div style="margin-top: 19px;" class="col-md-4 go-right">
                            <textarea name="contact_message" placeholder="<?php echo trans('0262');?>" rows="7" class="form-control margtop10"></textarea>
                        </div>
                        <div class="col-md-4 opensans grey go-right RTL">
                            <strong><?php if(!empty($res2[0]->contact_address)){ ?>
                            <?php echo trans('0255');?>:</strong><br/>
                            <span class="dark">
                            <?php echo $res2[0]->contact_address; ?>
                            </span>
                            <?php } ?>
                            <br/><br>
                            <?php if(!empty($res2[0]->contact_phone)){ ?>
                            <?php echo trans('061');?><br/>
                            <p class="opensans size30 lblue xslim"><?php echo $res2[0]->contact_phone;?></p>
                            <?php } ?>
                            <?php if(!empty($res2[0]->contact_email)){ ?>
                            <?php echo trans('094');?><br/>
                            <a href="mailto:<?php echo $res2[0]->contact_email;?>" class="green2"><?php echo $res2[0]->contact_email;?></a>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="well well-sm">
                        <input class="btn btn-primary btn-block btn-lg go-right" type="submit" name="submit_contact" value="<?php echo trans('086');?>">
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End container -->
<!--<div id="map_contact"></div>-->
<div class="clearfix"></div>
<!--
    <?php if(!empty($res2[0]->contact_address)){ ?>
    <address>
    <?php echo $res2[0]->contact_address; ?>
    </address>
    <?php } ?>

    <script>
        $(document).ready(function(){
        $("address").each(function(){
        var embed ="<iframe width='100%' height='315' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='//maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&amp;output=embed'></iframe>";
        $(this).html(embed);
        }); });
    </script>-->