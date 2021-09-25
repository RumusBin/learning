<?php

namespace Rumus\Core\Router\Contexts;

class RouterHandlerContext
{
    public const PATH = 'path';
    public const METHOD = 'method';
    public const HANDLER = 'handler';

    public string $path;
    public string $method;
    public $handler;

    /**
     * @param string $path
     * @param string $method
     * @param $handler
     */
    public function __construct(string $path, string $method, $handler)
    {
        $this->path = $path;
        $this->method = $method;
        $this->handler = $handler;
    }

    public function toArray(): array
    {
        return [
            self::METHOD => $this->method,
            self::PATH => $this->path,
            self::HANDLER => $this->handler
        ];
    }
}
