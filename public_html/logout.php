<?php
require '../bootloader.php';

use App\App;
use Core\Cookie;

$cookie = new Cookie('User_id');
$cookie->unset();

App::$session->logout('index.php');

