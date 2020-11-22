<div class="app">
    <form method="post" action="#phone" class="delete-button hidden">
        <input type="hidden" name="a" value="delete" />
        <input type="hidden" name="delete" class="hidden" value="<?= $icon->PayloadUUID ?>" />
        <input class="app-close" type="submit" name="remove" value="&#8212;" />
    </form>
    <img class="icon" src="data:image;base64,<?= $icon->Icon ?>" />
    <p class="icon-label" title="<?= $icon->Label ?>">
        <?= $icon->Label ?>
    </p>
</div>