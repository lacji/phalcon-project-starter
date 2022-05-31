<?php

use Phalcon\Autoload\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

(new Loader())
    ->setDirectories([
        BASE_PATH . '/src/controllers/',
    ])
    ->register();

$container = new FactoryDefault();

$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(BASE_PATH . '/src/views/');
        return $view;
    }
);

try {
    $application = new Application($container);
    $application
        ->handle($_SERVER["REQUEST_URI"])
        ->send();
}
catch (Exception $e) {
    echo $e->getMessage();
}
