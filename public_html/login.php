<?php

require '../bootloader.php';

use App\App;
use App\Views\BasePage;
use App\Views\Forms\LoginForm;
use App\Views\Navigation;
use Core\Cookie;

if (App::$session->getUser()) {
    header('Location: /index.php');
    exit();
}

$nav = new Navigation();

$form = new LoginForm();

if ($form->validate()) {
    $clean_inputs = $form->values();
    App::$session->login($clean_inputs['email'], $clean_inputs['password']);
    $cookie = new Cookie('User_id');
    $cookie->cookieValue($clean_inputs['email']);
    $cookie->cookieTime(strtotime('+ 10 days'));
    $cookie->set();

    header('Location: /index.php');
}

$page = new BasePage([
        'title' => 'Login',
        'content' => $form->render(),
    ]
);

print $page->render();

?>
