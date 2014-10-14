<?php

class SearchController extends Controller
{

    public $header;

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        Yii::app()->session['cityHotelsIds']=array();
        $data=array();
        $arrivalDate='';
        $error=null;
        $departureDate='';
        $goodSign=0;
        $s=false;
        $isGoodArrivalDate=isset($_GET['day_arr'])&&isset($_GET['month_year_arr']);
        $isGoodDepartureDate=isset($_GET['day_dep'])&&isset($_GET['month_year_dep']);
        $arriveDateFromSession=Yii::app()->session['arrival_date'];
        $departDateFromSession=Yii::app()->session['departure_date'];

        $currentDate=new DateTime();
        $currentTimeStamp=$currentDate->getTimestamp();
        if(isset($_GET['s'])){
            $s=strip_tags($_GET['s']);
            if(isset($_GET['is_href']))
            {
                $is_href = true;
            } else {
                $is_href = false;
            }
            if( $isGoodArrivalDate ){
                if($is_href and $arriveDateFromSession)
                {
                    $arrivalDate=$arriveDateFromSession;
                } else {
                    $arrivalDate=$_GET['month_year_arr']."-".$_GET['day_arr'];
                    Yii::app()->session['arrival_date']=$arrivalDate;
                }
            }else if($arriveDateFromSession){
                $arrivalDate=$arriveDateFromSession;
            }

            if($arrivalDate){
                $arrivalDateObj=new DateTime($arrivalDate);
                $arrivalDateTimeStamp=$arrivalDateObj->getTimestamp();


                $today = new DateTime();
                $today=$today->sub(new \DateInterval('P1D'));

                if($today->getTimestamp()>=$arrivalDateTimeStamp){
                    $error='Дата прибытия не может быть в прошлом';
                }else{
                    $goodSign++;
                }
            }

            if($isGoodDepartureDate){
                if($is_href and $arriveDateFromSession)
                {
                    $departureDate=$departDateFromSession;
                } else {
                    $departureDate=$_GET['month_year_dep']."-".$_GET['day_dep'];
                    Yii::app()->session['departure_date']= $departureDate;
                }
            }else if($departDateFromSession){
                $departureDate=$departDateFromSession;
            }
            if($departureDate){
                $departureDateObj=new DateTime($departureDate);
                $departureDateTimeStamp=$departureDateObj->getTimestamp();
                if(isset($arrivalDateTimeStamp) and $arrivalDateTimeStamp>=$departureDateTimeStamp){
                    $error='Дата отъезда должна быть большей, чем дата приезда';
                }else{
                     $goodSign++;
                }
            }

            if($goodSign==2){
                $data=Service::search($s);
            }

        }

        $parameters['day_arr'] = isset($_GET['day_arr'])?$_GET['day_arr']:null;
        $parameters['month_year_arr'] = isset($_GET['month_year_arr'])?$_GET['month_year_arr']:null;
        $parameters['day_dep'] = isset($_GET['day_dep'])?$_GET['day_dep']:null;
        $parameters['month_year_dep'] = isset($_GET['month_year_dep'])?$_GET['month_year_dep']:null;
        $this->render('index',array('data'=>$data,'s'=>$s,'error'=>$error, 'parameters'=>$parameters));
	}


}