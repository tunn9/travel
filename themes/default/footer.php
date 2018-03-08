</div> <!--/ .body-section -->
<!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->

<footer id="footer">
    <div class="container">
        <div class="footer-wappper">
            <div class="footer-left">
                <div class="footer-about">
                    <div class="logo-footer">
                        <a href="#">
                            <img src="<?php echo base_url(); ?>uploads/global/logo_footer.png" alt="PHPTRAVELS" />
                        </a>
                    </div>
                    <div class="footer-about-content">
                        <p>Ubuk.com is a product of <br>
                            CÔNG TY CP DU LỊCH VÀ DỊCH VỤ HY VỌNG <br>
                            ESPERANTOUR <br>
                            Địa chỉ: 112 Hai Bà Trưng - Hoàn Kiếm - Hà Nội <br>
                            Điện thoại: (04) 3824 08 09 <br>
                            Hotline: 091 945 9393 <br>
                            Email: info@espc.vn <br>
                            Tên người đại diện: Phan Hồng Châu <br>
                            Số chứng nhận đăng ký kinh doanh gồm: <br>
                            1) Mã số thuế: 0101173217 <br>
                            2) Số quyết định: 0102003521 cấp ngày <br>
                            02/11/2004 do PHÒNG ĐKKD - SỞ KẾ <br>
                            HOẠCH VÀ ĐẦU TƯ TP HÀ NỘI <br>
                            3) Ngày cấp: 29/03/2014 - Nơi cấp: Công an TP Hà Nội</p>
                    </div>
                    <div class="footer-social hidden-xs">
                        <span><?php echo trans('0599'); ?></span>
<!--                        --><?php //foreach($footersocials as $fs){ ?>
<!--                            <a href="--><?php //echo $fs->social_link;?><!--" data-toggle="tooltip" data-placement="top" title="--><?php //echo $fs->social_name;?><!--" target="_blank"><img src="--><?php //echo PT_SOCIAL_IMAGES; ?><!----><?php //echo $fs->social_icon;?><!--" class="social-icons-footer" /></a>-->
<!--                        --><?php //} ?>
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-google-plus"></a>
                        <a href="#" class="fa fa-instagram"></a>
                    </div>
                </div>
                <!--            --><?php //if(pt_is_module_enabled('newsletter')){ ?>
                <!--                <h2 class="go-text-right"><strong>--><?php //echo trans('023');?><!--</strong></h2>-->
                <!--                <div class="col-md-12">-->
                <!--                    <div id="message-newsletter_2"></div>-->
                <!--                    <form role="search" onsubmit="return false;">-->
                <!--                    </form>-->
                <!--                    <div class="row">-->
                <!--                        <input type="email" class="form-control fccustom2 sub_email form-group" id="exampleInputEmail1" placeholder="--><?php //echo trans('023');?><!-- --><?php //echo trans('0403');?><!--" required>-->
                <!--                        <div class="clearfix"></div>-->
                <!--                        <button type="submit" class="btn btn-success btn-block sub_newsletter ttu"> --><?php //echo trans('024');?><!--</button>-->
                <!--                    </div>-->
                <!--                    <ul class="nav navbar-nav">-->
                <!--                        <li>-->
                <!--                            <a class="newstext" href="javascript:void(0);">-->
                <!--                                <div style="color:white" class="subscriberesponse"></div>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--            --><?php //} ?>

            </div>
            <div class="footer-right hidden-xs">
                <div class="footer-items">
                    <div class="footer-items-inner">
                        <?php get_footer_menu_items(19,"footer-inner-content","footer-title","footer-list" );?>
                    </div>
                    <div class="footer-items-inner">
                        <?php get_footer_menu_items(19, "footer-inner-content","footer-title","footer-list"  );?>
                    </div>
                    <div class="footer-items-inner">
                        <?php get_footer_menu_items(25,"footer-inner-content","footer-title","footer-list" );?>
                    </div>
                </div>
                <div style="position: relative">
                    <ul class="footer-certificate">
                        <li>
                            <p>Payment Partners</p>
                            <img src="<?php echo $theme_url ?>assets/img/one-page.png" alt="Payment Partners">
                        </li>
                        <li>
                            <p>General Certificate</p>
                            <img src="<?php echo $theme_url ?>assets/img/certificate.png" alt="General Certificate">
                        </li>
                    </ul>
                    <a href="javascript:void" class="gotop scroll wow fadeInUp btn btn-default"><img src="<?php echo $theme_url ?>assets//img/goTop.png" alt="go top" /></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>
<div class="foot hidden-xs hidden-sm hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 text-right footbrand nopadding">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" class="pull-right brand img-responsive"/></a>
            </div>
            <div class="col-md-1 footside"></div>
            <div class="col-3 col-sm-3 col-md-2">
                <img src="<?php echo $theme_url; ?>assets/img/payments.png" class="img-responsive payments" alt="">
            </div>
            <div class="col-md-4">
                <?php if($allowsupplierreg){ ?>
                    <div class="col-md-6">
                        <a class="btn btn-warning btn-block" target="_blank" href="<?php echo base_url(); ?>supplier-register/"><?php echo trans('0241');?></a>
                    </div>
                <?php } ?>
                <div class="col-md-6">
                    <a class="btn btn-success btn-block" target="_blank" href="<?php echo base_url(); ?>supplier/"><?php echo trans('0527');?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rightsdiv">
    <div class="container">
        <!--        <div class="col-md-6">-->
        <!--            --><?php //foreach($footersocials as $fs){ ?>
        <!--                <a href="--><?php //echo $fs->social_link;?><!--" data-toggle="tooltip" data-placement="top" title="--><?php //echo $fs->social_name;?><!--" target="_blank"><img src="--><?php //echo PT_SOCIAL_IMAGES; ?><!----><?php //echo $fs->social_icon;?><!--" class="social-icons-footer" /></a>-->
        <!--            --><?php //} ?>
        <!--        </div>-->
        <div class="col-md-12">
            <p class="copyright text-center"><strong>&copy; <?php echo $app_settings[0]->copyright;?></strong></p>
        </div>
    </div>
    <!-- tripadvisors block -->
<!--    --><?php //if($tripmodule){ ?>
<!--        <div class="footerbg text-center hidden-xs hidden-sm hide">-->
<!--            <a class="btn-block" target="_blank" href="//www.tripadvisor.com/pages/terms.html"><img width="200" lass="block-center" src="--><?php //echo PT_GLOBAL_IMAGES_FOLDER . 'tripadvisor.png';?><!--" alt="TripAdvisor" /></a>-->
<!--            <p>Ratings and Reviews Powered by TripAdvisor</p>-->
<!--        </div>-->
<!--    --><?php //} ?>
    <!-- tripadvisors block -->
<!--    <div class="hidden-xs hidden-sm gotopDiv">-->
<!--        <div class="container text-right">-->
<!--            <a href="javascript:void" class="gotop scroll wow fadeInUp btn btn-default"><img src="--><?php //echo $theme_url ?><!--assets//img/goTop.png" alt="go top" /></a>-->
<!--        </div>-->
<!--    </div>-->
</div>
<?php include 'scripts.php'; ?>
</body>
</html>