<div class="main_wrapper">
    <? $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list">

        <? foreach ($reviews as $review) : ?>
            <div class="hotel_opinion">
                <strong><?= CHtml::encode($review['client']['name']) ?>,</strong><br>
                Деловая поездка <b>2 Июня 2014</b><br>
                <div class="ocenka">9.8</div>
            </div>

            <div class="hotel_opinion_sp">
                <ul>
                    <li>
                        <img src="/images/plus.png" alt="" class="padR10 floatL w26h26">
                        <div class="padL4p">Перший раз їздив у відрядження. Але все пройшло дуже добре. Сподобались дівчата на ресепшні, дуже швидко і оперативно заселили в готель, до 12 години. Номер був такий як і уявляв, нічого зайвого, все необхідне. Прибирали кожен день, так як потрібно. Співвідношення ціна/якість дуже добра, як для столиці. </div>
                    </li>
                    <li>
                        <img src="/images/minus.png" alt="" class="padR10 floatL w26h26">
                        <div class="padL4p">Маленький мінус це те, що крім мила нічого не давали, як я знаю потрібно видавати ще і шампунь. </div>
                    </li>
                </ul>
            </div>
        <? endforeach; ?>
    </div>
</div>

