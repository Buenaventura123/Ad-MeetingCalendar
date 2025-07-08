<?php
define('BASE_PATH', realpath(__DIR__));
define('UTILS_PATH', BASE_PATH . '/utils');
define('DUMMIES_PATH', BASE_PATH . '/staticDatas/dummies');
define('COMPONENTS_PATH', BASE_PATH . '/components');
define('STATICDATAS_PATH', BASE_PATH . '/staticDatas');

chdir(BASE_PATH);

require_once BASE_PATH . '/vendor/autoload.php';

