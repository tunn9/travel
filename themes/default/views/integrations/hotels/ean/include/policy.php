<h4> <strong><i class="fa fa-briefcase text-warning"></i> <?php echo trans('0405');?> <?php echo trans('040');?></strong></h4>

    <table class="table">

      <tbody>
        <tr>
         <th scope="row"><i class="fa fa-clock-o text-warning"></i> <?php echo trans('0406');?></th>
          <td><p><strong><?php if(!empty($details[0]->hotel_check_in)){ ?> <?php echo trans('07');?> </strong> :   <?php echo $details[0]->hotel_check_in;?>  <?php } ?> </p></td>
          <td><p><strong><?php if(!empty($details[0]->hotel_check_out)){ ?> <?php echo trans('09');?> </strong> :   <?php echo $details[0]->hotel_check_out;?>  <?php } ?>  </p></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        <tr>
         <th scope="row"><i class="fa fa-automobile text-warning"></i> <?php echo trans('0356');?></th>
          <td><p><?php if(!empty($details[0]->hotel_from_airport)){ ?>  <?php echo trans('0357');?> :                   <?php if(!empty($details[0]->hotel_from_airport)){ ?>  <?php echo $details[0]->hotel_from_airport;?> <?php } ?>   <?php } ?> <?php echo trans('0370');?></p></td>
          <td><p><?php if(!empty($details[0]->hotel_from_city)){ ?>  <?php echo trans('0358');?>   :                   <?php if(!empty($details[0]->hotel_from_city)){ ?>  <?php echo $details[0]->hotel_from_city;?> <?php } ?>   <?php } ?> <?php echo trans('0370');?></p></td>
          <td><p><?php if(!empty($details[0]->hotel_from_market)){ ?>  <?php echo trans('0359');?>   :                   <?php if(!empty($details[0]->hotel_from_market)){ ?>  <?php echo $details[0]->hotel_from_market;?> <?php } ?>   <?php } ?> <?php echo trans('0370');?></p></td>
          <td><p><?php if(!empty($details[0]->hotel_from_hospital)){ ?> <?php echo trans('0360');?>   :                   <?php if(!empty($details[0]->hotel_from_hospital)){ ?>  <?php echo $details[0]->hotel_from_hospital;?> <?php } ?>   <?php } ?> <?php echo trans('0370');?></p></td>
          <td></td>
        </tr>

        <tr>
         <th scope="row"><i class="fa fa-street-view text-warning"></i> <?php echo trans('0361');?></th>
          <td><p><?php echo trans('0362');?>  : <?php if($details[0]->hotel_pets == "1"){ echo trans('0363'); }else{ echo trans('0364'); } ?></p></td>
          <td><p><?php echo trans('0365');?>  : <?php if(!empty($details[0]->hotel_parking)){ ?>  <?php echo $details[0]->hotel_parking;?> <?php } ?></p></td>
          <td><p><?php echo trans('0366');?>  : <?php if($details[0]->hotel_smoking == "1"){ echo trans('0363'); }else{ echo trans('0364'); } ?></p></td>
          <td><p><?php echo trans('0367');?>  : <?php if($details[0]->hotel_drinking == "1"){ echo trans('0363'); }else{ echo trans('0364'); } ?></p></td>
          <td></td>
        </tr>

                <?php $ptypes = $details[0]->hotel_payment_opt; if(!empty($ptypes)){ ?>
        <tr>
         <th scope="row"><i class="fa fa-dollar text-warning"></i> <?php echo trans('0407');?></th>
         <?php
                  $items = explode(",",$ptypes);
                  $payments = pt_get_types_details('hpayments',$items);

                  foreach($payments as $p){
                  ?>

          <td><p><strong><i class="fa fa-check text-warning"></i></strong> <?php echo ucwords($p->sett_name);?></p></td>
         <?php } ?>
                   <td></td>

        </tr>
          <?php } ?>
      </tbody>
    </table>


<h4> <strong><i class="fa fa-dot-circle-o text-warning"></i> <?php echo trans('0148');?></strong></h4>
<div class="line2"></div>
<p><?php echo $policy;?></p>


