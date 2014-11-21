<?php
/**
 * @var string $hotelType
 * @var string $hotelName
 * @var string $email
 * @var string $firstName
 * @var int $bookingId
 */
?>
<div class="main_wrapper">

    <div class="center padTB30"><img src="/images//smile.png" alt="" class="v-aM padR10"> <b class="you_byut">Вы
            восхитительны!</b></div>
    <div class="cong_text">Номер в <?= $hotelType ?> <?= $hotelName?> успешно забронирован. Оплата за проживание осуществляется
        непосредственно в отеле. Мы отправили акт заселения на ваш адрес <b><?= $email ?></b>.<br><br>
        Номер вашего заказа: <b><?= $bookingId ?></b>
    </div>
    <div class="center you_byut marT20"><b><?= $firstName ?>, давайте дружить!</b><br>

        <div class="padTB30">
            <a href="#"><img src="/images//vk_opera.png" alt="" class="v-aM "></a><br>
            <a href="#"><img src="/images//fb_opera.png" alt="" class="v-aM padT10"></a><br>
            <a href="#"><img src="/images//ok_opera.png" alt="" class="v-aM padT10"></a>
        </div>
    </div>
</div>