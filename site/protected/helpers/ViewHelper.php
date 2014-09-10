<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 8/21/14
 * Time: 6:18 PM
 */

class ViewHelper {

    public static $monthNamesAr = array(
        1 => array(
            'nominative'=>'Январь',
            'genitive' => 'Января'
        ),
        2 =>  array(
            'nominative'=>'Февраль',
            'genitive' => 'Февраля'
        ),
        3 => array(
            'nominative'=>'Март',
            'genitive' => 'Марта'
        ),
        4 => array(
            'nominative'=>'Апрель',
            'genitive' => 'Апреля'
        ),
        5 => array(
            'nominative'=>'Май',
            'genitive' => 'Мая'
        ),
        6 => array(
            'nominative'=>'Июнь',
            'genitive' => 'Июня'
        ),
        7 => array(
            'nominative'=>'Июль',
            'genitive' => 'Июля'
        ),
        8 => array(
            'nominative'=>'Август',
            'genitive' => 'Августа'
        ),
        9 => array(
            'nominative'=>'Сентябрь',
            'genitive' => 'Сентября'
        ),
        10 => array(
            'nominative'=>'Октябрь',
            'genitive' => 'Октября'
        ),
        11 => array(
            'nominative'=>'Ноябрь',
            'genitive' => 'Ноября'
        ),
        12 => array(
            'nominative'=>'Декабрь',
            'genitive' => 'Декабря'
        ),
    );

    public static $weekDaysShortAr = array(
        1 => array(
            'short' => 'Пн',
            'full' => 'Понедельник',
        ),
        2 => array(
            'short' => 'Вт',
            'full' => 'Вторник',
        ),
        3 => array(
            'short' => 'Ср',
            'full' => 'Среда',
        ),
        4 => array(
            'short' => 'Чт',
            'full' => 'Четверг',
        ),
        5 => array(
            'short' => 'Пт',
            'full' => 'Пятница',
        ),
        6 => array(
            'short' => 'Сб',
            'full' => 'Субота',
        ),
        7 => array(
            'short' => 'Вс',
            'full' => 'Воскресение',
        ),
    );

    public static function mkViewedDate($date)
    {
//        чт - 10 июля - 2014
        $weekDay = $date->format('N');
        $weekDay = self::$weekDaysShortAr[$weekDay]['short'];

        $monthDay = $date->format('j');

        $month = $date->format('n');
        $month = self::$monthNamesAr[$month]['genitive'];

        $year = $date->format('Y');

        return $weekDay.' - '.$monthDay.' '.$month.' - '.$year;
    }

    public static function mkBookingDate($date)
    {
//        суббота, 25 января
        $weekDay = $date->format('N');
        $weekDay = self::$weekDaysShortAr[$weekDay]['full'];
        $monthDay = $date->format('j');
        $month = $date->format('n');
        $month = self::$monthNamesAr[$month]['genitive'];
        return $weekDay.', '.$monthDay.' '.$month;
    }

    public static function bookingOccupancyFormat($max_occupancy)
    {
        switch($max_occupancy)
        {
            case 1:
                $format = $max_occupancy.' место';
                break;
            case 2:
            case 3:
            case 4:
                $format = $max_occupancy.' места';
                break;
            default:
                $format = $max_occupancy.' мест';
                break;
        }
        return $format;
    }

    /**
     * Example: 2 Июня 2014
     *
     * @param $date
     */
    public static function dateFull($date)
    {
        return Yii::app()->dateFormatter->format('d MMMM y', $date);
    }
} 