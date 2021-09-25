<?php

namespace Rumus\core;

use Rumus\core\Contexts\RouterHandlerContext;
use Rumus\core\Interfaces\RouterInterface;

class Router implements RouterInterface
{
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    private RouterHandlerContext $handler;

    public function handle(): void
    {
        var_dump($_SERVER);
    }

    public function get(string $path, $handler): void
    {
        $this->initHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->initHandler(self::METHOD_POST, $path, $handler);
    }

    private function initHandler(string $method, string $path, $handler): void
    {
        $this->handler = new RouterHandlerContext($path, $method, $handler);
    }
}