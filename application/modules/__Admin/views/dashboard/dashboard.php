<?php $UriSegment = $this->uri->segment(1); ?>
<div class="row form-group">
  <!-- BEGIN ICON BUTTONS SET-->
  <!-- <?php if($canQuickBook){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2">
    <button data-toggle="modal" data-target="#quickbook" class="btn btn-danger btn-block">
      <div class="h5"><i class="fa fa-dashboard fa-lg"></i> Quick Booking</div>
    </button>
  </div>
  <?php } ?>
  <div class="col-xs-6 col-sm-6 col-md-2">
    <form action="<?php echo base_url().$this->uri->segment(1); ?>/bookings/" method="post">
      <button type="submit" class="btn btn-primary btn-block">
        <div class="h5"><i class="fa fa-bar-chart-o fa-lg"></i> Bookings</div>
      </button>
    </form>
  </div>
  <?php if($isadmin){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2">
    <form action="<?php echo base_url(); ?>admin/cms/" method="post">
      <button type="submit" class="btn btn-info btn-block">
        <div class="h5"><i class="fa fa-list-alt fa-lg"></i> &nbsp; CMS Pages</div>
      </button>
    </form>
  </div>
  <?php if($blogenabled){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2">
    <form action="<?php echo base_url(); ?>admin/blog/" method="post">
      <button type="submit" class="btn btn-success btn-block">
        <div class="h5"><i class="glyphicon glyphicon-th-large fa-lg"></i> Blog</div>
      </button>
    </form>
  </div>
  <?php } if($newsletterEnabled){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2">
    <form action="<?php echo base_url(); ?>admin/newsletter/" method="post">
      <button type="submit" role="button" class="btn btn-warning btn-block">
        <div class="h5"><i class="fa fa-envelope fa-lg"></i> Send Newsletter</div>
      </button>
    </form>
  </div>
  <?php } ?>
  <div class="col-xs-6 col-sm-6 col-md-2">
    <form action="<?php echo base_url(); ?>admin/backup/" method="post">
      <button type="submit" role="button" class="btn btn-default btn-block">
        <div class="h5"><i class="fa fa-inbox fa-lg"></i> Backup Databse</div>
      </button>
    </form>
  </div>
  <?php } ?> -->
  <!-- END ICON BUTTONS SET-->
</div>

<!-- Reports section -->
<?php if(!empty($isadmin)){ ?>


    <div class="panel panel-default">
      <div class="panel-heading"><?php echo trans('0196');?></div>
      <div class="panel-body">
        <div class="row">
        <div class="col-md-4">
        <div class="block">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(0, 204, 51);"><?php echo $today->totalCount + $todayExpedia->totalCount + $travelportCurrentDaySale->total_booking;?></div>
              </div>
            </div>
            <div class="col-md-7 col-sm-7">
              <div class="text-left">
                <h4><strong><?php echo trans('0198');?></strong></h4>
                <p>Hôm qua : <?php echo $yesterday->totalCount + $yesterdayExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong><?php echo trans('0145');?></strong> <?php echo $today->paidAmount + $todayExpedia->paidAmount + $travelportCurrentDaySale->total_price;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong><?php echo trans('0146');?></strong> <?php echo $today->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="block">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(255, 153, 51);"><?php echo $thirtyDays->totalCount + $thirtyDaysExpedia->totalCount + $travelportLastThirtyDays->total_booking;?></div>
              </div>
            </div>
            <div class="col-md-7 col-sm-7">
              <div class="text-left">
                <h4><strong><?php echo trans('0199');?></strong></h4>
                <p>60 Ngày trước : <?php echo $sixtyDays->totalCount + $sixtyDaysExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong><?php echo trans('0145');?></strong> <?php echo $thirtyDays->paidAmount + $thirtyDaysExpedia->paidAmount + $travelportLastThirtyDays->total_price;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong><?php echo trans('0146');?></strong> <?php echo $thirtyDays->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="block hidden-md hiddin-sm hidden-xs">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(204, 0, 51);"><?php echo $nintyDays->totalCount + $nintyDaysExpedia->totalCount + $travelportLastNinghtyDays->total_booking;?></div>
              </div>
            </div>
            <div class="col-md-7 col-sm-7">
              <div class="text-left">
                <h4><strong><?php echo trans('0200');?></strong></h4>
                <p>180 Ngày trước : <?php echo $oneEightyDays->totalCount + $oneEightyDaysExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong><?php echo trans('0145');?></strong> <?php echo $nintyDays->paidAmount + $nintyDaysExpedia->paidAmount + $travelportLastNinghtyDays->total_price;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong><?php echo trans('0146');?></strong> <?php echo $nintyDays->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>


<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><?php echo trans('0197');?></div>
      <div class="panel-body">
        <style>
          td span {width: 100%;font-weight: bold;}
          .rev-but { padding: 8px 16px; background-color:#f7f7f7; }
          .rev-bg { border: 1px solid #eee;background-color:#f9f9f9;border-radius:5px }
          .pad8 { padding: 8px; }
          .pad8 h4 { margin-bottom: 5px; }
          .pad8 p { color: #8e8e8e }
          .mlr0 { padding-right: 0px; padding-left: 0px; }
          .mtb10 { margin-top: 15px;margin-bottom: 15px; }
          .mtb04 { margin-top: 0px;margin-bottom: 5px; }
          .mb0 { margin-bottom: 0px; }
          .tempStatBox { width: 120px; -webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box; margin: 0 auto; }
          .tempStatBox .tempStat { position: relative; font-size: 27px; line-height: 80px; -webkit-border-radius: 50em; -moz-border-radius: 50em; border-radius: 50em; border: 10px solid #FFF; background: #f9f9f9; height: 80px; width: 80px; text-align: center; margin: 0 auto; -webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box; }
          .tempStatBox .tempStat:before { content: ""; top: -10px; left: -10px; height: 100px; width: 100px; position: absolute; -webkit-border-radius: 50em; -moz-border-radius: 50em; border-radius: 50em; background: transparent; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff; -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff; box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff; -webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box;}
        </style>
        <div class="row">
          <div class="col-md-12">
            <div id="container" style="min-width: 310px; height: 335px; margin: 0 auto"></div>
          </div>
          <!-- Line Chart JS -->
          <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    title: {
                        text: 'Last 30 Days Bookings Report',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: <?php echo json_encode($graphReport['days']); ?>
                    },
                    yAxis: {
                        title: {
                            text: 'Booking Amount'
                        },
                        min: 0,
                        plotLines: [{value: 0, width: 1, color: '#808080'}]
                    },
                    tooltip: {
                        valueSuffix: ' <?php echo $currCode; ?>'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: <?php echo $resArray;?>
                });
            });
          </script>
          <!-- End Line Chart JS -->
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  <?php echo trans('0198');?>
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo ($todayPaid->totalPaidAmount + $todayExpedia->totalAmount + $travelportCurrentDaySale->total_price);?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  <?php echo trans('0199');?>
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo ($thirtyDaysPaid->totalPaidAmount + $thirtyDaysExpedia->totalAmount + $travelportLastThirtyDays->total_price); ?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  <?php echo trans('0200');?>
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo ($nintyDaysPaid->totalPaidAmount + $nintyDaysExpedia->totalAmount + $travelportLastNinghtyDays->total_price); ?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>
</div>

<?php } ?>
<!-- Reports section -->


<!-- Recent Bookings -->

<?php  echo modules::run($UriSegment.'/bookings/dashboardBookings'); ?>

<!--Recent Bookings -->

<!-- Expedia Recent Bookings -->
<?php
  /*if(!empty($isadmin)) {
      $chkExpedia = $chklib->is_mod_available_enabled("ean");
      if($chkExpedia) {
        echo modules::run('ean/eanback/dashboardBookings');
      }
  }*/
?>


<?php 
  if( ! empty($isadmin) ) {
    $travelport_flight = $chklib->is_mod_available_enabled("travelport_flight");
    if($travelport_flight) {
?>
<!-- Travelport -->
<div class="col-md-12">
  <div class="panel panel-default">
  <div class="panel-body">
      <div id="tpcontainer" style="min-width: 310px; height: 335px; margin: 0 auto"></div>
  </div>
</div>

<!-- Line Chart JS -->
<script type="text/javascript">
  $(function () {
      $('#tpcontainer').highcharts({
          title: {
              text: 'Last 30 Days Travelport Bookings Report',
              x: -20 //center
          },
          xAxis: {
              categories: <?php echo json_encode($xaxis); ?>
          },
          yAxis: {
              title: {
                  text: 'Booking Amount'
              },
              min: 0,
              plotLines: [{value: 0, width: 1, color: '#808080'}]
          },
          tooltip: {
              valueSuffix: ' <?php echo $currCode; ?>'
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
          },
          series: <?php echo $travelportSeries; ?>
      });
  });
</script>
<?php
        echo modules::run('travelport_flight/flightback/bookings');
      }
  }
?>

<!--Expedia Recent Bookings -->
<div class="row">
  <div class="col-md-12">
    <?php if(!empty($isadmin)){ ?>
    <div class="panel panel-default">
      <div class="panel-heading">
       <div class="pull-left"> <span class="fa fa-bar-chart-o"></span> Visit Statistics of <?php echo date('F', time()); ?></div>
       <div class="pull-right btn btn-xs btn-danger resetChart"> <span class="fa fa-bar-chart-o"></span> Reset Chart </div>
      <div class="clearfix"></div>
     </div>

      <div class="panel-body">
        <br>
        <!-- <canvas id="canvasbar" height="237" width="750"></canvas>-->
        <div id="resgraph" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<!---quick booking modal-->
<div class="modal fade" id="quickbook" tabindex="-1" role="dialog" aria-labelledby="ADD_BLOG_CAT" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url().$this->uri->segment(1); ?>/quickbooking/" method="GET">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Quick Booking</h4>
        </div>
        <div class="modal-body form-horizontal">
          <div class="form-group">
            <label class="col-md-3 control-label" >Apply Tax</label>
            <div class="col-md-4">
              <select name="applytax" class="form-control" id="apply" >
                <option value="yes" >Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" id="service" >Service</label>
            <div class="col-md-4">
              <select required name="service" data-placeholder="Select" class="form-control" id="servicetype" tabindex="1">
                <option value="">Select</option>
                <?php
                  foreach($quickmodules as $mod):
                    $istrue = $chklib->is_mod_available_enabled($mod);
                     $isintegration = $chklib->is_integration($mod);
                   if($istrue && !$isintegration && !in_array($mod,$chklib->notinclude)){
                     if(pt_permissions($mod,@$userloggedin)){
                  ?>
                <option value="<?php echo $mod;?>"><?php echo ucfirst($mod);?></option>
                <?php } } endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Next</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->
<!-- Charts -->
<script src="<?php echo base_url(); ?>assets/include/highcharts/highcharts.js"></script>
<!-- Charts -->
<script type="text/javascript">
  $(function () {

    $(".resetChart").on("click",function(){

  $.alert.open('confirm', 'Are you sure you want to reset visits data?', function(answer) {
   if(answer == 'yes'){

      $.post("<?php echo base_url();?>admin/resetVisits",{isAjax: "yes"},function(resp){

       location.reload();

      })

    }else{

      return false;
    }

    });

});


          $('#resgraph').highcharts({
                  chart: {
              type: 'column',
               zoomType: 'x'
          },
          title: {
              text: ''
          },
          xAxis: {
            title: {
                  text: "<?php echo date('F', time()); ?>"
              },
            categories: [<?php for($day =1;$day <= $totalDays;$day++){echo $day.","; }?>]
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Visits'
              },
              stackLabels: {
                  enabled: true,
                  style: {
                      fontWeight: 'bold',
                      color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                  }
              }
          },
          legend: {
              align: 'right',
              x: -70,
              verticalAlign: 'top',
              y: 20,
              floating: true,
              backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
              borderColor: '#CCC',
              borderWidth: 1,
              shadow: false
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.x + '</b><br/>' +
                      this.series.name + ': ' + this.y + '<br/>' +
                      'Total: ' + this.point.stackTotal;
              }
          },
          plotOptions: {
              column: {
                  stacking: 'normal',
                  dataLabels: {
                      enabled: false,
                      color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                      style: {
                          textShadow: '0 0 3px black, 0 0 3px black'
                      }
                  }
              }
          },
          series: [{
              name: 'Unique',
              data: [<?php echo implode(",", $uniqueVisits); ?>],
       stack: 'male'
          }, {
              name: 'Total Hits',
              data: [<?php echo implode(",", $totalHits); ?>],
      stack: 'female'
          }]
          });
      });


</script>