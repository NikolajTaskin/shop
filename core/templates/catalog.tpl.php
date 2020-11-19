<?php foreach ($catalog as $item): ?>
    <div class="card">
        <h4><?php print $item['title']; ?></h4>
        <img src="<?php print $item['image']; ?>" alt="goods">
        <h4><?php print $item['price']; ?> $</h4>
        <h5><?php print $item['description']; ?></h5>
    </div>
<?php endforeach; ?>