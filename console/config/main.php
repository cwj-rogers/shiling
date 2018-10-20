<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'providers' => [
                'app\tests\unit\faker\providers\Book',
            ],
        ],
        'dbloc' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=localhost;port=3306;dbname=bdm314524321_db',
            'username'    => 'root',
            'password'    => 'root',
            'charset'     => 'utf8',
            'tablePrefix' => 'ecs_',
        ],
        //阿里
        'db_hjz' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=rm-wz9v7k8a32633m1zt5o.mysql.rds.aliyuncs.com;port=3306;dbname=bdm314524321_db',
            'username'    => 'hjzhome',
            'password'    => 'Hjzhome888'
        ]
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'e282486518\migration\ConsoleController',
        ],
    ],
    'params' => $params,
];
