<nav class="nav-container">
    <ul class="nav-ul">
        <?php foreach ($data as $link => $text): ?>
            <li class="nav-li"><a class="li-a" href="<?php print $link ?>"><?php print $text; ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>