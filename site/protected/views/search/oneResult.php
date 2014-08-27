<?if($data):?>

<h2><img src="<?=$img?>" alt="" class="dispIB padR10"><?=$label?></h2>
<?$sessionData=Yii::app()->session['cityHotelsIds']?>
<?foreach($data as $one):?>
    <?$href='';
      $id='';
        if(isset($one['cityId'])){
            $href="/hotels/byCity";
            $id=$one['cityId'];
            $sessionData['cityId-'.$id]=$one['cityName'];

        }

        else if(isset($one['regionId'])){
            $href="/hotels/byRegion";
            $id=$one['regionId'];
            $sessionData['regionId-'.$id]=$one['regionName']." обл.";
        }
        else if(isset($one['hotelId'])){
            $href="/hotels/info/";
            $id=$one['hotelId'];
        }
        ?>
      <form action="<?=$href?>" method="get">
        <input type="hidden" name="id" value="<?=$id?>">
        <div class="main_search">
           <img src="/images/str.png" alt="" class="floatR marT10R10">
           <span><?=$one[$prop]?></span>
           <strong>
            <?if(isset($one['hotelsCount'])):?>
                <?=$one['hotelsCount']?>   отелей
            <?else:?>
               <?=$one['hotelName']?>
            <?endif?>
             </strong>
            <input type="submit" value="">
        </div>
      </form>
<?endforeach?>
    <?Yii::app()->session['cityHotelsIds']=$sessionData;  ?>
<?endif?>
