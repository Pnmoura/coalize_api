<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'JurF6e72AmB1nm_hvX52CRH7z5arVTrr',
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
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/app.log', // Configuração de arquivo de log
                ],
            ],
        ],

        'db' => $db,

        'as authenticator' => [
            'class' => 'yii\filters\auth\HttpBearerAuth',
            'except' => ['auth/login'], // Exceto a rota de autenticação
        ],
        

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //Rota para criação de usuário
                'api/user/create' => 'user/create',

                //Rota para autenticação 
                'api/auth/login' => 'auth/login',

                //Rotas ligadas a cliente
                'api/create' => 'client/create',
                'api/clients' => 'client/custom-select', // Rota personalizada para o SELECT completo
                'api/clients/<page:\d+>' => 'client/custom-select', // Rota personalizada para paginação
                
                //Rotas ligadas a produtos
                'api/product/create' => 'product/create',
                'api/product/list-by-client/<clientId:\d+>' => 'product/list-by-client',
                'api/product/<limit:\d+>' => 'product/index',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '172.21.0.1', '172.22.0.1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['127.0.0.1', '::1', '172.21.0.1', '172.22.0.1'],
    ];
}

return $config;
