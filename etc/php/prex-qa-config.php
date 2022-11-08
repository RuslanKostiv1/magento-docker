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
    'catalog-sync-admin/CatalogSyncAdmin/etc/csp_whitelist.xml' => [
        'api.magento.com' => 'qa-api.magedevteam.com',
        'commerce.adobe.io' => 'commerce-int.adobe.io',
        'commerce.adobe.net' => 'catalog-sync-ui-qa.magento-datasolutions.com',
    ],
];
