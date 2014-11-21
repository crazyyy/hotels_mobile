<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
$file = __FILE__;
$layout = $this->getLayoutFile('main');
?>
<script>
    function GotoSearch(url) {
        var tmp_day_arr = document.getElementById('day_arr');
        var tmp_day_dep = document.getElementById('day_dep');
        var tmp_month_year_arr = document.getElementById('month_year_arr');
        var tmp_month_year_dep = document.getElementById('month_year_dep');

        var day_arr = tmp_day_arr.options[tmp_day_arr.selectedIndex].value;
        var day_dep = tmp_day_dep.options[tmp_day_dep.selectedIndex].value;
        var month_year_arr = tmp_month_year_arr.options[tmp_month_year_arr.selectedIndex].value;
        var month_year_dep = tmp_month_year_dep.options[tmp_month_year_dep.selectedIndex].value;

        var newUrl = url + '&day_arr=' + day_arr + '&month_year_arr=' + month_year_arr + '&day_dep=' + day_dep + '&month_year_dep=' + month_year_dep;

        window.location.href = newUrl;
        return false;
    }
</script>
<!-- ready -->
<div class="form_wrapper bgc_orange">
    <form id="" action="/search" method="get">
        <ul>
            <li>
                <label for="scity">Найти город или отель:</label>
                <input typte="text" id="scity" name="s" placeholder="" value="<?php if ($s) {
                    echo $s;
                } ?>" autocomplete="off" spellcheck="false" required="required">
            </li>
            <li class="empty_hotel dispNone">
                <span>В этом отеле нет ни одного свободного номера на выбранные даты</span>
            </li>
            <!-- empty_hotel -->
            <li class="search_arrive">
                <label for="day_arr">Прибытие</label>
                <select id="day_arr" name="day_arr">
                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                        <option <?php if ($i == date('d')): ?> selected <?php endif ?> value="<?php if ($i < 10) {
                            echo '0';
                        }
                        echo $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <select name="month_year_arr" id="month_year_arr">
                    <?php for ($i = $monthNumber; $i < $monthNumber + 12; $i++) { ?>
                        <?php $yearCurrent = $year ?>
                        <?php $index = $i % 12 ?>
                        <?php if ($index == 0) $index = 12 ?>
                        <option value="<?= $yearCurrent ?>-<?php if ($index < 10) {
                            echo '0';
                        } ?><?= $index ?>"><?= Yii::app()->controller->monthes[$index] ?> <?= $yearCurrent ?></option>
                        <?php if ($index == 12) $yearCurrent++ ?>
                    <?php } ?>
                </select>
            </li>
            <!-- search_arrive -->
            <li class="search_dep">
                <label for="day_dep">Отъезд</label>
                <select id="day_dep" name="day_dep">
                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                        <option <?php if ($i == date('d') + 1): ?> selected <?php endif ?> value="<?php if ($i < 10) {
                            echo '0';
                        }
                        echo $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <select name="month_year_dep" id="month_year_dep">
                    <?php for ($i = $monthNumber; $i < $monthNumber + 12; $i++) { ?>
                        <?php $yearCurrent = $year ?>
                        <?php $index = $i % 12 ?>
                        <?php if ($index == 0) $index = 12 ?>
                        <option value="<?= $yearCurrent ?>-<?php if ($index < 10) {
                            echo '0';
                        } ?><?= $index ?>"><?= Yii::app()->controller->monthes[$index] ?> <?= $yearCurrent ?></option>
                        <?php if ($index == 12) $yearCurrent++ ?>
                    <?php } ?>
                </select>
            </li>
            <!-- search_dep -->
            <li>
                <button id="" type="submit" class="button_green">Найти</button>
            </li>
        </ul>
    </form>
</div>
<ul class="search_citywnumbers">
    <?php foreach ($data[0]['data'] as $city): ?>
        <li>

            <a onclick="return GotoSearch('/search?s=<?= $city['name'] ?>&is_href=1');"
               href="/search?s=<?= $city['name'] ?>&day_arr=<?php echo date(
                   'd'
               ) ?>&month_year_arr=<?= $year ?>-<?php if ($monthNumber < 10) {
                   echo '0';
               } ?><?= $monthNumber ?>&day_dep=31&month_year_dep=<?= $year ?>-<?php if ($monthNumber < 10) {
                   echo '0';
               } ?><?= $monthNumber ?>&is_href=1">
                <?= $city['name'] ?><span><?= $city['nr_hotels'] ?></span>
            </a>
        </li>
    <?php endforeach; ?>
    <?php foreach ($data[1]['data'] as $region): ?>
        <li>
            <a onclick="return GotoSearch('/search?s=<?= $region['name'] ?>&is_href=1');"
               href="/search?s=<?= $region['name'] ?>&day_arr=<?php echo date(
                   'd'
               ) ?>&month_year_arr=<?= $year ?>-<?php if ($monthNumber < 10) {
                   echo '0';
               } ?><?= $monthNumber ?>&day_dep=31&month_year_dep=<?= $year ?>-<?php if ($monthNumber < 10) {
                   echo '0';
               } ?><?= $monthNumber ?>&is_href=1">
                <?= $region['name'] ?><span><?= $region['count'] ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul><!-- search_citywnumbers -->
<div class="home_aftersearch">
    <h1>Почему нас выбирают?</h1>
    <ul>
        <li>Абсолютно бесплатные услуги бронирования</li>
        <li>Отзывы о гостиницах: более 8000 людей написали свои впечатления для вас</li>
        <li>Удобный выбор из 2160 гостиниц в 164 городах Украины</li>
        <li>Круглосуточная поддержка по телефону, без выходных.</li>
    </ul>
</div><!-- main_wrapper -->
