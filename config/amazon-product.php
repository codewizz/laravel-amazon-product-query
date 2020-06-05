<?php

return [
    'api_key' => env('AMAZON_PRODUCT_KEY', ''),
    'api_secret_key' => env('AMAZON_PRODUCT_SECRET_KEY', ''),

    'associate_tags' => [
        'ae' => env('AMAZON_PRODUCT_AE_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.com.au marketplace
        'au' => env('AMAZON_PRODUCT_AU_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.ae marketplace
        'br' => env('AMAZON_PRODUCT_BR_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.com.br marketplace
        'ca' => env('AMAZON_PRODUCT_CA_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.ca marketplace
        'de' => env('AMAZON_PRODUCT_DE_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.de marketplace
        'es' => env('AMAZON_PRODUCT_ES_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.es marketplace
        'fr' => env('AMAZON_PRODUCT_FR_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.fr marketplace
        'in' => env('AMAZON_PRODUCT_IN_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.in marketplace
        'it' => env('AMAZON_PRODUCT_IT_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.it marketplace
        'jp' => env('AMAZON_PRODUCT_JP_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.co.jp marketplace
        'mx' => env('AMAZON_PRODUCT_MX_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.mx marketplace
        'nl' => env('AMAZON_PRODUCT_NL_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.nl marketplace
        'sg' => env('AMAZON_PRODUCT_SG_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.sg marketplace
        'tr' => env('AMAZON_PRODUCT_TR_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.com.tr marketplace
        'uk' => env('AMAZON_PRODUCT_UK_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.co.uk marketplace
        'us' => env('AMAZON_PRODUCT_US_ASSOCIATE_TAG', ''),     // Associate tag for https://www.amazon.com marketplace
    ],

    'default_market' => env('AMAZON_PRODUCT_DEFAULT_MARKET', 'us')
];
