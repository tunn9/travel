<br>
<div class="panel panel-default">
<?php if(empty($usersession)){ ?>
<ul class="nav nav-tabs RTL nav-justified">
<li role="presentation" class="active" data-title="HOTELS">
<a class="text-center" href="#Guest" id="guesttab" data-toggle="tab">
<i class="icon-user-7"></i>
<div class="visible-xs clearfix"></div>
<span class="hidden-xs"><?php echo trans('0167');?></span>
</a>
</li>
<!--  <li role="presentation" class="text-center" data-title="flight">
<a href="#flight" data-toggle="tab" aria-controls="home" aria-expanded="true">
<i class="icon_set_1_icon-16"></i>
<div class="visible-xs clearfix"></div>
<span class="hidden-xs">Register and Book</span>
</a>
</li>-->

<?php if($app_settings[0]->allow_registration == "1"){ ?>
<li role="presentation" class="text-center" data-title="VISA">
<a class="text-center" href="#Sign-In" id="signintab" data-toggle="tab">
<i class="icon-key-4"></i>
<div class="visible-xs clearfix"></div>
<span class="hidden-xs"><?php echo trans('0168');?></span>
</a>
</li>
<?php } ?>
</ul>

    <div class="panel-body">
        <div class="row">
            <div class="clearfix"></div>
            <!-- PHPTRAVELS Booking tabs ending  -->
            <div class="tab-content" style="height: inherit;">
                <!-- PHPTRAVELS Guest Booking Starting  -->
                <div class="tab-pane fade in active" id="Guest">
                    <form id="guestform">
                        <div class="col-md-6  go-right">
                            <div class="form-group ">
                                <label  class="required go-right hidden-xs"><?php echo trans('0171');?></label>
                                <input class="form-control" type="text" placeholder="<?php echo trans('0171');?>" name="firstname"  value="">
                            </div>
                        </div>
                        <div class="col-md-6  go-left">
                            <div class="form-group ">
                                <label  class="required go-right hidden-xs"><?php echo trans('0172');?></label>
                                <input class="form-control" type="text" placeholder="<?php echo trans('0172');?>" name="lastname"  value="">
                            </div>
                        </div>
                        <div class="col-md-6 go-right">
                            <div class="form-group ">
                                <label  class="required go-right hidden-xs"><?php echo trans('094');?></label>
                                <input class="form-control" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="">
                            </div>
                        </div>
                        <div class="col-md-6 go-left">
                            <div class="form-group">
                                <label  class="required go-right hidden-xs"><?php echo trans('0175');?> <?php echo trans('094');?></label>
                                <input class="form-control" type="email" placeholder="<?php echo trans('0175');?> <?php echo trans('094');?>" name="confirmemail"  value="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 go-right">
                            <div class="form-group ">
                                <label  class="required go-right hidden-xs"><?php echo trans('0173');?></label>
                                <input class="form-control" type="text" placeholder="<?php echo trans('0414');?>" name="phone"  value="">
                            </div>
                        </div>
                        <div class="col-md-6 go-right">
                            <div class="form-group ">
                                <label  class="required go-right hidden-xs"><?php echo trans('098');?></label>
                                <input class="form-control" type="text" placeholder="<?php echo trans('098');?>" name="address"  value="">
                            </div>
                        </div>
                        <div class="col-md-12 go-right">
                            <div class="form-group ">
                                <label  class="required go-right hidden-xs"><?php echo trans('0105');?></label>
                                <select  class="chosen-select" name="country">
                                    <option value=""><?php echo trans('0484');?></option>
                                    <?php
                                        foreach($allcountries as $country){
                                        ?>
                                    <option value="<?php echo $country->iso2;?>" <?php if($profile[0]->ai_country == $country->iso2){echo "selected";}?> ><?php echo $country->short_name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12  go-right">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0178');?></label>
                                <textarea class="form-control" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <!-- PHPTRAVELS Guest Booking Ending  -->
                <!-- PHPTRAVELS Sign in Starting  -->
                <div class="tab-pane fade" id="Sign-In">
                    <form action="" method="POST" id="loginform">
                        <div class="col-md-6 go-right">
                            <div class="form-group ">
                                <label  class="required  go-right"><?php echo trans('094');?></label>
                                <input class="form-control" type="text" placeholder="Email" name="username" id="username"  value="">
                            </div>
                        </div>
                        <div class="col-md-6 go-left">
                            <div class="form-group">
                                <label  class="required go-right"><?php echo trans('095');?></label>
                                <input class="form-control" type="password" placeholder="<?php echo trans('095');?>" name="password" id="password"  value="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 go-right">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0178');?></label>
                                <textarea class="form-control" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- PHPTRAVELS Sign in Ending  -->
            <?php }else{ ?>
            <!-- PHPTRAVELS LoggeIn Booking Starting  -->
            <div id="loggeduserdiv">
                <form id="loggedform">
                    <div class="panel-body">
                        <div class="col-md-6  go-right">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0171');?></label>
                                <input class="form-control" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_first_name?>" disabled="disabled" style="background-color: #DEDEDE !important"/>
                            </div>
                        </div>
                        <div class="col-md-6  go-left">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0172');?></label>
                                <input class="form-control" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_last_name?>" disabled="disabled" style="background-color: #DEDEDE !important">
                            </div>
                        </div>
                        <div class="col-md-6 go-right">
                            <div class="form-group ">
                                <label  class="required  go-right"><?php echo trans('094');?></label>
                                <input class="form-control" type="text" placeholder="" name=""  value="<?php echo $profile[0]->accounts_email?>" disabled="disabled" style="background-color: #DEDEDE !important">
                            </div>
                        </div>
                        <div class="col-md-12  go-right">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0178');?></label>
                                <textarea class="form-control" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <!-- PHPTRAVELS LoggedIn User Booking Ending  -->
            <?php } ?>
        </div>
    </div>
</div>