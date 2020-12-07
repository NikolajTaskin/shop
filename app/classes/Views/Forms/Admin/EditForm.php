<?php

namespace App\Views\Forms\Admin;

use Core\Views\Form;

class EditForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST'
            ],
            'fields' => [
                'name' => [
                    'label' => 'Title',
                    'type' => 'text',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Title',
                            'class' => 'input-field'
                        ]
                    ]
                ],
                'price' => [
                    'label' => 'Price',
                    'type' => 'number',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Price',
                            'class' => 'input-field'
                        ]
                    ]
                ],
                'img' => [
                    'label' => 'Product image',
                    'type' => 'text',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'http://url',
                            'class' => 'input-field'
                        ]
                    ]
                ],
                'description' => [
                    'label' => 'Description',
                    'type' => 'textarea',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Save changes',
                    'type' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn'
                        ]
                    ]
                ],
//                'clear' => [
//                    'title' => 'Clear',
//                    'type' => 'reset',
//                    'extra' => [
//                        'attr' => [
//                            'class' => 'btn'
//                        ]
//                    ]
//                ]
            ]
        ]);
    }
}