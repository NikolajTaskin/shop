<?php


namespace App\Views\Forms\Admin;

use Core\Views\Form;

class DeleteForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
            ],
            'fields' => [
                'id' => [
                    'type' => 'hidden',
                ],
            ],
            'buttons' => [
                'delete' => [
                    'title' => 'Delete',
                    'type' => 'delete',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn',
                        ],
                    ],
                ],
            ],
        ]);
    }
}