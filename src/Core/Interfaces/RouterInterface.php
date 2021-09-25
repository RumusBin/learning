<?php

namespace Rumus\Core\Interfaces;

interface RouterInterface
{
    public function handle();

    public function get(string $path, $handler): void;

    public function post(string $path, $handler): void;
}