<form action="" method="POST">
  <div class="panel panel-default">
    <div class="panel-heading">
      <span class="panel-title pull-left"> <?php echo trans('0205');?></span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="spacer20px">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo trans('0119');?> </h3>
          </div>
          <div class="panel-body">
            <div class="form-horizontal  col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <div class="form-group">
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        <td><?php echo trans('0206');?></td>
                        <td style="width:380px">
                          <input type="text" name="page_icon" class="form-control" placeholder="Select icon" value="<?php echo $settings[0]->front_icon;?>" >
                        </td>
                        <td><?php echo trans('0207');?></td>
                      </tr>
                      <tr>
                        <td><?php echo trans('0208');?></td>
                        <td>
                          <select  class="form-control" name="target">
                            <option  value="_self" <?php makeSelected('_self',$settings[0]->linktarget); ?> ><?php echo trans('0177');?></option>
                            <option  value="_blank" <?php makeSelected('_blank',$settings[0]->linktarget); ?> ><?php echo trans('0178');?></option>
                          </select>
                        </td>
                        <td><?php echo trans('0209');?></td>
                      </tr>
                      <tr>
                        <td><?php echo trans('0210');?></td>
                        <td>
                          <input type="text" class="form-control" name="headertitle" value="<?php echo $settings[0]->header_title;?>" placeholder="title "/>
                        </td>
                        <td><?php echo trans('0211');?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Display</h3>
          </div>
          <div class="panel-body">
            <div class="form-horizontal  col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <label class="col-md-3 control-label"><?php echo trans('0212');?></label>
              <div class="col-md-2">
                <input class="form-control" type="text" placeholder="" name="home"  value="<?php echo $settings[0]->front_homepage;?>">
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0213');?> </label>
                <div class="col-md-3">
                  <select class="form-control" name="order">
                    <option value="ol" label="By Order Given" <?php if ($settings[0]->front_homepage_order == "ol") {echo "selected";}?><?php echo trans('0216');?></option>
                    <option value="newf" label="By Latest First" <?php if ($settings[0]->front_homepage_order == "newf") {echo "selected";}?><?php echo trans('0217');?></option>
                    <option value="oldf" label="By Oldest First" <?php if ($settings[0]->front_homepage_order == "oldf") {echo "selected";}?><?php echo trans('0218');?></option>
                    <option value="az" label="Ascending Order (A-Z)" <?php if ($settings[0]->front_homepage_order == "az") {echo "selected";}?><?php echo trans('0219');?></option>
                    <option value="za" label="Descending  Order (Z-A)" <?php if ($settings[0]->front_homepage_order == "za") {echo "selected";}?><?php echo trans('0220');?></option>
                  </select>
                </div>
              </div>
              <div class="row">
                <label class="col-md-3 control-label"><?php echo trans('0214');?> </label>
                <div class="col-md-2">
                  <select class="form-control" name="showonhomepage">
                    <option value="Yes" <?php if ($settings[0]->front_homepage_hero == "Yes") {echo "selected";}?>><?php echo trans('058');?></option>
                    <option value="No" <?php if ($settings[0]->front_homepage_hero == "No") {echo "selected";}?> ><?php echo trans('059');?></option>
                  </select>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0215');?></label>
                <div class="col-md-2">
                  <input class="form-control" type="text" placeholder="" name="listings"  value="<?php echo $settings[0]->front_listings;?>">
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"><?php echo trans('0213');?></label>
                  <div class="col-md-3">
                    <select class="form-control" name="listingsorder">
                      <option value="ol" label="By Order Given" <?php if ($settings[0]->front_listings_order == "ol") {echo "selected";}?>><?php echo trans('0216');?></option>
                      <option value="newf" label="By Latest First" <?php if ($settings[0]->front_listings_order == "newf") {echo "selected";}?> ><?php echo trans('0217');?></option>
                      <option value="oldf" label="By Oldest First" <?php if ($settings[0]->front_listings_order == "oldf") {echo "selected";}?>><?php echo trans('0218');?></option>
                      <option value="az" label="Ascending Order (A-Z)" <?php if ($settings[0]->front_listings_order == "az") {echo "selected";}?>><?php echo trans('0219');?></option>
                      <option value="za" label="Descending  Order (Z-A)" <?php if ($settings[0]->front_listings_order == "za") {echo "selected";}?>><?php echo trans('0220');?></option>
                    </select>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0221');?></label>
                <div class="col-md-2">
                  <input class="form-control" type="text" placeholder="" name="searchresult"  value="<?php echo $settings[0]->front_search;?>">
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"><?php echo trans('0222');?></label>
                  <div class="col-md-3">
                    <select class="form-control" name="searchorder">
                      <option value="ol" label="By Order Given" <?php if ($settings[0]->front_search_order == "ol") {echo "selected";}?><?php echo trans('0216');?></option>
                      <option value="newf" label="By Latest First" <?php if ($settings[0]->front_search_order == "newf") {echo "selected";}?><?php echo trans('0217');?></option>
                      <option value="oldf" label="By Oldest First" <?php if ($settings[0]->front_search_order == "oldf") {echo "selected";}?><?php echo trans('0218');?></option>
                      <option value="az" label="Ascending Order (A-Z)" <?php if ($settings[0]->front_search_order == "az") {echo "selected";}?><?php echo trans('0219');?></option>
                      <option value="za" label="Descending  Order (Z-A)" <?php if ($settings[0]->front_search_order == "za") {echo "selected";}?><?php echo trans('0220');?></option>
                    </select>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0223');?></label>
                <div class="col-md-2">
                  <input class="form-control" type="text" placeholder="" name="related"  value="<?php echo $settings[0]->front_related;?>">
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"><?php echo trans('0203');?></label>
                  <div class="col-md-3">
                    <select class="form-control" name="relatedstatus">
                      <option value="1" <?php if ($settings[0]->testing_mode == "1") {echo "selected";}?> ><?php echo trans('053');?></option>
                      <option value="0" <?php if ($settings[0]->testing_mode == "0") {echo "selected";}?> ><?php echo trans('054');?></option>
                    </select>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0224');?></label>
                <div class="col-md-2">
                  <input class="form-control" type="text" placeholder="" name="popular"  value="<?php echo $settings[0]->front_popular;?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   <div class="panel-footer">
  <input type="hidden" name="updatesettings" value="1" />
  <input type="hidden" name="updatefor" value="blog" />
  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo trans('037');?></button>  </div>
  </div>
</form>