<?php

return [
    /* filename */
    'product-recommendations/ProductRecommendationsLayout/etc/csp_whitelist.xml' => [
        /* replace from => to */
        'api.magento.com' => 'qa-api.magedevteam.com',
        'commerce.adobe.io' => 'commerce-int.adobe.io',
        'magento-recs-sdk.adobe.net' => 'sdk.magento-datasolutions.com',
    ],
    'product-recommendations/PageBuilderProductRecommendations/etc/csp_whitelist.xml' => [
        'api.magento.com' => 'qa-api.magedevteam.com',
        'commerce.adobe.io' => 'commerce-int.adobe.io',
        'magento-recs-sdk.adobe.net' => 'sdk.magento-datasolutions.com',
    ],
    'product-recommendations-admin/ProductRecommendationsAdmin/etc/csp_whitelist.xml' => [
        'api.magento.com' => 'qa-api.magedevteam.com',
        'commerce.adobe.io' => 'commerce-int.adobe.io',
        'commerce.adobedc.net' => 'admin-ui-qa.magento-datasolutions.com',
    ],
    'product-recommendations/ProductRecommendationsLayout/view/frontend/requirejs-config.js' => [
        'magento-recs-sdk.adobe.net/v2/index' => 'sdk.magento-datasolutions.com/qa/v2/index',
    ],
    'catalog-sync-admin/CatalogSyncAdmin/etc/csp_whitelist.xml' => [
        'api.magento.com' => 'qa-api.magedevteam.com',
        'commerce.adobe.io' => 'commerce-int.adobe.io',
        'commerce.adobe.net' => 'catalog-sync-ui-qa.magento-datasolutions.com',
    ],
];
