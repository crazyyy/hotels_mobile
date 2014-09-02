<?
/* @var $this HotelsController */
$rank = number_format($hotel['ranking'] / $hotel['rating'] * 10, 1);
$rankIndex = ceil($rank / 2);
?>
    <div class="posR header_hotel">
        <img src="<?= CHtml::encode($slider['image']) ?>" alt="<?= $hotel['name'] ?>" title="<?= $hotel['name'] ?>" class="v-aM header_hotel_img">

        <div class="hotel_info_page_top">
            <div class="star_wrap clearfix">
                <? for ($i = 0; $i < $rankIndex; $i++) { ?>
                    <span></span>
                <? } ?>
            </div>
            <div class="floatR bal">Потрясающе,
                <div class="ocenka"><?= $rank ?></div>
            </div>
            <div class="name"><?= $hotel['name'] ?></div>
        </div>
        <div class="hotel_info_page_bottom" style="display: none">
            <div class="cena"><span>от 400 грн</span> от 200 грн</div>
            <div class="plashka_big"></div>
        </div>
        <? if ($slider['current']) : ?>
        <a href="?<?= http_build_query(array_merge($_GET, array('slideTo' => $slider['prev']))) ?>">
            <div class="icon_left"></div>
        </a>
        <? endif; ?>
        <? if ($slider['next']) : ?>
            <a href="?<?= http_build_query(array_merge($_GET, array('slideTo' => $slider['next']))) ?>">
                <div class="icon_right"></div>
            </a>
        <? endif; ?>
    </div><!-- header_hotel -->

    <div class="city_wrapper">
        <a href="#" class="date">Изменить дату</a>
        <div class="numb"><?= $hotel['address'] ?></div>
        <? $this->renderPartial('../common/fromTo', array()) ?>
    </div><!-- city_wrapper -->
<? $this->renderPartial('../common/menuHotel', array('hotel' => $hotel)) ?>