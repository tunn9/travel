<?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } ?>
<form action="" method="POST">
    <div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title pull-left">Ivisa Settings</span>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="spacer20px">
            <div class="panel-body">
                <div class="form-horizontal  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <div class="form-group">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Show Header/Footer</td>
                                        <td>
                                            <select  class="form-control" name="showheaderfooter">
                                                <option  value="yes" <?php if($settings->showHeaderFooter == "yes"){ echo "selected";} ?>   >Enable</option>
                                                <option  value="no"  <?php if($settings->showHeaderFooter == "no"){ echo "selected";} ?>  >Disable</option>
                                            </select>
                                        </td>
                                        <td>Enable/Disable to load header/footer </td>
                                    </tr>

                                    <tr>
                                        <td>Affiliate ID</td>
                                        <td>
                                            <input type="" class="form-control" name="aid" placeholder="Affiliate ID" value="<?php echo $settings->aid;?>" />
                                        </td>
                                        <td>Input your Affiliate ID here</td>
                                    </tr>
                                    <tr>
                                        <td>Header title</td>
                                        <td>
                                            <input type="text" name="headertitle" class="form-control" placeholder="title" value="<?php echo $settings->headerTitle;?>" />
                                        </td>
                                        <td>Write your listing page header title here</td>
                                    </tr>
                                    <tr>
                                        <td>From Country</td>
                                        <td>
                                            <input type="text" name="from" class="form-control" placeholder="From" value="<?php echo $settings->from;?>" />
                                        </td>
                                        <td>Type the name of country which</td>
                                    </tr>
                                    <tr>
                                        <td>To Country</td>
                                        <td>
                                            <input type="text" name="to" class="form-control" placeholder="To" value="<?php echo $settings->to;?>" />
                                        </td>
                                        <td>Type the name of country which</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <input type="hidden" name="updatesettings" value="1" />
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>
