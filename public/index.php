<?php

use Jgut\Slim\Benchmark\App;
use Jgut\Slim\Benchmark\Formatter;

$startTime = microtime(true);

require __DIR__ . '/../vendor/autoload.php';

$app = new App(require __DIR__ . '/../src/settings.php');
require __DIR__ . '/../src/dependencies.php';
require __DIR__ . '/../src/routes.php';

/** @var Monolog\Logger $logger */
$logger = $app->getContainer()->get('logger');
/** @var \Psr\Http\Message\ServerRequestInterface $request */
$request = $app->getContainer()->get('request');

$query = $request->getQueryParams();

if (isset($query['fastcgi'])) {
    $app->fastCgiRun();
} else {
    $app->run();
}

if (isset($query['sleep'])) {
    sleep((int) $query['sleep']);
}

$logger->info(sprintf('Execution time: %s', Formatter::formatTime(microtime(true) - $startTime)));
