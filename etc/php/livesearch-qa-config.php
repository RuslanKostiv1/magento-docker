<?php

return [
    /* filename */
    'data-services/DataServices/view/frontend/requirejs-config.js' => [
        /* replace from => to */
        'commerce.adobedtm.com/v6' => 'js.magento-datasolutions.com/qa/snowplow/events/v6',
        'magento-storefront-events-sdk@^1/dist/index' => 'magento-storefront-events-sdk@qa/dist/index',
        'magento-storefront-event-collector@^1/dist/index' => 'magento-storefront-event-collector@qa/dist/index',
    ],
    'data-services/DataServices/etc/csp_whitelist.xml' => [
        'commerce.adobedtm.com' => 'js.magento-datasolutions.com',
        'commerce.adobedc.net' => 'com-magento-qa1.collector.snplow.net',
    ],
];
