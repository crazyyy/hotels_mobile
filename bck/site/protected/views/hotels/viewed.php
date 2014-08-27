<div class="main_wrapper">
    <div class="city_wrapper">
        <a href="#"><div class="date">Изменить даты</div></a>
        <div><span>Ивано-Франковск</span></div>
        <div class="numb">317 отелей</div>
        <div class="floatL"><img src="/images/icon_calendar.png" alt="Call" class="padR10"><strong>1 Ночь  (23 Июн - 24 Июн)</strong></div>
    </div>
    <?if(isset($data)&&isset($dataPagination)){?>
    <div class="hotel_list">
        <?
        $lastFormatDate = $dataPagination[0];
        foreach($dataPagination as $key=>$oneHotel):?>
            <?
            $formatDate = ViewHelper::mkViewedDate($oneHotel['date']);
            if($key == 0 or $formatDate!=$lastFormatDate) { ?>
            <div class="views">
                <?
                $lastFormatDate = $formatDate;
                echo $formatDate;
                ?>
            </div>
            <? } ?>
            <?
            OneHotelView::renderViewed($oneHotel);
            ?>
        <?endforeach?>
    </div>
    <div class="center">
        <div class="pag_wrap">
            <? if($page>0){ ?>
                <a href="/hotels/viewed?page=<? echo $page-1; ?>">
                    <div class="floatL pag_body marL20 pad_str_L">
                        <img class="floatL" alt="" src="/images/str_l.png">
                        <span class="padL15">Предыдущая</span>
                    </div>
                </a>
            <? } ?>
            <?
            $maxLimit = ceil(count($data)/$limit)-1;
            if($page < $maxLimit) { ?>
                <a href="/hotels/viewed?page=<? echo $page+1; ?>">
                    <div class="floatR pag_body marR20 pad_str_R">
                        <span class="padR15">Следующая</span>
                        <img class="floatR" alt="" src="/images/str_r.png">
                    </div>
                </a>
            <? } ?>
        </div>
        <div class="paginator">Страница: <?=$page+1?> из <? echo ceil(count($data)/$limit)?></div>
    </div>
    <?}else{?>
       Нет результатов
   <?}?>
</div>