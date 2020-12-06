<?php

use App\App;
use App\Views\BasePage;
use App\Views\Forms\Admin\EditForm;
use App\Views\Navigation;
use Core\View;

require '../../bootloader.php';

$content = new View([
    'title' => 'Welcome to the eSHOP',
    'products' => App::$db->getRowsWhere('items'),
]);


$nav = new Navigation();

$form = new EditForm();

$page = new BasePage([
    'title' => 'Index',
    'content' => $form->render(),
]);
//
//if ($form->validate()) {
//
//    $clean_inputs = $form->values();
//    $items= App::$db->insertRow('items', $clean_inputs);
//}

print $page->render();


?>
