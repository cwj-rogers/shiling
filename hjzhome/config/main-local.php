<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY'),
        ],
//        'db' => [
//            'class'       => 'yii\db\Connection',
//            'dsn'         => 'mysql:host=127.0.0.1;port=3306;dbname=yii2admin',
//            'username'    => 'root',
//            'password'    => 'root'
//        ],
       //搬瓦
//        'db_bw' => [
//            'class'       => 'yii\db\Connection',
//            'dsn'         => 'mysql:host=95.169.30.158;port=3306;dbname=bdm314524321_db',
//            'username'    => 'root',
//            'password'    => 'root'
//        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
