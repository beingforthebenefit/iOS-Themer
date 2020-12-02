    <?php var_dump(); ?>
    <script>
            //changePage("<?= $_SESSION['page'] ?>");
            switchTab("<?= $_SESSION['tab'] ?? '' ?>");
            document.getElementById('amznBanners_assoc_banner_placement_default_0_a').target = '_blank';
            document.getElementById('amznBanners_assoc_banner_placement_default_1_a').target = '_blank';
    </script>
    <?php if ($_SESSION['editMode']) { ?>
        <script>toggleEditMode()</script>
    <?php } ?>
    <footer class="footer">
        <?php include AD_PATH . 'media.net.php'; ?>
        <div class="footer-left">
            <?php include AD_PATH . 'iphone-cases.php'; ?>
        </div>
        <div class="footer-row">
            <div class="footer-note">
                <p class="contact">Made with love by <a href="https://github.com/beingforthebenefit" target="_BLANK">Gerald Todd</a>. Design by Ubaid D.</p>
            </div>
            <div class="footer-note">
                <a href="https://twitter.com/intent/tweet?screen_name=iOSThemeLive&ref_src=twsrc%5Etfw" class="twitter-mention-button" data-show-count="false">Tweet to @iOSThemeLive</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
        <div class="footer-right">
            <a href="https://www.buymeacoffee.com/iostheme" target="_blank"><p class="donate-note">Like that this site is free? Buy me a beer 🍻</p></a>
        </div>
    </footer>
</body> 