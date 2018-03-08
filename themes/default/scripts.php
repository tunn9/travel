<script src="<?php echo $theme_url; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/owl.carousel.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/scripts.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/custom-scripts.js"></script>


<!-- cartrawler settings -->
<script>
    $(document).ready(function(){
    // Safari 3.0+ "[object HTMLElementConstructor]"
    var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0 || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
    if(isSafari == true){
    $(".bg-warning").css("padding-bottom", "82px !important");
    }
    });

    $(".car-startlocation").select2({
        placeholder: "Search for an Item",
        minimumInputLength: 3,
        width: '100%',
        maximumSelectionSize: 1,
        ajax: {
            url: '<?php echo base_url('cartrawler/getLocations'); ?>',
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (term) {
                return {
                    term: term
                };
            },
            results: function (data) {
                return {
                    results: $.map(data.locations, function (item) {
                        return {
                            text: item.locationName,
                            code: item.locationCode,
                            id: item.locationName
                        }
                    })
                };
            }
        }
    });
    $(".car-endlocation").select2({
        placeholder: "Search for an Item",
        minimumInputLength: 3,
        width: '100%',
        maximumSelectionSize: 1,
        ajax: {
            url: '<?php echo base_url('cartrawler/getLocations'); ?>',
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (term) {
                return {
                    term: term
                };
            },
            results: function (data) {
                return {
                    results: $.map(data.locations, function (item) {
                        return {
                            text: item.locationName,
                            code: item.locationCode,
                            id: item.locationName
                        }
                    })
                };
            }
        }
    });

    $(".car-startlocation").on("select2-selecting",function(e){
        $("input[name='pickupLocationId']").val(e.object.code);
        $("input[name='returnLocationId']").val(e.object.code);
        $('.car-endlocation').select2('data', {
            text: e.object.text,
            id: e.object.text
        });
    });
</script>
<!-- cartrawler settings -->

<script>
var options = {
  url: function(phrase) {
   return "https://yasen.hotellook.com/autocomplete?lang=en-US&limit=10&term="+phrase;
  },
  categories:[{
    listLocation: "cities"
  }],
    list: {
        match: {
            enabled: false
        },
        maxNumberOfElements: 10
    },
    getValue: "fullname",
};
$("#citiesInput").easyAutocomplete(options);
</script>

<script>
var fmt = "<?php echo $app_settings[0]->date_f_js;?>";
var baseURL = "<?php echo base_url(); ?>";

$(function() {


/* Wish list global function */
$(".wishlistcheck").on("click",function(){
var id = $(this).prop('id');
var module = $(this).data('module');
var userid = "<?php echo $usersession; ?>";
var action = "add";
var thisdiv = $(this);
if($(this).hasClass('fav')){
action = "remove";
}


$.post(baseURL+'account/wishlist/'+action,{module: module, itemid: id, loggedin: userid},function(resp){
var response = $.parseJSON(resp);
if(response.isloggedIn){

if(action == "remove"){
$("."+module+"wishsign"+id).html("+");
//$("."+module+"wishtext"+id).html("Add to Wishlist");
$("."+module+"wishtext"+id).tooltip('hide').attr('data-original-title', "<?php echo trans('029'); ?>").tooltip('fixTitle').tooltip('show');
$("."+module+"wishsign"+id).removeClass("fav");
thisdiv.removeClass('fav');

}else{

thisdiv.addClass('fav');
$("."+module+"wishsign"+id).addClass("fav");
$("."+module+"wishsign"+id).html("-");
//$("."+module+"wishtext"+id).html("Remove From Wishlist");
$("."+module+"wishtext"+id).tooltip('hide').attr('data-original-title', "<?php echo trans('028'); ?>").tooltip('fixTitle').tooltip('show');

}

}else{
alert("<?php echo trans('0482');?>");
}

});

})
/* End Wish list global function */


/* tours ajax categories loader */
<?php  if(pt_main_module_available('tours')){ ?>
$('#location').on('change',function(){ var location = $(this).val(); $.post(baseURL+'tours/tourajaxcalls/onChangeLocation',{location: location},function(resp){ var response = $.parseJSON(resp); console.log(response); if(response.hasResult){ $("#tourtype").html(response.optionsList); }else{ $("#tourtype").html(response.optionsList); } mySelectUpdate(); }) });
<?php } ?>

/* cars ajax types loader */
<?php  if(pt_main_module_available('cars')){ ?>
var totalsVal=$("#cartotals").val();if(totalsVal=="1"){$(".showTotal").show()}else{$(".showTotal").hide()}
var pickupLocation=$('#pickuplocation').val();var dropoffLocation=$('#droplocation').val();$('#carlocations').on('change',function(){var location=$(this).val();$.post(baseURL+'cars/carajaxcalls/onChangeLocation',{location:location},function(resp){var response=$.parseJSON(resp);if(response.hasResult){$("#carlocations2").html(response.optionsList).select2({width:'100%',maximumSelectionSize:1})}})});$('#pickuplocation').on('change',function(){var location=$('#pickuplocation').val();var carid=$("#itemid").val();var pickupDate=$("#departcar").val();var dropoffDate=$("#returncar").val();$.post(baseURL+'cars/carajaxcalls/getDropoffLocations',{location:location,carid:carid,pickupDate:pickupDate,dropoffDate:dropoffDate},function(resp){var response=$.parseJSON(resp);console.log(response);if(response.hasResult){$(".showTotal").show();$(".totaldeposit").html(response.priceInfo.depositAmount);$(".totalTax").html(response.priceInfo.taxAmount);$(".grandTotal").html(response.priceInfo.grandTotal);$("#droplocation").html(response.optionsList).select2({width:'100%',maximumSelectionSize:1})}})});$('.carDates').blur(function(){setTimeout(function(){getCarPrice()},500)});$('#droplocation').on("change",(function(){getCarPrice()}));function getCarPrice(){var pickupLocation=$('#pickuplocation').val();var dropoffLocation=$('#droplocation').val();var carid=$("#itemid").val();var pickupDate=$("#departcar").val();var dropoffDate=$("#returncar").val();$.post(baseURL+'cars/carajaxcalls/getCarPriceAjax',{pickupLocation:pickupLocation,dropoffLocation:dropoffLocation,carid:carid,pickupDate:pickupDate,dropoffDate:dropoffDate},function(resp){var response=$.parseJSON(resp);console.log(response);$(".showTotal").show();$(".totaldeposit").html(response.depositAmount);$(".totalTax").html(response.taxAmount);$(".grandTotal").html(response.grandTotal)})}
<?php } ?>

/* Datepicker */

/* disabling dates */
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var checkin = $('.dpd1').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() < now.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
// if (ev.date.valueOf() > checkout.date.valueOf()) {
var newDate = new Date(ev.date);
newDate.setDate(newDate.getDate() + 1);
checkout.setValue(newDate);
// }
checkin.hide();
$('.dpd2')[0].focus();
}).data('datepicker');
var checkout = $('.dpd2').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
var newDate = new Date(ev.date);
checkout.hide();

}).data('datepicker');

/* disabling dates for rooms search */
var nowTemprooms = new Date();
var nowrooms = new Date(nowTemprooms.getFullYear(), nowTemprooms.getMonth(), nowTemprooms.getDate(), 0, 0, 0, 0);
var checkinrooms = $('.dpd1rooms').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() < now.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
// if (ev.date.valueOf() > checkout.date.valueOf()) {
var newDaterooms = new Date(ev.date);
newDaterooms.setDate(newDaterooms.getDate() + 1);
checkoutrooms.setValue(newDaterooms);
// }
checkinrooms.hide();
$('.dpd2rooms')[0].focus();
}).data('datepicker');
var checkoutrooms = $('.dpd2rooms').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() <= checkinrooms.date.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
var newDaterooms = new Date(ev.date);
checkoutrooms.hide();

}).data('datepicker');

/* Expedia datepicker */
<?php  if(pt_main_module_available('ean')){ ?>
var nowTemp2=new Date,now2=new Date(nowTemp2.getFullYear(),nowTemp2.getMonth(),nowTemp2.getDate(),0,0,0,0),checkin2=$(".dpean1").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<now2.valueOf()?"disabled":""}}).on("changeDate",function(e){
// if(e.date.valueOf()>checkout2.date.valueOf()){
var a = new Date(e.date);
a.setDate(a.getDate() + 1);
a.setDate(a.getDate()+1),checkout2.setValue(a)
//}
checkin2.hide(),$(".dpean2")[0].focus()}).data("datepicker"),checkout2=$(".dpean2").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<=checkin2.date.valueOf()?"disabled":""}}).on("changeDate",function(ev){
var b = new Date(ev.date);
checkout2.hide()}).data("datepicker");
<?php } ?>
/* End Expedia Datepicker*/

/* Dohop datepicker */
<?php  if(pt_main_module_available('flightsdohop')){ ?>
var nowTemp3=new Date,now3=new Date(nowTemp3.getFullYear(),nowTemp3.getMonth(),nowTemp3.getDate(),0,0,0,0),checkin3=$(".dpfd1").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<now3.valueOf()?"disabled":""}}).on("changeDate",function(e){

//if(e.date.valueOf()>checkout3.date.valueOf()){
var a=new Date(e.date);

console.log();
a.setDate(a.getDate() + 1);
checkout3.setValue(a);
// }
checkin3.hide(),$(".dpfd2")[0].focus()}).data("datepicker"),checkout3=$(".dpfd2").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<=checkin3.date.valueOf()?"disabled":""}}).on("changeDate",function(ev){
var b = new Date(ev.date);
checkout3.hide()

}).data("datepicker");
<?php } ?>
/* End Dohop Datepicker*/

<?php  if(pt_main_module_available('tours')){ ?>
// Tours checkin - disabling Single date
var nowTemp4 = new Date();
var now4 = new Date(nowTemp4.getFullYear(), nowTemp4.getMonth(), nowTemp4.getDate(), 0, 0, 0, 0);
var checkin4 = $('.tchkin').datepicker({format: fmt, onRender: function(date) {
return date.valueOf() < now4.valueOf() ? 'disabled' : ''; } }).on('changeDate', function(ev) {
var tdate =new Date(ev.date);
$('.tchkin').datepicker('hide');
});
<?php } ?>
<?php  if(pt_main_module_available('cars')){ ?>
var nowTemp5 = new Date();
var now5 = new Date(nowTemp5.getFullYear(), nowTemp5.getMonth(), nowTemp5.getDate(), 0, 0, 0, 0);
var departcar = $('#departcar').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() < now5.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
//   if (ev.date.valueOf() > returncar.date.valueOf()) {
var newDate5 = new Date(ev.date)

newDate5.setDate(newDate5.getDate() + 0);

returncar.setValue(newDate5);
//  }
departcar.hide();
$('#returncar')[0].focus();
}).data('datepicker');
var returncar = $('#returncar').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() <= departcar.date.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
var cnewDate = new Date(ev.date);
returncar.hide();

}).data('datepicker');

var nowTemp52 = new Date();
var now52 = new Date(nowTemp52.getFullYear(), nowTemp52.getMonth(), nowTemp52.getDate(), 0, 0, 0, 0);
var departcar2 = $('#departcar2').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() < now52.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
//   if (ev.date.valueOf() > returncar.date.valueOf()) {
var newDate52 = new Date(ev.date)

newDate52.setDate(newDate52.getDate() + 0);

returncar2.setValue(newDate52);
//  }
departcar2.hide();
$('#returncar2')[0].focus();
}).data('datepicker');
var returncar2 = $('#returncar2').datepicker({
format: fmt,
onRender: function(date) {
return date.valueOf() <= departcar2.date.valueOf() ? 'disabled' : '';
}
}).on('changeDate', function(ev) {
var cnewDate2 = new Date(ev.date);
returncar2.hide();

}).data('datepicker');

<?php } ?>

/* Cartrawler datepicker */
<?php  if(pt_main_module_available('cartrawler')){ ?>
var nowTemp6=new Date,now6=new Date(nowTemp6.getFullYear(),nowTemp6.getMonth(),nowTemp6.getDate(),0,0,0,0),checkin6=$(".dpcd1").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()<now6.valueOf()?"disabled":""}}).on("changeDate",function(e){
//if(e.date.valueOf()>checkout6.date.valueOf()){
var a=new Date(e.date);
a.setDate(a.getDate() + 0);
checkout6.setValue(a)
//}
checkin6.hide(),$(".dpcd2")[0].focus()}).data("datepicker"),checkout6=$(".dpcd2").datepicker({format:"mm/dd/yyyy",onRender:function(e){return e.valueOf()< checkin6.date.valueOf()?"disabled":""}}).on("changeDate",function(ev){
var cnDate = new Date(ev.date);
checkout6.hide()
}).data("datepicker");
<?php } ?>
/* End Cartrawler Datepicker*/

/* Newsletter subscription */
$(".sub_newsletter").on("click",function(){var e=$(".sub_email").val();$.post("<?php echo base_url();?>home/subscribe",{email:e},function(e){$(".subscriberesponse").html(e).fadeIn("slow"),setTimeout(function(){$(".subscriberesponse").fadeOut("slow")},2000)})});

/* dropdown on hover */
$("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(200).fadeIn(200)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(200).fadeOut(200)}); });

/* start change currency functionality */
function change_currency(element){
    var currency_id = $(element).data('code');
    $("#loadingbg").css("display","block"),
    $.post("<?php echo base_url();?>admin/ajaxcalls/changeCurrency",{ id: currency_id}, function() {
        location.reload();
    }
)};

/* map iframe modal */
function showMap(a,o){"modal"==o?($("#mapModal").modal("show"),$("#mapModal").on("shown.bs.modal",function(){$("#mapModal .mapContent").html('<iframe src="'+a+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>')})):$("#"+o).html('<iframe src="'+a+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>')}
</script>
<?php  if(pt_main_module_available('flightsdohop')){ ?>
<script type="text/javascript">
/* dohop auto suggest */
function selectValue(l,h){$("#"+h).val(l),$("#"+h+"resp").html("")}$(function(){$(".sterm").on("keyup",function(l){var h=$(this).val(),e=h.length,i=$(this).prop("id"),t=l.keyCode||l.which;if($.trim(e)>1&&38!=t&&40!=t)console.log(t),$("#"+i+"resp").html(""),$.post("<?php echo base_url();?>flightsdohop/getLocationsList",{term:h,inputid:i},function(l){$("#"+i+"resp").html(l)});else if(38!=t&&40!=t)$("#"+i+"resp").html("");else{var s,g,n=$("#"+i+"resp ul li.highlight");40!==t||n.length||$("#"+i+"resp ul li:first").addClass("highlight"),40===t&&n.length?(g=n.next("#"+i+"resp ul li"),g.length&&(n.removeClass("highlight"),g.addClass("highlight"))):38===t&&(s=n.prev("#"+i+"resp ul li"),s.length&&(n.removeClass("highlight"),s.addClass("highlight"))),console.log($(".highlight").innerHTML)}})});
</script>
<?php } ?>
<?php  if(pt_main_module_available('cartrawler')){ ?>
<script type="text/javascript">
/* cartrawler auto suggest */
function selectLocationValue(l,h,locname){  $("#"+h).val(locname);  if(h == 'ct1'){ $("input[name='pickupLocationId']").val(l); $("#ct2").val(locname); $("input[name='returnLocationId']").val(l); }else if(h == "ct2"){ $("#returnlocation").val(l);   }; $("#"+h+"resp").html("") } $(function(){ $(".ctlocation").on("keyup",function(l){ var h=$(this).val(),e=h.length,i=$(this).prop("id"),t=l.keyCode||l.which;if($.trim(e)>1&&38!=t&&40!=t)$("#"+i+"resp").html(""),$.post("<?php echo base_url();?>cartrawler/getLocations",{term:h,inputid:i},function(l){$("#"+i+"resp").html(l)});else if(38!=t&&40!=t)$("#"+i+"resp").html("");else{var s,g,n=$("#"+i+"resp ul li.highlight");40!==t||n.length||$("#"+i+"resp ul li:first").addClass("highlight"),40===t&&n.length?(g=n.next("#"+i+"resp ul li"),g.length&&(n.removeClass("highlight"),g.addClass("highlight"))):38===t&&(s=n.prev("#"+i+"resp ul li"),s.length&&(n.removeClass("highlight"),s.addClass("highlight"))),console.log($(".highlight").innerHTML)}})});

</script>
<?php } ?>
