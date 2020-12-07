    <script>
        switchTab("<?= $_SESSION['tab'] ?? '' ?>");
    </script>
    <?php if (array_key_exists('editMode', $_SESSION) && $_SESSION['editMode']) { ?>
        <script>toggleEditMode()</script>
    <?php } ?>
    <footer class="footer">
        <div class="footer-row">
            <div class="footer-note">
                <p class="contact">Made with love by <a href="https://github.com/beingforthebenefit" target="_BLANK">Gerald Todd</a>. Designed by <a href="https://twitter.com/ubaidafedar" target="_BLANK">Ubaid D.</a></p>
            </div>
            <div class="footer-note">
                <a href="https://twitter.com/intent/tweet?screen_name=iOSThemeLive&ref_src=twsrc%5Etfw" target="_BLANK">Tweet to @iOSThemeLive</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </footer>
</body> 