
<div class="form_wrapper cf5af41">
    <form id="" action="" method="get">
        <ul>
            <li class="padT10 padB10">
                <img src="/images/zoom.png" alt="" class="marR10">Найти город или отель:<br>
                <input type="text" id="" value="<?if($s) echo $s?>" name="s" class="inp" placeholder="" autocomplete="off" spellcheck="false">
            </li>
        </ul>
    </form>
</div>
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
    </div>
</div>