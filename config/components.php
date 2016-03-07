<?php
/**
 * Created by PhpStorm.
 * User: Jaylee
 * Date: 15/6/9
 * Time: 23:30
 */

return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'sjclijie',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'app\models\User',
        'enableAutoLogin' => true,
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db' => require(__DIR__ . '/db.php'),
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        //'suffix' => '',
        'rules' => [
            'index' =>  'site/index',
            'about' =>  'site/about',
            [
                'pattern'   =>  'views/<page:\d+>/<tag>',
                'route'     =>  'site/view',
                'defaults'  =>  [
                    'page'  => 1,
                    'tag'   => 'hello'
                ]
            ],
            [
                'pattern'   => 'http://<site:\w+>.yii.com:8080/jaylee/<id:\w+>',
                'route'     => 'site/jaylee',
                'defaults'   =>  [
                    'site'  => 'www',
                    'id'    => 0
                ]
            ]
        ]
    ]
];