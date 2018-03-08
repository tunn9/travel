<!DOCTYPE HTML>
<html>
<head>
<meta name="author" content="PHPTRAVELS">
<link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER.'favicon.png';?>">
<link href="<?php echo base_url(); ?>themes/default/assets/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>themes/default/assets/js/jquery-1.11.2.min.js"></script>
<title><?php echo @$pageTitle; ?> <?php echo $invoice->id; ?></title>
<script type="text/javascript" src="<?php echo base_url(); ?>themes/default/assets/js/jspdf.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>themes/default/assets/js/html2canvas.min.js"></script>
<script type="text/javascript">
var specialElementHandlers = {
        '#editor': function (element, renderer) {
        return true;
    }
};
</script>

<div class="container">
<br><br>
<div class="col-md-2"></div>
<div class="col-md-8">
<?php include 'pay.php'; ?>
</div>
<div class="col-md-2"></div>
</div>

<div id="content">
<div id="printablediv">
<body  style="margin: 0 !important; padding: 0 !important; background-color: #d8d8d8;" bgcolor="#d8d8d8">
    <table id="invoiceTable" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;margin-top: 35px; margin-bottom: 35px;">
        <tr>
            <?php if ($invoice->status == "unpaid") { if (time() < $invoice->expiryUnixtime) { ?>
            <td align="center" valign="top" style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;background: #FA0000" bgcolor="#FA0000">
                <div style="font-size:16px;color:white;">
                    <?php echo trans("082"); ?>
                </div>
            </td>
            <?php } else { ?>
            <td align="center" valign="top" style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" bgcolor="#FA0000">
                <div style="font-size:16px;color:white;">
                    <?php echo trans("0409"); ?> <b class="wow flash animted"><?php echo trans("0519"); ?></b>
                </div>
            </td>
            <?php }
                } elseif ($invoice->status == "reserved") { ?>
            <td align="center" valign="top" style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" bgcolor="#FF9900">
                <div style="font-size:16px;color:white;">
                    <?php echo trans("0409"); ?> <b class="wow flash animted"><?php echo trans("0445"); ?></b>
                    <?php if ($invoice->paymethod == "payonarrival") { ?>
                    <p style="color:white;letter-spacing: 2px; font-size: 10px; margin-top: 0px;" class="text-center"><?php echo trans("0474"); ?></p>
                </div>
            </td>
            <?php }
                } elseif ($invoice->status == "cancelled") { ?>
            <td align="center" valign="top" style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" bgcolor="#FA0000">
                <div style="font-size:16px;color:white;">
                    <?php echo trans("0347"); ?>
                </div>
            </td>
            <?php } else { ?>
            <td align="center" valign="top" style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" bgcolor="#38A870">
                <div style="font-size:16px;color:white;">
                    <?php echo trans("0409"); ?> <b class="wow flash animted"><?php echo trans("081"); ?></b>
                    <p style="color:white;letter-spacing: 2px; font-size: 10px; margin-top: 0px;" class="text-center"><?php echo trans("0410"); ?><?php echo $invoice->accountEmail; ?></p>
                </div>
            </td>
            <?php } ?>
        </tr>
        <tr>
            <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#E0F0FF">
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="left" valign="top" style="font-family: Tahoma; font-size: 36px;line-height: 28px;color:#002141">
                                <div style="font-size: 12px !important;height: 14px;"><strong><?php echo trans("076"); ?> <?php echo trans("08"); ?> </strong>: <?php echo $invoice->bookingDate; ?></div>
                                <div style="font-size: 12px !important;height: 14px;margin-bottom:14px"><strong><?php echo trans("079"); ?> </strong>: <?php echo $invoice->expiry; ?></div>
                                <div style="font-size: 34px;text-transform:uppercase;font-weight: bold;"><?php echo trans("076"); ?></div>
                                <div style="font-size: 12px !important;height: 14px;"><strong><?php echo trans("076"); ?> <?php echo trans("0434"); ?></strong> : <?php echo $invoice->id; ?></div>
                                <div style="font-size: 12px !important;height: 14px;"><strong><?php echo trans("0398"); ?></strong> <?php echo $invoice->code; ?></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="right" valign="top" style="font-family: Tahoma; font-size: 18px; font-weight: 400; line-height: 48px;">
                               <div style="text-transform: uppercase;font-size: 16px !important;height: 20px;font-weight:bold"><?php echo trans("0545"); ?></div>
                               <div style="text-transform: uppercase; letter-spacing: 0px;font-size: 12px !important;height: 4px;margin-bottom:14px"><?php echo $invoice->userFullName; ?></div>
                               <div style="text-transform: uppercase; letter-spacing: 0px;font-size: 12px !important;height: 4px;margin-bottom:14px"><?php echo $invoice->userAddress; ?></div>
                               <div style="text-transform: uppercase; letter-spacing: 0px;font-size: 12px !important;height: 4px;margin-bottom:14px"><?php echo $invoice->userMobile; ?></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
           <tr style="height: 4px; width: 100%; float: left;background: #f76570; background: -moz-linear-gradient(left, #f76570 0%, #f76570 8%, #f3a46b 8%, #f3a46b 16%, #f3a46b 16%, #ffd205 16%, #ffd205 24%, #ffd205 24%, #1bbc9b 24%, #1bbc9b 25%, #1bbc9b 32%, #14b9d5 32%, #14b9d5 40%, #c377e4 40%, #c377e4 48%, #f76570 48%, #f76570 56%, #f3a46b 56%, #f3a46b 64%, #ffd205 64%, #ffd205 72%, #1bbc9b 72%, #1bbc9b 80%, #14b9d5 80%, #14b9d5 80%, #14b9d5 89%, #c377e4 89%, #c377e4 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,#f76570), color-stop(8%,#f76570), color-stop(8%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#1bbc9b), color-stop(25%,#1bbc9b), color-stop(32%,#1bbc9b), color-stop(32%,#14b9d5), color-stop(40%,#14b9d5), color-stop(40%,#c377e4), color-stop(48%,#c377e4), color-stop(48%,#f76570), color-stop(56%,#f76570), color-stop(56%,#f3a46b), color-stop(64%,#f3a46b), color-stop(64%,#ffd205), color-stop(72%,#ffd205), color-stop(72%,#1bbc9b), color-stop(80%,#1bbc9b), color-stop(80%,#14b9d5), color-stop(80%,#14b9d5), color-stop(89%,#14b9d5), color-stop(89%,#c377e4), color-stop(100%,#c377e4)); /* background: -webkit-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); */ background: -o-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: -ms-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: linear-gradient(to right, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f76570', endColorstr='#c377e4',GradientType=1 );"></tr>
        <tr>
            <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <!--<tr>
                        <td align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 24px;">
                         <table cellspacing="0" cellpadding="0" border="0" align="right">
                            <tr>
                                <td style="font-family: Tahoma; font-size: 18px; font-weight: 400;">
                                    <p style="font-size: 14px; font-weight: 400; margin: 0; color: #002141;"><a href="<?php echo base_url(); ?>" target="_blank" style="color: #002141; letter-spacing: 5px; font-size: 22px; text-align: right; text-decoration: none;"><?php echo $app_settings[0]->site_title; ?> &nbsp;</a></p>
                                </td>
                            </tr>
                         </table>
                        </td>
                    </tr>-->
                    <tr>
                        <td align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 5px;">
                           <!-- <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"></p>-->
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Tahoma; font-size: 16px; font-weight: 800; line-height: 24px; padding: 5px;">
                                        <?php echo $invoice->title;?> <?php echo $invoice->stars;?>
                                    </td>
                                    <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Tahoma; font-size: 16px; font-weight: 800; line-height: 24px; padding: 5px;">
                                        <small><?php echo $invoice->location;?></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <img style="width:55px" src="<?php echo $invoice->thumbnail;?>" class="img-responsive">
                                    </td>
                                </tr>


                                <?php if($invoice->module == "hotels"){ ?>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans("0435");?> : <?php echo $invoice->subItem->title;?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <strong><?php echo trans("07");?>  </strong>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->checkin; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <strong><?php echo trans("09");?>  </strong>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->checkout; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <span style="text-transform:uppercase"><?php echo trans("060");?></span>  <?php echo $invoice->nights;?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->price;?>
                                    </td>
                                </tr>
                                <?php if($invoice->extraBeds > 0){ ?>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0428');?> <?php echo $invoice->extraBeds; ?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->currSymbol; ?><?php echo $invoice->extraBedsCharges; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>


                                <?php if(!empty($invoice->bookingExtras)){ ?>
                                <?php foreach($invoice->bookingExtras as $extra){ ?>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $extra->title;?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->currSymbol.$extra->price;?>
                                    </td>
                                </tr>
                                <?php } } ?>

                                <!--<tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->subItem->quantity;?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php if(!empty($invoice->subItem->total)){ echo $invoice->currSymbol;?><?php echo $invoice->subItem->total; }?>
                                    </td>
                                </tr>-->

                                <!-- Start Tours Section -->
                                <?php if($invoice->module == "tours"){ ?>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('07');?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->checkin; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('010');?>  <?php echo $invoice->subItem->adults->count;?> <?php echo $invoice->currCode; ?> / <?php echo $invoice->currSymbol;?> <?php echo str_replace(".00",'',number_format($invoice->subItem->adults->price,2));?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                         <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo str_replace(".00",'',number_format($invoice->subItem->adults->price * $invoice->subItem->adults->count,2));?>
                                    </td>
                                </tr>
                                <?php if($invoice->subItem->child->count > 0){ ?>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('011');?>  <?php echo $invoice->subItem->child->count;?> / <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->child->price;?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                       <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->child->price * $invoice->subItem->child->count;?>
                                    </td>
                                </tr>
                                <?php } if($invoice->subItem->infant->count > 0){ ?>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0282');?>   <?php echo $invoice->subItem->infant->count;?> / <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->infant->price;?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->infant->price * $invoice->subItem->infant->count;?>
                                    </td>
                                </tr>
                                <?php } ?>



                                <!-- Guest Info Table -->
                                <?php $chk = (array)$invoice->guestInfo; $chk1 = reset($chk); ?>
                                <?php if(!empty($chk1->name)){ ?>
                                <table class="table table-bordered table-striped" style="width:100%;background: #F5F5F5; padding: 10px;">
                                    <thead style="text-transform:uppercase;background: #e1dddd;">
                                        <tr>
                                            <td width="33.3%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                <?php echo trans('0350');?>
                                            </td>
                                            <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                <?php echo trans('0523');?>
                                            </td>
                                            <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                <?php echo trans('0524');?>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($invoice->guestInfo as $guest){ ?>
                                        <tr>
                                            <td width="33.3%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                <?php echo $guest->name;?>
                                            </td>
                                            <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                <?php echo $guest->passportnumber;?>
                                            </td>
                                            <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                <?php echo $guest->age;?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                                <!-- End Guest Info Table -->
                                <?php } ?>
                                <!-- End Tours Section -->





                                <!-- Start Cars Section -->
                                <?php if($invoice->module == "cars"){ ?>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('08');?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->date; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0275');?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->nights; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0210');?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->bookedItemInfo->pickupLocation; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0211');?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->bookedItemInfo->dropoffLocation; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0210');?>  <?php echo trans('08'); ?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->bookedItemInfo->pickupDate; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0210');?> <?php echo trans('0259'); ?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->bookedItemInfo->pickupTime; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0211');?> <?php echo trans('08'); ?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->bookedItemInfo->dropoffDate; ?>
                                    </td>
                                </tr>

                                 <tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo trans('0211');?> <?php echo trans('0259'); ?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                       <?php echo $invoice->bookedItemInfo->dropoffTime; ?>
                                    </td>
                                </tr>

                                <?php } ?>
                                <!-- End Cars Section -->

                                <table class="table table-bordered" style="width:100%;background: #F5F5F5; padding: 10px;margin-top:25px;margin-bottom:25px">
                                    <thead style="text-transform:uppercase;background: #e1dddd;">
                                        <tr style="width:100%">
                                    <td width="33.3%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                       <strong> <?php echo trans("0126");?></strong>
                                    </td>
                                    <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                         <strong><?php echo trans("0153");?></strong>
                                    </td>
                                    <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                         <strong><?php echo trans("0124");?></strong>
                                    </td>
                               </tr>
                                  </thead>
                                    <tbody>
                                 <tr style="width:100%">
                                    <td width="33.3%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo str_replace(".00","",number_format($invoice->checkoutAmount,2)); ?>
                                    </td>
                                    <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo str_replace(".00","",number_format($invoice->tax,2));?>
                                    </td>
                                    <td width="33.3%" align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                        <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo str_replace(".00","",number_format($invoice->checkoutTotal,2));?>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                                <?php if(!empty($invoice->additionaNotes)){ ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading"><?php echo trans('0178');?></div>
                                  <div class="panel-body"><p><?php echo $invoice->additionaNotes;?></p> </div>
                                </div>
                                <?php } ?>

                                <?php if($invoice->couponRate > 0){ ?>
                                <div class="panel panel-success">
                                  <div class="panel-heading"><i class="text-success fa fa-check"></i> <?php echo trans("0518");?> <?php echo $invoice->couponRate; ?>%</div>
                                </div>
                                <?php } ?>

                            </table>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td align="center" style="padding: 10px 37px;; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td style="width:50px">
                                    <img src="<?php echo PT_GLOBAL_IMAGES_FOLDER."favicon.png";?>" style="display: block; border: 0px;height:50px;width:50px;margin-right: 10px;"/>
                                    </td>
                                    <td align="left" style="color:#002141;width:550px">
                                        <p style="font-size: 14px;font-family: tahoma; font-weight: 800; line-height: 0px; color: #002141;    margin-top: 5px;"><?php echo $app_settings[0]->site_title; ?></p>
                                        <p style="margin: 0px;"><i class="icon_set_1_icon-41"></i> <?php echo strip_tags($contactaddress); ?></p>
                                        <p style="margin: 0px;"><i class="icon_set_1_icon-84"></i> <?php echo strip_tags($contactemail); ?></p>
                                        <p style="margin: 0px;"><i class="icon_set_1_icon-90"></i> <?php echo strip_tags($phone); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</div>
</div>

<div class="text-center">
<div id="editor"></div>
<input type="button" class="btn btn-success" value="Print" onclick="printDiv()"/>
<button id="downloadInvoice" class="btn btn-default"><?php echo trans('0596');?></button>
    <a href="#" id="image"></a>
<a href="javascript:void()" id="btn" class="btn btn-primary"><?php echo trans('0593');?></a>
</div>
</html>
<script language="javascript" type="text/javascript">

// Create invoice snap shot and download as a pdf
$(document).ready(function() {
    $('#btn').click(function () {
        var container = document.getElementById("invoiceTable");
        html2canvas(container, {
            onrendered: function (snapshot) {
                var tempcanvas = document.createElement('canvas');
                    tempcanvas.width = container.clientWidth;
                    tempcanvas.height = container.clientHeight;
                var context = tempcanvas.getContext('2d');
                    context.drawImage(snapshot, 0, 0);
                var base64ImageString = tempcanvas.toDataURL('image/jpeg');
                // Save as a pdf
                var doc = new jsPDF();
                doc.addImage(base64ImageString, 'JPEG', 5, 20, 200, 250);
                doc.save('invoice_<?php echo $invoice->id; ?>.pdf');
            }
        });
    });

    $('#downloadInvoice').click(function () {
        var container = document.getElementById("invoiceTable");
        html2canvas(container, {
            onrendered: function (snapshot) {
                var tempcanvas = document.createElement('canvas');
                tempcanvas.width = container.clientWidth;
                tempcanvas.height = container.clientHeight;
                var context = tempcanvas.getContext('2d');
                context.drawImage(snapshot, 0, 0);
                var base64ImageString = tempcanvas.toDataURL('image/jpeg');
                // Download image
                var image = base64ImageString.replace("image/png", "application/octet-stream;headers=Content-Disposition: attachment; filename=invoice.png");
                var anchor = document.getElementById('image');
                anchor.href = image;
                anchor.download = 'invoice_'+Date.now()+'.png';
                anchor.click();
            }
        });
    });
});

function printDiv() {
    var container = document.getElementById("invoiceTable");
    html2canvas(container, {
        onrendered: function (snapshot) {
            var tempcanvas = document.createElement('canvas');
                tempcanvas.width = container.clientWidth;
                tempcanvas.height = container.clientHeight;
            var context = tempcanvas.getContext('2d');
                context.drawImage(snapshot, 0, 0);
            var base64ImageString = tempcanvas.toDataURL('image/jpeg');
            // Print image
            var oldPage = document.body.innerHTML; //Get the HTML of whole page
            document.body.innerHTML ="<html><head><title></title></head><body><img style='margin:10px 60px' src='" + base64ImageString + "'/></body>";
            setTimeout(function() {
                window.print(); //Print Page
                document.body.innerHTML = oldPage; //Restore orignal HTML
            }, 1000)
        }
    });
}
</script>

<script type="text/javascript">
  // set the date we're counting down to
  var target_date = new Date('<?php echo $invoice->expiryFullDate; ?>').getTime();
  var target_date = '<?php echo $invoice->expiryUnixtime * 1000; ?>';
  var invoiceStatus = "<?php echo $invoice->status; ?>";

  // variables for time units
   var days, hours, minutes, seconds;

  // get tag element
   var countdown = document.getElementById('countdown');
   var ccc = new Date().getTime();
   if(invoiceStatus == "unpaid"){
        // update the tag with id "countdown" every 1 second
        setInterval(function () {

      // find the amount of "seconds" between now and target
       var current_date = new Date().getTime();
       var seconds_left = (target_date - current_date) / 1000;

      // do some time calculations
       days = parseInt(seconds_left / 86400);
       seconds_left = seconds_left % 86400;
       hours = parseInt(seconds_left / 3600);
       seconds_left = seconds_left % 3600;
       minutes = parseInt(seconds_left / 60);
       seconds = parseInt(seconds_left % 60);

      // format countdown string + set tag value
       countdown.innerHTML = '<span class="days">' + days +  ' <b><?php echo trans("0440");?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441");?></b></span> <span class="minutes">'
       + minutes + ' <b><?php echo trans("0442");?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443");?></b></span>';
       }, 1000);
   }

  $(function(){
  $(".submitresult").hide();
  loadPaymethodData();
  $(".arrivalpay").on("click",function(){
  var id = $(this).prop("id");
  var module = $(this).data("module");
  var check = confirm("<?php echo trans('0483')?>");
  if(check){
  $.post("<?php echo base_url();?>invoice/updatePayOnArrival", {id: id,module: module}, function(resp){
  location.reload();
  }); }
  });

  $('#response').on('click','input[type="image"],input[type="submit"]',function(){
  setTimeout(function(){

  $("#response").html("<div id='rotatingDiv'></div>");
  }, 500)
  });

  $("#gateway").on("change",function(){
  var gateway = $(this).val();
  $("#response").html("<div id='rotatingDiv'></div>");
  $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){

 var response = $.parseJSON(resp);
  console.log(response);
    if(response.gateway === 'paystack') {
      if(response.htmldata.status === 'success') {
        window.location.href = response.htmldata.message;
      }
    } else {
        if(response.iscreditcard == "1"){
          $(".creditcardform").fadeIn("slow");
          $("#creditcardgateway").val(response.gateway);
          $("#response").html("");
          }else{
          $(".creditcardform").hide();
          $("#response").html(response.htmldata);
          }
    }
  });
  })
  });
   function expcheck(){
   $(".submitresult").html("").fadeOut("fast");
   var cardno = $("#card-number").val();
   var firstname = $("#card-holder-firstname").val();
   var lastname = $("#card-holder-lastname").val();
   var minMonth = new Date().getMonth() + 1;
   var minYear = new Date().getFullYear();
   var month = parseInt($("#expiry-month").val(), 10);
   var year = parseInt($("#expiry-year").val(), 10);

   if($.trim(firstname) == ""){
   $(".submitresult").html("Enter First Name").fadeIn("slow");
   return false;
   }else if($.trim(lastname) == ""){
   $(".submitresult").html("Enter Last Name").fadeIn("slow");
   return false;
   }else if($.trim(cardno) == ""){
   $(".submitresult").html("Enter Card number").fadeIn("slow");
   return false;
   }else if(month <= minMonth && year <= minYear){
   $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");
   return false;

   }else{
   $(".paynowbtn").hide();
   $(".submitresult").removeClass("alert-danger");
   $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");
   }
   }

   function loadPaymethodData(){
   var gateway = $("#gateway").val();
   var invoiceStatus = "<?php echo $invoice->status; ?>";

   if(invoiceStatus == "unpaid"){
   if(gateway != ""){
   $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
   var response = $.parseJSON(resp);
   console.log(response);
   if(response.iscreditcard == "1"){
   $(".creditcardform").fadeIn("slow");
   $("#creditcardgateway").val(response.gateway);
   $("#response").html("");
   }else{
   $(".creditcardform").hide();
   $("#response").html(response.htmldata);
   }
   });
   }
   }
   }
</script>

<script src="<?php echo base_url(); ?>themes/default/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>themes/default/assets/js/scripts.js"></script>

