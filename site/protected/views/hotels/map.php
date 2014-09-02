<!-- ready -->
<div class="main_wrapper">
    <? $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list map_page">
        <img
            src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $hotel['latitude'] ?>,<?= $hotel['longitude'] ?>&zoom=12&size=320x200&markers=color:red%7C<?= $hotel['latitude'] ?>,<?= $hotel['longitude'] ?>"
            alt="" class="map">
    </div>
</div><!-- main_wrapper -->

