<?php if (!empty($_SESSION['errors'])) { ?>
    <?php foreach ($_SESSION['errors'] as $error) { ?>
        <h3 class="error">
            Error: <?php echo $error ?>
        </h3>
	<?php }
	}
$_SESSION['errors'] = [ ]; ?>