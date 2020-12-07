<h1 class="header main_header"><?php print $data['title']; ?></h1>
<h3 class="header"><?php print $data['heading']; ?></h3>
<section class="grid-container">

    <?php foreach ($data['products'] as $product) : ?>

        <div class="item_card">
            <h4><?php print $product['name']; ?></h4>
            <img class="item_image" src="<?php print $product['img']; ?>" alt="">
            <p><?php print $product['description']; ?></p>
            <p class="price"><?php print $product['price']; ?> $</p>
<!--            <form method="POST" action="/admin/edit.php">-->
<!--                <input type="hidden" name="id" value="--><?php //print $product['id']; ?><!--">-->
<!--            </form>-->
        </div>

    <?php endforeach; ?>

</section>
