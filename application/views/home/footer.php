    <script>
        window.onload = function() {
            switchTab("<?= $_SESSION['tab'] ?? '' ?>");
            document.getElementById('amznBanners_assoc_banner_placement_default_0_a').target = '_blank';
            document.getElementById('amznBanners_assoc_banner_placement_default_1_a').target = '_blank';
        }
    </script>
    <?php if ($_SESSION['editMode']) { ?>
        <script>toggleEditMode()</script>
    <?php } ?>
    <footer class="footer">
        <?php include AD_PATH . 'media.net.php'; ?>
        <div class="case-ad">
            <?php include AD_PATH . 'iphone-cases.php'; ?>
        </div>
        <div class="footer-note donate">
            <a href="https://www.buymeacoffee.com/iostheme" target="_blank"><p class="donate-note">Like that this site is free?</p><img src="https://img.buymeacoffee.com/button-api/?text=Buy me a beer&emoji=🍺&slug=iostheme&button_colour=FFDD00&font_colour=000000&font_family=Cookie&outline_colour=000000&coffee_colour=ffffff"></a>
        </div>
        <div class="footer-row">
            <div class="footer-note">
                <p class="contact">Made with love by <a href="https://github.com/beingforthebenefit" target="_BLANK">Gerald Todd</a></p>
            </div>
            <div class="footer-note">
                <a href="https://twitter.com/intent/tweet?screen_name=iOSThemeLive&ref_src=twsrc%5Etfw" class="twitter-mention-button" data-show-count="false">Tweet to @iOSThemeLive</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </footer>
</body> 