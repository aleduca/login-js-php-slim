<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header('Access-Control-Allow-Headers: Content-Type');

require '../vendor/autoload.php';
require 'bootstrap.php';

use app\controllers\LoginController;

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->post('/login', [LoginController::class, 'store']);

$app->run();
