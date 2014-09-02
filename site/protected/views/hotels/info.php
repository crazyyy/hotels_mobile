<!-- ready -->
<div class="main_wrapper">
    <? $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list">
        <div class="hotel_info_doc">
            <h3>Описание отеля</h3>
            <p><?= $hotel['description'] ?></p>
        </div>
        <div class="hotel_info_doc">
            <h3>Услуги в отеле</h3>
            <p><? foreach ($hotel['facilities'] as $facility): ?>
                <? echo "- " . $facility['name'] . "<br>" ?>
            <? endforeach ?></p>
        </div>
        <div class="hotel_info_doc">
            <h3>Порядок проживания в отеле</h3>
            <p>Регистрация заезда: с <?= $hotel['checkin_to'] ?> часов.</p>
            <p>Регистрация отъезда: до <?= $hotel['checkout_to'] ?> часов.</p>
        </div>
    </div>
</div>
