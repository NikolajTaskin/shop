<?php
require '../../bootloader.php';

if (!is_logged_in()) {
    header("Location: /login.php");
    exit();
}
$db_data = file_to_array(DB_FILE);
$nav = nav();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/media/style.css">
    <title>Personal bloxs</title>
    <style>
        .grid-item {
            width: 10px;
            height: 10px;
            position: fixed;
            z-index: 1;
        }
    </style>
</head>
<body>
<main>

    <?php require ROOT . '/app/templates/nav.tpl.php'; ?>
    <section class="wrapper">
        <section class="grid-container">
        <?php if (isset($db_data['items'])): ?>
            <article class="items_box">
                <?php foreach ($db_data['items'] as $item): ?>
                    <?php if (isset($item['id']) && $item['id'] === $_SESSION['email']): ?>
                <div class="grid-item" style="position: fixed; z-index: 2; left: <?php print $item['X']; ?>px; top: <?php print $item['Y']; ?>px; background-color: <?php print $item['color']; ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </article>
        <?php endif; ?>
        </section>
    </article>
</main>
</body>
</html>