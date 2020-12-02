<body>
    <div class="top-wrap">
        <div class="logo-wrap">
            22over7
        </div>
        <div class="nav-wrap">
            <div class="nav-link-wrap">
                <a class="nav-link active" id="home-link" onclick="changePage('home')">
                    Home
                </a>
            </div>
            <div class="nav-link-wrap" id="how-to-link" onclick="changePage('how-to')">
                <a class="nav-link">
                    How To
                </a>
            </div>
            <div class="nav-link-wrap" id="installer-link" onclick="changePage('installer')">
                <a class="nav-link">
                    iOS Themer
                </a>
            </div>
            <div class="nav-link-wrap" id="icon-packs-link" onclick="changePage('icon-packs')">
                <a class="nav-link">
                    Icon Packs
                </a>
            </div>
        </div>
    </div>










    <!-- <div class="header-wrap">
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
    </div> -->
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