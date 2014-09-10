<?php

class HotelsController extends Controller
{
    public $header;

    public function getHotelOr404($hotelId)
    {
        if (!$hotelId) {
            throw new CHttpException(404);
        }

        $res = Service::getHotelInfo($hotelId);
        if (!isset($res['data'][$hotelId])) {
            throw new CHttpException(404);
        }

        $hotel = & $res['data'][$hotelId];

        $reviews = Service::getReviews($hotelId);
        $hotel['commentsCount'] = count($reviews);

        return $hotel;
    }

    /**
     * Слайдер фоток на страницах просмотра информации о отеле.
     * @param integer $hotelId
     * @return array
     */
    protected function getSlider($hotelId)
    {
        $slider = array();

        $photosRes = Service::getHotelPhoto($hotelId);
        $photos = $photosRes['data'];

        $currentPos = intval(Yii::app()->request->getParam('slideTo'));

        $currentPos = min(count($photos) - 1, $currentPos);
        $currentPos = max(0, $currentPos);

        $slider['current'] = $currentPos;
        $slider['prev'] = $currentPos > 0 ? $currentPos - 1 : null;
        $slider['next'] = $currentPos < count($photos) - 1 ? $currentPos + 1 : null;
        if (count($photos)) {
            $slider['image'] = str_replace('img.hotels24.prod', 'img.hotels24.ua', $photos[$currentPos]['url_max_300']);
        } else {
            $slider['image'] = null;
        }

        return $slider;
    }

    public function actionInfo()
    {
        $hotel = $this->getHotelOr404(Yii::app()->request->getParam('id'));

        if(!isset(Yii::app()->session['viewedHotels']))
        {
            $viewedHotels = array();
        } else {
            $viewedHotels = Yii::app()->session['viewedHotels'];
        }
        $issetViewed =0;
        foreach ($viewedHotels as $viewed) {
            if($viewed['hotel_id'] == $hotel['hotel_id'])
            {
                $issetViewed = 1;
            }
        }
        if($issetViewed != 1)
        {
            $viewedHotels[] = array(
                'hotel_id' => $hotel['hotel_id'],
                'date' => new DateTime('now'),
            );
            Yii::app()->session['viewedHotels'] = $viewedHotels;
        }

        $this->render('info', array(
            'hotel'  => $hotel,
            'slider' => $this->getSlider($hotel['hotel_id']),
        ));
    }


    public function actionRooms()
    {
        $hotel = $this->getHotelOr404(Yii::app()->request->getParam('id'));

        $session = Yii::app()->session;

        $roomsApi = Service::getBlockAvailability($hotel['hotel_id'], null, null, $session['arrival_date'], $session['departure_date']);

        if ($roomsApi['data']) {
            $rooms = array();
            foreach ($roomsApi['data'] as $block) {
                foreach ($block['block'] as $entry) {
                    $room = $entry;
                    $room['photo'] = reset($room['photos']);
                    $rooms[] = $room;
                }
            }
        } else {
            $rooms = array();
        }

        $this->render('rooms', array(
            'hotel'  => $hotel,
            'rooms'  => $rooms,
            'slider' => $this->getSlider($hotel['hotel_id']),
        ));
    }

    public function actionViewed()
    {
        $referer = '/';
        if (isset($_SERVER['HTTP_REFERER']))
            $referer = $_SERVER['HTTP_REFERER'];
        $this->header = $this->renderPartial('/headers/hotels-viewed', array('referer' => $referer), true);

        $data = null;
        if(isset(Yii::app()->session['viewedHotels']))
        {
            $data = Yii::app()->session['viewedHotels'];
        }

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = 0;
        }
        $limit = 10;

        $dataPagination = array();
        if($data)
        {
            foreach ($data as $key => $value) {
                if($key>=$page*$limit and $key<($page+1)*$limit)
                {
                    $dataPagination[] = $value;
                }
            }
        }

        $this->render('viewed', array(
                'limit'=>$limit,
                'page'=>$page,
                'data'=>$data,
                'dataPagination' => $dataPagination
            ));
    }

    public function actionHalfprice()
    {
        $data=array();
        $discount = 50;

        $data=Service::getDiscount($discount);

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = 0;
        }
        $limit = 10;

        $dataPagination = array();
        if($data['data'])
        {
            foreach ($data['data'] as $key => $value) {
                if($key>=$page*$limit and $key<($page+1)*$limit)
                {
                    $dataPagination[] = $value;
                }
            }
        }

        $this->render('halfprice', array(
                'limit'=>$limit,
                'page'=>$page,
                'data'=>$data,
                'dataPagination' => $dataPagination
            ));
    }


    public function actionMap()
    {
        $hotel = $this->getHotelOr404(Yii::app()->request->getParam('id'));
        $this->render('map', array(
            'hotel'  => $hotel,
            'slider' => $this->getSlider($hotel['hotel_id']),
        ));
    }

    public function actionReviews()
    {
        $hotel = $this->getHotelOr404(Yii::app()->request->getParam('id'));

        $reviews = array_reverse(Service::getReviews($hotel['hotel_id']));

        $pagination = new CPagination(count($reviews));
        $pagination->setPageSize(5);
        $pagination->setCurrentPage(Yii::app()->request->getParam('page', 1) - 1);

        $reviews = array_slice($reviews, $pagination->getOffset(), $pagination->getLimit());

        foreach ($reviews as &$review) {
            $totalRating = 0;
            foreach ($review['grades'] as $grade) {
                $totalRating += $grade['value'];
            }

            $review['rating'] = number_format($totalRating / (count($review['grades']) ? : 1), 1);
        }

        $this->render('reviews', array(
            'hotel'      => $hotel,
            'reviews'    => $reviews,
            'pagination' => $pagination,
            'slider'     => $this->getSlider($hotel['hotel_id']),
        ));
    }

    public function actionByCity()
    {
        $data=array();
        $ids=Yii::app()->session['cityHotelsIds'];
        $label=null;

        $id = null;
        if(isset($_GET['id']) and $_GET['id']!=null){
            $id=intval($_GET['id']);
            if(isset($ids['cityId-'.$id]))
                $label=$ids['cityId-'.$id];
            $arrival_date=Yii::app()->session['arrival_date'];
            $departure_date=Yii::app()->session['departure_date'];
            $data=Service::getBlockAvailability(null,$id,null,$arrival_date,$departure_date);
        }

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = 0;
        }
        $limit = 10;

        $dataPagination = array();
        if($data['data'])
        {
            foreach ($data['data'] as $key => $value) {
                if($key>=$page*$limit and $key<($page+1)*$limit)
                {
                    $dataPagination[] = $value;
                }
            }
        }

        $this->render('list',array(
                'limit'=>$limit,
                'page'=>$page,
                'cityId'=>$id,
                'data'=>$data,
                'label'=>$label,
                'dataPagination' => $dataPagination
            ));
    }

    public function actionByRegion()
   	{
        $data=array();
        $ids=Yii::app()->session['cityHotelsIds'];
        $label=null;
        if(isset($_GET['id'])){
            $id=intval($_GET['id']);
            if(isset($ids['regionId-'.$id]))
                $label=$ids['regionId-'.$id];
            $arrival_date=Yii::app()->session['arrival_date'];
            $departure_date=Yii::app()->session['departure_date'];
            $data=Service::getBlockAvailability(null,null,$id,$arrival_date,$departure_date);
        }
        $this->render('list',array('data'=>$data,'label'=>$label));
   	}

}
