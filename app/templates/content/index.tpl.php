<h1 class="header header--main"><?php print $data['title']; ?></h1>
<h3 class="header"><?php print $data['heading']; ?></h3>
<section class="grid-container">

    <?php foreach ($data['products'] as $product) : ?>
        <?php if (App\App::$session->getUser()): ?>

            <?php if (App\App::$session->getUser()['role'] === 'admin') : ?>

                         <div class="grid-item">
                            <h4><?php print $product['name']; ?></h4>
                            <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                            <p><?php print $product['price']; ?> $</p>
                             <button>Edit</button>
                             <button>Delete</button>
                        </div>

            <?php else: ?>
                        <div class="grid-item">
                            <h4><?php print $product['name']; ?></h4>
                            <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                            <p><?php print $product['price']; ?> $</p>
                            <button>Order</button>
                        </div>
            <?php endif; ?>

        <?php else: ?>

                <div class="grid-item">
                    <h4><?php print $product['name']; ?></h4>
                    <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                    <p><?php print $product['price']; ?> $</p>
                </div>

        <?php endif; ?>
    <?php endforeach; ?>

</section>
<?php if (App\App::$session->getUser()): ?>

    <?php if (App\App::$session->getUser()['role'] === 'admin') : ?>

        <button>Create</button>

    <?php else: ?>

    <?php endif; ?>

<?php else: ?>

    <button>Login</button>

<?php endif; ?>
