<body>
    <div class="top-wrap">
        <div class="logo-wrap">
            22over7
        </div>
        <div class="nav-wrap">
            <div class="nav-link-wrap">
                <a class="nav-link <?= array_key_exists('page', $_SESSION) ? ('home' == $_SESSION['page'] ? 'active' : '') : 'active' ?>" id="home-link" onclick="changePage('home')">
                    Home
                </a>
            </div>
            <div class="nav-link-wrap <?= 'how-to' == $_SESSION['page'] ? 'active' : '' ?>" id="how-to-link" onclick="changePage('how-to')">
                <a class="nav-link">
                    How To
                </a>
            </div>
            <div class="nav-link-wrap <?= 'installer' == $_SESSION['page'] ? 'active' : '' ?>" id="installer-link" onclick="changePage('installer')">
                <a class="nav-link">
                    iOS Themer
                </a>
            </div>
            <div class="nav-link-wrap">
                <a class="nav-link" href="https://flurly.com/s/22over7" target="_BLANK">
                    Icon Packs
                </a>
            </div>
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