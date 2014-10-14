<!-- ready -->
<?if($data):?>
  <h2 class="<?=$prop?>"><?=$label?></h2>
  <?$sessionData=Yii::app()->session['cityHotelsIds']?>
  <?foreach($data as $one):?>
        <?$href='';
        $id='';
        if(isset($one['cityId'])){
            $href="/hotels/byCity";
            $id=$one['cityId'];
            $sessionData['cityId-'.$id]=$one['cityName'];
            $blockStyle ="city_style";
        }
        else if(isset($one['regionId'])){
            $href="/hotels/byRegion";
            $id=$one['regionId'];
            $sessionData['regionId-'.$id]=$one['regionName']." обл.";
            $blockStyle ="region_style";
        }
        else if(isset($one['hotelId'])){
            $href="/hotels/info/";
            $id=$one['hotelId'];
            $blockStyle ="hotel_style";
        }
        ?>

        <div class="one_resul_search <? echo $blockStyle; ?>">
            <form action="<?=$href?>" method="get">
                <?foreach($parameters as $name => $parameter){?>
                    <input type="hidden" name="<?=$name?>" value="<?=$parameter?>">
                <?}?>
                <input type="hidden" name="id" value="<?=$id?>">
                <span><?=$one[$prop]?></span>
                <p>
                    <?if(isset($one['hotelsCount'])):?>
                        <?=$one['hotelsCount']?>   отелей
                    <?else:?>
                        <?=$one['hotelName']?>
                    <?endif?>
                </p>
                <input type="submit" value="">
            </form>
        </div><!-- one_resul_search -->

    <?endforeach?>
    <?Yii::app()->session['cityHotelsIds']=$sessionData;  ?>
<?endif?>