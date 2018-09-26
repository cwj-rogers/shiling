<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('BACKEND_COOKIE_VALIDATION_KEY'),
        ],
        'db' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=gz-cdb-ecmy83dx.sql.tencentcdb.com;port=62387;dbname=yii2admin',
            'username'    => 'root',
            'password'    => 'hjzhome888'
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['120.79.17.199', '113.69.40.103']//'127.0.0.1', '::1',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '120.79.17.199', '113.69.40.103']
    ];
}

return $config;
