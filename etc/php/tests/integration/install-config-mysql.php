<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
return [
    'db-host' => 'db',
    'db-user' => 'root',
    'db-password' => '',
    'db-name' => 'magento_integration_tests',
    'db-prefix' => '',
    'search-engine' => 'elasticsearch6',
    'elasticsearch-host' => 'elastic',
    'elasticsearch-port' => '9200', 
    'backend-frontname' => 'backend',
    'admin-user' => \Magento\TestFramework\Bootstrap::ADMIN_NAME,
    'admin-password' => \Magento\TestFramework\Bootstrap::ADMIN_PASSWORD,
    'admin-email' => \Magento\TestFramework\Bootstrap::ADMIN_EMAIL,
    'admin-firstname' => \Magento\TestFramework\Bootstrap::ADMIN_FIRSTNAME,
    'admin-lastname' => \Magento\TestFramework\Bootstrap::ADMIN_LASTNAME,
    'document-root-is-pub'   => 'true',
];
