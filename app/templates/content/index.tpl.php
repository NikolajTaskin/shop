<h1 class="title"><?php print $data['title'] ?></h1>
<section class="grid-container">
    <?php foreach ($data['products'] as $product) : ?>
        <div class="grid-item">
            <h2 class="item-name"><?php print $product['item_name']; ?></h2>
            <img class="item-img" src="<?php print $product['item_photo']; ?>" alt="">
            <h2>Price: <?php print $product['item_price'] ?> eur</h2>
        </div>
    <?php endforeach; ?>
</section>
