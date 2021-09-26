<?php

declare(strict_types=1);

const METHOD_SEPARATOR = '@';

use JetBrains\PhpStorm\NoReturn;
use Rumus\Core\Router\Router;
use Rumus\Http\Controllers\FileManagerController;
use Rumus\Http\Controllers\MaxPrimeDivisorController;

#[NoReturn]
function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}

require __DIR__.'/../vendor/autoload.php';

try {
    $router = new Router();
    $router->get('/', function () {
        echo 'Home page';
    });
    $router->post('/about', function () {
        echo 'About page';
    });
    $router->get('/file-manager', FileManagerController::class . METHOD_SEPARATOR . 'index');
    $router->get('/max-prime-divisor', MaxPrimeDivisorController::class . METHOD_SEPARATOR . 'index');
    $router->post('/find-max-prime-number', MaxPrimeDivisorController::class . METHOD_SEPARATOR . 'find');

    $router->addNotFoundHandler(function (string $path, string $method) {
        echo 'Path:' . $path . ' by ' . $method . ' method not found!';
    });
    $router->handle();

} catch (\Throwable $exception) {
    echo $exception->getMessage();
}
