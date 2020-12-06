<?php

use App\App;
use App\Views\BasePage;
use App\Views\Navigation;
use Core\Cookie;
use Core\View;

require '../bootloader.php';

$content = new View([
    'title' => 'Welcome to the eSHOP',
    'products' => App::$db->getRowsWhere('items'),
]);


$cookie = new Cookie('User_id');
$cookie->getCookie();

$nav = new Navigation();

$page = new BasePage([
    'title' => 'Index',
    'content' => $content->render(ROOT . '/app/templates/content/index.tpl.php'),
]);

print $page->render();
?>
