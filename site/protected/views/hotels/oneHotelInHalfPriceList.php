<!-- ready -->
<?php if ($dataHotelInfo != null and count($dataHotelInfo)) { ?>
    <div class="hotel_info 1111111111">
        <a href="/hotels/info/?id=<?= $dataHotelInfo['hotel_id'] ?>">
            <img alt="<?= $dataHotelInfo['name'] ?>" class="v-aM floatL index" src=<?= $dataHotelInfo['hotel_photo'] ?>>
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
        <!-- rating -->

        <a class="name" href="/hotels/info/?id=<?= $dataHotelInfo['hotel_id'] ?>"><?= $dataHotelInfo['name'] ?></a>

        <div class="adress"><?= $dataHotelInfo['address'] ?></div>
        <div class="cena">
            <strong>от <?= $data['discount_price'] ?> грн</strong>
            <span>от <?= $data['base_price'] ?> грн</span>
        </div>
        <div class="plashka-skidka"></div>
    </div>
<?php } ?>