    <?php if (!empty($errormsg)) { ?>
                                                <div style="background-color: #ff3939; color: white; font-family: Tahoma; margin-bottom: 15px; padding: 16px; font-weight: lighter; text-transform: uppercase; letter-spacing: 6px; width: 571px; margin: auto;">
                                                        <?php echo $errormsg; ?>
                                                </div>
                                                <?php } ?>
                                                <?php if ($invoice->status == "unpaid") {
                                                        if (time() < $invoice->expiryUnixtime) { ?>
                                                <div class="text-center">
                                                        <div data-wow-delay="2s" class="wow fadeIn animated form-group" id="countdown"></div>
                                                </div>
                                                <div class="form-group">
                                                        <center>
                                                                <?php if ($payOnArrival) { ?>
                                                                <button class="btn btn-default arrivalpay" data-module="<?php echo $invoice->module; ?>" id="<?php echo $invoice->id; ?>"><?php echo trans("0345"); ?></button>
                                                                <?php }
                                                                        if ($singleGateway != "payonarrival") { ?>
                                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#pay" aria-expanded="false" aria-controls="pay"><?php echo trans("0117"); ?></button>
                                                                <?php } ?>
                                                        </center>
                                                </div>
                                                <?php } } ?>


                                                        <div class="collapse" id="pay">
                                                            <div class="well">

<!--<div class="modal fade" id="banktrans" tabindex="-1" role="dialog" aria-labelledby="banktrans" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo trans('0355');?></h4>
            </div>
            <div class="modal-body">
                <?php echo "banktransfer"; ?>
            </div>
        </div>
    </div>
</div>-->


                <div class="modal-header" style="margin-bottom: 0px;">
                <h4 class="modal-title" id="myModalLabel"><?php echo trans('0377');?></h4>
            </div>
            <div class="modal-body">
                <div class="form text-left">
                    <div class="form-group">
                        <label for="form-input" class="hidden-xs col-sm-4 control-label text-left" style="padding: 5px; font-size: 24px;"><?php echo trans('0154');?></label>
                        <div class="col-sm-8 col-md-8 col-xs-12">
                            <select class="form-control form selectx" name="gateway" id="gateway">
                                <option value=""><?php echo trans('0159');?></option>
                                <?php foreach ($paymentGateways as $pay) { if($pay['name'] != "payonarrival"){ ?>
                                <option value="<?php echo $pay['name']; ?>" <?php makeSelected($invoice->paymethod, $pay['name']); ?> ><?php echo $pay['gatewayValues'][$pay['name']]['name']; ?></option>
                                <?php } } ?>
                            </select>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-12">
                        <center>
                            <div  id="response"></div>
                        </center>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12 creditcardform" style="display:none;">
                        <form  role="form" action="<?php echo base_url();?>creditcard" method="POST">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6  go-right">
                                        <div class="form-group ">
                                            <label class="required go-right"><?php echo trans('0171');?></label>
                                            <input type="text" class="form-control" name="firstname" id="card-holder-firstname" placeholder="<?php echo trans('0171');?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6  go-left">
                                        <div class="form-group ">
                                            <label class="required go-right"><?php echo trans('0172');?></label>
                                            <input type="text" class="form-control" name="lastname" id="card-holder-lastname" placeholder="<?php echo trans('0172');?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12  go-right">
                                        <div class="form-group ">
                                            <label class="required go-right"><?php echo trans('0316');?></label>
                                            <input type="text" class="form-control" name="cardnum" id="card-number" placeholder="<?php echo trans('0316');?>" onkeypress="return isNumeric(event)" >
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-3 go-right">
                                        <div class="form-group ">
                                            <label style="font-size:13px"class="required  go-right"><?php echo trans('0329');?></label>
                                            <select class="form-control col-sm-2" name="expMonth" id="expiry-month">
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
                                                <option value="12"><?php echo trans('0328');?> (12)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 go-left">
                                        <div class="form-group">
                                            <label class="required go-right">&nbsp;</label>
                                            <select class="form-control" name="expYear" id="expiry-year">
                                                <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>
                                                <option value="<?php echo $y?>"><?php echo $y; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 go-left">
                                        <div class="form-group">
                                            <label class="required go-right">&nbsp;</label>
                                            <input type="text" class="form-control" name="cvv" id="cvv" placeholder="<?php echo trans('0331');?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 go-left">
                                        <label class="required go-right">&nbsp;</label>
                                        <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="form-group">
                                    <div class="alert alert-danger submitresult"></div>
                                    <input type="hidden" name="paymethod" id="creditcardgateway" value="" />
                                    <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $invoice->bookingID;?>" />
                                    <input type="hidden" name="refno" id="bookingid" value="<?php echo $invoice->code;?>" />
                                    <button type="submit" class="btn btn-success btn-lg paynowbtn pull-left" onclick="return expcheck();"><?php echo trans('0117');?></button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            </div>
            </div>