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
    'container' => [
        'definitions' => [
            \app\components\robots\generators\GeneratorRobotsTxtInterface::class => [
                'class' => \app\components\robots\generators\GeneratorRobotsTxt::class,
                'directives' => [
                    'User-agent: *',
                    'Sitemap: http://yii2-nsign-basic/sitemap.xml',
                ],
                'directive_generators' => [
                    'Disallow' => \app\components\robots\generators\DisallowGenerator::class,
                    'Allow' => \app\components\robots\generators\AllowGenerator::class,
                    'Clean-param' => \app\components\robots\generators\CleanParamGenerator::class,
                    'Crawl-delay' => \app\components\robots\generators\CrawlDelayGenerator::class,
                ],
            ],

            \app\components\redirect\RedirectInterface::class => \app\components\redirect\Redirect::class,

            \app\components\redirect\adapters\SourceAdapterInterface::class => [
                'class' => \app\components\redirect\adapters\Adapter::class,
                'params' => ['from', 'to', 'status'],
            ],

            \app\components\redirect\decoders\DecodeInterface::class => [
                'class' => \app\components\redirect\decoders\CsvDecode::class,
                'file' => '../files/redirect.csv',
            ],
        ],

        'singletons' => [
            'Robo' => [
                'class' => \app\components\robots\RobotsTxtInterface::class,
                'dirs' => [
                    'Disallow' => '',
                    'Allow' => '',
                    'Clean-param' => '',
                    'Crawl-delay' => ''
                ],
                'robots' => \app\components\robots\adapters\AdapterRobotsInterface::class,
            ],
            \app\components\robots\RobotsTxtInterface::class => \app\components\robots\RobotsTxt::class,

            \app\components\robots\adapters\AdapterRobotsInterface::class => \app\components\robots\adapters\ArrayAdapter::class,

            /*'Redirect' => [
                'class' => \app\components\redirect\RedirectInterface::class,
                'source_adapters' => [
                    'decoders' => \app\components\redirect\adapters\SourceAdapterInterface::class,
                ],
            ],*/
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kZAwaJq7425xRO1g1XmLJdZgSrpQkw2N',
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                ['pattern' => 'robots', 'route' => 'web/index', 'suffix' => '.txt'],
            ],
        ],

        'formatter' => [
          'class' => '\app\components\FormatterPhoneNumber',
          'locale' => 'ru-RU',
          'dateFormat' => 'dd.MM.yyyy',
          'datetimeFormat' => 'dd.MM.yyyy HH:mm:ss',
          'decimalSeparator' => ',',
          'thousandSeparator' => '.',
          'nullDisplay' => 'нет данных',
          'phoneMask' => '+7($1) $2-$3-$4',
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;