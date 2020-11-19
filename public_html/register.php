<?php

require '../bootloader.php';

if (is_logged_in()) {
    header("Location: /index.php");
    exit();
}


$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'email' => [
            'label' => 'El. paštas',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_email',
                'validate_user_unique',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk emailą',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password' => [
            'label' => 'Slaptažodis',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk slaptažodį',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password_repeat' => [
            'label' => 'Pakartok slaptažodį',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk slaptažodį dar kartą',
                    'class' => 'input-field',
                ]
            ]
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Registruokis',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $is_valid = validate_form($form, $clean_inputs);

    if ($is_valid) {
        unset($clean_inputs['password_repeat']);

        // Get data from file
        $input_from_json = file_to_array(ROOT . '/app/data/db.json');
        // Append new data from form
        $input_from_json[] = $clean_inputs;
        // Save old data together with appended data back to file
        array_to_file($input_from_json, ROOT . '/app/data/db.json');

        $text_output = 'Sveikinu užsiregistravus';
    } else {
        $text_output = 'Registracija nesekminga';
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
    <title>Naujo vartotojo registracija</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php require ROOT . '/core/templates/nav.tpl.php'; ?>
    </header>
    <main>
        <h2>Registruokis</h2>
        <?php require ROOT . '/core/templates/form.tpl.php'; ?>
        <?php if (isset($text_output)) print $text_output; ?>
    </main>
</body>
</html>

