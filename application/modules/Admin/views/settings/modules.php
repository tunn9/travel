<style>
    .btn-enable {
    background-color: #00bd00;
    color: white;
    }
    .btn-enable:hover {
    background-color: #00A300;
    color: white;
    }
    .btn-info {
    color: #ffffff;
    background-color: #f70000;
    border-color: #cc0000;
    }
    .btn-info:hover {
    color: #ffffff;
    background-color: #E60000;
    border-color: #cc0000;
    }
    .btn-warning {
    color: #ffffff;
    background-color: #007af3;
    border-color: #0963bb;
    }
    .btn-warning:hover {
    color: #ffffff;
    background-color: #0073E6;
    border-color: #0963bb;
    }
    table td {
    text-transform: uppercase;
    }
</style>
<script>
    $(function(){
    slideout();
    var baseurl = $('base').attr('href');
    // disable selected Module
    $('.disable_selected').click(function(){
    var modules = new Array();
    $("input:checked").each(function() {
    modules.push($(this).val());
    });
    var count_checked = $("[name='module_ids[]']:checked").length;
    if(count_checked == 0) {
    $.alert.open('info', 'Please select a Module to Disable.');
    return false;
    }
    $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/disable_multiple_modules", { modulelist: modules }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";

    });});});
    // enable selected Module
    $('.enable_selected').click(function(){
    var modules = new Array();
    $("input:checked").each(function() {
    modules.push($(this).val());
    });
    var count_checked = $("[name='module_ids[]']:checked").length;
    if(count_checked == 0) {
    $.alert.open('info', 'Please select a Module to Enable.');
    return false;
    }
    $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/enable_multiple_modules", { modulelist: modules }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";
    });});});
    // Enable single Module
    $(".enable_single").click(function(){
    var id = $(this).attr('id');
    $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/enable_single_module", { moduleid: id }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";
    });});});
    // Disable single Module
    $(".disable_single").click(function(){
    var id = $(this).attr('id');
    $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/disable_single_module", { moduleid: id }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";
    });});});
    // Enable Main Module
    $(".enable_main").click(function(){
        var id = $(this).attr('id');
        if (id == 'travelpayoutshotels') {
            $.alert.open('alert', 'Please go to settings page', function(answer) {});
        } else {
            $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
                if (answer == 'yes') {
                    $.post("<?php echo base_url();?>admin/ajaxcalls/enable_main_module", { modulename: id }, function(theResponse){
                        window.location = baseurl+"admin/settings/redirectSettings/modules";
                    });
                }
            });
        }
    });
    // Disable Main Module
    $(".disable_main").click(function(){
        var id = $(this).attr('id');
        if (id == 'travelpayoutshotels') {
            $.alert.open('alert', 'Please go to settings page', function(answer) {});
        } else {
            $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
                if (answer == 'yes') {
                    $.post("<?php echo base_url();?>admin/ajaxcalls/disable_main_module", { modulename: id }, function(theResponse){
                        window.location = baseurl+"admin/settings/redirectSettings/modules";
                    });
                }
            });
        }
    }); 
});
</script>
<div class="panel panel-default">
    <div class="panel-heading"> Modules Management</div>
    <div class="panel-body">
        <?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } ?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th align="center" style="width:55px;"><i style="margin-left: 14px;" class="fa fa-picture-o text-center center-block" data-toggle="tooltip" data-placement="top" title="Image"></i> </th>
                    <th><span class="fa fa-laptop" data-toggle="tooltip" data-placement="top" title="Module Name"></span> Module Name</th>
                    <!--<th style="width:50px;"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Status">&nbsp;</i></th>-->
                    <th><i class="fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Action"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $moduleslist = $this->ptmodules->read_config();
                    foreach($moduleslist as $modlist){ 
                        if(strtolower($modlist['Name']) == 'travelpayoutshotels') {
                            $isenabled = module_status_check('travelpayoutshotels');
                        } else {
                            $isenabled = $this->ptmodules->is_main_module_enabled(strtolower($modlist['Name']));   
                        }
                        // if(!in_array(strtolower($modlist['Name']),$this->ptmodules->integratedmoduleslist)){
                    ?>
                <tr>
                    <td align="center" class="zoom_img"><?php echo $modlist['Icon']; ?>  </td>
                    <td><?php echo $modlist['DisplayName'];?></td>
                    <!--<td>
                        <?php if($isenabled){ ?><span class="check"><i class="fa fa-check"  data-toggle="tooltip" data-placement="top" title="Enabled"></i></span> <?php }else{ ?>
                        <span class="times"><i class="fa fa-times"  data-toggle="tooltip" data-placement="top" title="Disabled"></i></span> <?php } ?>
                        </td>-->
                    <td align="">
                        <?php if(!$isenabled){ ?> 
                        <button class="btn btn-xs btn-enable enable_main" id="<?php echo strtolower($modlist['Name']);?>"><i class="fa fa-external-link"></i> enable</button>
                        <?php }
                        else{ ?><button class="btn btn-xs btn-info disable_main" id="<?php echo strtolower($modlist['Name']);?>" ><i class="fa fa-minus-square"></i> disable</button>
                        <?php } ?>

                        <?php if(strtolower($modlist['Name']) != 'flights'): ?>
                        <a href="<?php echo base_url(); ?>admin/<?php echo strtolower($modlist['Name']);?>/settings/"> <button class="btn btn-xs btn-warning"><i class="fa fa-table"></i> settings</button> </a>
                        <?php endif; ?>
                        
                        <?php if (strtolower($modlist['Name']) == "ean" && $isenabled) { ?>
                        <a href="<?php echo base_url();?>admin/<?php echo strtolower($modlist['Name']);?>/bookings/"> <button class="btn btn-xs btn-success"><i class="fa fa-gavel"></i> Bookings</button> </a>
                        <?php }?>
                    </td>
                </tr>
                <?php } //} ?>
                <?php
                    $count = 0;

                    foreach($modules as $mod){
                        if($mod->module_name != "reviews"){
                    $icons = '';

                    $ptitle  = $mod->module_name;
                    if($ptitle == 'reviews'){
                    $icons = "<i class='fa fa-smile-o'></i>";
                    }
                    if($ptitle == 'coupons'){
                    $icons = "<i class='fa fa-fa fa-asterisk'></i>";
                    }
                    if($ptitle == 'newsletter'){
                    $icons = "<i class='fa fa-envelope'></i>";
                    }
                    if($ptitle == 'offers'){
                        $i = pt_get_icon("offers");
                    $icons = "<i class='fa fa-gift'></i>";
                    }

                        $count++;
                    ?>
                <tr>
                    <td align="center" class="zoom_img"><?php echo $icons; ?>
                    </td>
                    <td><?php echo ucfirst($mod->module_display_name);?></td>
                    <!-- <td>
                        <?php if($mod->module_status == '1'){ ?><span class="check"><i class="fa fa-check"  data-toggle="tooltip" data-placement="top" title="Enabled"></i></span> <?php }else{ ?>
                        <span class="times"><i class="fa fa-times"  data-toggle="tooltip" data-placement="top" title="Disabled"></i></span> <?php } ?>
                        </td>-->
                    <td align="">
                        <?php if($mod->module_status == '0'){ ?> 
                            <button class="btn btn-xs btn-enable enable_single" id="<?php echo $mod->module_name;?>"><i class="fa fa-external-link"></i> enable</button>
                        <?php }else{ ?>
                            <button class="btn btn-xs btn-info disable_single" id="<?php echo $mod->module_name;?>" ><i class="fa fa-minus-square"></i> disable</button>
                        <?php } if($mod->module_name != "coupons" && $mod->module_name != "newsletter"){ ?>
                        <a href="<?php echo base_url(); ?>admin/<?php echo $mod->module_name;?>/settings/"> <button class="btn btn-xs btn-warning"><i class="fa fa-table"></i> settings</button> </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>