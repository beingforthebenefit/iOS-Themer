<?php if (!empty($_SESSION['errors'])) { ?>
    <?php foreach ($_SESSION['errors'] as $error) { ?>
        <div class="error-wrap">
            Error: <?= $error ?>
        </div>
    <?php } ?>
<?php }