<?php

class Service
{
    private static $apiKey = '4ab14a8d0d4f052682c805003191feab83a85c0a98cc8399eacea466417055b2';

    public static  $timeCaching=86400;

    /**
     * тип цены за номер
     */
    const PRICE_TYPE_PER_NUMBER = 1;

    /**
     * тип цены за место
     */
    const PRICE_TYPE_PER_PERSON = 2;


    /**
     * метод бронирования предоплата
     */
    const BOOKING_METHOD_PREPAID = 0;

    /**
     * метод бронирования оплата в отеле
     */
    const BOOKING_METHOD_PAY_IN_HOTEL = 1;

    /**
     * метод бронирования передача карточки
     */
    const BOOKING_METHOD_CARD_TRANSFER = 4;


    private static $defaultOptions = array(
        'useApiKey' => false,
        'cache'     => false,
    );

    public static  function request($host,$url,$params=array(), $options = array()){
        $curl = Yii::app()->curl;
        /* @var $curl Curl */

        $options = array_merge(self::$defaultOptions, $options);

        $headers = $headers = $curl->getHeaders();
        if ($options['useApiKey']) {
            $headers['apiKey'] = self::$apiKey;
        } elseif (isset($headers['apiKey'])) {
            unset($headers['apiKey']);
        }
        $curl->setHeaders($headers);

        $useCache = $options['cache'];
        $key = md5($host . $url . serialize($params) . $options['useApiKey']);
        if ($useCache) {
            $data = Yii::app()->cache->get($key);
            if (false === $data) {
                $data = json_decode($curl->get($host . $url, $params), true);
                Yii::app()->cache->set($key, $data, $options['cache']);
            } elseif(isset($data['data']) and $data['data']===null){
                $data = json_decode($curl->get($host . $url, $params), true);
                Yii::app()->cache->set($key, $data, $options['cache']);
            }
        } else {
            $data = json_decode($curl->get($host . $url, $params), true);
        }
        return $data;
    }

    public static function getDiscount($discount = null)
    {
        $params = array();
        if($discount)
        {
            $params['discount'] = $discount;
        }
        $params['apiKey'] = '4ab14a8d0d4f052682c805003191feab83a85c0a98cc8399eacea466417055b2';
        $data=self::request(Yii::app()->params->api['production'],'hotel/discount',$params, array(
            'cache' => 300,
        ));
        return $data;
    }


    public static function search($s,$callback=''){
        $cacheValue=Yii::app()->cache->get($s);

        $url = Yii::app()->params->api['productionAjax'].'===='.Yii::app()->params->api['ajaxUrl'];

        if(!$cacheValue){
            $data=self::request(Yii::app()->params->api['productionAjax'],Yii::app()->params->api['ajaxUrl'],array('e'=>'ac',
                                                                              'target'=>'completer',
                                                                              's'=>$s,
                                                                              'e'=>'ac',
                                                                              'callback'=>$callback ));
            Yii::app()->cache->set($s, $data, self::$timeCaching);
            return $data;
        }
        else
            return $cacheValue;
    }

//    example service/getblockavailability?hotelIds=3082,3085&arrival_date=2014-07-03&departure_date=2014-07-05
    public static function getBlockAvailability($hotelIds,$city_ids,$region_ids,$arrival_date,$departure_date,$hoteltype_id=null,$stars=null){
        $params=array();

        if(isset($hotelIds))
            $params['hotel_ids']=$hotelIds;
        if(isset($city_ids))
            $params['city_ids']=$city_ids;
        if(isset($region_ids))
            $params['Region_ids']=$region_ids;
        try{
            $params['arrival_date']=$arrival_date;
            $params['departure_date']=$departure_date;
        }
        catch(Exception $e){
            die('missed require params!');
        }
        if(isset($hoteltype_id))
         $params['hoteltype_id']=$hoteltype_id;
        if(isset($stars))
            $params['stars']=$stars;

        $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlBlockAvalability'],$params, array(
                'cache' => 300,
//                'useApiKey' => true
            ));
        return $data;
    }



//    example service/gethotelInfo?hotelIds=3082
//@TODO:got ERROR
    public static  function getHotelInfo($hotelIds,$cityId='',$regionId='',$hoteltype_id='',$order_mode='')
    {
        $params=array();
        try{
            $params['hotel_ids']=$hotelIds;
            $params['cityId']=$cityId;
            $params['regionId']=$regionId;

        }
        catch(Exception $e){
           die('missed require params!');
        }
        $params['hoteltype_id']=$hoteltype_id;
        $params['order_mode']=$order_mode;

        $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlHotelInfo'],$params, array(
            'cache' => 300,
            'useApiKey' => true
        ));
        return $data;
    }

//    example /service/gethotelphoto/3082
    public static  function getHotelPhoto($id){
        $id=intval($id);
        $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlHotelPhoto'],array('hotelId'=>$id), array(
            'useApiKey' => true,
            'cache' => 300,
        ));
        return $data;
    }
//example /service/gethotelfacilities?hotelIds=3082,3085
//@TODO:got NULL FROM RESPONSE!
    public static  function getHotelFacilities($hotelIds){
        $params=array();
        if(!$hotelIds)
           die('missed require params!');
        $params['hotel_ids']=$hotelIds;
        $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlHotelFacilities'],$params);
        return $data;
    }
//example service/GetRoomInfo?hotelIds=2,3
//example service/GetRoomInfo?roomIds=2,3
    public static  function getRoomInfo($hotelIds,$roomIds){
            $params=array();
            if(!$hotelIds&&!$roomIds)
                    die('missed require params!');
            if($hotelIds) $params['hotelIds']=$hotelIds;
            if($roomIds) $params['roomIds']=$roomIds;

            $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlRoom'],$params);
            return $data;
        }
//example service/GetRoomPhoto?roomId=2,3
//example /service/GetRoomPhoto?hotelId=2,3
    public static  function getRoomPhoto($hotelId,$roomId){
            $params=array();
            if(!$hotelId&&!$roomId)
                    die('missed require params!');
            if($hotelId) $params['hotelId']=$hotelId;
            if($roomId) $params['roomId']=$roomId;

            $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlRoomPhoto'],$params);
            return $data;
        }

//example service/GetCityInfo?regionId=2,3
// or service/GetCityInfo?regionId=2&cityId=18604
    public static function getCityInfo($regionId,$cityId){
            $params=array();
            if(!$regionId)
                    die('missed require params!');
            $params['regionId']=$regionId;
            if($cityId)    $params['cityId']=$cityId;


            $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlCity'],$params);
            return $data;
        }

//service/GetRegionInfo?regionId=2
    public static function getRegionInfo($regionId,$cityId,$hotelId,$regionType){
            $params=array();
            if(!$regionId)
                    die('missed require params!');
            $params['regionId']=$regionId;

             if($cityId)   $params['cityId']=$cityId;
             if($hotelId) $params['hotelId']=$hotelId;
             if($regionType)   $params['regionType']=$regionType;

            $data=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlRegion'],$params);
            return $data;
        }

    public static function mainPage(){
        $data=array();
        $data[0]=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlCity'],array('regionId'=>5,'cityId'=>'18302,18389,18058'));
        $data[1]=self::request(Yii::app()->params->api['production'],Yii::app()->params->api['urlRegion'],array('regionId'=>5));
        return $data;
    }

    /**
     * Информация об среднем рейтинге по отзывам
     * Обязательным является наличие одного из параметров(hotel_ids,cityId, region)
     * @param string|array $hotelId Id отелей (string через запятую) принимает id произвольного количества гостиниц через запятую
     * @param null $cityId Id города (int)
     * @param null $regionId Id региона (int)
     */
    public static function getReviewBest($hotelId, $cityId = null, $regionId = null)
    {
        $response = self::request('http://api.hotels24.ua', '/review/best/', array(
            'hotelId'  => $hotelId,
            'cityId'   => $cityId,
            'regionId' => $regionId
        ), array(
            'cache' => 300
        ));

        return $response['data'];
    }


    public static function booking($data)
    {
        $data = array(
            'arrivalDate'   => (new \DateTime())->format('Y-m-d'),
            'departureDate' => (new \DateTime("+1 days"))->format('Y-m-d'),
            'blocks'        => array(
                array(
                    'id'         => 1,
                    'tariff'     => '5425476b6b06784d498b4567',
                    'totalCost'  => 400,
                    'living'     => [],
                    'conditions' => array(
                        'cancellation'  => 1001,
                        'bookingMethod' => 3
                    ),
                )
            ),
            'requisites'    => array(
                'fistName' => 'TestFirstName',
                'lastName' => 'TestLastName',
                'email'    => 'test.email@hotels24.ua',
                'phone'    => '+3805555555'
            ),
            'nextState' => 'preRequisites',
        );

        $response = Yii::app()->curl->post('http://api.test.hotels24.ua/test/fast-booking', array(
            'request' => json_encode($data)
        ));
        $data = json_decode($response, true);
        return $data;
    }


    /**
     * Отзывы для страницы отзывов
     *
     * @param integer $hotelId Id отеля
     * @return mixed
     */
    public static function getReviews($hotelId)
    {
        $response = self::request('http://api.hotels24.ua', '/review/', array(
            'hotelId' => $hotelId,
            'apiKey'  => self::$apiKey,
        ), array(
            'cache' => 300
        ));

        return $response['data'];
    }
}