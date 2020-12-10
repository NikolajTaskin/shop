<?php

namespace App\Views\Tables\Admin;

use App\App;
use App\Views\Forms\Admin\DeleteForm;
use Core\Views\Link;
use Core\Views\Table;

class ProductsTable extends Table
{
    public function __construct()
    {
        $rows = App::$db->getRowsWhere('pizzas');

        foreach ($rows as $id => $row) {
            $link = new Link([
                'link' => "/edit?id={$id}",
                'text' => 'Edit'
            ]);

            $rows[$id]['link'] = $link->render();

            $deleteForm = new DeleteForm($id);
            $rows[$id]['delete'] = $deleteForm->render();
        }

        parent::__construct([
            'headers' => [
                'Pizza',
                'Price',
                'Image url',
                'Options',
                'Remove'
            ],
            'rows' => $rows
        ]);
    }
}