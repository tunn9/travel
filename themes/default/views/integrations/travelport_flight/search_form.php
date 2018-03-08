<style> .modal-backdrop { z-index: 0; } </style>
<?php 
    // $requestType = $travelportSearchFormData['requestType']; // Ajax or PHP
    $query = new StdClass();
    $query->triptype = 'oneway';
    $query->cabinclass = 'economy';
    $query->origin = ""; // requestType->default_origin;
    $query->destination = ""; // $travelportSearchFormData['configuration']->default_destination;
    // $tomorrow = date("Y-m-d", time() + 86400);
    $query->departure = ""; // $tomorrow;
    $query->arrival = ""; // sprintf('%s-%s', date('Y-m') . ((date('d') + 1)) );
    $query->passenger = array(
        'total' => 1,
        'adult' => 1,
        'children' => 0,
        'infant' => 0
    );
    if (isset($_SESSION['searchQuery']) && ! empty($_SESSION['searchQuery'])) {
        $query = (Object) $_SESSION['searchQuery'];
    }
?>
<form autocomplete="off" name="flightSearch" action="<?php echo base_url('flight/search'); ?>" method="GET" role="search">
    <div class="trip-check">
        <div class="col-md-4 col-xs-6">
            <div class="pure-checkbox">
                <input id="oneway" name="triptype" type="radio" class="checkbox triptype" value="oneway" data-type="oneway" <?php if($query->triptype == "oneway") { ?> checked <?php } ?>>
                <label for="oneway" data-type="oneway">&nbsp;<?php echo trans('0384');?></label>
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="pure-checkbox">
                <input id="round" name="triptype" type="radio" class="checkbox triptype" value="round" data-type="round" <?php if($query->triptype == "round") { ?> checked <?php } ?>>
                <label for="round" data-type="round">&nbsp;<?php echo trans('0385');?> </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="go-text-right">
            <div class="col-md-6 form-group go-right col-xs-12">
                <label class="go-right"><?php echo trans('0119'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-41"></i>
                <input type="text" name="origin" class="widget-select2" required value="<?php echo $query->origin; ?>">
            </div>
        </div>
        <div class="go-text-right">
            <div class="col-md-6 form-group go-right col-xs-12">
                <label class="go-right"><?php echo trans('0120'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-41"></i>
                <input type="text" name="destination" class="widget-select2" required value="<?php echo $query->destination; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
            <label class="go-right"><?php echo trans('0472');?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('0472'); ?>" name="departure" value="<?php echo $query->departure; ?>" class="form input-lg departureTime" required>
        </div>
        <div class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
            <label class="go-right"><?php echo trans('0473');?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('0473'); ?>" name="arrival" value="<?php echo $query->arrival; ?>" class="form input-lg arrivalTime">
        </div>
        <div class="go-text-right">
            <div class="col-md-6 form-group go-right col-xs-12">
                <label class="go-right"><?php echo trans('0557');?></label>
                <div class="clearfix"></div>
                <select class="form-control fs12" name="cabinclass">
                    <option value="economy" <?php echo ($query->cabinclass == "economy") ? "selected" : ""; ?>><?php echo trans('0552');?></option>
                    <option value="business" <?php echo ($query->cabinclass == "business") ? "selected" : ""; ?>><?php echo trans('0553');?></option>
                    <option value="first" <?php echo ($query->cabinclass == "first") ? "selected" : ""; ?>><?php echo trans('0554');?></option>
                </select>
            </div>
        </div>
        <div class="col-md-6 form-group go-right col-xs-12">
            <label class="go-right"><?php echo trans('0446');?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-70"></i>
            <input type="text" name="totalPassenger" value="<?php echo $query->passenger['total']; ?>" placeholder="0" class="form input-lg" data-toggle="modal" data-target="#flightTravelers" required>
        </div>
        <div class="bgfade col-md-12 col-xs-12">
            <div class="clearfix"></div>
            <button type="submit"  class="btn-danger btn btn-lg btn-block pfb0">
            <i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?>
            </button>
        </div>
    </div>
    <!--/ .row -->
    <div class="modal fade" id="flightTravelers" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm wow flipInY" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo trans('0533');?></h4>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="form-input" class="col-sm-3 col-xs-3 control-label"><?php echo trans('010');?></label>
                                <div class="col-sm-5 col-xs-5">
                                    <select class="travellercount form-control" name="adult">
                                        <option value="1" <?php echo ($query->passenger['adult'] == 1) ? "selected" : ""; ?>>1</option>
                                        <option value="2" <?php echo ($query->passenger['adult'] == 2) ? "selected" : ""; ?>>2</option>
                                        <option value="3" <?php echo ($query->passenger['adult'] == 3) ? "selected" : ""; ?>>3</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <label class="help-block">(12+yrs)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-input" class="col-sm-3 col-xs-3 control-label"><?php echo trans('011');?></label>
                                <div class="col-sm-5 col-xs-5">
                                    <select class="travellercount form-control" name="children" value="<?php echo $query->passenger['children']; ?>">
                                        <option value="0" <?php echo ($query->passenger['children'] == 0) ? "selected" : ""; ?>>0</option>
                                        <option value="1" <?php echo ($query->passenger['children'] == 1) ? "selected" : ""; ?>>1</option>
                                        <option value="2" <?php echo ($query->passenger['children'] == 2) ? "selected" : ""; ?>>2</option>
                                        <option value="3" <?php echo ($query->passenger['children'] == 3) ? "selected" : ""; ?>>3</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <label class="help-block">(4+yrs)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-input" class="col-sm-3 col-xs-3 control-label"><?php echo trans('0282');?></label>
                                <div class="col-sm-5 col-xs-5">
                                    <select class="travellercount form-control" name="infant" value="<?php echo $query->passenger['infant']; ?>">
                                        <option value="0" <?php echo ($query->passenger['infant'] == 0) ? "selected" : ""; ?>>0</option>
                                        <option value="1" <?php echo ($query->passenger['infant'] == 1) ? "selected" : ""; ?>>1</option>
                                        <option value="2" <?php echo ($query->passenger['infant'] == 2) ? "selected" : ""; ?>>2</option>
                                        <option value="3" <?php echo ($query->passenger['infant'] == 3) ? "selected" : ""; ?>>3</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <label class="help-block">(2+yrs)</label>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-block btn-lg bb" data-dismiss="modal" id="sumPassenger"><?php echo trans('0233');?></button>
                </div>
            </div>
        </div>
    </div>
    <!--/ .modal -->
</form>

<script>
    // First, checks if it isn't implemented yet.
    if (!String.prototype.format) {
            String.prototype.format = function() {
                    var args = arguments;
                    return this.replace(/{(\d+)}/g, function(match, number) {
                    return typeof args[number] != 'undefined'
                            ? args[number]
                            : match
                    ;
                    });
            };
    }

    $(function(){

            var adult = parseInt($("[name='adult']").val()); // Should be 1
            var children = parseInt($("[name='children']").val());
            var infant = parseInt($("[name='infant']").val());
            var totalPassenger = (adult + children + infant);
            var triptype = 'oneway';

            var arrivalDatetimePicker = $("[name='arrival']");
            arrivalDatetimePicker.attr('disabled', 'disabled').css('background', '#d9d9d9');
            $(".trip-check label, .iCheck-helper").on('click', function() {
                    triptype = $(this).parent().find("input").val();
                    if (triptype == 'oneway') {
                            arrivalDatetimePicker.attr('disabled', 'disabled').css('background', '#d9d9d9');
                            arrivalDatetimePicker.removeAttr('required');
                    } else {
                            arrivalDatetimePicker.removeAttr('disabled').css('background', '#F9F9F9');
                            arrivalDatetimePicker.attr('required', 'required');
                    }
                    arrivalDatetimePicker.val('');
            });

            $(".widget-select2").select2({
                    placeholder: "Enter Location",
                    minimumInputLength: 3,
                    width: '100%',
                    maximumSelectionSize: 1,
                    ajax:{
                            url: '<?php echo base_url('Suggestions/airports'); ?>',
                            dataType: 'json',
                            data: function(term, page) {
                                    return {
                                            q: term
                                    }
                            },
                            results: function(data, page) {
                                    return {
                                            results: data
                                    }
                            }
                    },
                    initSelection : function (element, callback) {
                        var elementText = $(element).val();
                        callback({"text": elementText, "id": elementText});
                    }
            });

            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
            // Depature time
            var departureTime = $('.departureTime').datepicker({
                    format: 'yyyy-mm-dd',
                    onRender: function(date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
            })
            .on('changeDate', function(e){
                    $(this).datepicker('hide');
                    if (triptype == 'round') {
                            var newDate = new Date(e.date);
                            arrivalTime.setValue(newDate.setDate(newDate.getDate() + 1));
                            $('.arrivalTime').focus();
                    }
            }).data('datepicker');

            // Arrival time
            var arrivalTime = $('.arrivalTime').datepicker({
                    format: 'yyyy-mm-dd',
                    onRender: function(date) {
                        return date.valueOf() <= departureTime.date.valueOf() ? 'disabled' : '';
                    }
            }).on('changeDate', function(){
                    $(this).datepicker('hide');
            }).data('datepicker');

            // Default fill up date
            if(departureTime.element.val()) {
                departureTime.setValue(departureTime.element.val());
            }
            if(arrivalTime.element.val()) {
                arrivalTime.setValue(arrivalTime.element.val());
            }


            $("[name='adult']").on('change', function() { adult = parseInt($(this).val()); });
            $("[name='children']").on('change', function() { children = parseInt($(this).val()); });
            $("[name='infant']").on('change', function() { infant = parseInt($(this).val()); });
            $("#sumPassenger").on('click', function() {
                    totalPassenger = (adult + children + infant);
                    $("[name='totalPassenger']").val(totalPassenger);
            });

            $("form[name='flightSearch']").on('submit', function(e) {
                    e.preventDefault();
                    var payload = {
                            triptype: triptype,
                            cabinclass: $('[name="cabinclass"]').val(),
                            passenger: {
                                    total: totalPassenger,
                                    adult: adult,
                                    children: children,
                                    infant: infant
                            },
                            origin: $(this).find("[name='origin']").val(),
                            destination: $(this).find("[name='destination']").val(),
                            departure: $(this).find("[name='departure']").val(),
                            arrival: $(this).find("[name='arrival']").val(),
                    };

                    $('.loader-wrapper').show();
                    $.post(base_url + 'flight/getLowFareFlights', payload, function(response) {
                            $('.loader-wrapper').hide();
                            $('#body-section').html(response.body);
                            window.history.pushState("", "", get_path('flight/search', payload));
                    });
            });
    });

    function get_path(req, payload)
    {
        var return_hash = "{0}/{1}/{2}/{3}".format(req, payload.origin, payload.destination, payload.departure);

        if (payload.arrival) {
                return_hash = "{0}/{1}".format(return_hash, payload.arrival)
        }
        if (payload.cabinclass) {
                return_hash = "{0}/{1}".format(return_hash, payload.cabinclass)
        }
        if (payload.passenger.adult) {
                return_hash = "{0}/{1}Adult".format(return_hash, payload.passenger.adult)
        }
        if (payload.passenger.children) {
                return_hash = "{0}/{1}Children".format(return_hash, payload.passenger.children)
        }
        if (payload.passenger.infant) {
                return_hash = "{0}/{1}Infant".format(return_hash, payload.passenger.infant)
        }

        return base_url + return_hash;
    }
</script>