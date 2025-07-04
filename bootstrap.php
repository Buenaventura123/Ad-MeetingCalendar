<?php
define('BASE_PATH', realpath(__DIR__));
define('UTILS_PATH', BASE_PATH . '/utils');
define('DUMMIES_PATH', BASE_PATH . '/staticDatas/dummies');

chdir(BASE_PATH);

require_once BASE_PATH . '/vendor/autoload.php';

