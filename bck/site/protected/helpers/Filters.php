<?php
/**
 * Created by PhpStorm.
 * User: sand
 * Date: 8/22/14
 * Time: 1:49 PM
 */

class Filters {

    public static  $hotelsTypeAr = array(
        1 => array(
            'id' => 2,
            'name' => 'Апартаменты',
        ),
        2 => array(
            'id' => 1,
            'name' => 'Отель',
        ),
        3 => array(
            'id' => 13,
            'name' => 'Хостел'
        ),
        4 => array(
            'id' => 34,
            'name' => 'Мини отель',
        ),
        5 => null,
    );

    public static $maxPricesAr = array(
        1 => 100,
        2 => 300,
        3 => 600,
        4 => 1000,
        5 => null,
    );

    public static $facilitiesAr = array(
        1 => 'Автостоянка',
        2 => 'Бассейн',
        3 => 'Интернет',
        4 => 'Размещение с животными',
        5 => 'Спортивные развлечения',
    );

    public static function getFilteringHotels($prices, $hotel_types, $facilities, $classes)
    {
        $hoteltype_ids = array();
        foreach ($hotel_types as $hotel_type) {
            if(self::$hotelsTypeAr[$hotel_type])
            {
                $hoteltype_ids[] = self::$hotelsTypeAr[$hotel_type]['id'];
            }
        }

        $city_id = 18058; // Одесса
        $data = Service::getHotelInfo(null, $city_id, null, null, $order_mode=null);
        $data = $data['data'];

        $hotels = $data;

        if($classes)
        {
            $hotels = self::filterByClasses($hotels, $classes);
        }

        if($facilities)
        {
            $facilities1 = array();
            foreach ($facilities as $facility) {
                $facilities1[] = self::$facilitiesAr[$facility];
            }
            $hotels = self::filterByFacilities($hotels, $facilities1);
        }

        if($prices)
        {
            $count = count($prices);
            $maxPrice = self::$maxPricesAr[$prices[$count-1]];
            if($maxPrice)
            {
                $hotels = self::filterByPrice($hotels, $maxPrice);
            }
        }

        return $hotels;
    }

    public static function sortByPrice($data)
    {
        $hotelIds = array();
        foreach ($data as $hotel) {
            $hotelIds[] = $hotel['hotel_id'];
        }

        $arrival_date=Yii::app()->session['arrival_date'];
        $departure_date=Yii::app()->session['departure_date'];
        $dataBlockAvailabilityResponse=Service::getBlockAvailability($hotelIds,null,null,$arrival_date,$departure_date);
        $dataBlockAvailability = $dataBlockAvailabilityResponse['data'];

        $minPrices = array();
        foreach ($data as $id => $hotel) {
            $minPrice = OneHotelView::getMinPrice($dataBlockAvailability[$hotel['hotel_id']]['block']);
            $minPrices[] = $minPrice;
        }
        array_multisort($minPrices, $data);

        return $data;
    }

    public static function filterByPrice($data, $maxPrice)
    {
        $hotelIds = array();
        foreach ($data as $hotel) {
            $hotelIds[] = $hotel['hotel_id'];
        }

        $arrival_date=Yii::app()->session['arrival_date'];
        $departure_date=Yii::app()->session['departure_date'];
        $dataBlockAvailabilityResponse=Service::getBlockAvailability($hotelIds,null,null,$arrival_date,$departure_date);
        $dataBlockAvailability = $dataBlockAvailabilityResponse['data'];

        $data1 = array();
        foreach ($data as $id => $hotel) {
            foreach ($dataBlockAvailability as $element) {
                if($element['hotel_id']==$hotel['hotel_id'])
                {
                    $minPrice = OneHotelView::getMinFilterPrice($element['block']);
                    if($minPrice<=$maxPrice)
                    {
                        $data1[$id] = $hotel;
                    }
                }
            }
        }

        return $data1;
    }

    public static function filterByFacilities($data, $facilities)
    {
        $data1 = array();
        foreach ($data as $id => $hotel) {
            $countRequires = count($facilities);
            $countMatches = 0;
            foreach ($facilities as $requiere) {
                foreach ($hotel['facilities'] as $facility) {
                    if($facility['name'] == $requiere)
                    {
                        $countMatches++;
                        break;
                    }
                }
            }
            if($countRequires == $countMatches)
            {
                $data1[$id] = $hotel;
            }
        }

        return $data1;
    }

    public static function filterByClasses($data, $classes)
    {
        $data1 = array();
        foreach ($data as $id => $hotel) {
            foreach ($classes as $class) {
                if($hotel['class'] = $class)
                {
                    $data1[$id] = $hotel;
                    break;
                }
            }
        }
        return $data1;
    }

    public static function sortByFacilities($data)
    {
        ;
    }

    public static function sortByClasses($data)
    {
        ;
    }
} 