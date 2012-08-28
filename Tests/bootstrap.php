<?php

$autoloadFile = __DIR__.'/../vendor/autoload.php';

if (!is_file($autoloadFile)) {
    throw new RuntimeException('Could not find autoloader. Did you run "composer.phar install --dev"?');
}

$loader = require_once $autoloadFile;

if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/locale/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->add('', __DIR__.'/../vendor/symfony/locale/Symfony/Component/Locale/Resources/stubs');
}
