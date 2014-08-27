<div class="main_wrapper">
    <? $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list">
        <div class="hotel_info_doc">
            <strong>Описание отеля</strong><br><br>
            <?= $hotel['description'] ?>
        </div>
        <div class="hotel_info_doc">
            <strong>Услуги в отеле</strong><br><br>
            <? foreach ($hotel['facilities'] as $facility): ?>
                <? echo "- " . $facility['name'] . "<br>" ?>
            <? endforeach ?>
        </div>
        <div class="hotel_info_doc">
            <strong>Порядок проживания в отеле</strong><br><br>
            Регистрация заезда: с <?= $hotel['checkin_to'] ?> часов.<br>
            Регистрация отъезда: до <?= $hotel['checkout_to'] ?> часов.<br><br>
        </div>
    </div>
</div>
