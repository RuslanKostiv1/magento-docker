<?php
return [
    'system' => [
        'default' => [
            'magento_saas' => [
                'environment' => 'sandbox',
            ],
            'live_search' => [
                'frontend_url' => 'https://search-admin-ui-qa.magento-datasolutions.com/v0/admin.js',
            ],
            'live_search_metrics' => [
                'metrics_url' => 'https://livesearch-metrics-qa.magento-datasolutions.com/v0/liveSearchMetrics.js',
            ],
            'live_search_storefront_popover' => [
                'frontend_url' => 'https://searchautocompleteqa.magento-datasolutions.com/v1/LiveSearchAutocomplete.js',
            ],
            'services_connector' => [
                'sandbox_gateway_url' => 'https://commerce-int.adobe.io/',
                'sandbox_magi_gateway_url' => 'https://qa-api.magedevteam.com/',
                'api_portal_url' => 'https://account-stage.magedevteam.com/apiportal/index/index/',
                'services_id' => [
                    'frontend_url' => 'https://services-connector-qa.magento-datasolutions.com/v1/index.js',
                ],
            ],
            'live_search_product_listing' => [
                'frontend_url' => 'https://plp-widgets-ui-qa.magento-datasolutions.com/v2/search.js',
            ],
            'catalog_sync_admin' => [
                'frontend_url' => 'https://data-management-external-qa.magento-datasolutions.com/v1/index.js',
                'frontend_css_url' => 'https://data-management-external-qa.magento-datasolutions.com/v1/index.css'
            ],
        ],
    ],
];