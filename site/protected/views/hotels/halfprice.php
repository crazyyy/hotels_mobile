<!-- ready -->
<div class="main_wrapper">
    <div class="skidka_wrapper">
        <h2>Отели за полцены</h2>
        <select>
            <option>Все города - 120 отелей</option>
            <option>Киев (50)</option>
            <option>Винница (50)</option>
            <option>Львов (223)</option>
            <option>Крым (наш)</option>
        </select>
    </div><!-- skidka_wrapper -->
    <?if(isset($data)&&isset($data['data'])&&isset($dataPagination)){?>
    <div class="hotel_list">
        <?foreach($dataPagination as $key=>$oneHotel):?>
            <?
                OneHotelView::renderHalfPrice($oneHotel);
            ?>
        <?endforeach?>
    </div>
    <table class="paginator">
        <tr>
            <td>
                <? if($page>0){ ?>
                <a href="/hotels/halfprice?page=<? echo $page-1; ?>">Предыдущая</a>
                <? } ?>
            </td>
            <td>
                <? $maxLimit = ceil(count($data['data'])/$limit)-1;
                if($page < $maxLimit) { ?>
                    <a href="/hotels/halfprice?page=<? echo $page+1; ?>">Следующая</a>
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