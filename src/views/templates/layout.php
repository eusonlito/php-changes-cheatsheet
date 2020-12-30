<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title><?= $title; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="author" content="Lito && Óscar Otero">
        <meta name="title" content="<?= $title; ?>">

        <meta property="og:title" content="<?= $title; ?>">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@lito_ordes">
        <meta name="twitter:creator" content="@lito_ordes">
        <meta name="twitter:title" content="<?= $title; ?>">

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
