<div class="main_wrapper">

    <div class="bron_info">
        <div class="floatL">
            <a href="#">
                <img class="v-aM floatL index" alt="hotel"
                             src="<?=$block['photo']?>">
            </a>
        </div>
        <div class="name padl110 "><b>Номер “<?=$block['name']?>”</b></div>
        <div class="padT5 padl110 ">
            <b>Заезд:</b>
            <?
            $arrival_date=new DateTime(Yii::app()->session['arrival_date']);
            $departure_date=new DateTime(Yii::app()->session['departure_date']);
            ?>
            <?=ViewHelper::mkBookingDate($arrival_date)?> с <?=$dataHotelInfo['checkin_to']?>
        </div>
        <div class="padB10 padl110 ">
            <b>Выезд:</b>
            <?=ViewHelper::mkBookingDate($departure_date)?> до <?=$dataHotelInfo['checkout_to']?>
        </div>

        <div class="cena padl110">
            <b><?=$block['block_price']?> грн</b>
            (за <?=ViewHelper::bookingOccupancyFormat($block['max_occupancy'])?>)
        </div><!--<div class="floatR gray">Вы сэкономили: 200 грн</div>-->
        <div class="plashka"></div>
    </div>
    <div class="overA padTB30LR15">
        <div class="floatL">Общая стоимость: <span class="font140p"><?=$block['incremental_price'][0]['price']?> грн</span></div>
        <div class="floatR green">Вы сэкономили:<br>
            ? грн</div>
    </div>
<div class="bron_form">
    <form action="/booking/card" method="post">
        <ul>
            <li><input type="text" required="" class="floatL w170" placeholder="Имя"><input type="text" required="" class="floatR w45p" placeholder="Фамилия"></li>
            <li><input type="email" required="" class="floatL w100p" placeholder="E-mail">
                <strong>Мы пришлем Вам информацию по бронированию</strong>
            </li>
            <li>
                <div class="select-style w170">
                    <select class="w187">
                        <option>+38 (Украина)</option>
                        <option>+38 (Украина)</option>
                    </select>
                </div>
                <input type="text" required="" class="floatR w45p" placeholder="Номер телефона">
            </li>
            <li><label class="for-checkbox">
                    <input type="checkbox" checked="" class="padR10" value="windows" name="">
                    <span class="soglasen">Я согласен с условиями <a href="#"><span>публичной оферты</span></a> и <a href="#"><span>соглашении о конфиденциальности</span></a> </span>
                </label></li>
        </ul>

        <div class="center padT10 padB10">
            <div>
                <button class="button" type="submit">
                    Далее <img height="38px" class="v-aM marL70" alt="" src="/images/big_str.png">
                </button>
<!--                <a href="#">-->
<!--                    <div class="button">-->
<!--                        Далее <img height="38px" class="v-aM marL70" alt="" src="/images/big_str.png">-->
<!--                    </div>-->
<!--                </a>-->
            </div>

            <div class="green left garant padTB30"><img height="28px" class="v-aM padR5 floatL" alt="" src="/images/ok.png"><span>Комиссия за бронирование не взимается!<br>
            Гарантия лучшей цены!</span></div>

        </div>
    </form>
</div>



</div>