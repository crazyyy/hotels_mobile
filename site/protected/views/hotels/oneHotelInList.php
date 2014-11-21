<!-- ready -->
<?php if ($dataHotelInfo != null and count($dataHotelInfo)) { ?>
    <div class="hotel_info hotel_info_lists">
        <a class="featureimg" href="/hotels/info/?id=<?= $dataHotelInfo['hotel_id'] ?>">
            <img alt="<?= $dataHotelInfo['name'] ?>" title="<?= $dataHotelInfo['name'] ?>"
                 src=<?= $dataHotelInfo['hotel_photo'] ?>>
        </a>

        <table>
            <tr class="ratings">
                <td>
                    <?php if (isset($dataHotelInfo['review'])) { ?>
                        <p>Потрясающе, <span><?= $dataHotelInfo['review'] ?></span></p>
                    <?php } ?>
                </td>
            </tr>
            <tr class="name">
                <td>
                    <a href="/hotels/info/?id=<?= $dataHotelInfo['hotel_id'] ?>"> <?= $dataHotelInfo['name'] ?></a>
                </td>
            </tr>
            <tr class="adress">
                <td>
                    <?= $dataHotelInfo['address'] ?>
                </td>
            </tr>
            <tr class="price">
                <td>
                    от <?= $dataHotelInfo['min_price'] ?>
                </td>
            </tr>
        </table>


    </div><!-- hotel_info -->
<?php } ?>