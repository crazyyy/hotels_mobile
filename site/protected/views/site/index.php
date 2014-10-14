<?php
/* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
    $file=__FILE__;
    $layout=$this->getLayoutFile('main');
?>

<!-- ready -->
<div class="form_wrapper bgc_orange">
    <form id="" action="/search" method="get">
        <ul>
            <li>
                <label for="scity">Найти город или отель:</label>
                <input typte="text" id="scity" name="s" placeholder="" value="<? if($s)echo $s; ?>" autocomplete="off" spellcheck="false" required="required">
            </li>
            <li class="empty_hotel dispNone">
                <span>В этом отеле нет ни одного свободного номера на выбранные даты</span>
            </li><!-- empty_hotel -->
            <li class="search_arrive">
                <label for="day_arr">Прибытие</label>
                    <select id="day_arr" name="day_arr">
                        <?for ($i=1;$i<=31;$i++){?>
                            <option <? if($i==date('d')): ?> selected <? endif ?> value="<?if ($i<10) echo '0';echo $i?>"><?=$i?></option>
                        <?}?>
                    </select>
                    <select name="month_year_arr">
                        <?for ($i=$monthNumber;$i<$monthNumber+12;$i++){?>
                            <?$yearCurrent=$year?>
                            <?$index=$i%12?>
                            <?if($index==0) $index=12?>
                            <option value="<?=$yearCurrent?>-<?if ($index<10) echo '0'?><?=$index?>"><?=Yii::app()->controller->monthes[$index]?> <?=$yearCurrent?></option>
                            <?if($index==12) $yearCurrent++?>
                        <?}?>
                    </select>
            </li><!-- search_arrive -->
            <li class="search_dep">
                <label for="day_dep">Отъезд</label>
                <select id="day_dep" name="day_dep">
                    <?for ($i=31;$i>0;$i--){?>
                    <option value="<?if ($i<10) echo '0';echo $i?>"><?=$i?></option>
                    <?}?>
                </select>
                <select name="month_year_dep">
                    <?for ($i=$monthNumber;$i<$monthNumber+12;$i++){?>
                        <?$yearCurrent=$year?>
                        <?$index=$i%12?>
                        <?if($index==0) $index=12?>
                        <option value="<?=$yearCurrent?>-<?if ($index<10) echo '0'?><?=$index?>"><?=Yii::app()->controller->monthes[$index]?> <?=$yearCurrent?></option>
                        <?if($index==12) $yearCurrent++?>
                    <?}?>
                </select>
            </li><!-- search_dep -->
            <li>
                <button id="" type="submit" class="button_green">Найти</button>
            </li>
        </ul>
    </form>
</div>
<ul class="search_citywnumbers">
    <?foreach($data[0]['data'] as $city):?>
    <li>
        <a href="/search?s=<?=$city['name']?>&day_arr=<?if (date('d')<10) echo '0';echo date('d')?>&month_year_arr=<?=$year?>-<?if ($monthNumber<10) echo '0'?><?=$monthNumber?>&day_dep=31&month_year_dep=<?=$year?>-<?if ($monthNumber<10) echo '0'?><?=$monthNumber?>&is_href=1">
            <?=$city['name']?><span><?=$city['nr_hotels']?></span>
        </a>
    </li>
    <?endforeach;?>
    <?foreach($data[1]['data'] as $region):?>  
    <li>
        <a href="/search?s=<?=$region['name']?>&day_arr=<?if (date('d')<10) echo '0';echo date('d')?>&month_year_arr=<?=$year?>-<?if ($monthNumber<10) echo '0'?><?=$monthNumber?>&day_dep=31&month_year_dep=<?=$year?>-<?if ($monthNumber<10) echo '0'?><?=$monthNumber?>&is_href=1">
            <?=$region['name']?><span><?=$region['count']?></span>
        </a>
    </li>
    <?endforeach;?>
</ul><!-- search_citywnumbers -->
<div class="home_aftersearch">
    <h1>Почему нас выбирают?</h1>
    <ul>
        <li>Абсолютно бесплатные услуги бронирования</li>
        <li>Отзывы о гостиницах: более 8000 людей написали свои впечатления для вас </li>
        <li>Удобный выбор из 2160 гостиниц в 164 городах Украины</li>
        <li>Круглосуточная поддержка по телефону, без выходных.</li>
    </ul>
</div><!-- main_wrapper -->
