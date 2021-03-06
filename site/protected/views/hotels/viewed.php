<!-- ready -->
<div class="main_wrapper">
    <div class="city_wrapper">
        <a href="#">
            <div class="date">Изменить даты</div>
        </a>

        <div><span>Ивано-Франковск</span></div>
        <div class="numb">317 отелей</div>
        <div class="floatL"><img src="/images/icon_calendar.png" alt="Call" class="padR10"><strong>1 Ночь (23 Июн - 24
                Июн)</strong></div>
    </div>
    <?php if (isset($data) && isset($dataPagination)) { ?>
        <div class="hotel_list">
            <?
            $lastFormatDate = $dataPagination[0];
            foreach ($dataPagination as $key => $oneHotel):?>
                <?
                $formatDate = ViewHelper::mkViewedDate($oneHotel['date']);
                if ($key == 0 or $formatDate != $lastFormatDate) {
                    ?>
                    <div class="views">
                        <?
                        $lastFormatDate = $formatDate;
                        echo $formatDate;
                        ?>
                    </div>
                <?php } ?>
                <?
                OneHotelView::renderViewed($oneHotel);
                ?>
            <?php endforeach ?>
        </div>
        <table class="paginator">
            <tr>
                <td>
                    <?php if ($page > 0) { ?>
                        <a href="/hotels/byCity?id=<?= $cityId ?>&page=<?php echo $page - 1; ?>">Предыдущая</a>
                    <?php } ?>
                </td>
                <td>
                    <?php $maxLimit = ceil(count($data['data']) / $limit) - 1;
                    if ($page < $maxLimit) {
                        ?>
                        <a href="/hotels/byCity?id=<?= $cityId ?>&page=<?php echo $page + 1; ?>">Следующая</a>
                    <?php } ?>
                </td>
            </tr>
        </table><!-- paginator -->
        <div class="pagilist">
            <p>Страница: <?= $page + 1 ?> из <?php echo ceil(count($data['data']) / $limit) ?></p>
        </div>

    <?php } else { ?>
        <div class="no_result">
            <p>Нет результатов</p>
        </div>
    <?php } ?>
</div>