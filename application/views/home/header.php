<?php
    // unique ID to append to assets to prevent caching
    $u = '?random=' . rand(0, 1000);
    // determine if we're on dev or production
    $dev = explode('.', $_SERVER['HTTP_HOST'])[1] == "live" ? false : true;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- For favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <!-- End favicons -->

        <?php if (!$dev) { ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-KCM2YB8CJ6"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'G-KCM2YB8CJ6');
            </script>

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-183654641-1">
            </script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-183654641-1');
            </script>
            <!-- End Google stuff -->
        <?php } ?>

        <!-- This is a link to BoxIcons by jsDelivr on GitHub. -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- This is CSS -->
        <link rel="stylesheet" href="/css/styles.css<?= $u ?>">

        <title>22over7</title>
        <meta name="description" content="22over7 iOS icon themer.">
        <meta name="author" content="Gerald Todd and Ubaid Dafedar">

        <!-- Stuff that may be specific to the theming page -->
        <script src="/js/file-upload.js<?= $u ?>"></script>
        <script src="/js/search.js<?= $u ?>"></script>
        <script src="/js/edit-mode.js<?= $u ?>"></script>
        <script src="/js/donate.js<?= $u ?>"></script>
        <script src="/js/icon-edit.js<?= $u ?>"></script>
        <script src="/js/gumroad/gumroad.js<?= $u ?>"></script>
        <link rel="stylesheet" href="/css/style.css<?= $u ?>">
        <link rel="stylesheet" href="/css/iphone.css<?= $u ?>">
        <link rel="stylesheet" href="/css/iphone-switch.css<?= $u ?>">
        <!-- End theming-specific stuff -->
    </head>