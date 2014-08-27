<div class="main_wrapper">
    <div class="skidka_wrapper">

        <div class="floatL font140p">Отели за полцены</div>
        <div class="select-filtr-skidka w145 floatR">
            <select class="w172">
                <option>Все города - 120 отелей</option>
                <option>Киев (50)</option>
                <option>Винница (50)</option>
                <option>Львов (223)</option>
                <option>Крым (наш)</option>
            </select>
        </div>
    </div>
    <?if(isset($data)&&isset($data['data'])&&isset($dataPagination)){?>
    <div class="hotel_list">
        <?foreach($dataPagination as $key=>$oneHotel):?>
            <?
                OneHotelView::renderHalfPrice($oneHotel);
            ?>
        <?endforeach?>
    </div>
    <div class="center">
        <div class="pag_wrap">
            <? if($page>0){ ?>
                <a href="/hotels/halfprice?page=<? echo $page-1; ?>">
                    <div class="floatL pag_body marL20 pad_str_L">
                        <img class="floatL" alt="" src="/images/str_l.png">
                        <span class="padL15">Предыдущая</span>
                    </div>
                </a>
            <? } ?>
            <?
            $maxLimit = ceil(count($data['data'])/$limit)-1;
            if($page < $maxLimit) { ?>
                <a href="/hotels/halfprice?page=<? echo $page+1; ?>">
                    <div class="floatR pag_body marR20 pad_str_R">
                        <span class="padR15">Следующая</span>
                        <img class="floatR" alt="" src="/images/str_r.png">
                    </div>
                </a>
            <? } ?>
        </div>
        <div class="paginator">Страница: <?=$page+1?> из <? echo ceil(count($data['data'])/$limit)?></div>
    </div>
    <?}else{?>
       Нет результатов
   <?}?>
</div>