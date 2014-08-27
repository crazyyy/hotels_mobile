<?php

class OneHotelView
{
    const IMAGE_FORMAT_SMALL = 'sm';

    const IMAGE_FORMAT_BIG = 'z600';

    const IMAGE_FORMAT_MEDIUM = 'mx';

    public static function render($oneHotel){
        $hotel_id = $oneHotel['hotel_id'];
        $dataHotelInfoResponse = Service::getHotelInfo($hotel_id);
        $dataHotelInfo = $dataHotelInfoResponse['data'][$hotel_id];

        $dataHotelInfo['hotel_photo'] = self::listImageSrc($dataHotelInfo);

        $dataBlocks = $oneHotel['block'];
        $dataHotelInfo['min_price'] = self::getMinPrice($dataBlocks);

        $reviewBest = Service::getReviewBest($hotel_id);
        if(count($reviewBest))
        {
            $dataHotelInfo['review'] = round($reviewBest[$hotel_id]['rating'],1);
        }

        Yii::app()->getController()->renderPartial('oneHotelInList',array(
                'data'=>$oneHotel,
                'dataHotelInfo'=>$dataHotelInfo,
            ));

    }

    public static function renderHalfPrice($oneHotel)
    {
        $hotel_id = $oneHotel['hotel_id'];
        $dataHotelInfoResponse = Service::getHotelInfo($hotel_id);
        $dataHotelInfo = $dataHotelInfoResponse['data'][$hotel_id];

        $dataHotelInfo['hotel_photo'] = self::listImageSrc($dataHotelInfo);

        $reviewBest = Service::getReviewBest($hotel_id);
        if(count($reviewBest))
        {
            $dataHotelInfo['review'] = round($reviewBest[$hotel_id]['rating'],1);
        }

        Yii::app()->getController()->renderPartial('oneHotelInHalfPriceList',array(
                'data'=>$oneHotel,
                'dataHotelInfo'=>$dataHotelInfo,
            ));
    }

    public static function renderViewed($oneHotel)
    {
        $hotel_id = $oneHotel['hotel_id'];

        $dataHotelInfo = self::getHotelInfo($hotel_id);
        $dataHotelInfo['min_price'] = self::getPriceById($hotel_id);
        $review = self::getReview($hotel_id);
        if($review !== null)
        {
            $dataHotelInfo['review'] = $review;
        }

        Yii::app()->getController()->renderPartial('oneHotelInViewedList',array(
                'dataHotelInfo'=>$dataHotelInfo,
            ));
    }

    public static function getBlocks($hotel_id)
    {
        $arrival_date=Yii::app()->session['arrival_date'];
        $departure_date=Yii::app()->session['departure_date'];
        $data=Service::getBlockAvailability($hotel_id,null,null,$arrival_date,$departure_date);

        $dataBlocks = $data['data'][0]['block'];
        return $dataBlocks;
    }

    public static function getPriceById($hotel_id)
    {
        $dataBlocks = self::getBlocks($hotel_id);
        $min_price = self::getMinPrice($dataBlocks);
        return $min_price;
    }

    public static function getReview($hotel_id)
    {
        $reviewBest = Service::getReviewBest($hotel_id);
        $review = null;
        if(count($reviewBest))
        {
            $review = round($reviewBest[$hotel_id]['rating'],1);
        }
        return $review;
    }

    public static function getHotelInfo($hotel_id)
    {
        $dataHotelInfoResponse = Service::getHotelInfo($hotel_id);
        $dataHotelInfo = $dataHotelInfoResponse['data'][$hotel_id];

        $dataHotelInfo['hotel_photo'] = self::listImageSrc($dataHotelInfo);

        return $dataHotelInfo;
    }

    public static function getMinPrice($dataBlocks)
    {
        $price = $dataBlocks[0]['min_price']['price'];
        foreach ($dataBlocks as $dataBlock) {
            if($price>$dataBlock['min_price']['price'])
            {
                $price = $dataBlock['min_price']['price'];
            }
        }
        return $price;
    }

    public static function getMinFilterPrice($dataBlocks)
    {
        $price = $dataBlocks[0]['block_price'];
        foreach ($dataBlocks as $dataBlock) {
            if($price>$dataBlock['block_price'])
            {
                $price = $dataBlock['block_price'];
            }
        }
        return $price;
    }

    public static function listImageSrc($dataHotelInfo)
    {
//        $hotel_photo = $dataHotelInfo['hotel_photo'];
//        $replacePattern = preg_quote('.jpg');
//        $hotel_photo = preg_replace("/$replacePattern?/", '', $hotel_photo);
//        $hotel_photo = 'http://img.hotels24.ua/photos/'.$hotel_photo.'sm.jpg';
//        $dataHotelInfo['hotel_photo'] = $hotel_photo;
//
//        $hotel_photo = self::imageSrc($dataHotelInfo['hotel_photo']);
        $url = $dataHotelInfo['hotel_photo_url']['url_square100'];
        $url = str_replace('img.hotels24.prod', 'img.hotels24.ua', $url);
        return $url;
    }

    public static function imageSrc($path, $format = self::IMAGE_FORMAT_SMALL)
    {
        $url = 'http://img.hotels24.ua/photos/' . ltrim($path, '/');
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        $url = str_replace(".{$ext}", "{$format}.$ext", $url);
        return $url;
    }
}