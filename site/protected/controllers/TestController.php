<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 11/5/14
 * Time: 2:18 PM
 */

class TestController extends Controller
{
    public $header;

    public function actionIndex(){
        $this->render('index');
    }
} 