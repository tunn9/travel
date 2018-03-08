<style>
  .fotorama__wrap {
  width: 100% !important;
  }
</style>

<div class="col-md-7 go-right">
<div class="fotorama bg-dark" data-allowfullscreen="true" data-nav="thumbs">
<?php foreach($HotelImages['HotelImage'] as $hi){ ?>
<img src="<?php echo $hi['url']; ?>" />
<?php } ?>
</div>
<div class="visible-xs visible-sm"><div style="margin-top:25px"></div></div>
</div>

