<?php

use App\App;
use App\Views\BasePage;
use App\Views\Forms\Admin\AddForm;
use App\Views\Navigation;

require '../../bootloader.php';

$nav = new Navigation();

$form = new AddForm();

if ($form->validate()) {
    $card_id = [
        'id' => $_SESSION['email']
    ];
    $item_id = [
        'item_id' => uniqid()
    ];
    $clean_inputs = $form->values();
    $items= App::$db->insertRow('items', $clean_inputs + $card_id + $item_id);
}

$page = new BasePage([
        'title' => 'Add',
        'content' => $form->render(),
    ]
);

print $page->render();

?>

