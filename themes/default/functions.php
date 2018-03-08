<?php
//Wish list global function for all modules
if (!function_exists('wishListInfo')) {
  function wishListInfo($module, $id) {
    $inwishlist = pt_isInWishList($module, $id);
    if ($inwishlist) {
      $html = '<div title="' . trans('028') . '" data-toggle="tooltip" data-placement="left" id="' . $id . '" data-module="' . $module . '" class="wishlist wishlistcheck ' . $module . 'wishtext' . $id . ' fav"><a  class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="' . $module . 'wishsign' . $id . ' fav">-</span></a></div>';
    }
    else {
      $html = '<div  title="' . trans('029') . '" data-toggle="tooltip" data-placement="left" id="' . $id . '" data-module="' . $module . '" class="wishlist wishlistcheck ' . $module . 'wishtext' . $id . '"><a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="' . $module . 'wishsign' . $id . '">+</span></a></div>';
    }
    return $html;
  }
}
//Tours locations part on home page    iconspane-lg icon_set_1_icon-41
if (!function_exists('toursWithLocations')) {
  function toursWithLocations() {
    $appObj = appObj();
    $toursLib = $appObj->load->library('Tours/Tours_lib');
    $totalLocations = 7;
    $locationData = $toursLib->toursByLocations($totalLocations);
    return $locationData;
  }
}
//Show Lazy Loading icon
if (!function_exists('lazy')) {
  function lazy() {
    $appObj = appObj();
    $themeData = (object) $appObj->theme->_data;
    return "src='" . $themeData->theme_url . LOADING_ICON;
  }
}
    //Tours locations part on home page
    if (!function_exists('searchForm')) {
    function searchForm($module = "hotels", $data = NULL) {
    $appObj = appObj();
    $themeData = (object) $appObj->theme->_data;
    //$themeData->checkin = date($themeData->app_settings[0]->date_f,strtotime('+'.CHECKIN_SPAN.' day', time()));
    $themeData->checkinMonth = strtoupper(date("F", convert_to_unix($themeData->checkin)));
    $themeData->checkinDay = date("d", convert_to_unix($themeData->checkin));
    //$themeData->checkout = date($themeData->app_settings[0]->date_f, strtotime('+'.CHECKOUT_SPAN.' day', time()));
    $themeData->checkoutMonth = strtoupper(date("F", convert_to_unix($themeData->checkout)));
    $themeData->checkoutDay = date("d", convert_to_unix($themeData->checkout));
    $themeData->eancheckin = date("m/d/Y", convert_to_unix($themeData->eancheckin, "m/d/Y"));
    $themeData->eancheckout = date("m/d/Y", convert_to_unix($themeData->eancheckout, "m/d/Y"));
    $themeData->eancheckinMonth = strtoupper(date("F", convert_to_unix($themeData->eancheckin, "m/d/Y")));
    $themeData->eancheckinDay = date("d", convert_to_unix($themeData->eancheckin, "m/d/Y"));
    $themeData->eancheckoutMonth = strtoupper(date("F", convert_to_unix($themeData->eancheckout, "m/d/Y")));
    $themeData->eancheckoutDay = date("d", convert_to_unix($themeData->eancheckout, "m/d/Y"));
    $themeData->ctcheckin = date("m/d/Y", strtotime("+1 days"));
    $themeData->ctcheckout = date("m/d/Y", strtotime("+2 days"));
    $tourType = @ $_GET['type'];
    ?>
    <?php $col4 = "col-md-4 form-group go-right col-xs-12"; ?>
    <?php $col3 = "col-md-3 form-group go-right col-xs-12"; ?>
    <?php $col2 = "col-md-2 form-group go-right col-xs-6"; ?>
    <?php $col1 = "col-md-1 form-group go-right col-xs-6 col-sm-6"; ?>
    <?php $guest = "col-md-2 form-group go-right col-xs-12"; ?>

    <?php $button = "col-md-2 col-xs-12"; ?>
    <?php $lazy = "src='" . $theme_url . "assets/img/loader.gif'"; ?>
    <?php  if (pt_main_module_available($module)) { ?>

        <!------------------------------------------------------------------->
        <!-- ******************** CARTRAWLER MODULE  ********************  -->
        <!------------------------------------------------------------------->


    <?php } elseif ($module == "cartrawler") { ?>
    <!-- Start Cartrawler Form -->
    <form action="<?php echo base_url(); ?>car/" method="GET" target="_self">
        <div class="<?php echo $col2; ?>">
            <div class="row">
                <label class="hidden-xs go-right"><?php echo trans('0210'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-41"></i>
                <input required id="ct1" name="startlocation" type="text" class="form input-lg RTL ctlocation" placeholder="<?php echo trans('0210'); ?>" autocomplete="off" required />
                <div id="ct1resp" class="autosuggest col-md-11 col-sm-11"></div>
            </div>
        </div>
        <div class="<?php echo $col2; ?>">
            <div class="row">
                <label class="hidden-xs go-right"><?php echo trans('0211'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-41"></i>
                <input id="ct2" name="endlocation" type="text" class="searchInput form input-lg RTL ctlocation" placeholder="<?php echo trans('0211'); ?>" autocomplete="off" />
                <div id="ct2resp" class="autosuggest col-md-11 col-sm-11"></div>
            </div>
        </div>
        <div class="<?php echo $col2; ?> chkin">
            <div class="row">
                <label class="hidden-xs go-right"><?php echo trans('0210'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
                <input type="text" class="form input-lg checkinsearch RTL icon-calendar dpcd1" name="pickupdate" value="<?php echo $themeData->ctcheckin; ?>" placeholder="<?php echo trans('08'); ?>" required />
            </div>
        </div>
        <div class="<?php echo $col1; ?>">
            <div class="row">
                <label class="hidden-xs go-right"><?php echo trans('0259'); ?></label>
                <div class="clearfix"></div>
                <select style="padding-left:10px;" class="text-center input-lg form selectx" name="timeDepart">
                    <?php foreach ($themeData->timing as $time) { ?>
                    <option value="<?php echo $time; ?>" <?php makeSelected('10:00', $time); ?> ><?php echo $time; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="<?php echo $col2; ?> chkout" style="margin-bottom: -10px">
            <div class="row">
                <label class="hidden-xs go-right"><?php echo trans('0211'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
                <input type="text" class="form input-lg checkinsearch RTL icon-calendar dpcd2" name="dropoffdate" value="<?php echo $ctcheckout; ?>" placeholder="<?php echo trans('08'); ?>" required />
            </div>
        </div>
        <div class="<?php echo $col1; ?>" style="margin-bottom: -10px">
            <div class="row">
                <label class="hidden-xs go-right"><?php echo trans('0259'); ?></label>
                <div class="clearfix"></div>
                <!--<i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>-->
                <select style="padding-left:10px;" class="text-center input-lg form selectx" name="timeReturn">
                    <?php foreach ($themeData->timing as $time) { ?>
                    <option value="<?php echo $time; ?>" <?php makeSelected('10:00', $time); ?> ><?php echo $time; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <input type="hidden" id="pickuplocation" name="pickupLocationId" value="">
        <input type="hidden" id="returnlocation" name="returnLocationId" value="">
        <input type="hidden" name="clientId" value="<?php echo $themeData->cartrawlerid; ?>">
        <input type="hidden" name="residencyId" value="PK">
        <div class="col-md-2 col-xs-12">
            <div class="row">
                <label>&nbsp;</label>
                <div class="clearfix"></div>
                <input type="submit" value="<?php echo trans('012'); ?>" class="btn-danger btn btn-lg btn-block loader">
            </div>
        </div>
    </form>

    <!-- travelport flight form body  -->
    <?php } if ($module == "travelport_flight") {
        $travelportSearchFormData = $data;
        include 'views/integrations/travelport_flight/search_form.php';
    } ?>
    <!--/ .travelport flight form body  -->

        <!------------------------------------------------------------------->
        <!-- ******************** CARTRAWLER MODULE  ********************  -->
        <!------------------------------------------------------------------->





        <!------------------------------------------------------------------->
        <!-- ********************      EAN MODULE    ********************  -->
        <!------------------------------------------------------------------->

            <?php if ($module == "ean") { ?>

            <style> .modal-backdrop { z-index: 9; } </style>
            <script> $(function() { google.maps.event.addDomListener(window,"load",function(){new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"))}); }); var loading = false;//to prevent duplicate
            function loadNewContent(){var moreResultsAvailable=$("#moreResultsAvailable").val();var cacheKey=$("#cacheKey").val();var cacheLocation=$("#cacheLocation").val();var cachePaging=$("#cachePaging").val();var checkin=$(".dpean1").val();var checkout=$(".dpean2").val();var agesappend=$("#agesappendurl").val();var adultsCount=$("#adultsCount").val();$('#loader_new').html("<div id='rotatingDiv'></div>");var url_to_new_content='<?php echo base_url(); ?>ean/loadMore';$.ajax({type:'POST',data:{'moreResultsAvailable':moreResultsAvailable,'cacheKey':cacheKey,'cacheLocation':cacheLocation,'checkin':checkin,'checkout':checkout,'agesappendurl':agesappend,'adultsCount':adultsCount},url:url_to_new_content,success:function(data){if(data!=""&&data!="404"){$('#loader_new').html('');loading=!1;var newData=data.split("###");$("#latest_record_para").html(newData[0]);$("#New_data_load").append(newData[1])}
            else{$('#loader_new').html('');$("#message_noResult").html('')}}})}
            var winTop=$(window).scrollTop();var docHeight=$(document).height();var winHeight=$(window).height();$(window).scroll(function(){var moreResultsAvailable=$("#moreResultsAvailable").val();var foot=$("#footer").offset().top-500;if(moreResultsAvailable!=''&&moreResultsAvailable==1){if($(window).scrollTop()>foot){if(!loading){loading=!0;loadNewContent()}}}})
            </script>
            <script type="text/javascript"> $(function(){ $(".childcount").on("change",function(){ var count = $(this).val(); var ages = []; if(count > 0){ for(i = 1; i <= count; i++){ ages.push('0'); } $("#childages").val(ages); $(".ageselect").empty(); addChildsAgeField(count); $("#ages").modal('show'); }else{ $("#childages").val(""); } }) }); function addChildsAgeField(children) { var childagestxt = ''; for (child = 1; child <= children; child++) { var StringChildAge = ''; StringChildAge = '\ <label for="form-input-popover" class="col-sm-4 control-label">'+child+' Age</label><div class="col-sm-8">\n\ <select class="room-child-age form-control" onchange="updateChildAges();">\n\ <option value="0"> Under 1 </option>\n\ <option value="1">1</option>\n\ <option value="2">2</option>\n\ <option value="3">3</option>\n\ <option value="4">4</option>\n\ <option value="5">5</option>\n\ <option value="6">6</option>\n\ <option value="7">7</option>\n\ <option value="8">8</option>\n\ <option value="9">9</option>\n\ <option value="10">10</option>\n\ <option value="11">11</option>\n\ <option value="12">12</option>\n\ <option value="13">13</option>\n\ <option value="14">14</option>\n\ <option value="15">15</option>\n\ <option value="16">16</option>\n\ <option value="17">17</option>\n\ </select></div>'; $(".ageselect").append(StringChildAge); } } function updateChildAges(){ var selectedAges = []; $('.room-child-age option:selected').each(function () { selectedAges.push($(this).val()); }); $("#childages").val(selectedAges); } </script>

            <form autocomplete="off" action="<?php echo base_url(); ?>properties/search" method="GET" role="search">


            <div class="col-md-12 col-xs-12 go-text-right form-group">
                                <div class="row">
                                    <label class="go-right"><?php echo trans('0254'); ?></label>
                                    <div class="clearfix"></div>
                                    <i class="iconspane-lg icon_set_1_icon-41"></i>
    <input required id="citiesInput" name="city" type="text" class="form input-lg RTL" placeholder="<?php echo trans('026'); ?>" value="<?php echo @ $_GET['city']; ?>" required />
                                        <input type="hidden" id="txtsearch" name="txtSearch" value="<?php echo $_GET['txtSearch']; ?>">
                                </div>
                        </div>




            <div class="row">

        <div class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput" id="<?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>">
                <label class="go-right"><?php echo trans('07');?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-53"></i>
                <input type="text" placeholder="<?php echo trans('07'); ?>" name="<?php if ($module == 'hotels' || $module == 'ean') { echo 'checkin'; } elseif ($module == 'tours') { echo 'date'; } ?>" class="form input-lg <?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>" value="<?php if ($module == 'ean') { echo $themeData->eancheckin; } else { echo $themeData->checkin; } ?>" required >
            </div>
        <div id="dpd2" class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
                <label class="go-right"><?php echo trans('09');?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-53"></i>
                <input type="text" placeholder="<?php echo trans('09'); ?>" name="checkout" class="form input-lg <?php if ($module == 'hotels') { echo 'dpd2'; } elseif ($module == 'ean') { echo 'dpean2'; } ?>" value="<?php if ($module == 'ean') { echo $themeData->eancheckout; } else { echo $themeData->checkout; } ?>" required >
        </div>

        <div class="col-md-6 form-group go-right col-xs-12">
                                <label class="go-right"><?php echo trans('010'); ?></label>
                                <div class="clearfix"></div>
                                 <i class="iconspane-lg icon_set_1_icon-70"></i>
                                <div class="clearfix"></div>
                                <select name="adults" id="adults" class="form input-lg">
                                        <option>0</option>
                                        <option>1</option>
                                        <option selected>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                </select>
                </div>

        <div class="col-md-6 form-group go-right col-xs-12">
                                <label class="go-right"><?php echo trans('011'); ?></label>
                                <div class="clearfix"></div>
                                 <i class="iconspane-lg icon_set_1_icon-70"></i>
                                <?php if ($module == "hotels") { ?>
                                <div class="clearfix"></div>
                                <select name="child" id="child" class="form input-lg">
                                        <option selected>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                </select>

                        <?php } else { ?>
                            <div class="clearfix"></div>
                                <select class="form input-lg childcount" placeholder="<?php echo trans('011'); ?>" name="child" id="child">
                                <?php for ($i = 0; $i <= 4; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php makeSelected($themeData->child, $i); ?> > <?php echo $i; ?></option>
                                <?php } } ?>
                        </select>
                </div>

        <div class="bgfade col-md-12 col-xs-12">
                <div class="clearfix"></div>
                <button type="submit"  class="btn-danger btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?></button>
        </div>
        </div>

            <!-- Start Modal child ages -->
            <div style="color:black;margin-top:150px" class="modal fade" id="ages" tabindex="1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm" style="z-index: 9999;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo trans('011'); ?></h4>
                        </div>
                        <div class="modal-body">
                         <div class="form-horizontal ageselect"></div>
                        </div>
                        <div class="clearfix"></div>
                        <br><br>
                        <div class="clearfix"></div>
                        <div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo trans('0233'); ?></button> </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ages" tabindex="1" role="dialog" aria-hidden="true" style="margin-top:-70px">
                <div class="modal-dialog modal-sm" style="z-index: 9999;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo trans('011'); ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-horizontal ageselect"> </div>
                        </div>
                        <div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo trans('0233'); ?></button> </div>
                    </div>
                </div>
            </div>



        <input type="hidden" name="childages" id="childages" value="<?php echo $themeData->childages; ?>">
        <input type="hidden" name="search" value="search" >
        </form>
    <?php } ?>

        <!------------------------------------------------------------------->
        <!-- ********************      EAN MODULE    ********************  -->
        <!------------------------------------------------------------------->


        <!------------------------------------------------------------------->
        <!-- ********************   HOTELS MODULE    ********************  -->

        <?php if ($module == "hotels") { ?>
        <form autocomplete="off" action="<?php echo base_url() . $module; ?>/search" method="GET" role="search">
            <div class="col-md-12 col-xs-12 go-text-right form-group">
                <div class="row">
                    <label class="go-right"><?php echo trans('0254'); ?></label>
                    <div class="clearfix"></div>
                    <i class="iconspane-lg icon_set_1_icon-41"></i>
                    <input type="text" data-module="<?php echo $module; ?>" class="hotelsearch locationlist<?php echo $module; ?>" placeholder="<?php if ($module == 'hotels') { echo trans('026'); } elseif ($module == 'tours') { echo trans('0526'); } ?>" value="<?php echo $_GET['txtSearch']; ?>">
                    <input type="hidden" id="txtsearch" name="txtSearch" value="<?php echo $_GET['txtSearch']; ?>">
                </div>
            </div>

            <div class="row">
                <div class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput" id="<?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>">
                    <label class="go-right"><?php echo trans('07');?></label>
                    <div class="clearfix"></div>
                    <i class="iconspane-lg icon_set_1_icon-53"></i>
                    <input type="text" placeholder="<?php echo trans('07'); ?>" name="<?php if ($module == 'hotels' || $module == 'ean') { echo 'checkin'; } elseif ($module == 'tours') { echo 'date'; } ?>" class="form input-lg <?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>" value="<?php if ($module == 'ean') { echo $themeData->eancheckin; } else { echo $themeData->checkin; } ?>" required >
                </div>
                <div id="dpd2" class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
                    <label class="go-right"><?php echo trans('09');?></label>
                    <div class="clearfix"></div>
                    <i class="iconspane-lg icon_set_1_icon-53"></i>
                    <input type="text" placeholder="<?php echo trans('09'); ?>" name="checkout" class="form input-lg <?php if ($module == 'hotels') { echo 'dpd2'; } elseif ($module == 'ean') { echo 'dpean2'; } ?>" value="<?php if ($module == 'ean') { echo $themeData->eancheckout; } else { echo $themeData->checkout; } ?>" required >
                </div>
                </div>
            <div class="row">
                <div class="bgfade col-md-6 form-group go-right col-xs-6">
                    <label class="go-right"><?php echo trans('010');?></label>
                    <div class="clearfix"></div>
                    <select name="adults" id="adults" class="input-lg form selectx">
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                </div>
                <div class="bgfade col-md-6 form-group go-right col-xs-6">
                    <label class="go-right"><?php echo trans('011');?></label>
                    <div class="clearfix"></div>
                    <select name="child" id="child" class="input-lg form selectx">
                    <option value="0" selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                </div>

                <div class="bgfade col-md-12 form-group go-right col-xs-12">
                    <div class="clearfix"></div>
                    <input type="hidden" name="searching" class="searching" value="<?php echo $_GET['searching']; ?>">
                    <input type="hidden" class="modType" name="modType" value="<?php echo $_GET['modType']; ?>">
                    <button type="submit"  class="btn-danger btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?></button>
                </div>
            </div>

        </form>

        <script>
            $(function(){
                var adults = parseInt($("[name='adults']").val()); // Should be 1
                var child = parseInt($("[name='child']").val());
                var infant = parseInt($("[name='infant']").val());
                var totalPassenger = (adults + child + infant);

                $(".locationlist<?php echo $module; ?>").select2({
                    minimumInputLength: 3,
                    width: '100%',
                    maximumSelectionSize: 1,
                    initSelection: function(element,callback){
                        var elementText = $(element).val();
                        callback({"text": elementText, "id": elementText});
                    },
                    ajax:{
                        url: "<?php echo base_url(); ?>home/suggestions/<?php echo $module; ?>",
                        dataType: 'json',
                        data: function(term, page) {
                            return { q:term }
                        },
                        results:function(data, page) {
                            return { results: data }
                        }
                    }
                });

                $(".locationlist<?php echo $module; ?>").on("select2-selecting",function(e){
                    $(".modType").val(e.object.module);
                    $(".searching").val(e.object.id);
                    $("#txtsearch").val(e.object.text);
                });

                $("[name='adults']").on('change', function() { adults = parseInt($(this).val()); });
                $("[name='child']").on('change', function() { child = parseInt($(this).val()); });
                $("[name='infant']").on('change', function() { infant = parseInt($(this).val()); });
                $("#sumPassenger").on('click', function() {
                    totalPassenger = (adults + child + infant);
                    $("[name='travellers']").val(totalPassenger);
                });
            });
        </script>
        <?php } ?>
        <!------------------------------------------------------------------->
        <!-- ********************   HOTELS MODULE    ********************  -->
        <!------------------------------------------------------------------->


        <!------------------------------------------------------------------->
        <!-- ********************   FLIGHTS MODULE   ********************  -->
        <!------------------------------------------------------------------->
       <?php if ($module == "flights") { ?>

        <!-- <form action="%3C?php%20echo%20base_url()%20.%20$module;%20?%3E/search" autocomplete="off" method="get" role="search">
        <div class="trip-check">
            <div class="col-md-2 col-xs-4">
                <div class="pure-checkbox">
                    <input checked class="checkbox flightradio" data-type="round" id="checkbox1" name="stars" type="radio" value="1"> <label for="checkbox1">Round Trip</label>
                </div>
            </div>
            <div class="col-md-2 col-xs-4">
                <div class="pure-checkbox">
                    <input class="checkbox flightradio" data-type="oneway" id="checkbox2" name="stars" type="radio" value="2"> <label for="checkbox2">One Way</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="go-text-right">
                <div class="col-md-6 form-group go-right col-xs-12">
                    <label class="go-right"><?php echo trans('0119'); ?></label>
                    <div class="clearfix"></div><i class="iconspane-lg icon_set_1_icon-41"></i> <input class="hotelsearch locationlist&lt;?php echo $module; ?&gt;" data-module="<?php echo $module; ?>" placeholder="<?php if ($module == 'hotels') { echo trans('026'); } elseif ($module == 'tours') { echo trans('0526'); } ?>" type="text" value="<?php echo $_GET['txtSearch']; ?>"> <input id="txtsearch" name="txtSearch" type="hidden" value="<?php echo $_GET['txtSearch']; ?>">
                </div>
            </div>
            <div class="go-text-right">
                <div class="col-md-6 form-group go-right col-xs-12">
                    <label class="go-right"><?php echo trans('0120'); ?></label>
                    <div class="clearfix"></div><i class="iconspane-lg icon_set_1_icon-41"></i> <input class="hotelsearch locationlist&lt;?php echo $module; ?&gt;" data-module="<?php echo $module; ?>" placeholder="<?php if ($module == 'hotels') { echo trans('026'); } elseif ($module == 'tours') { echo trans('0526'); } ?>" type="text" value="<?php echo $_GET['txtSearch']; ?>"> <input id="txtsearch" name="txtSearch" type="hidden" value="<?php echo $_GET['txtSearch']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="bgfade col-md-3 form-group go-right col-xs-6 focusDateInput" id="<?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>">
                <label class="go-right"><?php echo trans('0472');?></label>
                <div class="clearfix"></div><i class="iconspane-lg icon_set_1_icon-53"></i> <input class="form input-lg &lt;?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?&gt;" name="<?php if ($module == 'hotels' || $module == 'ean') { echo 'checkin'; } elseif ($module == 'tours') { echo 'date'; } ?>" placeholder="<?php echo trans('0472'); ?>" required="" type="text" value="<?php if ($module == 'ean') { echo $themeData->eancheckin; } else { echo $themeData->checkin; } ?>">
            </div>
            <div class="bgfade col-md-3 form-group go-right col-xs-6 focusDateInput" id="dpd2">
                <label class="go-right"><?php echo trans('0473');?></label>
                <div class="clearfix"></div><i class="iconspane-lg icon_set_1_icon-53"></i> <input class="form input-lg &lt;?php if ($module == 'hotels') { echo 'dpd2'; } elseif ($module == 'ean') { echo 'dpean2'; } ?&gt;" name="checkout" placeholder="<?php echo trans('0473'); ?>" required="" type="text" value="<?php if ($module == 'ean') { echo $themeData->eancheckout; } else { echo $themeData->checkout; } ?>">
            </div>
            <div class="<?php echo $guest; ?>">
                <label class="go-right"><?php echo trans('0446');?></label>
                <div class="clearfix"></div><i class="iconspane-lg icon_set_1_icon-70"></i> <input class="form input-lg" data-target="#travellers" data-toggle="modal" name="checkout" placeholder="0" required="" type="text" value="2">
            </div>
            <div class="bgfade col-md-4 col-xs-12">
                <label class="lab hidden-xs hidden-sm">&nbsp;</label>
                <div class="clearfix"></div><button class="btn-danger btn btn-lg btn-block pfb0" type="submit"><i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?></button>
            </div>
        </div>
        <div class="clearfix"></div>
    </form>

        <script>
        $(function(){$(".locationlist<?php echo $module; ?>").select2({placeholder:"<?php if (empty($_GET['txtSearch'])) { echo "Enter Location"; } else { echo @ $_GET['txtSearch']; } ?>",minimumInputLength:3,width:'100%',maximumSelectionSize:1,initSelection:function(element,callback){var data={id:"1",text:"<?php echo @ $_GET['txtSearch']; ?>"};callback(data)},ajax:{url:"<?php echo base_url(); ?>home/suggestions/<?php echo $module; ?>",dataType:'json',data:function(term,page){return{q:term,}},results:function(data,page){return{results:data}}}});$(".locationlist<?php echo $module; ?>").on("select2-open",
        function(e){$(".select2-drop-mask").css("background-color","rgba(0,0,0,0.5)");$("#select2-drop-mask").css("opacity","1");$(".select2-drop-mask").css("z-index","1");$(".formSection").trigger("click")});$
        (".locationlist<?php echo $module; ?>").on("select2-selecting",function(e){$(".modType").val(e.object.module);$(".searching").val(e.object.id);$("#txtsearch").val(e.object.text);console.log(e.object)})})
        </script>
           -->
       <?php } ?>
        <!------------------------------------------------------------------->
        <!-- ********************   FLIGHTS MODULE   ********************  -->
        <!------------------------------------------------------------------->

  <?php if ($module=="cars" ) { ?>
        <!------------------------------------------------------------------->
        <!-- ********************     CARS MODULE    ********************  -->
        <!------------------------------------------------------------------->


<form autocomplete="off" action="<?php echo base_url() . $module; ?>/search" method="GET" role="search">
    <div class="row">
        <div class="col-md-6 form-group go-right col-xs-12 xxl">
                <label class="go-right"><?php echo trans('0210'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-21"></i>
            <select name="pickupLocation" class="carsearch chosen-select RTL" id="carlocations" required>
                <option>
                    <?php echo trans( '0210'); ?>
                    <?php echo trans( '032'); ?> </option>
                <?php foreach ($themeData->carspickuplocationsList as $locations) : ?>
                <option value="<?php echo $locations->id; ?>" <?php makeSelected($themeData->selectedpickupLocation, $locations->id); ?> >
                    <?php echo $locations->name; ?></option>
                <?php endforeach; ?> </select>
        </div>
        <div class="col-md-6 form-group go-right col-xs-12 xxl">
                <label class="go-right"><?php echo trans('0211'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-21"></i>
            <select name="dropoffLocation" class="carsearch chosen-select RTL" id="carlocations2" required>
                <option>
                    <?php echo trans( '0211'); ?>
                    <?php echo trans( '032'); ?> </option>
                <?php foreach ($themeData->carsdropofflocationsList as $locations) : ?>
                <option value="<?php echo $locations->id; ?>" <?php makeSelected($themeData->selecteddropoffLocation, $locations->id); ?> >
                    <?php echo $locations->name; ?></option>
                <?php endforeach; ?> </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group go-right col-xs-6 chkin chkin">
            <label class="go-right">
                <?php echo trans( '0210'); ?>
                <?php echo trans( '08'); ?> </label>
            <div class="clearfix"></div> <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" class="form input-lg RTL" id="departcar" name="pickupDate" placeholder="<?php echo trans('08'); ?>" value="<?php echo $themeData->checkin; ?>" required> </div>
        <div class="col-md-6 form-group go-right col-xs-6 chkin">
            <label class="go-right">
                <?php echo trans( '0259'); ?> </label>
            <div class="clearfix"></div>
            <select style="padding-left:10px;" class="text-center input-lg form selectx car_tab" name="pickupTime">
                <?php foreach ($themeData->carModTiming as $time) { ?>
                <option value="<?php echo $time; ?>" <?php makeSelected($themeData->pickupTime, $time); ?> >
                    <?php echo $time; ?> </option>
                <?php } ?> </select>
        </div>

        <div class="col-md-6 form-group go-right col-xs-6 chkin chkout">
            <label class="go-right">
                <?php echo trans( '0211'); ?>
                <?php echo trans( '08'); ?> </label>
            <div class="clearfix"></div> <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" class="form input-lg RTL" id="returncar" name="dropoffDate" placeholder="<?php echo trans('08'); ?>" value="<?php echo $themeData->checkout; ?>" required> </div>
        <div class="col-md-6 form-group go-right col-xs-6 chkin">
            <label class="go-right">
                <?php echo trans( '0259'); ?> </label>
            <div class="clearfix"></div>
            <select style="padding-left:10px;" class="text-center input-lg form selectx car_tab" name="dropoffTime">
                <?php foreach ($themeData->carModTiming as $time) { ?>
                <option value="<?php echo $time; ?>" <?php makeSelected($themeData->dropoffTime, $time); ?> >
                    <?php echo $time; ?> </option>
                <?php } ?> </select>
        </div>
        <div class="col-md-12">
            <label class="lab hidden-xs hidden-sm">&nbsp;</label>
            <div class="clearfix"></div>
            <button type="submit" class="btn-danger btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i>
                <?php echo trans( '012'); ?> </button>
        </div>
    </div>
</form>


        <!------------------------------------------------------------------->
        <!-- ********************     CARS MODULE    ********************  -->
        <!------------------------------------------------------------------->
<?php } ?>


        <?php if ($module=="tours" ) { ?>
<!------------------------------------------------------------------->
<!-- ********************    TOURS MODULE    ********************  -->
<!------------------------------------------------------------------->
<form autocomplete="off" action="<?php echo base_url() . $module; ?>/search" method="GET" role="search">
    <div class="row">
        <div class="go-text-right">
            <!-- Start Autosuggest textbox for hotels/tours -->
            <div class="col-md-12 form-group go-right col-xs-12">
                <label class="go-right">
                    <?php echo trans( '0254'); ?> </label>
                <div class="clearfix"></div> <i class="iconspane-lg icon_set_1_icon-41"></i>
                <input type="text" data-module="<?php echo $module; ?>" class="hotelsearch locationlist<?php echo $module; ?>" placeholder="<?php if ($module == 'hotels') { echo trans('026'); } elseif ($module == 'tours') { echo trans('0526'); } ?>" value="<?php echo $_GET['txtSearch']; ?>">
                <input type="hidden" id="txtsearch" name="txtSearch" value="<?php echo $_GET['txtSearch']; ?>"> </div>
            <!-- End Autosuggest textbox for hotels/tours -->
        </div>
    </div>
    <div class="row">
        <div id="<?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>" class="col-md-6 form-group go-right col-xs-12 focusDateInput">
            <label class="go-right">
                <?php echo trans( '07');?> </label>
            <div class="clearfix"></div> <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('07'); ?>" name="<?php if ($module == 'hotels' || $module == 'ean') { echo 'checkin'; } elseif ($module == 'tours') { echo 'date'; } ?>" class="form input-lg <?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>" value="<?php if ($module == 'ean') { echo $themeData->eancheckin; } else { echo $themeData->checkin; } ?>" required>
        </div>
        <div class="col-md-6 form-group go-right col-xs-12">
            <label class="go-right">
                <?php echo trans( '0446'); ?> </label>
            <div class="clearfix"></div>
            <select name="adults" id="adults" class="input-lg form selectx">
                <option>0</option>
                <option>1</option>
                <option selected>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="col-md-12 form-group go-right col-xs-12">
            <label class="hidden-xs go-right">
                <?php echo trans( '0222'); ?> </label>
            <div class="clearfix"></div> <i class="iconspane-lg icon_set_1_icon-8"></i>
            <select class="chosen-select" name="type" id="tourtype">
                <option value="">
                    <?php echo trans( '0158'); ?> </option>
                <?php foreach ($themeData->moduleTypes as $ttype) { ?>
                <option value="<?php echo $ttype->id; ?>" <?php makeSelected($tourType, $ttype->id); ?> >
                    <?php echo $ttype->name; ?> </option>
                <?php } ?> </select>
        </div>
        <div class="col-md-12 form-group go-right col-xs-12">
            <div class="clearfix"></div>
            <button type="submit" class="btn-danger btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i>
                <?php echo trans( '012'); ?> </button>
        </div>
    </div>
    <input type="hidden" name="searching" class="searching" value="<?php echo $_GET['searching']; ?>">
    <input type="hidden" class="modType" name="modType" value="<?php echo $_GET['modType']; ?>">
        <script>
        $(function(){$(".locationlist<?php echo $module; ?>").select2({placeholder:"<?php if (empty($_GET['txtSearch'])) { echo "Enter Location"; } else { echo @ $_GET['txtSearch']; } ?>",minimumInputLength:3,width:'100%',maximumSelectionSize:1,initSelection:function(element,callback){var data={id:"1",text:"<?php echo @ $_GET['txtSearch']; ?>"};callback(data)},ajax:{url:"<?php echo base_url(); ?>home/suggestions/<?php echo $module; ?>",dataType:'json',data:function(term,page){return{q:term,}},results:function(data,page){return{results:data}}}});$(".locationlist<?php echo $module; ?>").on("select2-open",
        function(e){$(".select2-drop-mask");$(".formSection").trigger("click")});
        $(".locationlist<?php echo $module; ?>").on("select2-selecting",function(e){$(".modType").val(e.object.module);$(".searching").val(e.object.id);$("#txtsearch").val(e.object.text);console.log(e.object)})})
        </script>
        </form>
        <!------------------------------------------------------------------->
        <!-- ********************    TOURS MODULE    ********************  -->
        <!------------------------------------------------------------------->
        <?php } if ($module == "ivisa") { ?>
        <!------------------------------------------------------------------->
        <!-- ********************     VISA MODULE    ********************  -->
        <!------------------------------------------------------------------->
        <form autocomplete="off" action="<?php echo base_url(); ?>visa" method="GET" role="search">

    <div class="row">
        <div class="go-text-right">
            <div class="col-md-12 form-group go-right col-xs-12">
                <label class="go-right">
                    <?php echo trans( '0273'); ?>
                    <?php echo trans( '0105'); ?>
                </label>
                <div class="clearfix"></div> <i class="iconspane-lg icon_set_1_icon-41"></i>
                <select name="nationality_country" id="" class="chosen-select" required>
                    <option value="">
                        <?php echo trans( '0158'); ?>
                        <?php echo trans( '0105'); ?>
                    </option>
                    <?php foreach($themeData->allcountries as $c){ ?>
                    <option value="<?php echo $c->iso2;?>">
                        <?php echo $c->short_name;?></option>
                    <?php } ?> </select>
            </div>
        </div>
        <div class="go-text-right">
            <div class="col-md-12 form-group go-right col-xs-12">
                <label class="go-right">
                    <?php echo trans( '0274'); ?>
                    <?php echo trans( '0105'); ?>
                </label>
                <div class="clearfix"></div> <i class="iconspane-lg icon_set_1_icon-41"></i>
                <select name="destination_country" id="" class="chosen-select" required>
                    <option value="">
                        <?php echo trans( '0158'); ?>
                        <?php echo trans( '0105'); ?>
                    </option>
                    <?php foreach($themeData->allcountries as $c){ ?>
                    <option value="<?php echo $c->iso2;?>">
                        <?php echo $c->short_name;?></option>
                    <?php } ?> </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group go-right col-xs-12">
            <div class="clearfix"></div>
            <button type="submit" class="btn-danger btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i>
                <?php echo trans( '012'); ?>
            </button>
        </div>
    </div>
</form>
        <!------------------------------------------------------------------->
        <!-- ********************     VISA MODULE    ********************  -->
        <!------------------------------------------------------------------->
        <?php } } } ?>
