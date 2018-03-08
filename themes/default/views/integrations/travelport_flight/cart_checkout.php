<style>h5{font-weight:bold}</style>
<div class="header-mob mob-mt">
    <div class="container">
        <div class="row">
            <div class="col-xs-2 col-sm-1 text-left">
                <a data-toggle="tooltip" data-placement="right" title="" class="icon-angle-left pull-left mob-back" onclick="goBack()" data-original-title="Back"></a>
            </div>
            <div class="col-xs-8 col-sm-10">
                <div class="mob-trip-info-head ttu">
                    <div class="mt10"></div>
                    <span><strong class="ellipsis ttu"><span><i class="icon_set_1_icon-87 go-right"></i><span><?php echo trans('0558');?></span> <span class="countprice"></span></span></strong></span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php if ($fakedata->sandbox_mode): ?>
    <div class="alert alert-danger"><?php echo trans('0597');?></div>
    <?php endif; ?>
    <div class="mb15 bs bgwhite">
        <div class="panel-body p0">
            <div>
                <div class="col-xs-4 col-md-1">
                    <div class="row">
                        <img class="img-responsive" src="<?php echo $dataAdapter->summary->carrier->image_path; ?>" style="width: 100%;" alt="<?php echo $dataAdapter->summary->carrier->shortname; ?>">
                    </div>
                </div>
                <div class="col-xs-4 col-md-4">
                    <div style="margin-top:5px" class="fs18 dark bold RTL go-right mob-fs10"><?php echo $dataAdapter->summary->carrier->shortname; ?></div>
                    <div class="clearfix"></div>
                    <div class="grey RTL go-right mob-fs10">
                    <?php foreach($dataAdapter->outbound->segment as $segment): ?>
                        <p>
                            <i class="fa fa-plane"></i> <?= $segment->Origin ?> <i class="fa fa-long-arrow-right"></i> <?= $segment->Destination ?>
                            <div class="clearfix"></div>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?= date('Y-m-d H:i', strtotime($segment->DepartureTime)) ?> <?= date('Y-m-d H:i', strtotime($segment->ArrivalTime)) ?>
                        </p>
                    <?php endforeach; ?>
                    <hr>
                    <?php if($dataAdapter->summary->triptype == 'round'): ?>
                    <?php foreach($dataAdapter->inbound->segment as $segment): ?>
                        <p><i class="fa fa-plane"></i> <?= $segment->Origin ?> <i class="fa fa-long-arrow-left"></i> <?= $segment->Destination ?> </p>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="mob-fs10">
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 total_div mob-fs10">
                    <div class="booking-deposit">
                    </div>
                    <table style="margin-bottom:0px;" class="table table_summary">
                        <tbody>
                            <tr>
                                <td><?php echo trans('0562');?></td>
                                <td class="text-right"><?php echo $dataAdapter->airPricingSolution->ApproximateBasePrice; ?></td>
                            </tr>
                            <tr>
                                <td class="booking-deposit-font"><strong><?php echo trans('0563');?> </strong></td>
                                <td class="text-right">
                                    <strong><span class="booking-deposit-font go-left"><?php echo $dataAdapter->airPricingSolution->Taxes; ?></span></strong>
                                </td>
                            </tr>
                            <tr><td></td><td></td></tr>
                        </tbody>
                    </table>
                    <div class="left size14 dark">&nbsp;<?php echo trans('0124');?> :</div>
                    <div style="padding-top:0px;">
                        <span class="right lred2 bold fs18"><strong><?php echo $dataAdapter->airPricingSolution->TotalPrice; ?></strong></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#details"><strong><?php echo trans('052');?><i class="icon-angle-down"></i></strong><i class=""></i></a>
                    </h4>
                </div>
                <div id="details" class="panel-collapse collapse">
                    <div class="panel-body">
                        <section>
                            <div>
                                <h5><strong class="text-primary"><?php echo trans('0472');?></strong></h5>
                                <?php foreach($dataAdapter->outbound->segment as $segment): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><?php echo trans('08');?></h5>
                                        <p><?= date('Y-m-d H:i', strtotime($segment->DepartureTime)) ?></p>
                                        <p><?= date('Y-m-d H:i', strtotime($segment->ArrivalTime)) ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo $segment->detail->carrier->shortname; ?></h5>
                                        <p><?php echo $segment->Origin; ?></p>
                                        <p><?php echo $segment->Destination; ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo trans('0564');?>: <?php echo $segment->FlightNumber ?> Class: <?php echo $segment->ClassOfService; ?></h5>
                                        <p><?php echo $segment->detail->carrier->fullname; ?></p>
                                        <p><?php echo trans('0565');?>: <?php echo sprintf('%s:%s', $segment->detail->totalDuration->hour, $segment->detail->totalDuration->minute); ?></p>
                                    </div>
                                    <div class="col-md-2">
                                        <h5><?php echo $segment->detail->bookingInfo->CabinClass; ?></h5>
                                    </div>
                                </div> <!--/ .row -->
                                <?php endforeach; ?>
                                <hr>
                                <?php if($dataAdapter->summary->triptype == 'round'): ?>
                                <h5><strong class="text-primary"><?php echo trans('0473');?></strong></h5>
                                <?php foreach($dataAdapter->inbound->segment as $segment): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><?php echo trans('08');?></h5>
                                        <p><?= date('Y-m-d H:i', strtotime($segment->DepartureTime)) ?></p>
                                        <p><?= date('Y-m-d H:i', strtotime($segment->ArrivalTime)) ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo $segment->detail->carrier->shortname; ?></h5>
                                        <p><?php echo $segment->Origin; ?></p>
                                        <p><?php echo $segment->Destination; ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo trans('0564');?>: <?php echo $segment->FlightNumber ?> Class: <?php echo $segment->ClassOfService; ?></h5>
                                        <p><?php echo $segment->detail->carrier->fullname; ?></p>
                                        <p><?php echo trans('0565');?>: <?php echo sprintf('%s:%s', $segment->detail->totalDuration->hour, $segment->detail->totalDuration->minute); ?></p>
                                    </div>
                                    <div class="col-md-2">
                                        <h5><?php echo $segment->detail->bookingInfo->CabinClass; ?></h5>
                                    </div>
                                </div> <!--/ .row -->
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div>
                            </div>
                        </section>
                    </div>
                    <div class="panel-footer">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>

<form name="ticketBookingForm">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo trans('0566');?></div>
            <div class="panel-body">
                <?php $total_forms = 0; ?>
                <?php foreach($dataAdapter->searchPassenger as $index => $searchPassenger): ?>
                <section>
                    <h4><strong class="text-primary"><?php echo trans('Passenger');?> <?=($index + 1)?> - <?=$searchPassenger['Name']?></strong></h4>
                    <div class="row">
                        <hr style="width: 95%; text-align: left;">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <select class="form-control" id="title" name="title[]" required>
                                        <option value="Mr."><?php echo trans('0567');?>.</option>
                                        <option value="Ms."><?php echo trans('0568');?>.</option>
                                        <option value="Master."><?php echo trans('0569');?>.</option>
                                        <option value="Miss."><?php echo trans('0570');?>.</option>
                                        <option value="Mrs."><?php echo trans('0571');?>.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="firstname"><?php echo trans('090');?>:</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname[]" required value="<?php echo $fakedata->first_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="lastname"><?php echo trans('091');?>:</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname[]" required value="<?php echo $fakedata->last_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone"><?php echo trans('092');?>:</label>
                                    <input type="text" class="form-control" id="phone" name="phone[]" required value="<?php echo $fakedata->phone_number; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email"><?php echo trans('094');?>:</label>
                                    <input type="text" class="form-control" id="email" name="email[]" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nationality"><?php echo trans('0572');?>:</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality[]" required value="<?php echo $fakedata->nationality; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" readonly class="form-control" id="code" name="code[]" required value="<?php echo $searchPassenger['Code']; ?>">
                                    <input type="hidden" readonly class="form-control" id="code" name="formsCount" required value="<?php echo $total_forms; ?>">
                                </div>
                            </div>
                    </div>
                </section>
                <?php $total_forms += 1; ?>
                <?php endforeach; ?>
            </div>
        </div> <!--/ ."panel panel-default: Travellers Info -->
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo trans('0459');?></div>
            <div class="panel-body">
                <section>
                    <div class="row">
                    <div class="col-md-6  go-right">
                        <div class="form-group ">
                            <label  class="required go-right"><?php echo trans('0330');?></label>
                            <select class="form-control" name="cardtype" id="cardtype" required>
                                <option value=""><?php echo trans('0573');?></option>
                                <option value="AX"><?php echo trans('0574');?></option>
                                <option value="DS"><?php echo trans('0575');?></option>
                                <option value="CA" <?=($fakedata->sandbox_mode) ? 'selected' : ''?>><?php echo trans('0576');?></option>
                                <option value="VI"><?php echo trans('0577');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6  go-left">
                        <div class="form-group ">
                            <label  class="required go-right"><?php echo trans('0316');?></label>
                            <input type="text" class="form-control" name="cardno" value="<?php echo $fakedata->card_number; ?>" required id="card-number" placeholder="Credit Card Number">
                        </div>
                    </div>
                    <div class="col-md-3 go-right">
                        <div class="form-group ">
                            <label  class="required  go-right"><?php echo trans('0329');?></label>
                            <select class="form-control" name="expMonth" id="expiry-month" required>
                                <option value=""><?php echo trans('0578');?></option>
                                <option value="01"><?php echo trans('0317');?> (01)</option>
                                <option value="02"><?php echo trans('0318');?> (02)</option>
                                <option value="03"><?php echo trans('0319');?> (03)</option>
                                <option value="04"><?php echo trans('0320');?> (04)</option>
                                <option value="05"><?php echo trans('0321');?> (05)</option>
                                <option value="06"><?php echo trans('0322');?> (06)</option>
                                <option value="07"><?php echo trans('0323');?> (07)</option>
                                <option value="08"><?php echo trans('0324');?> (08)</option>
                                <option value="09"><?php echo trans('0325');?> (09)</option>
                                <option value="10"><?php echo trans('0326');?> (10)</option>
                                <option value="11"><?php echo trans('0327');?> (11)</option>
                                <option value="12" <?=($fakedata->sandbox_mode) ? 'selected' : ''?>><?php echo trans('0328');?> (12)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 go-left">
                        <div class="form-group">
                            <label  class="required go-right">&nbsp;</label>
                            <select class="form-control" name="expYear" id="expiry-year" required>
                                <option value=""><?php echo trans('0579');?></option>
                                <?php for($y = date("Y");$y <= date("Y") + 10;$y++): ?>
                                <?php 
                                    $selected = "";
                                    if ($fakedata->sandbox_mode) {
                                        if ($y == (date("Y") + 10)) {
                                            $selected = 'selected';
                                        }
                                    }
                                ?>
                                <option value="<?php echo $y?>" <?=$selected?>><?php echo $y; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 go-left">
                        <div class="form-group">
                            <label  class="required go-right"><?php echo trans('0331');?></label>
                            <input type="text" class="form-control" name="cvv" required id="cvv" placeholder="<?php echo trans('0331');?>" value="<?php echo $fakedata->cvv; ?>">
                        </div>
                    </div>
                    <div class="col-md-3 go-left">
                        <label  class="required go-right">&nbsp;</label>
                        <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive" />
                    </div>
                    </div> <!--/ .row -->
                </section>
            </div>
        </div> <!--/ ."panel panel-default: Payment Information -->
        <div class="alert alert-danger">
            <strong class="RTL go-right"><?php echo trans('045');?></strong>
            <hr>
            <p class="RTL" style="font-size:12px"><?php echo trans('0461');?>.</p>
        </div> <!--/ .alert alert-danger -->
        <div class="form-group">
            <button onclick="scrollWin(0, -15000)" type="submit" class="btn btn-action btn-lg btn-block completebook upClick" id="confirmBooking"><?php echo trans('0306');?></button>
        </div> <!--/ .form-group -->
    </div> <!--/ .container -->
</form>

<!--/ .scroll up -->
<script>
function scrollWin(x, y) {
    window.scrollBy(x, y);
}
</script>
<!--/ .scroll up -->

<script>
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $("[name='ticketBookingForm']").on('submit', function(e) {
            e.preventDefault();
            var payload = $(this).serializeArray();
            $('.loader-wrapper').show();
            $.post( base_url + 'flight/cart/placeorder', payload, function(response) {
                $('.loader-wrapper').hide();
                $('#body-section').html(response.body);
            });
        });
    });
</script>