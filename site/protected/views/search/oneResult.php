<!-- ready -->
<?php if ($data) { ?>
    <h2 class="<?= $prop ?>"><?= $label ?></h2>
    <?php $sessionData = Yii::app()->session['cityHotelsIds'] ?>
    <?php foreach ($data as $one) { ?>
        <?php
        $href = '';
        $id = '';
        if (isset($one['cityId'])) {
            $href = "/hotels/byCity";
            $id = $one['cityId'];
            $sessionData['cityId-' . $id] = $one['cityName'];
            $blockStyle = "city_style";
        } else {
            if (isset($one['regionId'])) {
                $href = "/hotels/byRegion";
                $id = $one['regionId'];
                $sessionData['regionId-' . $id] = $one['regionName'] . " обл.";
                $blockStyle = "region_style";
            } else {
                if (isset($one['hotelId'])) {
                    $href = "/hotels/rooms/";
                    $id = $one['hotelId'];
                    $blockStyle = "hotel_style";
                }
            }
        }
        ?>

        <div class="one_resul_search <?= isset($blockStyle) ? $blockStyle : '' ?>">
            <form action="<?= isset($href) ? $href : '/' ?>" method="get">
                <?php foreach ($parameters as $name => $parameter) { ?>
                    <input type="hidden" name="<?= $name ?>" value="<?= $parameter ?>">
                <?php } ?>
                <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                <span><?= $one[$prop] ?></span>

                <p>
                    <?php if (isset($one['hotelsCount'])): ?>
                        <?= $one['hotelsCount'] ?>   отелей
                    <?php else: ?>
                        <?= $one['hotelName'] ?>
                    <?php endif ?>
                </p>
                <input type="submit" value="">
            </form>
        </div><!-- one_resul_search -->

    <?php } ?>
    <?php Yii::app()->session['cityHotelsIds'] = $sessionData; ?>
<?php } ?>