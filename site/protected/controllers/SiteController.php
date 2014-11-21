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
//        Service::booking(array());
        $data=Service::mainPage();
        $date=new DateTime();
        $year= $date->format('Y');
        $monthNumber= intval($date->format('m'));
        if(isset($_GET['month'])){
            $monthNumber=  intval($_GET['month']);
            if($monthNumber>12) $monthNumber=12;
            if($monthNumber<1) $monthNumber=1;
        }
        $s = null;
        if(isset($_GET['s']))
        {
            $s = $_GET['s'];
        }
        $days=cal_days_in_month(CAL_GREGORIAN, $monthNumber,  $year);
        $this->render('index',array('data'=>$data,'year'=>$year,'monthNumber'=>$monthNumber,'days'=>$days,'s'=>$s));
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
        if(isset($_GET['referer']))
        {
            $urlFilter = '';
            if(isset($_GET['price']))
            {
                foreach ($_GET['price'] as $key=>$value) {
                    $urlFilter.='&price'.'['.$key.']'.'='.$value;
                }
            }
            if(isset($_GET['class']))
            {
                foreach ($_GET['class'] as $key=>$value) {
                    $urlFilter.='&class'.'['.$key.']'.'='.$value;
                }
            }
            if(isset($_GET['facility']))
            {
                foreach ($_GET['facility'] as $key=>$value) {
                    $urlFilter.='&facility'.'['.$key.']'.'='.$value;
                }
            }
            if(isset($_GET['hotel_type']))
            {
                foreach ($_GET['hotel_type'] as $key=>$value) {
                    $urlFilter.='&hotel_type'.'['.$key.']'.'='.$value;
                }
            }

            if(isset($_GET['unset']))
            {
                $urlFilter = '';
            }

            $this->redirect(urldecode($_GET['referer']).$urlFilter);
        } else {
            $referer='/';
            if(isset($_SERVER['HTTP_REFERER']))
                $referer=$_SERVER['HTTP_REFERER'];

            $this->render('filter', array(
                    'referer'=>urlencode($referer),
                ));
        }
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

    public function actionHelp()
    {
        $this->render('help');
    }

    public function actionAbout()
    {
        $this->render('about');
    }

    public function actionConfidence()
    {
        $this->render('confidence');
    }

}
