<!doctype html>

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

    <title>iDevice Icon Themer</title>
    <meta name="description" content="iDevice Icon Themer">
    <meta name="author" content="Gerald Todd">

    <script src="/js/file-upload.js?rnd=<?= rand(0, 1000) ?>"></script>
    <script src="/js/search.js?rnd=<?= rand(0, 1000) ?>"></script>
    <script src="/js/tabs.js?rnd=<?= rand(0, 1000) ?>"></script>
    <link rel="stylesheet" href="/css/style.css?rnd=<?= rand(0, 1000) ?>">
    <link rel="stylesheet" href="/css/iphone.css?rnd=<?= rand(0, 1000) ?>">
    <link rel="stylesheet" href="/css/iphone-switch.css?rnd=<?= rand(0, 1000) ?>">

</head>

<body>
    <?php if (array_key_exists('errors', $_SESSION)) { 
        foreach ($_SESSION['errors'] as $error) { ?>
            <div class="error-wrap">
                <p class="error"><?= $error ?></p>
            </div>
        <?php } ?>
    <?php $_SESSION['errors'] = [ ];
    } ?>