<!-- not ready - what page? -->
<?php if ($dataHotelInfo != null and count($dataHotelInfo)) { ?>
    <div class="hotel_info 33333333333">
        <a href="/hotels/info/?id=<?= $dataHotelInfo['hotel_id'] ?>">
            <img alt="hotel" class="v-aM floatL index" src=<?= $dataHotelInfo['hotel_photo'] ?>>
        </a>

        <div class="ratings">
            <?php if (isset($dataHotelInfo['review'])) { ?>
                <p>Потрясающе, <span><?= $dataHotelInfo['review'] ?></span></p>
            <?php } ?>
        </div>
        <!-- ratings -->

        <div class="rating clearfix">
            <?php for ($index = 1; $index <= $dataHotelInfo['class']; $index++) { ?>
                <span></span>
            <?php } ?>
        </div>

        <div class="name">
            <a href="/hotels/info/?id=<?= $dataHotelInfo['hotel_id'] ?>"><?= $dataHotelInfo['name'] ?></a>
        </div>

        <div class="adress"><?= $dataHotelInfo['address'] ?></div>
        <div class="cena"><i>от <?= $dataHotelInfo['min_price'] ?></i></div>
        <div class="plashka"></div>
    </div>
<?php } ?>