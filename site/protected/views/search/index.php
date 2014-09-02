<!-- ready -->
<div class="form_wrapper bgc_orange">
    <form id="" action="/search" method="get">
        <ul>
            <li>
                <label for="scity">Найти город или отель:</span>
                <input typte="text" id="scity" name="s" placeholder="" value="<?if($s) echo $s?>" autocomplete="off" spellcheck="false" required="required">
            </li>
        </ul>
    </form>
</div><!-- form_wrapper -->
<div class="main_wrapper">
    <div class="search_wrapper">
        <?if($data&&isset($data['result'][1])):?>
            <?$count=0;?>
            <?$count+=count($data['result'][1]['cities'])?>
            <?$count+=count($data['result'][1]['regions'])?>
            <?$count+=count($data['result'][1]['hotels'])?>
        <?endif?>
        <?if(isset($error))?>
            <?=$error."<br><br>"?>
        <?if(!$data||!isset($data['result'][1])||!$count):?>
                Нет результатов.
        <?else:?>
            <?foreach($data['result'][1] as $key=>$rArray):?>
                <?=SearchResultView::render($key,$rArray)?>
            <?endforeach?>
         <?endif;?>
    </div><!-- search_wrapper -->
</div><!-- main_wrapper -->