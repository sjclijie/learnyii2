<?php
/**
 * Created by PhpStorm.
 * User: Jaylee
 * Date: 15/6/9
 * Time: 23:41
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\User;

class LoginController extends Controller {

    public function actionIndex(){

        echo json_encode(["status"=>4000,"data"=>["name"=>"jaylee"]]);
        exit;
    }

    public function actionSignup(){


    }

    public function actionLogin(){

    }
}

