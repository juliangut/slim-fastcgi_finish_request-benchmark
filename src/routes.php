<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->get('/[{name}]', function (ServerRequestInterface $request, ResponseInterface $response, array $args = []) {
    return $this->renderer->render($response, 'index.phtml', $args);
});
