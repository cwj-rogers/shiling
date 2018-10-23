<?php
$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-home',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    /* 默认路由 */
    'defaultRoute' => 'index',
    /* 控制器默认命名空间 */
    'controllerNamespace' => 'hjzhome\controllers',
    /* 源语言 */
    'sourceLanguage' => 'zh-CN',
    /* 目标语言 */
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    //文件方式存储日志操作对应操作对象
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','error'],
                    'logVars' => [],
                ],
                /* 使用数据库存储日志 */
                'db' => [
                    //数据库存储日志对象
                    'class' => 'yii\log\DbTarget',
                    //同上
                    'levels' => ['error', 'warning'],
                    'logVars' => ['_SESSION'],
                ]
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'public/error',
        ],
        'session' => [
            'class' => 'yii\web\Session'
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => '/',
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'db' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=rm-wz9v7k8a32633m1zt5o.mysql.rds.aliyuncs.com;port=3306;dbname=bdm314524321_db',
            'username'    => 'hjzhome',
            'password'    => 'Hjzhome888'
        ],
        //阿里
        'db_hjz' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=rm-wz9v7k8a32633m1zt5o.mysql.rds.aliyuncs.com;port=3306;dbname=bdm314524321_db',
            'username'    => 'hjzhome',
            'password'    => 'Hjzhome888'
        ],
        //搬瓦
        'db_bw' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=95.169.30.158;port=3306;dbname=bdm314524321_db',
            'username'    => 'root',
            'password'    => 'root'
        ],
    ],
    'params' => $params,
];
