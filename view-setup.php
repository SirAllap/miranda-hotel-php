<?php
//env variables
require_once __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/')->load();
//Template

use eftec\bladeone\BladeOne;

$blade = new BladeOne();
