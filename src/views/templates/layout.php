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
    </head>

    <body class="<?= $class; ?>">
        <?= $content; ?>
    </body>
</html>
