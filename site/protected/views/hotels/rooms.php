<!-- not ready -->
<div class="main_wrapper">
    <?php $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list rooms_list">
        <?php foreach ($rooms as $room) : ?>
            <div class="room_info">
                <div class="floatL">
                    <a href="#">
                        <img src="<?= $room['photo'] ? CHtml::encode(
                            $room['photo']['url_square100']
                        ) : '/images/nomer_0.png' ?>" alt="hotel" class="v-aM floatL index">
                    </a>

                    <div class="people">
                        <?php for ($i = 0; $i < min(3, $room['max_occupancy']); $i++): ?>
                            <img src="/images/ico_people.png" alt="" class="v-aM">
                        <?php endfor; ?>
                        <div class="bal"><?= $room['max_occupancy'] ?></div>
                        <br>

                        <?php if (0) : ?>
                            <div>Осталось 6 номеров</div>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="/booking/index?id=<?= $hotel['hotel_id'] ?>&block=<?= $room['block_id'] ?>">
                    <div class="dropdown_wrap">Забронировать</div>
                </a>

                <div class="name"><?= CHtml::encode($room['name']) ?></div>
                <div class="cena">
                    <?php if (0) : ?>
                        <span>400 грн</span>
                    <?php endif; ?>
                    <strong><?= $room['block_price'] ?> грн</strong>
                    <br>
                    <?php if (Service::PRICE_TYPE_PER_NUMBER == $room['price_type']): ?>
                        за номер (1 ночь)
                    <?php else : ?>
                        за место (1 ночь)
                    <?php endif; ?>
                </div>
                <div class="uslugi">
                    <?php if ($room['cancel_booking_day']) : ?>
                        Отмена за <?= $room['cancel_booking_day'] ?> дней,
                    <?php else : ?>
                        Отмена невозможна,
                    <?php endif; ?>

                    <?php if (Service::BOOKING_METHOD_PREPAID == $room['booking_method']): ?>
                        полная предоплата
                    <?php elseif (Service::BOOKING_METHOD_PAY_IN_HOTEL == $room['booking_method']) : ?>
                        оплата в отеле
                    <?
                    else : ?>
                        передача карточки
                    <?php endif ?>
                </div>

                <?php if (0) : ?>
                    <div class="plashka"></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- rooms_list -->
</div>


