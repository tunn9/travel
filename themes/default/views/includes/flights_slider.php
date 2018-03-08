<?php if(pt_main_module_available('flights')){ ?>
    <section class="flights-home">
        <div class="container">
                <h2 class="destination-title">
                    <?php echo trans('0603');?>
                </h2>
            <div class="main_slider">
                <div class="flights" class="get">
                    <?php foreach($featuredFlights as $item){ ?>
                    <div class="flights-item">
                        <img class="" src="<?php echo $item->thumbnail; ?>">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>