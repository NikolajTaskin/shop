<?php

use App\App;
use App\Views\BasePage;
use Core\Views\Link;
use Core\Views\Table;
use App\Views\Forms\Admin\DeleteForm;

require '../../bootloader.php';

if (!App::$session->getUser()) {
    header("Location: /login.php");
    exit();
}

if (isset($_POST['id'])) {
    App::$db->deleteRow('items', $_POST['id']);
}

$rows = App::$db->getRowsWhere('items');

foreach ($rows as $id => $row){
    $link = new Link([
        'link' => "/admin/edit.php?id={$id}",
        'text' => 'Edit'
    ]);

    $remove = new DeleteForm();
    $remove->fill(['id' => $id]);

    $rows[$id]['link'] = $link->render();
    $rows[$id]['remove'] = $remove->render();
}

$table = new Table([
    'headers' => [
        'Item',
        'Price',
        'Image url',
        'Description',
        'Options',
        'Remove'
    ],
    'rows' => $rows
]);

$page = new BasePage([
    'title' => 'Edit List',
    'content' => $table->render()
]);



print $page->render();

