<?php


namespace App\Views\Forms\Admin;

use Core\Views\Form;

class EditForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'GET',
            ],
            'fields' => [
                'item_name' => [
                    'label' => 'Item name',
                    'type' => 'text',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Type item name',
                            'class' => 'input-field',
                        ],
                    ],
                ],
                'item_photo' => [
                    'label' => 'Item photo',
                    'type' => 'text',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Add image url',
                            'class' => 'input-field',
                        ],
                    ],
                ],
                'item_price' => [
                    'label' => 'Item price',
                    'type' => 'number',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Type price $ ',
                            'class' => 'input-field',
                        ],
                    ],
                ],
            ],
            'buttons' => [
                'send' => [
                    'title' => 'Save changes',
                    'type' => 'submit',
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