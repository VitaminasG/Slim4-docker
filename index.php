<?php
declare(strict_types=1);

use DI\Container;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/vendor/autoload.php';

// Load .env variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/config');
$dotenv->safeLoad();

// Instantiate PHP-DI Container
$container = new Container;

AppFactory::setContainer($container);
$app = AppFactory::create();

// Should be set to false in production
$debugMode = (bool)$_ENV['DEBUG_MODE'];

// Add Routing Middleware
$app->addRoutingMiddleware();

// Logger registration
$logger = new Logger($_ENV['LOGGER_NAME']);
$streamHandler = new StreamHandler(__DIR__ . $_ENV['LOGGER_PATH'], (int)$_ENV['LOGGER_LEVEL']);
$logger->pushHandler($streamHandler);

// Add Error Middleware with Logger
$app->addErrorMiddleware(
    (bool)$_ENV['DISPLAY_ERROR_DETAILS'],
    (bool)$_ENV['LOG_ERRORS'],
    (bool)$_ENV['LOG_ERROR_DETAILS'],
    $logger
);

// Register routes
$routes = require __DIR__ . '/config/routes.php';
$routes($app, $debugMode);

$app->run();
