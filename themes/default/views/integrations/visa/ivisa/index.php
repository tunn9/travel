<?php
$api_params = array('nationality_country' => $filteredCountires['nationality_country']['iso2'], 'destination_country' => $filteredCountires['destination_country']['iso2'], 'utm_source'=> $affiliate_code);
$api_resp = json_decode(file_get_contents('http://www.ivisa.com/api/visa_required?' . http_build_query($api_params)), true);
// NOTE: use bootstrap=0   jquery=0  jquery_ui=0  if these libaries are already loaded on your page
if($api_resp['ivisa_supported'] == 1)
  $application_html = file_get_contents($api_resp['application_url'] . 'mode=embed&bootstrap=0&jquery=0&utm_source='.$affiliate_code);
else
  $application_html = $api_resp['error_msg'];
?>
<style>
.ivisa-applicant-fields input,select { padding: 8px !important; padding-right: 0 !important; padding-left: 5px !important; height: 40px !important; font-size: 12px !important; line-height: 1.5 !important; border-radius: 0px !important; margin-top: 8px !important; }
.promo-section { position: relative; text-align: center; background-position: 50% 50%; background-repeat: no-repeat; background-size: cover; overflow: hidden; height: 250px; display: table; width: 100%; color: #fff; background-color: #1a2028; margin-bottom: 25px; }
.promo-section > .cell { display: table-cell; vertical-align: middle; padding: 70px 0 70px; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 15; }
.promo-section .overlay { position: absolute; left: 0; top: 0; right: 0; bottom: 0; display: block; width: 100%; height: 100%; z-index: 10; opacity: 0.9; }
.ivisa-submit-step1-button { display: block; width: 100%; }
</style>

<section class="promo-section sm" style="background-image: url(<?php echo $theme_url; ?>assets/img/visa.jpg)">
    <div class="cell light">
        <div class="container">
            <div class="text">
                <h3 data-wow-duration="0.3s" data-wow-delay="0.5s" class="cw wow fadeIn title animated animated">
                    <strong><?=$filteredCountires['nationality_country']['short_name']; ?></strong> &#x2794; <strong><?=$filteredCountires['destination_country']['short_name']; ?></strong>
                </h3>
                <h5 data-wow-duration="0.3s" data-wow-delay="0.6s" class="cw wow fadeIn sub-title animated animated"><?php echo trans('0590');?></h5>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</section>

<div class="container">
<span style="font-size:16px"><?php echo $application_html ?></span>
</div>
<div style="margin-bottom:50px"></div>
