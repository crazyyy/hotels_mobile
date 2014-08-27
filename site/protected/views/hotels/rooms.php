<div class="main_wrapper">
    <? $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list">
        <? foreach ($rooms as $room) : ?>
            <div class="room_info">
                <div class="floatL">
                    <a href="#">
                        <img src="<?= $room['photo'] ? CHtml::encode($room['photo']['url_square100']) : '/images/nomer_0.png' ?>" alt="hotel" class="v-aM floatL index">
                    </a>

                    <div class="people">
                        <? for ($i = 0; $i < min(3, $room['max_occupancy']); $i++): ?>
                            <img src="/images/ico_people.png" alt="" class="v-aM">
                        <? endfor; ?>
                        <div class="bal"><?= $room['max_occupancy'] ?></div>
                        <br>

                        <? if (0) : ?>
                            <div>Осталось 6 номеров</div>
                        <? endif; ?>
                    </div>
                </div>
                <a href="/booking/index?id=<?=$hotel['hotel_id']?>&block=<?=$room['block_id']?>">
                    <div class="dropdown_wrap">Забронировать</div>
                </a>

                <div class="name"><?= CHtml::encode($room['name']) ?></div>
                <div class="cena">
                    <? if (0) : ?>
                        <span>400 грн</span>
                    <? endif; ?>
                    <strong><?= $room['block_price'] ?> грн</strong>
                    <br>
                    <? if (Service::PRICE_TYPE_PER_NUMBER == $room['price_type']): ?>
                        за номер (1 ночь)
                    <? else : ?>
                        за место (1 ночь)
                    <? endif; ?>
                </div>
                <div class="uslugi">
                    <? if ($room['cancel_booking_day']) : ?>
                        Отмена за <?= $room['cancel_booking_day'] ?> дней,
                    <? else : ?>
                        Отмена невозможна,
                    <? endif; ?>

                    <? if (Service::BOOKING_METHOD_PREPAID == $room['booking_method']): ?>
                        полная предоплата
                    <? elseif (Service::BOOKING_METHOD_PAY_IN_HOTEL == $room['booking_method']) : ?>
                        оплата в отеле
                    <? else : ?>
                        передача карточки
                    <? endif ?>
                </div>

                <? if (0) : ?>
                    <div class="plashka"></div>
                <? endif; ?>
            </div>
        <? endforeach; ?>
    </div>
</div>


