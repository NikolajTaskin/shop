<?php
require '../../bootloader.php';

if (!is_logged_in()) {
    header("Location: /login.php");
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'title' => [
            'label' => 'Pavadinimas',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Prekes pavadinimas',
                    'class' => 'input-field',
                ]
            ]
        ],
        'price' => [
            'label' => 'Kaina',
            'type' => 'number',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Prekes kaina',
                    'class' => 'input-field',
                ]
            ]
        ],
        'description' => [
            'label' => 'Prekes apibūdinimas',
            'type' => 'textarea',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Trumpai aprašyk parduodamą daiktą',
                    'class' => 'input-field',
                ]
            ]
        ],
        'image' => [
            'label' => 'Prekes nuotrauka',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įkelk prekės nuotraukos url',
                    'class' => 'input-field',
                ]
            ]
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Pridėti',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
];


$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $is_valid = validate_form($form, $clean_inputs);

    if ($is_valid) {

        // Get data from file
        $input_from_json = file_to_array(ROOT . '/app/items/db.json');
        // Append new data from form
        $input_from_json[] = $clean_inputs;
        // Save old data together with appended data back to file
        array_to_file($input_from_json, ROOT . '/app/items/db.json');

        $text_output = 'Preke prideta';
    } else {
        $text_output = 'Prekes prideti nepavyko';
    }
}


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Naujos prekės pridėjimas</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php require ROOT . '/core/templates/nav.tpl.php'; ?>
    </header>
    <main>
        <h2>Užregistruok naują prekę</h2>
        <?php require ROOT . '/core/templates/form.tpl.php'; ?>
        <?php if (isset($text_output)) print $text_output; ?>
    </main>
</body>
</html>