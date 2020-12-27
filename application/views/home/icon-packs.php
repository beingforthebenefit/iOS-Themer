<link rel="stylesheet" href="/css/card-style.css<?= $u ?>">
<div class="container">
    <?php foreach ((new PackModel('packs'))->rows() as $pack) { ?>
        <div class="card" style="background:url(/images/icon-pack-previews/<?= $pack['background'] ?>)">
            <div class="content">
                <h3><?= $pack['title'] ?></h3>
                <a href="<?= $pack['link1Url'] ?>"><?= $pack['link1Text'] ?></a><br />
                <a href="<?= $pack['link2Url'] ?>" <?= $pack['paid'] ? 'class="gumroad-button"' : '' ?>><?= $pack['link2Text'] ?></a>
                <p><?= $pack['description'] ?></p>
            </div>
        </div>
    <?php } ?>
</div>
