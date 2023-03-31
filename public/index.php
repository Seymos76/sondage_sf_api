<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
$trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false;
dump($trustedProxies);
$trustedProxies = $trustedProxies ? explode(',', $trustedProxies) : [];
dump($trustedProxies);
if('prod' === $_SERVER['APP_ENV']) $trustedProxies[] = $_SERVER['REMOTE_ADDR'];
dump($trustedProxies);
if($trustedProxies) {
    Request::setTrustedProxies($trustedProxies, Request::HEADER_X_FORWARDED_AWS_ELB);
}
