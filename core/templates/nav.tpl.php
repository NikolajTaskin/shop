<nav>
    <ul>
        <?php foreach (navigation_bar() as $page => $link): ?>
            <li><a href="<?php print $link; ?>"><?php print $page; ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>

