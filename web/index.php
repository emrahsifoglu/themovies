<?php
require_once '../src/config.php';
require_once '../src/init.php';

$app = new App();
$app->addRoute('login', 'Login', false);
$app->addRoute('movies', 'Movie', true);
$app->addRoute('logout', 'Logout', false);
$app->run();