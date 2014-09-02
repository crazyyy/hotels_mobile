<!-- ready -->
<?
    //    $app
    //Yii::app()->controller->monthes
    $date1=new DateTime(Yii::app()->session['arrival_date']);
    $date2=new DateTime(Yii::app()->session['departure_date']);
    $interval =  $date1->diff($date2);
    $nightCount=intval($interval->format('%a'));
      if(($nightCount%10)==1)
          $nightCount.=' Ночь';
      else if((($nightCount%10)==2)||(($nightCount%10)==3)||(($nightCount%10)==4))
          $nightCount.=' Ночи';
      else $nightCount.=' Ночей';
    $day1=intval($date1->format('d'));
    $month1=Yii::app()->controller->monthes[intval($date1->format('m'))];
    $day2=intval($date2->format('d'));
    $month2=Yii::app()->controller->monthes[intval($date2->format('m'))];
?>
<div class="floatL from_to">
  <span><?=$nightCount?>  (<?=$day1." ".$month1." - ".$day2." ".$month2?>)</span>
</div>