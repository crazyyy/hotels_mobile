<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$file=__FILE__;
$layout=$this->getLayoutFile('main');
?>

<div class="form_wrapper cf5af41">
    <form id="" action="/search" method="get">
        <ul>
            <li class="padT10">
                <img src="/images/zoom.png" alt="" class="marR10">Найти город или отель:<br>
                <input type="text" id="" name="s" class="inp" placeholder="" autocomplete="off" spellcheck="false" required="required">
            </li>
            <!--для скрытия ошибки добавить в <li> класс dispNone-->
            <li class="padT10  dispNone">
                <img src="images/info.png" alt="" class="marR10 v-aM floatL"><div class="info">В этом отеле нет ни одного свободного номера на выбранные даты</div>
            </li>
            <li class="padT10 ">Прибытие<br>
                <div class="new-select-style-wpandyou w55 marR10">
                <select class="w80" name="day_arr">
                    <?for ($i=1;$i<=31;$i++){?>
                        <option <? if($i==date('d')): ?> selected <? endif ?> value="<?if ($i<10) echo '0';echo $i?>"><?=$i?></option>
                    <?}?>
                </select>
                </div>
                <div class="new-select-style-wpandyou w170">
                <select class="w195" name="month_year_arr">
                    <?for ($i=$monthNumber;$i<$monthNumber+12;$i++){?>
                                                                <?$yearCurrent=$year?>
                                                                <?$index=$i%12?>
                                                                <?if($index==0) $index=12?>
                                                                <option value="<?=$yearCurrent?>-<?if ($index<10) echo '0'?><?=$index?>"><?=Yii::app()->controller->monthes[$index]?> <?=$yearCurrent?></option>
                                                                <?if($index==12) $yearCurrent++?>
                                                            <?}?>
                </select>
                    </div>
            </li>
            <li class="padT10 ">Отъезд<br>
                <div class="new-select-style-wpandyou w55 marR10">
                <select class="w80" name="day_dep">
                    <?for ($i=31;$i>0;$i--){?>
                    <option value="<?if ($i<10) echo '0';echo $i?>"><?=$i?></option>
                    <?}?>
                </select>
                </div>
                <div class="new-select-style-wpandyou w170">
                <select class="w195" name="month_year_dep">
                    <?for ($i=$monthNumber;$i<$monthNumber+12;$i++){?>
                        <?$index=$i%12?>
                        <?if($index==0) $index=12?>
                        <option value="<?=$year?>-<?if ($index<10) echo '0'?><?=$index?>"><?=Yii::app()->controller->monthes[$index]?> <?=$year?></option>
                        <?if($index==12) $year++?>
                    <?}?>
                </select>
                </div>
            </li>
            <li class="padT10">
                <div class="center padTB40">
                    <input id="" type="submit" value="Найти" class="button_green">
                </div>
            </li>
        </ul>
    </form>
</div>
<div class="main_wrapper">
    <?foreach($data[0]['data'] as $city):?>
        <a href="/search?s=<?=$city['name']?>"><div class="city"><?=$city['name']?><span><?=$city['nr_hotels']?></span><img src="/images/str.png" alt="" class="floatR marT5R10"></div></a>
    <?endforeach;?>
    <?foreach($data[1]['data'] as $region):?>
        <a href="/search?s=<?=$region['name']?>"><div class="city"><?=$region['name']?><span><?=$region['count']?></span><img src="/images/str.png" alt="" class="floatR marT5R10"></div></a>
    <?endforeach;?>
<h1>Почему нас выбирают?</h1>
    <ul>
        <img src="/images/11.png" alt="" class="floatL v-aM"><li>Абсолютно бесплатные услуги бронирования</li>
        <img src="/images/14.png" alt="" class="floatL"><li>Отзывы о гостиницах: более 8000 людей написали свои впечатления для вас </li>
        <img src="/images/13.png" alt="" class="floatL"><li>Удобный выбор из 2160 гостиниц в 164 городах Украины</li>
        <img src="/images/12.png" alt="" class="floatL"><li>Круглосуточная поддержка по телефону, без выходных.</li>
    </ul>
</div>
