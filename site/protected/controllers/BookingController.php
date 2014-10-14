<?php

class BookingController extends Controller
{
    public $header;


	public function actionIndex()
	{
        if(!isset($_GET['id']) or !isset($_GET['block']))
        {
            throw new CHttpException(404);
        }

        $hotels_id = $_GET['id'];
        $blockId = $_GET['block'];
        $blocks = OneHotelView::getBlocks($hotels_id);
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

        $booking = new BookingForm();

        if (isset($_POST['BookingForm'])) {
            $booking->setAttributes($_POST['BookingForm']);
            if ($booking->validate()) {
                $response = Service::booking(1);
                $this->redirect($this->createUrl('booking/card'));
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
        $this->header=$this->renderPartial('/headers/booking-card',array(),true);
        $this->layout='/layouts/main-bez-footer';
        $this->render('card');
	}

    public function actionFinished()
	{
        $this->render('finished');
	}


}
