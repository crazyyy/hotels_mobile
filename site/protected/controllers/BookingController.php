<?php

//use application\models\booking\IndexForm;

class BookingController extends Controller
{
    public $header;


	public function actionIndex()
	{
        if(!isset($_GET['id']) or !isset($_GET['block']))
        {
            throw new CHttpException(404);
        }

        $arrival_date=Yii::app()->session['arrival_date'];
        $departure_date=Yii::app()->session['departure_date'];

        $hotels_id = $_GET['id'];
        $blockId = $_GET['block'];
        $blocks = OneHotelView::getBlocks($hotels_id);

        $block = [];

        foreach ($blocks as $element) {
            if($element['block_id'] == $blockId)
            {
                $block = $element;
                break;
            }
        }

        $urlPhoto = $block['photos'][0]['url_square100'];
        $urlPhoto = str_replace('img.hotels24.prod', 'img.hotels24.ua', $urlPhoto);
        $block['photo'] = $urlPhoto;

        $dataHotelInfo = OneHotelView::getHotelInfo($hotels_id);

        $this->header=$this->renderPartial('/headers/booking-index',array(),true);
        $this->layout='/layouts/main-bez-footer';

        $booking = new IndexForm();

        if (isset($_POST['IndexForm'])) {
            $booking->setAttributes($_POST['IndexForm']);
            $isValid = $booking->validate();
            if ($isValid) {
                $request = array(
                    'arrivalDate'   => $arrival_date,
                    'departureDate' => $departure_date,
                    'blocks'        => array(
                        0 => array(
                            'id'         => $block['block_id'],
                            'tariff'     => $block['tariff_id'],
                            'totalCost'  => $block['incremental_price'][0]['price'],
                            "living" => [],
                            'conditions' => array(
                                'cancellation'  => $block['cancel_booking_day'],
                                'bookingMethod' => $block['booking_method']
                            ),
                        )
                    ),
                    'requisites'    => array(
                        'fistName' => $booking->firstName,
                        'lastName' => $booking->lastName,
                        'email'    => $booking->email,
                        'phone'    => $booking->phone,
                    ),
//                    'nextState' => 'requisites',
                );
                $response = Service::booking($request);

                $hotelData = OneHotelView::getHotelInfo($hotels_id);

                if($response['state']['type'] == 'complete')
                {
                    if($response['state']['status'] == 'ok')
                    {
                        $this->redirect($this->createUrl('booking/finished',
                                BookingHelper::getBookingDataForRequest($booking, $hotelData, $response['booking']['bookingId'])));
                    }
                }

                if($response['state']['type'] == 'payment')
                {

                    if(!isset($response['booking']['conditions']['paymentMethods'])) {
                        throw new Exception('No payment methods available');
                    }

                    foreach($response['booking']['conditions']['paymentMethods'] as $payment) {

                        try {
                            $bookingMethods = $response['booking']['conditions']['bookingMethod'];
                        } catch (Exception $e) {
                            throw $e;
                        };

                        if($bookingMethods === Service::BOOKING_METHOD_CARD_TRANSFER) {
                            if ($payment['type'] == 853) {
                                try {
                                    $this->redirect(
                                        [
                                            'booking/card/?' . BookingHelper::getBookingDataForRequest($booking, $hotelData, $response['booking']['bookingId'])
                                        ]
                                    );
                                } catch (CHttpException $e) {
                                    throw $e;
                                }
                            }
                        } elseif($bookingMethods === Service::BOOKING_METHOD_PREPAID) {
                            if($payment['type'] === 843) {

                                $successRedirectUrl = http_build_url('booking/platonredirect/',[
                                        'query' => BookingHelper::getBookingDataForRequest($booking, $hotelData, $response['booking']['bookingId'])
                                    ]);

                                try {
                                    $platonData = Service::getPlatonData(
                                        $payment['rel'],
                                        $successRedirectUrl,
                                        './'
                                    );
                                    $this->redirect([
                                            'booking/platon',
                                            'data' => $platonData
                                        ]);
                                } catch (Exception $e) {
                                    throw $e;
                                }
                            }
                        } else {
                            die('todo other payment methods');
                        }
                    }

                }

                if($response['state']['type'] == 'requisites')
                {
                    if($response['state']['status'] == 'rejection')
                    {
                        $requestId = $response['requestId'];
                        $rejected = $response['statusBody'];
                        $blocksCorrect = $response['booking']['blocks'];
                        $request = array(
                            'arrivalDate'   => $arrival_date,
                            'departureDate' => $departure_date,
                            'blocks'        => $response['booking']['blocks'],
                            'requisites'    => array(
                                'fistName' => $booking->firstName,
                                //                        'lastName' => 'Скайвокер',
                                //                        'lastName' => 'Палпатин',
                                'lastName' => $booking->lastName,
//                                                        'lastName' => $booking->lastName,
                                'email'    => $booking->email,
                                'phone'    => $booking->phone,
                            ),
//                            'requestId' => $requestId,
                            'nextState' => 'requisites',
                        );
                        $response = Service::booking($request);
                        // ...
                    } elseif($response['state']['status'] == 'failure') {
//                        Любая другая фамилия - вернет статус failure
                    }
                }
            }
        }

        $this->render('index', array(
            'block' => $block,
            'booking' => $booking,
            'dataHotelInfo' => $dataHotelInfo,
        ));
	}

    public function actionCard()
	{
        /** @var CHttpRequest $request */
        $request = Yii::app()->request;

        $this->header=$this->renderPartial('/headers/booking-card',array(),true);
        $this->layout='/layouts/main-bez-footer';
        $this->render('card', BookingHelper::getBookingDataFromRequest($request));
	}

    public function actionPlaton() {
        $data = Yii::app()->request->getParam('data');
        $this->header = $this->renderPartial('/headers/booking-card', array(), true);
        $this->layout = '/layouts/main-bez-footer';
        $this->render('platon', $data);
    }

    public function actionPlatonRedirect() {
        /** @var CHttpRequest $request */
        $request = Yii::app()->request;
        $url = http_build_url(
            'booking/finished',
            [
                'query' => http_build_str(BookingHelper::getBookingDataFromRequest($request))
            ]
        );
        $this->render('platonRedirect', ['url' => $url]);
    }

    public function actionFinished()
	{
        /** @var CHttpRequest $request */
        $request = Yii::app()->request;


        $this->render('finished', BookingHelper::getBookingDataFromRequest($request));
	}


}
