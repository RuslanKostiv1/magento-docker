<?php
return [
    'system' => [
        'default' => [
            'product_recommendations' => [
                'frontend_url' => 'https://admin-ui-qa.magento-datasolutions.com/loader.js',
                # Connect to recs admin UI running locally
                #'frontend_url' => 'http://localhost:1234/loader.js',
                'content_security_policy' => 'assets.adobedtm.com use.typekit.net p.typekit.net recommendations-admin-ui.s3.amazonaws.com amcglobal.sc.omtrdc.net admin-ui-qa.magento-datasolutions.com',
            ],
        ],
    ],
];
