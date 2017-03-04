<?php
require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use ThirdBridge\ThirdBridgeCommand;

$application = new Application();
$application->add(new ThirdBridgeCommand());
$application->run();
