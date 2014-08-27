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
            if( $isGoodArrivalDate){
                    $arrivalDate=$_GET['month_year_arr']."-".$_GET['day_arr'];
                    Yii::app()->session['arrival_date']=$arrivalDate;

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
                    $departureDate=$_GET['month_year_dep']."-".$_GET['day_dep'];
                    Yii::app()->session['departure_date']= $departureDate;

            }else if($departDateFromSession){
                    $departureDate=$departDateFromSession;
            }
            if($departureDate){
                $departureDateObj=new DateTime($departureDate);
                $departureDateTimeStamp=$departureDateObj->getTimestamp();
                if($arrivalDateTimeStamp>=$departureDateTimeStamp){
                    $error='Дата отъезда должна быть большей, чем дата приезда';
                }else{
                     $goodSign++;
                }
            }

            if($goodSign==2){
                $data=Service::search($s);
            }

        }
        $this->render('index',array('data'=>$data,'s'=>$s,'error'=>$error));
	}


}
