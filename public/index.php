<?php

declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;
use Rumus\Core\Router\Router;
use Rumus\Http\Controllers\FileManagerController;

#[NoReturn]
function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}

const METHOD_SEPARATOR = '@';

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

    $router->addNotFoundHandler(function (string $path, string $method) {
        echo 'Path:' . $path . ' by ' . $method . ' method not found!';
    });
    $router->handle();

} catch (\Throwable $exception) {
    echo $exception->getMessage();
}
