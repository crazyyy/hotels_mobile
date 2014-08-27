<?php

class SearchResultView
{
    public static function render($key,$data){

            if($key=='cities')
            {
                $label='Города';
                $img='/images/town.png';
                $prop='cityName';
            }
            else if($key=='regions'){
                $label='Регионы';
                $img='/images/clock.png';
                $prop='regionName';

            }
            else if($key=='hotels') {
                $label='Отели';
                $img='/images/motel.png';
                $prop='hotelCity';
            }
            Yii::app()->getController()->renderPartial('oneResult',array('label'=>$label,'img'=>$img,'prop'=>$prop,'data'=>$data));

    }

}