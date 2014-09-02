<!-- ready -->
<? if($dataHotelInfo!=null and count($dataHotelInfo)) { ?>
    <div class="hotel_info">
        <a href="/hotels/info/?id=<?=$dataHotelInfo['hotel_id']?>"><img class="v-aM floatL index" alt="<?=$dataHotelInfo['name']?>" title="<?=$dataHotelInfo['name']?>" src=<?=$dataHotelInfo['hotel_photo']?>
                ></a>
        <? if(isset($dataHotelInfo['review'])) { ?>
            <div class="floatR bal">Потрясающе,
                <div class="ocenka"><?=$dataHotelInfo['review']?></div>
            </div>
        <? } ?>
        <div class="name">
            <a href="/hotels/info/?id=<?=$dataHotelInfo['hotel_id']?>">
                <?=$dataHotelInfo['name']?>
            </a>
        </div>
        <div class="adress"><?=$dataHotelInfo['address']?></div>
        <div class="cena"><i>от <?=$dataHotelInfo['min_price']?></i></div>
    </div>
<? } ?>