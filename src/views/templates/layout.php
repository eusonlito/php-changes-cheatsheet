<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title><?= $title; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="author" content="Lito && Óscar Otero">
        <meta name="title" content="<?= $title; ?>">

        <meta property="og:type" content="website">
        <meta property="og:url" content="https://eusonlito.github.io/php-changes-cheatsheet/">
        <meta property="og:title" content="<?= $title; ?>">
        <meta property="og:description" content="Look up new features, deprecations, and breaking changes across PHP versions.">
        <meta property="og:image" content="https://eusonlito.github.io/php-changes-cheatsheet/images/php-changes-cover.jpg">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="PHP Changes Cheatsheet beside a purple elephant raising its trunk.">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="https://eusonlito.github.io/php-changes-cheatsheet/">
        <meta name="twitter:site" content="@lito_ordes">
        <meta name="twitter:creator" content="@lito_ordes">
        <meta name="twitter:title" content="<?= $title; ?>">
        <meta name="twitter:image" content="https://eusonlito.github.io/php-changes-cheatsheet/images/php-changes-cover.jpg">
        <meta name="twitter:image:alt" content="PHP Changes Cheatsheet beside a purple elephant raising its trunk.">

        <link href="//fonts.googleapis.com/css?family=Fira+Sans|Droid+Sans|Source+Sans+Pro" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="./phpnet.css?<?= time(); ?>" type="text/css" media="screen">
        <link rel="stylesheet" href="./styles.css?<?= time(); ?>" type="text/css" media="screen">

        <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="./favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">

        <link rel="icon" href="./favicon.ico" type="image/x-icon">

        <meta name="theme-color" content="#ffffff">
    </head>

    <body class="<?= $class; ?>">
        <?= $content; ?>
    </body>
</html>
