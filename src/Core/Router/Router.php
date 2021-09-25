<?php

namespace Rumus\Core\Router;

use Rumus\Core\Interfaces\RouterInterface;
use Rumus\Core\Router\Contexts\RouterHandlerContext;

class Router implements RouterInterface
{
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    /** @var array|RouterHandlerContext[] */
    private array $handlers;
    private $notFoundHandler;

    public function handle(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach ($this->handlers as $handlerContext) {
            if ($handlerContext->path === $requestPath && $handlerContext->method === $requestMethod) {
                $callback = $handlerContext->handler;
            }
        }
        if (is_string($callback)) {
            $parts = explode('@', $callback);
            if (is_array($parts)) {
                $className = array_shift($parts);
                $method = array_shift($parts);
                $handler = new $className;
                $callback = [$handler, $method];
            }
        }
        if (!$callback) {
            header('HTTP/2.0 404 Not Found');
            if (!empty($this->notFoundHandler)) {
                call_user_func_array($this->notFoundHandler, [$requestPath, $requestMethod]);
            }
            return;
        }
        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
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
        $this->handlers[] = new RouterHandlerContext($path, $method, $handler);
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }
}
