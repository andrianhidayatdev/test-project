<?php
require_once __DIR__ . '/../library/Router.php';
require_once __DIR__ . '/../app/Controller/PosController.php';

Router::add('GET', '/', PosController::class, 'index');
Router::add('POST', '/pos/add', PosController::class, 'save');
Router::run();
