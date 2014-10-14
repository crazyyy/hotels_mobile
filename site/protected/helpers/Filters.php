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
            'included' => array(2),
            'excluded' => array(),
            'name' => 'Апартаменты',
        ),
        2 => array(
            'included' => array(1),
            'excluded' => array(),
            'name' => 'Отель',
        ),
        3 => array(
            'included' => array(13),
            'excluded' => array(),
            'name' => 'Хостел'
        ),
        4 => array(
            'included' => array(34),
            'excluded' => array(),
            'name' => 'Мини отель',
        ),
        5 => array(
            'included' => array(),
            'excluded' => array(2,1,13,34),
            'name' => 'Другие',
        ),
    );

    public static $maxPricesAr = array(
        1 => array(
            'min' => 0,
            'max' => 100,
        ),
        2 => array(
            'min' => 100,
            'max' => 300,
        ),
        3 => array(
            'min' => 300,
            'max' => 600,
        ),
        4 => array(
            'min' => 600,
            'max' => 1000,
        ),
        5 => array(
            'min' => 1000,
            'max' => null,
        ),
    );

    public static $facilitiesAr = array(
        1 => 'Автостоянка',
        2 => 'Бассейн',
        3 => 'Интернет',
        4 => 'Размещение с животными',
        5 => 'Спортивные развлечения',
    );

    public static function getFilteringHotels($dataAvailability, $filters)
    {
        $hotelsIds = array();
        foreach ($dataAvailability['data'] as $hotel) {
            $hotelsIds[] = $hotel['hotel_id'];
        }

//        $city_id = 18058; // Одесса
        $data = Service::getHotelInfo($hotelsIds, null, null, null, $order_mode=null);
        $hotels = $data['data'];

        $prices = isset($filters['price'])?$filters['price']:null;
        $hotel_types = isset($filters['hotel_type'])?$filters['hotel_type']:null;
        $facilities = isset($filters['facility'])?$filters['facility']:null;
        $classes = isset($filters['class'])?$filters['class']:null;

        if($classes)
        {
            $hotels = self::filterByClasses($hotels, $classes);
        }

        if($hotel_types)
        {
            $hotel_types1 = array();
            foreach ($hotel_types as $hotel_type) {
                $hotel_types1[] = self::$hotelsTypeAr[$hotel_type];
            }
            $hotels = self::filterByHotelTypes($hotels, $hotel_types1);
        }

        if($facilities)
        {
            $facilities1 = array();
            foreach ($facilities as $facility) {
                $facilities1[] = self::$facilitiesAr[$facility];
            }
            $hotels = self::filterByFacilities($hotels, $facilities1);
        }

        $dataAvailability1 = array();
        foreach ($hotels as $hotel) {
            foreach ($dataAvailability['data'] as $element) {
                if($element['hotel_id'] == $hotel['hotel_id'])
                {
                    $dataAvailability1[] = $element;
                }
            }
        }

        if($prices)
        {
            $prices1 = array();
            foreach ($prices as $price) {
                $prices1[] = self::$maxPricesAr[$price];
            }
            $dataAvailability1 = self::filterByPrice($dataAvailability1, $prices1);
        }

//        $dataAvailability['data'] = $dataAvailability1;
        return $dataAvailability1;
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

    public static function filterByPrice($data, $prices)
    {
//        $hotelIds = array();
//        foreach ($data as $hotel) {
//            $hotelIds[] = $hotel['hotel_id'];
//        }
//
//        $arrival_date=Yii::app()->session['arrival_date'];
//        $departure_date=Yii::app()->session['departure_date'];
//        $dataBlockAvailabilityResponse=Service::getBlockAvailability($hotelIds,null,null,$arrival_date,$departure_date);
//        $dataBlockAvailability = $dataBlockAvailabilityResponse['data'];
//
////        Якщо вільних номерів немає, то отель не попаде в $dataBlockAvailability
////        тоді ціну не отримати (=
//
//        $data1 = array();
//        foreach ($data as $id => $hotel) {
//            foreach ($dataBlockAvailability as $element) {
//                if($element['hotel_id']==$hotel['hotel_id'])
//                {
//                    $minPrice = OneHotelView::getMinFilterPrice($element['block']);
//                    $hit=0;
//                    foreach ($prices as $price) {
//                        if($price['min']<=$minPrice)
//                        {
//                            if($price['max']===null or $minPrice<=$price['max'])
//                            {
//                                $hit=1;
//                            }
//                        }
//                    }
//                    if($hit==1)
//                    {
//                        $data1[$id] = $hotel;
//                    }
//                }
//            }
//        }

        $data1 = array();
        foreach ($data as $element) {
            foreach ($prices as $price) {
                if($price['min']<=$element['minPrice'])
                {
                    if($price['max']===null or $element['minPrice']<=$price['max'])
                    {
                        $data1[] = $element;
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
                if($hotel['class'] == $class)
                {
                    $data1[$id] = $hotel;
                    break;
                }
            }
        }
        return $data1;
    }

    public static  function filterByHotelTypes($data, $types)
    {
        $data1 = array();
        $included = array();
        $excluded = array();
        foreach ($types as $type) {
            $included = array_merge($included, $type['included']);
            $excluded = array_merge($excluded, $type['excluded']);
        }

        $excluded1 = array();
        foreach ($excluded as $excl) {
            $hit = 0;
            foreach ($included as $incl) {
                if($excl==$incl)
                {
                    $hit = 1;
                    break;
                }
            }
            if($hit == 0)
            {
                $excluded1[] = $excl;
            }
        }

        foreach ($data as $id => $hotel) {
            if(count($excluded1))
            {
                foreach ($excluded1 as $excl) {
                    if($hotel['hoteltype_id'] != $excl)
                    {
                        $data1[$id] = $hotel;
                        break;
                    }
                }
            } else {
                foreach ($included as $incl) {
                    if($hotel['hoteltype_id'] == $incl)
                    {
                        $data1[$id] = $hotel;
                        break;
                    }
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