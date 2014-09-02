<!-- ready -->
<?
/* @var $this HotelsController */
?>
<div class="main_wrapper hotels_list">
    <?if(isset($label)&&isset($data)&&isset($data['data'])&&isset($dataPagination)){?>
    <div class="city_wrapper clearfix">
        <a href="#" class="date">Изменить даты</a>
        <h2><?=$label?></h2>
        <span class="numb"><?=count($data['data'])?> отелей</span>
        <?$this->renderPartial('../common/fromTo',array())?>
    </div><!-- city_wrapper -->
    <div class="hotel_list">
        <?foreach($dataPagination as $key=>$oneHotel):?>
            <?
                OneHotelView::render($oneHotel);
            ?>
        <?endforeach?>
    </div>
    <table class="paginator">
        <tr>
            <td>
                <? if($page>0){ ?>
                    <a href="/hotels/byCity?id=<?=$cityId?>&page=<? echo $page-1; ?>">Предыдущая</a>
                <? } ?>
            </td>
            <td>
                <? $maxLimit = ceil(count($data['data'])/$limit)-1;
                    if($page < $maxLimit) { ?>
                    <a href="/hotels/byCity?id=<?=$cityId?>&page=<? echo $page+1; ?>">Следующая</a>
               <? } ?>
           </td>
        </tr>
    </table><!-- paginator -->
    <div class="pagilist">
        <p>Страница: <?=$page+1?> из <? echo ceil(count($data['data'])/$limit)?></p>
    </div>

     <?}else{?>
        <div class="no_result">
            <p>Нет результатов</p>
        </div>
    <?}?>
</div><!-- main_wrapper -->