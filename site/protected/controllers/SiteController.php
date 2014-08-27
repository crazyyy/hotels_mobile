<?php

class SiteController extends Controller
{
    public $header;

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $data=Service::mainPage();
        $date=new DateTime();
        $year= $date->format('Y');
        $monthNumber= intval($date->format('m'));
        if(isset($_GET['month'])){
            $monthNumber=  intval($_GET['month']);
            if($monthNumber>12) $monthNumber=12;
            if($monthNumber<1) $monthNumber=1;
        }
        $days=cal_days_in_month(CAL_GREGORIAN, $monthNumber,  $year);
        $this->render('index',array('data'=>$data,'year'=>$year,'monthNumber'=>$monthNumber,'days'=>$days));
	}

    public function actionError(){
        if($error=Yii::app()->errorHandler->error)
                $this->render('error', $error);
    }

    public function actionMenu()
	{
        $this->render('menu');
	}

    public function actionFilter()
	{
        if(isset($_GET) and count($_GET))
        {
            $prices = null;
            $classes = null;
            $facilities = null;
            $hotel_types = null;

            if(isset($_GET['price']))
            {
                $prices = $_GET['price'];
            }
            if(isset($_GET['class']))
            {
                $classes = $_GET['class'];
            }
            if(isset($_GET['facility']))
            {
                $facilities = $_GET['facility'];
            }
            if(isset($_GET['hotel_type']))
            {
                $hotel_types = $_GET['hotel_type'];
            }
            $hotels = Filters::getFilteringHotels($prices, $hotel_types, $facilities, $classes);
        }
        $this->render('filter');
	}



    public function actionContacts()
	{
        $referer='/';
        if(isset($_SERVER['HTTP_REFERER']))
            $referer=$_SERVER['HTTP_REFERER'];
        $this->layout='/layouts/main-bez-footer';
        $this->header=$this->renderPartial('/headers/site-contacts',array('referer'=>$referer),true);
        $this->render('contacts');
	}


}
