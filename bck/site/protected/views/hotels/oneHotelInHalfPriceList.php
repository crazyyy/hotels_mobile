
<? if($dataHotelInfo!=null and count($dataHotelInfo)) { ?>
    <div class="hotel_info">
        <a href="/hotels/info/?id=<?=$dataHotelInfo['hotel_id']?>">
            <img alt="hotel" class="v-aM floatL index"
                 src=<?=$dataHotelInfo['hotel_photo']?>
                >
        </a>
        <? if(isset($dataHotelInfo['review'])) { ?>
            <div class="floatR bal">Потрясающе,
                <div class="ocenka"><?=$dataHotelInfo['review']?></div>
            </div>
        <? } ?>
        <div class="star">
            <? for($index=1; $index<=$dataHotelInfo['class']; $index++) { ?>
                <img src="/images/icon_star.png" alt="hotel" class="v-aM dispIB">
            <? } ?>
        </div>
        <div class="name">
            <a href="/hotels/info/?id=<?=$dataHotelInfo['hotel_id']?>"><?=$dataHotelInfo['name']?></a>
        </div>
        <div class="adress"><?=$dataHotelInfo['address']?></div>
        <div class="cena">
            <strong>от <?=$data['discount_price']?> грн</strong>
            <span>от <?=$data['base_price']?> грн</span>
        </div>
        <div class="plashka-skidka"></div>
    </div>
<? } ?>