<!-- ready -->
<div class="main_wrapper">
    <?php $this->renderPartial('../common/headerHotel', array('hotel' => $hotel, 'slider' => $slider)) ?>
    <div class="hotel_list">
        <?php foreach ($reviews as $review) : ?>
            <div class="hotel_opinion">
                <h4><?= CHtml::encode($review['client']['name']) ?>,</h4>
                Деловая поездка
                <span><?= CHtml::encode(ViewHelper::dateFull($review['reviewDate']['sec'])) ?></span>

                <div class="ocenka"><?= CHtml::encode($review['rating']) ?></div>
            </div><!-- hotel_opinion -->

            <ul class="hotel_opinion_sp">
                <li><?= CHtml::encode(@$review['review']) ?></li>
                <li></li>
            </ul><!-- hotel_opinion_sp -->
        <?php endforeach; ?>
    </div>
    <!-- hotel_list -->

    <?php $this->widget('Pagination', array('pagination' => $pagination)) ?>

</div>
