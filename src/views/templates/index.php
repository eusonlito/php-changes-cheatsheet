<header class="main-header">
    <h1>PHP Changes Cheatsheet</h1>
</header>

<main class="index-main">
    <ul>
        <?php foreach ($groups as $group) { ?>
        <li><a href="<?= $group['link']; ?>">&raquo; <?= $group['title']; ?></a></li>
        <?php } ?>

        <li><a href="all.html">&raquo; All</a></li>
        <li><a href="https://github.com/eusonlito/php-changes-cheatsheet" target="_blank">&raquo; About this project in Github</a></li>
    </ul>
</main>