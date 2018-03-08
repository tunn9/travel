<?php echo $this->render_table_name(); ?>

        <div class="xcrud-top-actions">
        <div class="btn-group pull-right">
        <?php if(!empty($this->multiDelUrl)){ ?>
        <a href="javascript: multiDelfunc('<?php echo $this->multiDelUrl;?>', '<?php echo $this->chkboxClass;?>')" style="position: absolute; right: 6px;margin-top: 10px;" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete Selected</a>
        <?php } ?>     
        <?php if ($this->is_csv or $this->is_print){ ?>
                <?php echo $this->print_button('btn btn-default','glyphicon glyphicon-print');
                echo $this->csv_button('btn btn-default','glyphicon glyphicon-file'); } ?>
        </div>
         <?php if ($this->is_create){ ?>
            <?php echo $this->add_button('btn btn-success','glyphicon glyphicon-plus-sign'); ?>
         <?php } ?>
        <div class="clearfix"></div>
        </div>

        <div class="xcrud-list-container">
        <table class="xcrud-list table table-striped table-hover">
            <thead>
                <?php echo $this->render_grid_head('tr', 'th'); ?>
            </thead>
            <tbody>
                <?php echo $this->render_grid_body('tr', 'td'); ?>
            </tbody>
            <tfoot>
                <?php echo $this->render_grid_footer('tr', 'td'); ?>
            </tfoot>
        </table>
        </div>
        <div class="xcrud-nav">
            <?php echo $this->render_limitlist(true); ?>
            <?php echo $this->render_pagination(); ?>
            <?php echo $this->render_search(); ?>
            <!-- <?php echo $this->render_benchmark(); ?> -->
        </div>
