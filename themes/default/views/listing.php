
<style>
  .summary  { border-right: solid 2px rgb(0, 93, 247); color: #ffffff; background: #4285f4; padding: 14px; float: left; font-size: 14px; }
  .sideline { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; display: table-cell; border-left: solid 1px #e7e7e7; }
  .localarea { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; }
  .captext  { display: block; font-size: 14px; font-weight: 400; color: #23527c; line-height: 1.2em; text-transform: capitalize; }
  .ellipsis { max-width: 250px; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; }
  .noResults { right: 30px; top: 26px; color: #008cff; font-size: 16px; }
  .table { margin-bottom: 5px; }
</style>
<?php if($ismobile): ?>
<div class="modal <?php if($isRTL == "RTL"){ ?> right <?php } else { ?> left <?php } ?> fade" id="sidebar_filter" tabindex="1" role="dialog" aria-labelledby="sidebar_filter">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close go-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="close icon-angle-<?php if($isRTL == "RTL"){ ?>right<?php } else { ?>left<?php } ?>"></i></span></button>
        <h4 class="modal-title go-text-right" id="sidebar_filter"><i class="icon_set_1_icon-65 go-right"></i> <?php echo trans('0191');?></h4>
      </div>
      <?php require $themeurl.'views/includes/filter.php';?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php
if($appModule == "hotels");
if($appModule == "tours");
if($appModule == "cars");
{?>
<div class="header-mob">
  <div class="container">
    <div class="row">
      <div class="col-xs-2 text-leftt">
        <a data-toggle="tooltip" data-placement="right" title="<?php echo trans('0533');?>" class="icon-angle-left pull-left mob-back" onclick="goBack()"></a>
      </div>
      <div class="col-xs-7 p5">
        <div class="mob-trip-info-head ttu">
        <?php if(isset($searchText) && ! empty($searchText)): ?>
          <span><?php echo $searchText; ?></span>
          <div><?php echo $checkin; ?>  -  <?php echo $checkout; ?></div>
        <?php endif; ?>

        <?php if($appModule == 'cars' && ! empty($pickupLocationName)): ?>
          <span><?php echo $pickupLocationName .' - '. $dropoffLocationName; ?></span>
          <div><?php echo sprintf('%s %s', $pickupDate, $pickupTime); ?>  -  <?php echo sprintf('%s %s', $dropoffDate, $dropoffTime); ?></div>
        <?php endif; ?>
        </div>
      </div>
      <?php if($appModule != "offers"){ ?>
      <div class="col-xs-2 text-center pull-right visible-xs">
        <a class="ttu" data-toggle="modal" data-target="#sidebar_filter">
        <i class="icon-filter mob-filter"></i>
        <span class="cw"><?php echo trans('0217');?></span>
        </a>
      </div>
      <div class="col-xs-1 text-center pull-right hidden-xs ttu">
        <div class="row">
          <a class="btn btn-primary btn-xs btn-block" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">
          <i class="icon-location-7 mob-filter"></i>
          <span><?php echo trans('067');?></span>
          </a>
        </div>
      </div>
      <div class="col-xs-1 text-center pull-right hidden-xs ttu opl20pdr20">
        <div class="row">
          <a class="btn btn-success btn-xs btn-block" data-toggle="collapse" data-target="#modify" aria-expanded="false" aria-controls="modify">
          <i class="icon-filter mob-filter"></i>
          <span><?php echo trans('0106');?></span>
          </a>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>
<div class="mob-alert-msg go-text-right">
  <div class="container">
    <div class="row">
      <div class="col-md-6 fs12">
        <i class="icon-info-circled-alt go-right"></i>
        <span><?php echo trans('0534');?></span>
        </div>
        <?php if($appModule != "ean"){ ?>
        <div class="col-md-6 text-right hidden-xs">
        <strong class="go-text-right"><?php echo $info['totalrows']; ?></strong>
        <span  class="go-text-left"><?php echo trans('0535');?></span>
        </div>
       <?php } ?>
    </div>
  </div>
</div>
<div class="collapse listing-search-BG" id="modify">
  <div class="container">
    <div class="panel-body">
      <?php echo searchForm($appModule); ?>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<!--<div class="container">
  <?php if($appModule != "offers"){ ?>
  <div class="row listing-search">

  <div class="col-md-1 col-sm-2 col-xs-4 summary go-right">
   <small><?php echo trans('0379');?></small>
   <?php echo trans('039');?>
   </div>

    <?php if($appModule == "cars"){ ?>
    <div class="col-md-3 col-sm-10 col-xs-8 localarea go-right">
   <small class=" go-right"><?php echo trans('0210');?></small><div class="clearfix"></div>
   <span class="captext ellipsis go-right"><?php if(!empty($pickupLocationName)){ echo $pickupLocationName; }else{ ?> <span data-toggle="modal" data-target="#modify" style="cursor: pointer"> <?php echo trans('0447'); ?> </span> <?php } ?></span>
   </div>

   <div class="col-md-3 col-sm-10 col-xs-8 sideline localarea go-right">
   <small class=" go-right"><?php echo trans('0211');?></small><div class="clearfix"></div>
   <span class="captext ellipsis go-right"><?php if(!empty($dropoffLocationName)){ echo $dropoffLocationName; }else{ ?> <span data-toggle="modal" data-target="#modify" style="cursor: pointer">  <?php echo trans('0447'); ?> </span> <?php } ?></span>
   </div>

   <div class="visible-sm"><div class="clearfix"></div></div>
   <div class="visible-xs"><div class="clearfix"></div></div>

   <div class="col-md-2 col-sm-2 col-xs-4 sideline go-right">
   <small class="go-right"><?php echo trans('0210');?> <?php echo trans('08');?></small><div class="clearfix"></div>
   <span class="captext go-right"><?php echo @$checkin; ?></span>
   </div>

   <div class="col-md-2 col-sm-2 col-xs-4 sideline go-right">
   <small class="go-right"><?php echo trans('0211');?> <?php echo trans('08');?></small><div class="clearfix"></div>
   <span class="captext go-right"><?php echo @$checkout; ?></span>
   </div>

    <?php }else{ ?>
   <div class="col-md-<?php if($appModule == "tours"){ echo '6'; }else{ echo '3'; }?> col-sm-10 col-xs-8 localarea go-right">
   <small class=" go-right"><?php echo trans('0254');?></small><div class="clearfix"></div>
   <span class="captext ellipsis go-right"><?php if(!empty($searchText)){ echo @$searchText; }else{ ?><span data-toggle="modal" data-target="#modify" style="cursor: pointer">  <?php echo trans('0447'); ?> </span><?php } ?></span>
   </div>

   <div class="visible-sm"><div class="clearfix"></div></div>
   <div class="visible-xs"><div class="clearfix"></div></div>

   <div class="col-md-2 col-sm-2 col-xs-4 sideline go-right">
   <small class="go-right"><?php echo trans('07');?></small><div class="clearfix"></div>
   <span class="captext go-right"><?php echo @$checkin; ?></span>
   </div>
    <?php if(!empty($checkout)){ ?>
   <div class="col-md-2 col-sm-2 col-xs-4 sideline go-right">
   <small class="go-right"><?php echo trans('09');?></small><div class="clearfix"></div>
   <span class="captext go-right"><?php echo @$checkout; ?></span>
   </div>
   <?php } ?>

    <?php if(!empty($totalStay)){ ?>
   <div class="col-md-2 col-sm-2 col-xs-4 sideline hidden-md go-right">
   <small class="go-right"><?php echo trans('060');?></small><div class="clearfix"></div>
   <span class="captext go-right"><?php echo $totalStay; ?> <?php echo trans('0122'); ?></span>
   </div>
   <?php } ?>

   <div class="visible-xs"><div class="clearfix"></div></div>

   <div class="col-md-1 col-sm-2 col-xs-4 sideline go-right">
   <small class="go-right"><?php echo trans('010');?></small><div class="clearfix"></div>
   <span class="captext go-right"><?php echo $adults;?></span>
   </div>

   <div class="col-md-1 col-sm-2 col-xs-4 sideline go-right">
   <small class="go-right"><?php echo trans('011');?></small><div class="clearfix"></div>
   <span class="captext go-right"><?php echo (int)$child; ?></span>
   </div>

   <?php } ?>

   <div class="clearfix"></div>
   </div>

  <?php } ?>
   </div>-->
<!-- CONTENT -->
<div style="margin-top:-15px" class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
  <br>
</div>
<div class="container offset-0">

  <div class="clearfix"></div>
  <?php if(!$ismobile): ?>
  <div class="col-md-3 hidden-sm hidden-xs" style="background: #f2f2f2;padding-bottom:15px"><?php require $themeurl.'views/includes/filter.php';?></div>
  <?php endif; ?>
  <div class="col-md-9 col-xs-12">

   <?php if($appModule != "ean" && $appModule != "hotels" && $appModule != "tours" && $appModule != "cars"){ ?>
   <?php if($appModule == "offers"); {?>
   <?php foreach($module as $item){ ?>
    <div class="col-md-6 owl-item go-right" style="margin-bottom: 25px;">
          <a href="<?php echo $item->slug;?>">
           <div class="imgLodBg loader">
            <div class="load"></div>
            <img style="width:100%" data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $item->thumbnail;?>">
            </div>
               </a>
                <h4 class="ellipsis bold mb0 go-right RTL"><?php echo character_limiter($item->title,20);?></h4>
                <div class="clearfix"></div>
                <p class="tr RTL">
                 <?php echo character_limiter($item->desc,100);?> &nbsp;
                </p>
                <a class="btn btn-primary go-right loader" href="<?php echo $item->slug;?>">
                <?php echo trans( '0286');?>
                </a>
                <?php  if($item->price > 0){ ?>
                <div class="text-success fs18 text-left go-text-right go-right" style="position: absolute; top: 120px; color: white; padding: 10px; background: #e94b28;">
                  <b>
                  <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                  </b>
                </div>
               <?php } ?>
             </div>
         <?php } ?>
      <?php } ?>
     <?php } ?>

    <div class="itemscontainer">
      <?php if(!empty($module)){ ?>
      <table class="bgwhite table table-striped">
          <?php if($appModule != "offers"){ ?>
        <?php foreach($module as $item){ ?>
        <tr>
          <td class="wow fadeIn p-10-0">
            <div class="col-md-4 col-xs-5 go-right rtl_pic">
              <!-- Add to whishlist -->
              <?php if($appModule != "ean" && $appModule != "offers"){ ?>
              <span class="hidden-xs"><?php echo wishListInfo($appModule, $item->id); ?></span>
              <?php } ?>
              <!-- Add to whishlist -->
              <div class="img_list">
                <a href="<?php echo $item->slug;?>">
                  <img <?php echo lazy(); ?> class="center-block loader" data-lazy="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
                  <div class="short_info"></div>
                </a>
              </div>
            </div>
            <div class="col-md-8 col-xs-7 g0-left">
              <div class="row">
                <h4 class="RTL go-text-right mt0 list_title">
                  <a href="<?php echo $item->slug;?>"><b><?php echo character_limiter($item->title,20);?>
                  </b></a>
                  <!-- Cars airport pickup -->  <?php if($appModule == "cars"){ if($item->airportPickup == "yes"){ ?> <button class="btn btn-success btn-xs"><i class="icon-paper-plane-2"></i> <?php echo trans('0207');?></button> <?php } } ?> <!-- Cars airport pickup -->
                </h4>
                <?php if($appModule != "offers"){ ?> <a class="go-right ellipsisFIX go-text-right mob-fs14" href="javascript:void(0);" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/<?php echo $appModule; ?>/<?php echo $item->id;?>','modal');" title="<?php echo $item->location;?>"><i style="margin-left: -3px;" class="mob-fs14 icon-location-6 go-right"></i><?php echo character_limiter($item->location,10);?></a> <span class="go-right mob-fs10"><?php echo $item->stars;?></span> <?php } ?>
                <?php if(!empty($item->avgReviews->imgUrl)){ ?> <img style="margin: 7px 0px 0px 0px;" class="img-responsive" src="<?php echo $item->avgReviews->imgUrl;?>" /> <?php } ?>
                <p style="margin: 7px 0px 7px 0px;" class="grey RTL fs12 hidden-xs"><?php echo character_limiter($item->desc,150);?></p>
                <?php if($appModule == "hotels"){ ?>
                <ul class="hotelpreferences go-right hidden-xs">
                  <?php $cnt = 0; foreach($item->amenities as $amt){ $cnt++; if($cnt <= 10){ if(!empty($amt->name)){ ?>
                  <img title="<?php echo $amt->name;?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt->icon;?>" alt="<?php echo $amt->name;?>" />
                  <?php } } } ?>
                </ul>
                <?php } if($appModule == "tours"){ ?>
                <div class="add_info hidden-sm hidden-xs go-right RTL">
                  <strong><?php echo trans('0222');?></strong> : <a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo character_limiter($item->tourType,5); ?>"><?php echo character_limiter($item->tourType,5); ?></a>
                  &nbsp;<strong><?php echo trans('0275');?></strong> : <a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo $item->tourDays;?>"><?php echo $item->tourDays;?></a>
                  &nbsp;<strong><?php echo trans('0276');?></strong> : <a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo $item->tourNights;?>"><?php echo $item->tourNights;?></a>
                </div>
                <?php } if($appModule == "cars"){ ?>
                <table class="table-bordered table-striped hidden-xs">
                  <thead>
                    <tr>
                      <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0446');?>"><i class="icon-user-7"></i><?php echo trans('0446');?></a></td>
                      <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0213');?>"><i class="icon-print-3"></i><?php echo trans('0213');?></a></td>
                      <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0201');?>"><i class="icon-params"></i><?php echo trans('0201');?></a></td>
                      <td class="text-center"><a href="javascript:void(0);" class="tooltip-1" data-placement="top" data-original-title="<?php echo trans('0199');?>"><i class="icon-tag-6"></i><?php echo trans('0199');?></a></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center"><?php echo $item->passengers;?></td>
                      <td class="text-center"><?php echo $item->doors;?></td>
                      <td class="text-center"><?php echo $item->transmission;?></td>
                      <td class="text-center"><?php echo $item->baggage;?></td>
                    </tr>
                  </tbody>
                </table>
                <?php } ?>
                <div class="hidden-xs">
                  <div class="mt15"></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-xs-6 col-sm-4 go-right">
                  <div class="row">
                    <?php  if($item->price > 0){ ?>
                    <div class="text-success fs18 text-left go-text-right go-right review ">
                      <b>
                      <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                      </b>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-4 col-xs-4 col-sm-4 hidden-xs go-right">
                  <?php  if($item->avgReviews->overall > 0){ ?>
                  <div class="review text-center size18 hidden-xs"><i class="icon-thumbs-up-4"></i><?php echo $item->avgReviews->overall; ?> / <?php echo $item->avgReviews->totalReviews; ?></div>
                  <?php } ?>
                  <?php if($appModule == "ean"){ if($item->tripAdvisorRating > 0){ ?>
                  <div class="review text-center size18 hidden-xs"><i class="icon-thumbs-up-4"></i><?php echo $item->tripAdvisorRating;?> </div>
                  <div class="clearfix"></div>
                  <?php } } ?>
                </div>
                <div class="col-md-4 col-xs-6 col-sm-4 go-left">
                  <a href="<?php echo $item->slug;?>">
                  <button class="btn btn-action loader loader btn-block"><?php echo trans('0177');?></button>
                  </a>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <div class="clearfix"></div>
        <?php } ?>
        <?php } ?>
      </table>
      <div class="clearfix"></div>
      <div class="offset-3 offset-RTL">
        <ul class="nav nav-pills nav-justified pagination-margin" role="tablist">
          <?php echo createPagination($info);?>
        </ul>
      </div>
      <?php }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
      <!-- End of offset1-->
      <!-- start EAN multiple locations found and load more hotels -->
      <?php if($appModule == "ean"){ if($multipleLocations > 0){ foreach($locationInfo as $loc){ ?>
      <p><?php echo $loc->link; ?></p>
      <?php } } ?>
      <!--This is for display cache Parameter-->
      <div id="latest_record_para">
        <input type="hidden" name="moreResultsAvailable" id="moreResultsAvailable" value="<?php echo $moreResultsAvailable; ?>" />
        <input type="hidden" name="cacheKey" id="cacheKey" value="<?php echo $cacheKey; ?>" />
        <input type="hidden" name="cacheLocation" id="cacheLocation" value="<?php echo $cacheLocation; ?>" />
        <input type="hidden" name="" id="agesappendurl" value="<?php echo $agesApendUrl; ?>" />
        <input type="hidden" name="" id="adultsCount" value="<?php echo $adults;?>" />
      </div>
      <!--This is for display content-->
      <div id="New_data_load"></div>
      <!--This is for display Loader Image-->
      <div id="loader_new"></div>
      <div id="message_noResult"></div>
      <!-- END OF LIST CONTENT-->
      <?php } ?>
      <!-- End EAN multiple locations found and load more hotels  -->
    </div>
    <!-- END OF LIST CONTENT-->
  </div>
  <!-- END OF container-->
</div>
<!-- END OF CONTENT -->
<!-- End container -->
<!-- Map -->
<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div  class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo trans('0254');?></h4>
      </div>
      <div class="mapContent"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-block btn-lg pfb0" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<script>
  <?php if($appModule == "cars"){ ?>
  $(function(){
    $(".saveDates").on("click",function(){
      var pickup = $("#departcar").val();
      var drop = $("#returncar").val();
      var htmlvar = pickup+' - '+drop;
      $(".datesModal").html(htmlvar);
    });
  })

  <?php } ?>

  $('#collapseMap').on('shown.bs.collapse', function(e){
  (function(A) {

  if (!Array.prototype.forEach)
   A.forEach = A.forEach || function(action, that) {
     for (var i = 0, l = this.length; i < l; i++)
       if (i in this)
         action.call(that, this[i], i, this);
     };

   })(Array.prototype);

   var
   mapObject,
   markers = [],
   markersData = {

     'map-red': [
      <?php foreach($module as $item): ?>
     {
       name: 'hotel name',
       location_latitude: "<?php echo $item->latitude;?>",
       location_longitude: "<?php echo $item->longitude;?>",
       map_image_url: "<?php echo $item->thumbnail;?>",
       name_point: "<?php echo $item->title;?>",
       description_point: "<?php echo character_limiter(strip_tags(trim($item->desc)),75);?>",
       url_point: "<?php echo $item->slug;?>"
     },
      <?php endforeach; ?>

     ],

   };
     var mapOptions = {
        <?php if(empty($_GET)){ ?>
       zoom: 10,
        <?php }else{ ?>
         zoom: 12,
        <?php } ?>
       center: new google.maps.LatLng(<?php echo $item->latitude;?>, <?php echo $item->longitude;?>),
       mapTypeId: google.maps.MapTypeId.ROADMAP,

       mapTypeControl: false,
       mapTypeControlOptions: {
         style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
         position: google.maps.ControlPosition.LEFT_CENTER
       },
       panControl: false,
       panControlOptions: {
         position: google.maps.ControlPosition.TOP_RIGHT
       },
       zoomControl: true,
       zoomControlOptions: {
         style: google.maps.ZoomControlStyle.LARGE,
         position: google.maps.ControlPosition.TOP_RIGHT
       },
       scrollwheel: false,
       scaleControl: false,
       scaleControlOptions: {
         position: google.maps.ControlPosition.TOP_LEFT
       },
       streetViewControl: true,
       streetViewControlOptions: {
         position: google.maps.ControlPosition.LEFT_TOP
       },
       styles: [/*map styles*/]
     };
     var
     marker;
     mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
     for (var key in markersData)
       markersData[key].forEach(function (item) {
         marker = new google.maps.Marker({
           position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
           map: mapObject,
           icon: '<?php echo base_url(); ?>assets/img/' + key + '.png',
         });

         if ('undefined' === typeof markers[key])
           markers[key] = [];
         markers[key].push(marker);
         google.maps.event.addListener(marker, 'click', (function () {
       closeInfoBox();
       getInfoBox(item).open(mapObject, this);
       mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
      }));

  });

   function hideAllMarkers () {
     for (var key in markers)
       markers[key].forEach(function (marker) {
         marker.setMap(null);
       });
   };

   function closeInfoBox() {
     $('div.infoBox').remove();
   };

   function getInfoBox(item) {
     return new InfoBox({
       content:
       '<div class="marker_info" id="marker_info">' +
       '<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt=""/>' +
       '<h3>'+ item.name_point +'</h3>' +
       '<span>'+ item.description_point +'</span>' +
       '<a href="'+ item.url_point + '" class="btn btn-primary"><?php echo trans('0177');?></a>' +
       '</div>',
       disableAutoPan: true,
       maxWidth: 0,
       pixelOffset: new google.maps.Size(40, -190),
       closeBoxMargin: '0px -20px 2px 2px',
       closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
       isHidden: false,
       pane: 'floatPane',
       enableEventPropagation: true
     }); };  });
</script>