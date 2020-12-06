<?php

use App\App;
use App\Views\BasePage;
use App\Views\Forms\RegisterForm;
use App\Views\Navigation;

require '../bootloader.php';

if (App::$session->getUser()) {
    header('Location: login.php');
    exit();
}

$nav = new Navigation();

$form = new RegisterForm();

if ($form->validate()) {
    $clean_inputs = $form->values();
    unset($clean_inputs['password_repeat']);
    $user = $clean_inputs;

    App::$db->insertRow('users', $user);

    header('Location: login.php');
}

$page = new BasePage([
        'title' => 'Register',
        'content' => $form->render(),
    ]
);

print $page->render();

?>


