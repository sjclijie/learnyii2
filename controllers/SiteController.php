<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Url;


/*
class Post extends yii\base\Object {

    private $_title;

    public function getTitle(){
        return $this->_title;
    }

    public function setTitle($value){
        $this->_title = $value;
    }
}

$post = new Post();

$post->title = 'xxx';

var_dump($post->title);

unset($post->titlea);

var_dump( isset($post->title) );

var_dump($post->hasProperty('title'));

exit;
*/

/**
 *  Behavior
 */

/*
class MyClass extends yii\base\Component {

}*/

// Step 2: 定义一个行为类，他将绑定到MyClass上
/*class MyBehavior extends yii\base\Behavior
{
    // 行为的一个属性
    public $property1 = 'This is property in MyBehavior.';

    // 行为的一个方法
    public function method1()
    {
        return 'Method in MyBehavior is called.';
    }
}*/

//$myClass = new MyClass();

//$myClass->attachBehavior('test', new MyBehavior());

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($message = "Hello world")
    {
        return $this->render('index');
    }

    public function actionView( $tag, $page ){

        var_dump( $tag, $page );
    }

    public function actionJaylee( $site, $id = 1){

        echo 'site:'.$site.'<br />';
        echo 'id:'. $id. '<br />';

    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
