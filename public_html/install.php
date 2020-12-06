<?php

use App\App;
use Core\FileDB;

require '../bootloader.php';
App::$db = new FileDB(DB_FILE);
App::$db->createTable('users');
App::$db->insertRow('users', [
    'email' => 'test@test.com',
    'password' => '123',
]);
App::$db->createTable('items');

print 'DB cleared';
