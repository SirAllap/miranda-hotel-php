<?php
//env variables
require_once __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/')->load();
//Template
require_once('lib/BladeOne.php');

use eftec\bladeone\BladeOne;

$views = 'views';
$compiledFolder = 'cache';

$blade = new BladeOne($views, $compiledFolder, BladeOne::MODE_AUTO);
