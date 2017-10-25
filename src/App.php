<?php
/**
 * Created by PhpStorm.
 * User: julian
 * Date: 9/11/17
 * Time: 10:57 PM
 */

namespace Jgut\Slim\Benchmark;

use Psr\Http\Message\ResponseInterface;
use Slim\Exception\InvalidMethodException;

class App extends \Slim\App
{
    public function fastCgiRun($silent = false)
    {
        $container = $this->getContainer();

        $response = $container->get('response');

        try {
            $response = $this->process($container->get('request'), $response);
        } catch (InvalidMethodException $e) {
            $response = $this->processInvalidMethod($e->getRequest(), $response);
        }

        if (!$silent) {
            $this->fastCgiRespond($response);
        }

        return $response;
    }

    public function fastCgiRespond(ResponseInterface $response)
    {
        $this->respond($response);

        if (function_exists('fastcgi_finish_request')) {
            \fastcgi_finish_request();
        } else {
            throw new \RuntimeException('fastcgi_finish_request function not available');
        }

        return $this;
    }
}
