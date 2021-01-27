<link rel="stylesheet" href="/css/card-style.css<?= $u ?>">
<div class="container">
    <?php foreach ((new PackModel('packs'))->getAllIconPacks() as $pack) {
        $previewFile = DS . 'images' . DS . 'icon-pack-previews' . DS . end(explode('/', $pack['url'])) . '.jpg'; ?>
        <div class="card" style="background:url('<?= $previewFile ?>')">
            <div class="content">
                <h3><?= $pack['name'] . ' - ' . $pack['price'] . strtoupper($pack['currency']) ?></h3>
                <a href="<?= $pack['url'] ?>" <?= $pack['paid'] && strpos('gum.co', $pack['url']) ? 'class="gumroad-button"' : '' ?>>Click to download!</a><br />
                <p class="icon-pack-description overflow"><?= $pack['description'] ?></p>
            </div>
        </div>
    <?php } ?>
</div>
