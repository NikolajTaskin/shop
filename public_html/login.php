<?php

use App\App;
use App\Views\BasePage;
use App\Views\Forms\LoginForm;


require '../bootloader.php';

$controller = new \App\Controllers\LoginController();

print $controller->index();

