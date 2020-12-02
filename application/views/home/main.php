    <?php include CURR_VIEW_PATH . 'top.php' ?>

    <div class="page-wrap">
        <img class="background-left" src="/images/background-left.svg">
        <img class="background-right" src="/images/background-right.svg">

        <!-- Home -->

        <div class="home <?= array_key_exists('page', $_SESSION) ? ('home' == $_SESSION['page'] ? '' : 'hidden') : '' ?>" id="home">
            <?php include CURR_VIEW_PATH . 'home.php' ?>
        </div>

        <!-- end Home -->

        <!-- How To -->

        <div class="how-to <?= 'how-to' == $_SESSION['page'] ? '' : 'hidden' ?>" id="how-to">
            <?php include CURR_VIEW_PATH . 'how-to.php' ?>
        </div>

        <!-- end How To -->

        <!-- Installer -->

        <div class="installer <?= 'installer' == $_SESSION['page'] ? '' : 'hidden' ?>" id="installer">
            <div class="form-container" id="upload">
                <h1 class="header">1. Add as Many Apps As You Want</h1>
                <?php include CURR_VIEW_PATH . 'upload.php' ?>
            </div>

            <div class="phone-container" id="phone">
                <?php include CURR_VIEW_PATH . 'phone.php' ?>
            </div>

            <div class="download-container" id="download">
                <h1 class="header">2. Install On Your Device</h1>
                <?php include CURR_VIEW_PATH . 'download.php' ?>
            </div>
            
        </div>

        <!-- end Installer -->

        <!-- Icon Packs -->

        <div class="icon-packs <?= 'icon-packs' == $_SESSION['page'] ? '' : 'hidden' ?>" id="icon-packs">
            <?php include CURR_VIEW_PATH . 'icon-packs.php' ?>
        </div>

        <!-- end Icon Packs -->

    </div>
