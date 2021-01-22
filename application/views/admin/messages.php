<?php if (!is_empty($_SESSION['errors'])) { ?>
    <?php foreach ($_SESSION['errors'] as $error) { ?>
        <h3 class="error">
            <?= "Error: <?= $error" ?> ?>
        </h3>
    <?php } ?>
<?php }
$_SESSION['errors'] = [ ] ?>