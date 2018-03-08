<?php if($appModule == "ean") {?>
        <div class="panel-body">
            <form  action="" method="GET" role="search">
                <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
                        <input type="text" placeholder="<?php echo trans('07');?>" name="checkin" class="form-control dpean1" value="<?php echo $eancheckin;?>" required>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
                        <input type="text" placeholder="<?php echo trans('09');?>" name="checkout" class="form-control dpean2" value="<?php echo $eancheckout;?>" required>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
                        <select class="mySelectBoxClass form-control" name="adults" id="adults">
                            <?php for($i = 1; $i <= $maxAdults;$i++){ ?>
                            <option value="<?php echo $i;?>" <?php makeselected($i,$adultsCount); ?> ><?php echo $i;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
                        <select class="mySelectBoxClass form-control childcountDetailsPage" name="child" id="child">
                            <option selected value="0">0</option>
                            <?php for($child = 1; $child <= 6;$child++){ ?>
                            <option value="<?php echo $child;?>" <?php if($child == $childCount){ echo "selected"; } ?>> <?php echo $child;?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
                    <label>&nbsp;</label>
                    <button class="btn btn-block btn-success textupper loader"><?php echo trans('0106');?></button>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
<?php } ?>
<?php if($appModule == "hotels") {?>
<div class="panel panel-default">
                            <div class="panel-heading panel-default ttu"><span class="go-right"><?php echo trans('0197'); ?></span>
                            <?php if(!empty($rooms)){ ?>
                            <span class="pull-right go-left"><strong><i class="icon_set_1_icon-83"></i> <?php echo trans('0122');?></strong> <?php echo $modulelib->stay; ?> </span>
                            <?php } ?>
                            <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                              <form class="row" action="" method="GET">
                            <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
                        <input type="text" placeholder="<?php echo trans('07');?>" name="checkin" class="form-control dpd1rooms" value="<?php echo $checkin;?>" required>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
                        <input type="text" placeholder="<?php echo trans('09');?>" name="checkout" class="form-control dpd2rooms" value="<?php echo $checkout;?>" required>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
                        <select class="mySelectBoxClass form-control" name="adults" id="adults" value="<?php echo $modulelib->adults;?>">
                            <?php for($Selectadults = 1; $Selectadults < 11;$Selectadults++){ ?>
                            <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $modulelib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
                        <select class="mySelectBoxClass form-control" name="child" id="child" value="<?php echo $modulelib->children;?>">
                            <?php for($Selectchild = 0; $Selectchild < 6;$Selectchild++){ ?>
                            <option value="<?php echo $Selectchild;?>" <?php if($Selectchild == $modulelib->children){ echo "selected"; } ?> > <?php echo $Selectchild;?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 go-right">
               <label class="hidden-xs">&nbsp;</label>
              <button class="btn btn-block btn-success-small textupper loader"><?php echo trans('0106');?></button>
             <input type="hidden" id="loggedin" value="<?php echo $usersession;?>" />
            <input type="hidden" id="itemid" value="<?php echo $module->id; ?>" />
           <input type="hidden" id="module" value="<?php echo $appModule;?>" />
          <input type="hidden" id="addtxt" value="<?php echo trans('029');?>" />
         <input type="hidden" id="removetxt" value="<?php echo trans('028');?>" />
       </div>
      </form>
     </div>
    </div>
    <?php } ?>