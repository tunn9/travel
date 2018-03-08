<ul class="nav navbar-nav navbar-side navbar-right sidebar go-left">
    <?php  if(!empty($customerloggedin)){ ?>
    <li class="">
        <a href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle go-text-right">
            <img src="<?php echo $theme_url ?>/assets/img/icons/user.png" alt="user">
            <?php echo $firstname; ?> <b class="lightcaret mt-2 go-left"></b></a>
        <ul class="dropdown-menu">
            <li><a class="go-text-right" href="<?php echo base_url()?>account/">  <?php echo trans('02');?></a></li>
            <li><a class="go-text-right" href="<?php echo base_url()?>account/logout/">  <?php echo trans('03');?></a></li>
        </ul>
    </li>
    <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ if($allowreg == "1"){ ?>
    <li id="li_myaccount">
        <a href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle go-text-right">
            <img src="<?php echo $theme_url ?>assets/img/icons/user.png" alt="user">
            <?php echo trans('0146');?> <b class="lightcaret mt-2 go-left"></b></a>
        <ul class="dropdown-menu">
            <li><a class="go-text-right" href="<?php echo base_url(); ?>login"> <?php echo trans('04');?></a></li>
            <li><a class="go-text-right" href="<?php echo base_url(); ?>register">  <?php echo trans('0115');?></a></li>
        </ul>
    </li>
    <?php } } } ?>
    <?php 
        if(strpos($currenturl,'book') == false && $app_settings[0]->multi_curr == 1 && empty($hideCurr)):
            $currencies = ptCurrencies(); 
    ?>
        <li class="dropdown">
            <a class="dropdown-toggle go-text-right" data-toggle="dropdown" href="#">
                <strong><i class="icon-money-2 go-right"></i> 
                    <?php echo isset($_SESSION['currencycode']) ? $_SESSION['currencycode'] : 'USD'; ?>
                </strong>
            </a>
            <ul class="dropdown-menu wow fadeIn">
                <?php foreach($currencies as $c): ?>
                <li>
                    <a class="go-text-right" data-code='<?php echo $c->id;?>' href="#" onclick="change_currency(this)">
                        <?php echo $c->name;?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endif; ?>
    <?php if(empty($langname)){ $langname = languageName($lang_set); }else{ $langname = $langname; } if (strpos($currenturl,'book') !== false || !empty($hideLang)) { }else{
        if($app_settings[0]->multi_lang == '1') { $default_lang = $app_settings[0]->default_lang; if(!empty($lang_set)){ $default_lang = $lang_set; } ?>
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="javascript:void(0);" data-toggle="dropdown" class="go-text-right dropdown-toggle" aria-expanded="true"> <img class="go-right flafFIX" src="<?php echo PT_LANGUAGE_IMAGES.$default_lang.".png";?>" width="21" height="14" alt="<?php echo $langname;?>"> <?php echo $langname;?> </a>
            <ul class="dropdown-menu wow fadeIn">
                <?php foreach($languageList as $ldir => $lname){ $selectedlang = ''; if(!empty($lang_set) && $lang_set == $ldir){ $selectedlang = 'selected'; }elseif(empty($lang_set) && $default_lang == $ldir){ $selectedlang = 'selected'; } ?>
                <li><a href="<?php echo pt_set_langurl($langurl,$ldir);?>" data-langname="<?php echo $lname['name'];?>" id="<?php echo $ldir; ?>" class="go-text-right changelang" ><img class="go-right flafFIX" src="<?php echo PT_LANGUAGE_IMAGES.$ldir.".png";?>" width="21" height="14" alt="">  <?php echo $lname['name'];?></a></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
    <?php } ?>
    <?php } ?>
    <li class="visible-xs mob-menu go-text-right"><i class="go-right icon_set_1_icon-87"></i> <?php echo trans('0184');?></li>
    <li class="visible-xs go-text-right"><a href="<?php echo base_url(); ?>About-Us"><i class="icon_set_1_icon-93 go-right "></i> <?php echo trans('0475');?>  <i class="angle right icon pull-right"></i></a></li>
    <li class="visible-xs go-text-right"><a href="<?php echo base_url(); ?>Contact-Us"><i class="icon_set_1_icon-84 go-right "></i> <?php echo trans('0270');?>  <i class="angle right icon pull-right"></i></a></li>
    <li class="visible-xs go-text-right"><a href="<?php echo base_url(); ?>Terms-of-Use"><i class="icon_set_1_icon-92 go-right "></i> <?php echo trans('057');?>  <i class="angle right icon pull-right"></i></a></li>
    <li class="visible-xs go-text-right"><a href="<?php echo base_url(); ?>Privacy-Policy"><i class="icon_set_1_icon-17 go-right "></i> <?php echo trans('0148');?>  <i class="angle right icon pull-right"></i></a></li>
</ul>