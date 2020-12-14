                </div>
            </section>
        </main>

        <!-- This is just specific to the installer page -->    
        <?php if (array_key_exists('editMode', $_SESSION) && $_SESSION['editMode']) { ?>
            <script>toggleEditMode()</script>
        <?php } ?>
        <!-- End installer-specific stuff -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>

        <script src="/js/main.js"></script>
    </body>
</html>