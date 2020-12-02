<?php
    // unique ID to append to assets to prevent caching
    $u = '?random=' . rand(0, 1000);
?>
<!doctype html>

<!-- Hi, Awin. This is Gerald Todd, the owner of this site! -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- For favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- End favicons -->

    <!-- Media.net stuff -->
    <script type="text/javascript">
        window._mNHandle = window._mNHandle || {};
        window._mNHandle.queue = window._mNHandle.queue || [];
        medianet_versionId = "3121199";
    </script>
    <script src="https://contextual.media.net/dmedianet.js?cid=8CUFVB521" async="async"></script>
    <!-- End Media.net stuff -->

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

    <title>iDevice Icon Themer</title>
    <meta name="description" content="iDevice Icon Themer">
    <meta name="author" content="Gerald Todd">

    <script src="/js/file-upload.js<?= $u ?>"></script>
    <script src="/js/search.js<?= $u ?>"></script>
    <script src="/js/tabs.js<?= $u ?>"></script>
    <script src="/js/edit-mode.js<?= $u ?>"></script>
    <script src="/js/donate.js<?= $u ?>"></script>
    <link rel="stylesheet" href="/css/style.css<?= $u ?>">
    <link rel="stylesheet" href="/css/iphone.css<?= $u ?>">
    <link rel="stylesheet" href="/css/iphone-switch.css<?= $u ?>">
</head>

<body>
    <div class="header-wrap">
        <div class="logo">
            <a href="/">
                <img class="logo" src="/images/logo.png" title="iOSTheme.live" alt="iOSTheme.live" />
            </a>
        </div>
        <div class="instructions">
            <a class="menu-link" href="/?c=Instructions">
                <span class="menu-label">How Do I Use This?</span>
                <span class="menu-icon">🤔</span>
            </a>
            <br />
            <a class="menu-link" href="/?a=loadIcons#phone">
                <span class="menu-label">Load Some Default Apps</span>
                <span class="menu-icon">📲</span>
            </a><br />
            <a class="menu-link" href="/?c=FindIcons">
                <span class="menu-label">Find Icons for Your Device!</span>
                <span class="menu-icon">🔎</span>
            </a>
        </div>
    </div>
    <?php if (array_key_exists('messages', $_SESSION)) {
        foreach ($_SESSION['messages'] as $error) { ?>
            <div class="message-wrap">
                <p class="message"><?= $error ?></p>
            </div>
        <?php }
        $_SESSION['messages'] = [ ];
    }
    if (array_key_exists('errors', $_SESSION)) {
        foreach ($_SESSION['errors'] as $error) { ?>
            <div class="error-wrap">
                <p class="error"><?= $error ?></p>
            </div>
        <?php }
    $_SESSION['errors'] = [ ];
    } ?>