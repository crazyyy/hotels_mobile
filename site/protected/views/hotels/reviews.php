<!-- ready -->
<div class="main_wrapper">
    <? $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list">
        <? foreach ($reviews as $review) : ?>
            <div class="hotel_opinion">
                <h4><?= CHtml::encode($review['client']['name']) ?>,</h4>
                Деловая поездка <span>2 Июня 2014</span>
                <div class="ocenka">9.8</div>
            </div><!-- hotel_opinion -->

            <ul class="hotel_opinion_sp">
                <li>Перший раз їздив у відрядження. Але все пройшло дуже добре. Сподобались дівчата на ресепшні, дуже швидко і оперативно заселили в готель, до 12 години. Номер був такий як і уявляв, нічого зайвого, все необхідне. Прибирали кожен день, так як потрібно. Співвідношення ціна/якість дуже добра, як для столиці.</li>
                <li>Маленький мінус це те, що крім мила нічого не давали, як я знаю потрібно видавати ще і шампунь.</li>
            </ul><!-- hotel_opinion_sp -->
        <? endforeach; ?>
    </div><!-- hotel_list -->
</div>