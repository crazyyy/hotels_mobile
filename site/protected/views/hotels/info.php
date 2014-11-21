<!-- ready -->
<div class="main_wrapper">
    <?php $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list">
        <div class="hotel_info_doc">
            <h3>Описание отеля</h3>

            <p><?= $hotel['description'] ?></p>
        </div>
        <div class="hotel_info_doc">
            <h3>Услуги в отеле</h3>

            <p><?php foreach ($hotel['facilities'] as $facility): ?>
                    <?php echo "- " . $facility['name'] . "<br>" ?>
                <?php endforeach ?></p>
        </div>
        <div class="hotel_info_doc">
            <h3>Порядок проживания в отеле</h3>

            <p>Регистрация заезда: с <?= $hotel['checkin_to'] ?> часов.</p>

            <p>Регистрация отъезда: до <?= $hotel['checkout_to'] ?> часов.</p>
        </div>
    </div>
</div>
