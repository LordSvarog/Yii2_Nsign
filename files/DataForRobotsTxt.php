<?php

$data = [
    'host' => 'yii2-nsign-basic',
    'sitemap' => ['/sitemap.xml'],
    'userAgent' => [
        '*' => [
            'Disallow' => [
                'web',
            ],
            'Allow' => [
                'site/index'
            ],
        ],
        'BingBot' => [
            'Disallow' => [
                'site/contact'
            ],
            'Allow' => [
                'site/about'
            ],
            'Sitemap' => '/sitemapSpecialForBing.xml',
        ],
        'Googlebot' => [
            'Disallow' => [
                'site/login'
            ],
            'Allow' => [
                'site/logout'
            ],
            'Sitemap' => '/sitemapSpecialForGoogle.xml',
        ],
    ],
];