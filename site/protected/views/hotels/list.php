<?
/* @var $this HotelsController */
?>
<div class="main_wrapper">
    <?if(isset($label)&&isset($data)&&isset($data['data'])&&isset($dataPagination)){?>
    <div class="city_wrapper">
        <a href="#"><div class="date">Изменить даты</div></a>
        <div><span><?=$label?></span></div>
        <div class="numb"><?=count($data['data'])?> отелей</div>
        <?$this->renderPartial('../common/fromTo',array())?>
    </div>
    <div class="hotel_list">
        <?foreach($dataPagination as $key=>$oneHotel):?>
            <?
                OneHotelView::render($oneHotel);
            ?>
        <?endforeach?>
    </div>
    <div class="center">
        <div class="pag_wrap">
            <? if($page>0){ ?>
                <a href="/hotels/byCity?id=<?=$cityId?>&page=<? echo $page-1; ?>">
                    <div class="floatL pag_body marL20 pad_str_L">
                        <img class="floatL" alt="" src="/images/str_l.png">
                        <span class="padL15">Предыдущая</span>
                    </div>
                </a>
            <? } ?>
            <?
            $maxLimit = ceil(count($data['data'])/$limit)-1;
            if($page < $maxLimit) { ?>
                <a href="/hotels/byCity?id=<?=$cityId?>&page=<? echo $page+1; ?>">
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