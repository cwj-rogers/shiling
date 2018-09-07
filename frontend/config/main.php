<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
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
    'controllerNamespace' => 'frontend\controllers',
    /* 模块 */
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
    ],
    'components' => [
        // overtrue 微信SDK
        'wechat' => [
            'class' => 'maxwen\easywechat\Wechat',
            // 'userOptions' => []  # user identity class params
            // 'sessionParam' => '' # wechat user info will be stored in session under this key
            // 'returnUrlParam' => '' # returnUrl param stored in session
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
        ],
        /* 修改默认的request组件 */
        'request' => [
            'class' => 'common\core\Request',
            'baseUrl' => Yii::getAlias('@frontendUrl'),
        ],
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
            'enablePrettyUrl' => env('FRONTEND_PRETTY_URL', true),
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];
