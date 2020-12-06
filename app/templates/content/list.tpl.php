<section class="wrapper">
    <section class="grid-container">
        <?php if (isset($data['products'])): ?>
            <article class="grid-container">
                <?php foreach ($data['products'] as $product) : ?>
                <?php if (isset($product['id']) && $product['id'] === $_SESSION['email']): ?>
                        <div class="grid-item">
                            <h2 class="item-name"><?php print $product['item_name']; ?></h2>
                            <img class="item-img" src="<?php print $product['item_photo']; ?>" alt="">
                            <h2>Price: <?php print $product['item_price'] ?> eur</h2>
                            <form method="POST" action="/admin/edit.php">
                                <input type="hidden" name="id" value="<?php print $product['item_id']; ?>">
                                <button class="btn" type="submit">Edit item</button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
            </article>
        <?php endif; ?>
    </section>
</section>

