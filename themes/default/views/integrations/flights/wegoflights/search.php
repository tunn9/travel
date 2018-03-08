<form action="<?php echo $wegourl; ?>" id="wego-flights-searchform" target="_blank">
<div class="col-md-2 form-group go-right col-xs-6">
<div class="row">
<label class="hidden-xs go-right"><?php echo trans('0119');?></label>
<div class="clearfix"></div>
<i class="iconspane-lg icon_set_1_icon-41"></i>
<input type="text" class="form input-lg RTL sterm searchInput wego-text wego-from ui-autocomplete-input" name="wg_origin" value="" data-value="" placeholder="<?php echo trans('0119'); ?>" required="" autocorrect="off" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
</div>
</div>

<div class="col-md-2 form-group go-right col-xs-6">
<div class="row">
<label class="hidden-xs go-right"><?php echo trans('0120');?></label>
<div class="clearfix"></div>
<i class="iconspane-lg icon_set_1_icon-41"></i>
<input type="text" class="form input-lg RTL sterm searchInput wego-text wego-to ui-autocomplete-input" name="wg_destination" required="" autocorrect="off" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" placeholder="<?php echo trans('0120'); ?>">
</div>
</div>

<div class="col-md-2 col-sm-3 col-xs-6 form-group go-right">
<div class="row">
<label class="hidden-xs go-right"><?php echo trans('0472');?></label>
<div class="clearfix"></div>
<i class="iconspane-lg icon_set_1_icon-53"></i>

<input type="text" class="wego-text wego-depart form input-lg mySelectCalendar go-text-left checkinsearch RTL" name="wg_outbound_date" >
</div>
</div>

<div class="col-md-2 col-sm-3 col-xs-6 form-group go-right">
<div class="row">
<label class="hidden-xs go-right"><?php echo trans('0473');?></label>
<div class="clearfix"></div>
<i class="iconspane-lg icon_set_1_icon-53"></i>

<input type="text" class="wego-text wego-return returnDate mySelectCalendar form input-lg checkinsearch RTL go-text-left" name="wg_inbound_date">
</div>
</div>

<div class="form-group col-md-1 col-xs-6 col-sm-3 go-right">
<div class="row">
<label class="hidden-xs go-right"><?php echo trans('010'); ?></label>
<div class="clearfix"></div>
<select name="wg_adult" id="wg_adult" class="input-lg form selectx">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</div>
</div>

<div class="form-group col-md-1 col-xs-6 col-sm-3 go-right">
<div class="row">
<label class="hidden-xs go-right"><?php echo trans('0282'); ?></label>
<div class="clearfix"></div>
<select name="wg_children" id="wg_children" class="input-lg form selectx">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</div>
</div>


<select style="display:none" id="wg_cabin_class" name="wg_cabin_class" class="">
<option value="economy" selected="selected">Economy</option>
<option value="business">Business</option>
<option value="first">First</option>
</select>

<input type="hidden" class="wego-from-code" name="wg_from" value="" data-value="">
<input type="hidden" class="wego-def-from-code" name="wg-def-from-code" value="" data-value="">
<input type="hidden" class="wego-to-code" name="wg_to" value="">
<input type="hidden" class="wego-def-to-code" name="wg-def-to-code" value="">
<input type="hidden" class="wego-ts-code" name="ts_code" value="4c362">
<input type="hidden" class="wego-locale" name="wg-locale" value="en">
<input type="hidden" class="wego-def-from ui-autocomplete-input" name="wg-def-from" value="" autocorrect="off" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
<input type="hidden" class="wego-def-to ui-autocomplete-input" name="wego-def-to" value="" autocorrect="off" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
<input type="hidden" class="wego-sub-id" name="sub_id" value="">
<input type="hidden" class="wg_trip_type" name="wg_trip_type" value="true">
<input type="hidden" id="white-label" value="1">

<div class="col-md-2 col-xs-12">
<div class="row">
<label class="hidden-xs hidden-sm">&nbsp;</label>
<div class="clearfix"></div>
<input type="submit" id="search-button" class="btn-primary btn btn-lg btn-block" value="<?php echo trans('0379'); ?>">
</div>
</div>
</form>
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="//www.wan.travel/assets/app/datepicker.css">
<link rel="stylesheet" type="text/css" href="//www.wan.travel/assets/app/v2/searchbox.css">
<script charset="UTF-8" src="//www.wan.travel/assets/wan/v2/searchbox.js?body=1"></script>
