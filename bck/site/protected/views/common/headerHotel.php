<?
/* @var $this HotelsController */
$rank = number_format($hotel['ranking'] / $hotel['rating'] * 10, 1);
$rankIndex = ceil($rank / 2);
?>
    <div class="posR">
        <img src="<?= CHtml::encode($slider['image']) ?>" alt="" class="v-aM" style="width: 100%; height: 100%;">

        <div class="hotel_info_page_top">
            <div class="star_wrap">
                <? for ($i = 0; $i < $rankIndex; $i++) { ?>
                    <img src="/images/ico_star_big.png" alt="" class="star">
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
    </div>

    <div class="city_wrapper">
        <a href="#">
            <div class="date">Изменить дату</div>
        </a>

        <div class="numb"><?= $hotel['address'] ?></div>
        <? $this->renderPartial('../common/fromTo', array()) ?>
    </div>
<? $this->renderPartial('../common/menuHotel', array('hotel' => $hotel)) ?>