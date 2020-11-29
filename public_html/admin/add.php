<?php
require '../../bootloader.php';

if (!is_logged_in()) {
    header("Location: /login.php");
    exit();
}

$nav = nav();

$form = [
    'attr' => [
        'method' => 'POST'
    ],
    'fields' => [
        'X' => [
            'label' => 'X-cooordinate',
            'type' => 'number',
            'value' => '',

            'validators' => [
                'validate_field_not_empty',
                'validate_proper_number',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'x-axis',
                    'class' => 'input-field',
                    'min' => '0',
                    'max' => '490',
//                    'step' => '10',
                ]
            ]
        ],
        'Y' => [
            'label' => 'Y-cooordinate',
            'type' => 'number',
            'value' => '',

            'validators' => [
                'validate_field_not_empty',
                'validate_proper_number',

            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'y-axis',
                    'class' => 'input-field',
                    'min' => '0',
                    'max' => '490',
//                    'step' => '10',
                ]
            ]
        ],
        'color' => [
            'label' => 'choose color',
            'type' => 'select',
            'options' => [
                'red' => 'red',
                'green' => 'green',
                'blue' => 'blue',
                'yellow' => 'yellow',
            ],
            'validators' => [
                'validate_select',
            ],
            'value' => 'Not-Vegan'
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Prideti',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn'
                ]
            ]
        ],
        'clear' => [
            'title' => 'Clear',
            'type' => 'reset',
            'extra' => [
                'attr' => [
                    'class' => 'btn'
                ]
            ]
        ],
    ],
    'validators' => [
        'validate_tetris_unique' => [
        'X',
        'Y'
        ],
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $success = validate_form($form, $clean_inputs);

    if ($success) {
        $card_id = [
            'id' => $_SESSION['email']
        ];
        $fileDB = new FileDB(DB_FILE);

        $fileDB->load();
        $fileDB->createTable('items');
        $fileDB->insertRow('items', $clean_inputs + $card_id);
        $fileDB->save();

        $p = 'Tetriso blokelis pridetas';
    } else {
        $p = 'Uzpildyki visus laukus';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/media/style.css">
    <title>Add</title>
</head>
<body>
<main>

    <?php require ROOT . '/app/templates/nav.tpl.php'; ?>

    <article class="wrapper">
        <h1 class="header header--main">Pridėti spalvotą blokelį</h1>

        <?php require ROOT . '/core/templates/form.tpl.php'; ?>

        <?php if (isset ($p)): ?>
            <p><?php print $p; ?></p>
        <?php endif; ?>

    </article>
</main>
</body>
</html>

