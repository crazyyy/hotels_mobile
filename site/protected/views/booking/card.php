<?php
/**
 * @var string $firstName
 * @var string $email
 * @var int $bookingId
 * @var string $hotelType
 * @var string $hotelName
 */
?>
<div class="main_wrapper">

    <div class="bron_form">
        <form action="/booking/finished" method="post">
            <input type="hidden" name="firstName" value="<?= $firstName ?>" />
            <input type="hidden" name="email" value="<?= $email ?>" />
            <input type="hidden" name="bookingId" value="<?= $bookingId ?>" />
            <input type="hidden" name="hotelType" value="<?= $hotelType ?>" />
            <input type="hidden" name="hotelName" value="<?= $hotelName ?>" />
            <ul>
                <li class="font140p"><b>Введите данные вашей банковской карты</b></li>
                <li><input type="text" placeholder="Имя" class="floatL w170" required=""><input type="text"
                                                                                                placeholder="Фамилия"
                                                                                                class="floatR w45p"
                                                                                                required="">
                    <strong class="floatL clear">Латинскими буквами, так же, как на карте</strong>
                    <img src="/images//master.png" alt="" class="v-aM floatL clear padT20">
                </li>
                <li><input type="text" placeholder="Номер карты" class="floatL w60p" required=""><input type="text"
                                                                                                        placeholder="CVC2 / СVV2"
                                                                                                        class="floatR w35p"
                                                                                                        required="">
                </li>
                <li>
                    <input type="text" placeholder="Месяц" class="floatL w20p" required=""><input type="text"
                                                                                                  placeholder="Год"
                                                                                                  class="floatL w20p marL10"
                                                                                                  required="">

                    <div class="floatL w100p gray clear padTB30 just">Данные банковской карты необходимы
                        для гарантии вашего бронирования.
                        После подтверждения бронирования
                        отель получит данные вашей кредитной
                        карты и может заблокировать или снять
                        с нее сумму, необходимую для гарантии
                        заезда.
                    </div>
                </li>
            </ul>
            <div class="center padT10 padB10">
                <div>
                    <button type="submit" class="button padTB10L25">Забронировать<img src="/images//big_str.png" alt=""
                                                                                      class="v-aM marL20" height="38px">
                    </button>
                </div>

                <div class="padT20L15 left padB10 overA marB20"><img src="/images//comodo.png" alt=""
                                                                     class="v-aM padR15 floatL"><span
                        class="floatL w70p gray font110">Данные вашей банковской карты защищены сверхнадёжным криптографическим протоколом SSL, который обеспечивает полную безопасность передачи конфиденциальной информации.

               </span></div>

            </div>

        </form>

    </div>
</div>