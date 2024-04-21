<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return static function (App $app, $debugMode) {

    // Create Twig
    $twig = Twig::create(__DIR__ . $_ENV['TEMPLATE_PATH'], ['cache' => !$debugMode]);

    // Add Twig-View Middleware
    $app->add(TwigMiddleware::create($app, $twig));

    $app->get('/', function (Request $request, Response $response, $args) {
        return Twig::fromRequest($request)->render($response, 'home.twig');
    })->setName('home');
};
