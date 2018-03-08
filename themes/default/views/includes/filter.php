<?php if($appModule == "offers"){ ?>
<?php echo run_widget(63); ?>
<?php }else{ ?>

<?php if($appModule == "ean"){ ?>
<!-- TOP TIP -->
        <div style="padding:10px 10px 10px 10px">
            <div class="textline">
                <span class="filterstext"><span><i class="icon_set_1_icon-95"></i><?php echo trans('0191');?></span></span>
            </div>
        </div>
    <form  action="<?php echo $baseUrl;?>search" method="GET">
        <div class="tip-arrow"></div>
        <!-- Star ratings -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
        <?php echo trans('0137');?> <?php echo trans('069');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse1" class="collapse in">
            <div class="hpadding20">
                <br>
                <?php $star = '<i class="star text-warning fa fa-star voted"></i>'; ?>
                <?php $stars = '<i class="fa fa-star-o"></i>'; ?>
                <div  class="rating" style="font-size: 14px;">
                    <div class="go-right"><input id="1" type="radio" name="stars" class="go-right radio" value="1" <?php if(@$_GET['stars'] == "1"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="1"><?php echo $star; ?><?php for($i=1;$i<=6;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="2" type="radio" name="stars" class="radio go-right" value="2" <?php if(@$_GET['stars'] == "2"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="2"><?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=5;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="3" type="radio" name="stars" class="radio" value="3" <?php if(@$_GET['stars'] == "3"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="3"><?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=4;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="4" type="radio" name="stars" class="radio" value="4" <?php if(@$_GET['stars'] == "4"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="4"><?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=3;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="5" type="radio" name="stars" class="radio" value="5" <?php if(@$_GET['stars'] == "5"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="5"><?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=2;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <!-- <div class="go-right"><input id="7" type="radio" name="stars" class="radio" value="7" <?php if(@$_GET['stars'] == "7"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="7"><?php for($i=1;$i<=7;$i++){ ?> <?php echo $star; ?> <?php } ?></label></div>-->
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
        </div>
        <!-- End of Star ratings -->
        <!-- Price range -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
        <?php echo trans('0301');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse2" class="collapse in">
            <div class="panel-body text-center">
                <?php if(!empty($_GET['price'])){
                    $selectedprice = $_GET['price'];
                    }else{
                    $selectedprice =  $minprice.",".$maxprice;
                    }?>
                <input type="text" class="col-md-12" value="" data-slider-min="<?php echo @$minprice;?>" data-slider-max="<?php echo @$maxprice;?> " data-slider-step="100" data-slider-value="[<?php echo $selectedprice;?>]" id="sl2" name="price">
            </div>
        </div>
        <!-- End of Price range -->
        <!-- Acomodations -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
        <?php echo trans('0478');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse3" class="collapse in">
            <div class="hpadding20">
                <br>
                <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="6" id="all" class="checkbox go-right" <?php if(in_array("6", $propertyCategory)){ echo "checked"; } ?> /><label for="all" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0467');?> &nbsp;</label></div>
                <div class="clearfix"></div>
                <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="1" id="hotel" class="checkbox go-right" <?php if(in_array("1", $propertyCategory)){ echo "checked"; } ?> /><label for="hotel" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('01');?> &nbsp; </label></div>
                <div class="clearfix"></div>
                <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="2" id="suite" class="checkbox go-right" <?php if(in_array("2", $propertyCategory)){ echo "checked"; } ?> /><label for="suite" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0468');?>&nbsp;&nbsp; </label></div>
                <div class="clearfix"></div>
                <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="3" id="resort" class="checkbox go-right" <?php if(in_array("3", $propertyCategory)){ echo "checked"; } ?> /><label for="resort" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0469');?> &nbsp;</label></div>
                <div class="clearfix"></div>
                <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="4" id="vacation" class="checkbox go-right" <?php if(in_array("4", $propertyCategory)){ echo "checked"; } ?> /><label for="vacation" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0470');?> &nbsp; </label></div>
                <div class="clearfix"></div>
                <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="5" id="bed" class="checkbox go-right" <?php if(in_array("5", $propertyCategory)){ echo "checked"; } ?> /><label for="bed" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0471');?> &nbsp;</label></div>
                <div class="clearfix"></div>
                <br>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End of Acomodations -->
        <!-- Property Amenities -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse4">
        <?php echo trans('048');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse4" class="collapse in">
            <div class="scroll-400">
                <div class="hpadding20">
                    <br>
                    <?php foreach($propertyAmenities as $pa){ ?>
                    <div class="go-right">    <input class="checkbox go-right" id="pa<?php echo $pa->id;?>" name="amenities[]" value="<?php echo $ra->id;?>" type="checkbox">
                        <label for="pa<?php echo $pa->id;?>"><?php echo character_limiter($pa->name,20); ?>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End of Property Amenities -->
        <!-- Room Amenities -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse5">
        <?php echo trans('055');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse5" class="collapse in">
            <div class="scroll-400">
                <div class="hpadding20">
                    <br>
                    <?php foreach($roomAmenities as $ra){ ?>
                    <div class="go-right">    <input class="checkbox go-right" id="ra<?php echo $ra->id;?>" name="amenities[]" value="<?php echo $ra->id;?>" type="checkbox">
                        <label for="ra<?php echo $ra->id;?>"><?php echo character_limiter($ra->name,20); ?>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End of Room Amenities -->
        <!-- End of Hotel Preferences -->
        <div class="clearfix"></div>
        <br/>
        <input type="hidden" name="city" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>">
        <input type="hidden" name="checkIn" value="<?php echo $checkin; ?>">
        <input type="hidden" name="checkOut" value="<?php echo $checkout; ?>">
        <input type="hidden" name="childages" value="<?php echo $childAges; ?>">
        <input type="hidden" name="adults" value="<?php echo $adults; ?>">
        <input type="hidden" name="search" value="1">
        <button style="border-radius:0px;margin-bottom: 0px;" type="submit" class="btn btn-action btn-lg btn-block loader" id="searchform"><?php echo trans('012');?></button>
       </form>
      <!-- End Ean search form left side -->
     <?php }else{ ?>
      <!-- FILTERS -->
      <form  action="<?php echo base_url().$appModule;?>/search" method="GET" role="search">
        <!-- TOP TIP -->
        <div style="padding:10px 10px 10px 10px">
            <div class="textline">
                <span class="filterstext"><span><i class="icon_set_1_icon-95"></i><?php echo trans('0191');?></span></span>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Star ratings -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
        <?php echo trans('0137');?> <?php echo trans('069');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse1" class="collapse in">
            <div class="hpadding20">
                <br>
                <?php $star = '<i class="star text-warning fa fa-star voted"></i>'; ?>
                <?php $stars = '<i class="fa fa-star-o"></i>'; ?>
                <div  class="rating" style="font-size: 14px;">
                    <div class="go-right"><input id="1" type="radio" name="stars" class="go-right radio" value="1" <?php if(@$_GET['stars'] == "1"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="1"><?php echo $star; ?><?php for($i=1;$i<=6;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="2" type="radio" name="stars" class="radio go-right" value="2" <?php if(@$_GET['stars'] == "2"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="2"><?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=5;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="3" type="radio" name="stars" class="radio" value="3" <?php if(@$_GET['stars'] == "3"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="3"><?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=4;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="4" type="radio" name="stars" class="radio" value="4" <?php if(@$_GET['stars'] == "4"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="4"><?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=3;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <div class="go-right"><input id="5" type="radio" name="stars" class="radio" value="5" <?php if(@$_GET['stars'] == "5"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="5"><?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=2;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                    <div class="clearfix"></div>
                    <!--<div class="go-right"><input id="7" type="radio" name="stars" class="radio" value="7" <?php if(@$_GET['stars'] == "7"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="7"><?php for($i=1;$i<=7;$i++){ ?> <?php echo $star; ?> <?php } ?></label></div> -->
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
        </div>
        <!-- End of Star ratings -->
        <!-- Price range -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
        <?php echo trans('0301');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse2" class="collapse in">
            <div class="panel-body text-center">
                <?php if(!empty($_GET['price'])){
                    $selectedprice = $_GET['price'];
                    }else{
                    $selectedprice =  $minprice.",".$maxprice;
                    }?>
                <input type="text" class="col-md-12" value="" data-slider-min="<?php echo @$minprice;?>" data-slider-max="<?php echo @$maxprice;?> " data-slider-step="100" data-slider-value="[<?php echo $selectedprice;?>]" id="sl2" name="price">
            </div>
        </div>
        <!-- End of Price range -->
        <!-- Module types -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
        <?php if($appModule == "hotels"){ echo trans('0478'); }else if($appModule == "tours"){ echo trans('0366'); }else if($appModule == "cars"){ echo trans('0214'); } ?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse3" class="collapse in">
            <div class="hpadding20">
                <br>
                <div class="clearfix"></div>
                <?php @$vartype = $_GET['type'];
                    if(empty($vartype)){
                    $vartype = array();
                    }
                    foreach($moduleTypes as $mtype){
                        if(!empty($mtype->name)){
                            if($appModule == "hotels"){
                    ?>
                <div class="go-right"> <input type="checkbox" value="<?php echo $mtype->id;?>" <?php if(in_array($mtype->id,$vartype)){echo "checked";}?> name="type[]" id="<?php echo $mtype->name;?>" class="checkbox" /> <label for="<?php echo $mtype->name;?>" class="css-label go-left">&nbsp;&nbsp;<?php echo $mtype->name;?></label></div>
                <div class="clearfix"></div>
                <?php }else if($appModule == "tours" || $appModule == "cars"){ ?>
                <div class="go-right"><input class="radio" type="radio" value="<?php echo $mtype->id;?>" name="type" id="<?php echo $mtype->name;?>" class="checkbox go-right" <?php if($mtype->id == $vartype){echo "checked";}?> /><label for="<?php echo $mtype->name;?>" class="css-label go-left"> &nbsp;&nbsp; <?php echo $mtype->name;?> &nbsp;&nbsp;</label></div>
                <div class="clearfix"></div>
                <?php } } } ?>
                <br>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End of Module Types -->
        <!-- Hotel Amenities -->
        <?php if(!empty($amenities)){ ?>
        <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4">
        <?php echo trans('0249');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse4" class="collapse in">
            <div class="hpadding20">
                <br>
                <div class="clearfix"></div>
                <?php @$varAmt = $_GET['amenities'];
                    if(empty($varAmt)){
                    $varAmt = array();
                    }
                    foreach($amenities as $hamt){
                    ?>
                <div class="go-right"><input type="checkbox" value="<?php echo $hamt->id;?>" <?php if(in_array($hamt->id,$varAmt)){echo "checked";}?> name="amenities[]" id="<?php echo $hamt->name;?>" class="checkbox" /><label for="<?php echo $hamt->name;?>" class="css-label go-left"> <img class="go-right" style="height: 22px;margin-right:5px;margin-left:5px" src="<?php echo $hamt->icon;?>">  <?php echo $hamt->name;?></label></div>
                <div class="clearfix"></div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php } ?>
        <?php if($appModule == "cars"){ ?>
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse5">
        <?php echo trans('0207');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse5" class="collapse in">
            <div class="hpadding20">
                <br>
                <div class="clearfix"></div>
                <select class="selectx" name="pickup">
                    <option value=""> <?php echo trans('0158');?></option>
                    <option value="yes" <?php echo makeSelected($selectedPickup, "yes"); ?>  ><?php echo trans('0363');?></option>
                    <option value="no" <?php echo makeSelected($selectedPickup, "no"); ?> ><?php echo trans('0364');?></option>
                </select>
            </div>
        </div>
        <?php } ?>
        <!-- End of Hotel Amenities -->
        <div class="clearfix"></div>
        <br/>
        <input type="hidden" name="txtSearch" value="<?php echo @$_GET['txtSearch']; ?>">
        <input type="hidden" name="searching" value="<?php echo @$_GET['searching']; ?>"> <input type="hidden" name="modType" value="<?php echo @$_GET['modType']; ?>">
        <button style="border-radius:0px;margin-bottom:0px;" type="submit" class="btn btn-action btn-lg btn-block loader" id="searchform"><?php echo trans('012');?></button>
    </form>
<?php } } ?>
