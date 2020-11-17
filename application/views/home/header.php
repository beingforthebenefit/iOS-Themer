<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- For favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- End favicons -->

    <title>iDevice Icon Themer</title>
    <meta name="description" content="iDevice Icon Themer">
    <meta name="author" content="Gerald Todd">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/js/file-upload.js"></script>
    <script src="/js/search.js"></script>
    <link rel="stylesheet" href="/css/style.css">

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
