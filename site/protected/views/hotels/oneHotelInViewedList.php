<!-- not ready - what page? -->
<? if($dataHotelInfo!=null and count($dataHotelInfo)) { ?>
    <div class="hotel_info">
        <a href="/hotels/info/?id=<?=$dataHotelInfo['hotel_id']?>">
            <img alt="hotel" class="v-aM floatL index"
                 src=<?=$dataHotelInfo['hotel_photo']?>
                >
        </a>
        <div class="floatR bal">Потрясающе,
            <div class="ocenka"><?=$dataHotelInfo['review']?></div>
        </div>
        <div class="rating clearfix">
            <? for($index=1; $index<=$dataHotelInfo['class']; $index++) { ?>
                <span></span>
            <? } ?>
        </div>
        <div class="name">
            <a href="/hotels/info/?id=<?=$dataHotelInfo['hotel_id']?>"><?=$dataHotelInfo['name']?></a>
        </div>
        <div class="adress"><?=$dataHotelInfo['address']?></div>
        <div class="cena"><i>от <?=$dataHotelInfo['min_price']?></i></div>
        <div class="plashka"></div>
    </div>
<? } ?>