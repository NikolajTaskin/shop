<?php
require '../bootloader.php';

$nav = nav();

if (is_logged_in()) {
    $h3 = "Sveiki sugrize {$_SESSION['email']}";
} else {
    $h3 = 'Jus neprisijunges';
}

$fileDB = new FileDB(DB_FILE);
$fileDB->load();
$products = $fileDB->getRowsWhere('items');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/media/style.css">
    <title>Shop</title>
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

    <article class="wrapper">
        <h1 class="header header--main">Welcome to P-OOPWALL</h1>
        <h3 class="header"><?php print $h3; ?></h3>
        <section class="grid-container">

            <?php foreach ($products as $product) : ?>
                    <div class="grid-item" style="
                                                left: <?php print $product['X']; ?>px;
                                                top: <?php print $product['Y']; ?>px;
                                                background-color: <?php print $product['color']; ?>">
            <?php endforeach; ?>

        </section>
    </article>
</main>
</body>
</html>