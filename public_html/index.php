<?php

require '../bootloader.php';

$catalog = file_to_array(ITEMS_FILE);

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pagrindinis puslapis</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php require ROOT . '/core/templates/nav.tpl.php'; ?>
    </header>
    <main>
        <h1>SVEIKI ATVYKĘ Į <br> BBŽ PARDUOTUVĘ</h1>
        <section class="catalog">
            <?php require ROOT . '/core/templates/catalog.tpl.php'; ?>
        </section>
    </main>
</body>
</html>

